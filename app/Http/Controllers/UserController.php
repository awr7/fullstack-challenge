<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $usersQuery = User::query();

        // Handle country filter
        if ($request->filled('country')) {
            $usersQuery->where('country', $request->country);
        }

        // Add counts for comments, I defined today as in the last 24 hours and yesterday as between 24-48 hours ago
        $users = $usersQuery->withCount([
            'comments as comments_today' => function ($query) {
                $query->where('created_at', '>=', now()->subDay());
            },
            'comments as comments_yesterday' => function ($query) {
                $query->where('created_at', '>=', now()->subDays(2))
                      ->where('created_at', '<', now()->subDay());
            }
        ])->get();

        // Apply filtering in PHP
        if ($request->filled('comment_activity_trend')) {
            $trend = $request->input('comment_activity_trend');
            $users = $users->filter(function ($user) use ($trend) {
                if ($trend === 'higher') {
                    return $user->comments_today > $user->comments_yesterday;
                } elseif ($trend === 'lower') {
                    return $user->comments_today < $user->comments_yesterday;
                } elseif ($trend === 'neutral') {
                    return $user->comments_today === $user->comments_yesterday;
                }
                return true;
            });
        }

        // Apply sorting in PHP
        $sort_by = $request->input('sort_by', 'created_at');
        if ($sort_by === 'comments_today') {
            $users = $users->sortByDesc('comments_today');
        } else {
            $users = $users->sortByDesc('created_at');
        }

        // Paginate the results manually
        $page = $request->get('page', 1);
        $perPage = 5;
        $paginatedUsers = $users->forPage($page, $perPage)->values();

        $response = $paginatedUsers->map(function ($user) {
            $commentsToday = $user->comments_today;
            $commentsYesterday = $user->comments_yesterday;
            $trend = $commentsToday > $commentsYesterday ? 'higher' :
                     ($commentsToday < $commentsYesterday ? 'lower' : 'neutral');

            return [
                'id' => $user->id,
                'name' => $user->first_name . ' ' . $user->last_name,
                'country' => [
                    'code' => $user->country,
                    'name' => $this->getCountryName($user->country),
                ],
                'avatar' => $user->avatar,
                'comment_activity' => [
                    'comments_today' => $commentsToday,
                    'trend' => $trend,
                ],
            ];
        });

        return response()->json([
            'data' => $response,
            'total' => $users->count(),
            'current_page' => $page,
            'per_page' => $perPage,
            'total_pages' => ceil($users->count() / $perPage)
        ]);
    }

    private function getCountryName($code)
    {
        $countries = [
            'US' => 'United States',
            'MX' => 'Mexico',
            'CA' => 'Canada',
        ];
        return $countries[$code] ?? $code;
    }
}