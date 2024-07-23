<template>
    <div class="min-h-screen bg-gray-800 flex justify-center items-center p-8">
        <div class="w-full max-w-screen-2xl bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex">
                <div class="w-1/4 bg-gray-700 rounded-lg p-4 mr-4">
                    <h2 class="text-white text-2xl font-semibold mb-4">Filters</h2>
                    <label for="country" class="block text-white mb-2 text-lg font-medium">Country</label>
                    <select id="country" v-model="filters.country" @change="fetchUsers" class="block w-full mb-4 p-3 rounded-lg bg-gray-800 text-white border-none">
                        <option value="">All</option>
                        <option value="US">United States</option>
                        <option value="MX">Mexico</option>
                        <option value="CA">Canada</option>
                    </select>
                    <label for="trend" class="block text-white mb-2 text-lg font-medium">Comment Activity Trend</label>
                    <select id="trend" v-model="filters.comment_activity_trend" @change="fetchUsers" class="block w-full mb-4 p-3 rounded-lg bg-gray-800 text-white border-none">
                        <option value="">All</option>
                        <option value="higher">Higher</option>
                        <option value="lower">Lower</option>
                        <option value="neutral">Neutral</option>
                    </select>
                </div>
                <div class="flex-1 bg-gray-700 rounded-lg p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-white text-3xl font-semibold">User Dashboard</h1>
                        <div>
                            <label for="sort_by" class="text-white mr-2 text-lg font-medium">Sort By:</label>
                            <select id="sort_by" v-model="filters.sort_by" @change="fetchUsers" class="p-3 rounded-lg bg-gray-800 text-white border-none">
                                <option value="created_at">Member Since</option>
                                <option value="comments_today">Comment Activity</option>
                            </select>
                        </div>
                    </div>
                    <UserTable :users="users" />
                    <Pagination :pagination="pagination" @pageChanged="fetchUsers" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import UserTable from './UserTable.vue';
import Pagination from './Pagination.vue';

export default {
    components: {
        UserTable,
        Pagination,
    },
    data() {
        return {
            users: [],
            filters: {
                country: '',
                comment_activity_trend: '',
                sort_by: 'created_at',
                page: 1,
            },
            pagination: {},
        };
    },
    methods: {
        fetchUsers() {
            axios.get('/dashboard', { params: this.filters })
                .then(response => {
                    this.users = response.data.data;
                    this.pagination = {
                        total: response.data.total,
                        current_page: response.data.current_page,
                        per_page: response.data.per_page,
                    };
                });
        },
    },
    created() {
        this.fetchUsers();
    },
};
</script>