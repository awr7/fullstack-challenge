<template>
    <div>
        <div class="mb-6">
            <label for="country" class="block mb-2 text-lg font-medium">Country</label>
            <select id="country" v-model="filters.country" @change="onFilterChanged" class="w-full p-3 bg-gray-600 text-white rounded">
                <option value="">All</option>
                <option value="US">United States</option>
                <option value="MX">Mexico</option>
                <option value="CA">Canada</option>
            </select>
        </div>
        <div class="mb-6">
            <label for="comment_activity_trend" class="block mb-2 text-lg font-medium">Comment Activity Trend</label>
            <select id="comment_activity_trend" v-model="filters.comment_activity_trend" @change="onFilterChanged" class="w-full p-3 bg-gray-600 text-white rounded">
                <option value="">All</option>
                <option value="higher">Higher</option>
                <option value="lower">Lower</option>
                <option value="neutral">Neutral</option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        filters: Object,
    },
    methods: {
        onFilterChanged() {
            this.$emit('filterChanged');
        },
    },
};
</script>