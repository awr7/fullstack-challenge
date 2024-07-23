<template>
    <div>
        <button @click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page === 1">Previous</button>
        <button @click="changePage(pagination.current_page + 1)" :disabled="pagination.current_page === Math.ceil(pagination.total / pagination.per_page)">Next</button>
    </div>
</template>

<script>
export default {
    props: ['pagination'],
    methods: {
        changePage(page) {
            if (page >= 1 && page <= Math.ceil(this.pagination.total / this.pagination.per_page)) {
                this.$emit('pageChanged', page);
            }
        },
    },
};
</script>