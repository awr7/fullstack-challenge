<template>
    <div class="flex justify-center items-center mt-4">
        <button @click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page === 1" class="px-3 py-2 mx-1 bg-gray-800 text-white rounded-lg hover:bg-black disabled:opacity-50">&lt;</button>
        <button v-for="page in pages" :key="page" @click="changePage(page)" :class="{'bg-green-500 text-white': page === pagination.current_page, 'bg-gray-800 text-white': page !== pagination.current_page}" class="px-3 py-2 mx-1 rounded-lg hover:bg-black">{{ page }}</button>
        <button @click="changePage(pagination.current_page + 1)" :disabled="pagination.current_page === pagination.total_pages" class="px-3 py-2 mx-1 bg-gray-800 text-white rounded-lg hover:bg-black disabled:opacity-50">&gt;</button>
    </div>
</template>

<script>
export default {
    props: {
        pagination: Object
    },
    computed: {
        pages() {
            const pages = [];
            for (let i = 1; i <= Math.ceil(this.pagination.total / this.pagination.per_page); i++) {
                pages.push(i);
            }
            return pages;
        }
    },
    methods: {
        changePage(page) {
            if (page >= 1 && page <= Math.ceil(this.pagination.total / this.pagination.per_page)) {
                this.$emit('pageChanged', page);
            }
        }
    }
};
</script>