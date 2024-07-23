<template>
    <div>
        <h1>User Dashboard</h1>
        <Filters :filters="filters" @filterChanged="onFilterChange" />
        <UserTable :users="users" />
        <Pagination :pagination="pagination" @pageChanged="onPageChange" />
    </div>
</template>

<script>
import axios from 'axios';
import Filters from './Filters.vue';
import UserTable from './UserTable.vue';
import Pagination from './Pagination.vue';

export default {
    components: {
        Filters,
        UserTable,
        Pagination,
    },
    data() {
        return {
            users: [],
            filters: {
                country: '',
                comment_activity_trend: '',
                sort_by: '',
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
        onFilterChange() {
            this.filters.page = 1;
            this.fetchUsers();
        },
        onPageChange(page) {
            this.filters.page = page;
            this.fetchUsers();
        },
    },
    created() {
        this.fetchUsers();
    },
};
</script>