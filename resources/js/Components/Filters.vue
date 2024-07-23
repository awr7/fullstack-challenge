<template>
    <div>
        <select v-model="filters.country" @change="filterChanged">
            <option value="">Select Country</option>
            <option value="US">United States</option>
            <option value="MX">Mexico</option>
            <option value="CA">Canada</option>
        </select>
        <select v-model="filters.comment_activity_trend" @change="filterChanged">
            <option value="">Select Trend</option>
            <option value="higher">Higher</option>
            <option value="lower">Lower</option>
            <option value="neutral">Neutral</option>
        </select>
        <select v-model="filters.sort_by" @change="filterChanged">
            <option value="created_at">Member Since</option>
            <option value="comments_today">Comment Activity</option>
        </select>
    </div>
</template>

<script>
export default {
    props: ['filters'],
    methods: {
        filterChanged() {
            this.$emit('filterChanged');
        },
    },
};
</script>