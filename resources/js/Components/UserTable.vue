<template>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Country</th>
                <th>Comment Activity</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>
                    <img :src="user.avatar" alt="Avatar" width="50" height="50" />
                    {{ user.name }}
                </td>
                <td>{{ user.country.name }}</td>
                <td :class="getTrendClass(user.comment_activity.trend)">
                    {{ user.comment_activity.comments_today }}
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ['users'],
    methods: {
        getTrendClass(trend) {
            return {
                higher: 'text-green-500',
                lower: 'text-red-500',
                neutral: 'text-gray-500',
            }[trend];
        },
    },
};
</script>

<style scoped>
.text-green-500 { color: green; }
.text-red-500 { color: red; }
.text-gray-500 { color: gray; }
</style>