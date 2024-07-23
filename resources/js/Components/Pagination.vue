<template>
    <div class="flex justify-center items-center mt-4">
        <button 
            @click="changePage(parseInt(pagination.current_page) - 1)" 
            :disabled="parseInt(pagination.current_page) === 1" 
            class="px-3 py-1 mx-1 bg-gray-800 text-white rounded-lg hover:bg-gray-600 disabled:opacity-50">
            &lt;
        </button>
        <button 
            v-for="page in visiblePages" 
            :key="page" 
            @click="changePage(page)" 
            :class="{
                'bg-green-500 text-white': page === parseInt(pagination.current_page), 
                'bg-gray-800 text-white': page !== parseInt(pagination.current_page),
                'hover:bg-green-600': page !== parseInt(pagination.current_page)
            }" 
            class="px-3 py-1 mx-1 rounded-lg">
            {{ page }}
        </button>
        <button 
            @click="changePage(parseInt(pagination.current_page) + 1)" 
            :disabled="parseInt(pagination.current_page) === pagination.total_pages" 
            class="px-3 py-1 mx-1 bg-gray-800 text-white rounded-lg hover:bg-gray-600 disabled:opacity-50">
            &gt;
        </button>
    </div>
</template>

<script>
export default {
    props: {
        pagination: Object
    },
    data() {
        return {
            maxPages: this.calculateMaxPages(),
        };
    },
    computed: {
        visiblePages() {
            const pages = [];
            const totalPages = this.pagination.total_pages;
            const currentPage = parseInt(this.pagination.current_page);
            const maxPages = this.maxPages;

            if (totalPages <= maxPages) {
                for (let i = 1; i <= totalPages; i++) {
                    pages.push(i);
                }
            } else {
                if (currentPage <= Math.floor(maxPages / 2)) {
                    for (let i = 1; i < maxPages; i++) {
                        pages.push(i);
                    }
                    pages.push('...', totalPages);
                } else if (currentPage >= totalPages - Math.floor(maxPages / 2)) {
                    pages.push(1, '...');
                    for (let i = totalPages - maxPages + 2; i <= totalPages; i++) {
                        pages.push(i);
                    }
                } else {
                    pages.push(1, '...');
                    for (let i = currentPage - Math.floor(maxPages / 2) + 1; i <= currentPage + Math.floor(maxPages / 2) - 1; i++) {
                        pages.push(i);
                    }
                    pages.push('...', totalPages);
                }
            }
            return pages;
        }
    },
    methods: {
        changePage(page) {
            if (page !== '...' && page >= 1 && page <= this.pagination.total_pages) {
                this.$emit('pageChanged', page);
            }
        },
        calculateMaxPages() {
            const width = window.innerWidth;
            if (width < 600) {
                return 3;
            } else if (width < 900) {
                return 7;
            } else {
                return 9;
            }
        },
        handleResize() {
            this.maxPages = this.calculateMaxPages();
        }
    },
    mounted() {
        window.addEventListener('resize', this.handleResize);
        if (!this.pagination.current_page && this.pagination.total_pages > 0) {
            this.changePage(1);
        }
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.handleResize);
    }
};
</script>