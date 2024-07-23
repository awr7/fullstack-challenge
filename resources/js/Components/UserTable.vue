<template>
    <table class="min-w-full bg-gray-800 rounded-lg overflow-hidden text-sm lg:text-base">
        <thead>
            <tr class="bg-gray-900 text-white">
                <th class="p-2 lg:p-4 text-left font-medium">Name</th>
                <th class="p-2 lg:p-4 text-left font-medium">Country</th>
                <th class="p-2 lg:p-4 text-left font-medium">Comment Activity</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id" class="bg-gray-700 text-white">
                <td class="p-2 lg:p-4 flex items-center font-medium lg:text-lg">
                    <img :src="user.avatar" alt="avatar" class="w-6 h-6 lg:w-10 lg:h-10 rounded-full mr-2">
                    {{ user.name }}
                </td>
                <td class="p-2 lg:p-4 font-medium lg:text-lg">{{ user.country.name }}</td>
                <td class="p-2 lg:p-4 flex justify-center font-medium lg:text-lg">
                    <span class="inline-block w-full px-2 py-1 text-center rounded-lg" :class="{'bg-black text-red-500': user.comment_activity.trend === 'lower', 'bg-black text-green-500': user.comment_activity.trend === 'higher', 'bg-black text-white': user.comment_activity.trend === 'neutral'}">
                        {{ user.comment_activity.comments_today }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        users: Array
    }
};
</script>