<template>
    <div class="min-h-screen bg-gray-800 flex flex-col lg:flex-row justify-center items-center p-2 lg:p-8">
        <div class="w-full max-w-screen-2xl bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex flex-col lg:flex-row">
                <div class="w-full lg:w-1/4 bg-gray-700 rounded-lg p-4 mb-4 lg:mb-0 lg:mr-4">
                    <h2 class="text-white text-2xl font-semibold mb-4">Filters</h2>
                    <div class="mb-4">
                        <label for="country" class="block text-white mb-2 text-lg font-medium">Country</label>
                        <select id="country" v-model="filters.country" @change="applyFilters" class="block w-full p-3 rounded-lg bg-gray-800 text-white border-none">
                            <option value="">All</option>
                            <option value="US">United States</option>
                            <option value="MX">Mexico</option>
                            <option value="CA">Canada</option>
                        </select>
                    </div>
                    <div>
                        <label for="trend" class="block text-white mb-2 text-lg font-medium">Comment Activity Trend</label>
                        <select id="trend" v-model="filters.comment_activity_trend" @change="applyFilters" class="block w-full p-3 rounded-lg bg-gray-800 text-white border-none">
                            <option value="">All</option>
                            <option value="higher">Higher</option>
                            <option value="lower">Lower</option>
                            <option value="neutral">Neutral</option>
                        </select>
                    </div>
                </div>
                <div class="flex-1 bg-gray-700 rounded-lg p-4">
                    <div class="flex flex-col lg:flex-row justify-between items-center mb-4">
                        <h1 class="text-white text-3xl font-semibold mb-4 lg:mb-0">User Dashboard</h1>
                        <div class="flex items-center">
                            <label for="sort_by" class="text-white mr-2 text-lg font-medium">Sort By:</label>
                            <select id="sort_by" v-model="filters.sort_by" @change="applyFilters" class="p-3 rounded-lg bg-gray-800 text-white border-none">
                                <option value="created_at">Member Since</option>
                                <option value="comments_today">Comment Activity</option>
                            </select>
                        </div>
                    </div>
                    <div class="min-h-[300px]">
                        <UserTable :users="users" />
                    </div>
                    <Pagination :pagination="pagination" @pageChanged="changePage" />
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
            pagination: {
                current_page: 1,
                total_pages: 0,
                total: 0,
                per_page: 5
            },
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
                        total_pages: response.data.total_pages
                    };
                });
        },
        changePage(page) {
            if (page >= 1 && page <= this.pagination.total_pages) {
                this.filters.page = page;
                this.fetchUsers();
            }
        },
        applyFilters() {
            this.filters.page = 1;
            this.fetchUsers();
        }
    },
    created() {
        this.fetchUsers();
    },
};
</script>