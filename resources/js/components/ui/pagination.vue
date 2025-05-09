<script setup lang="ts">
interface Props {
    currentPage: number;
    lastPage: number;
}

const props = defineProps<Props>();
const emit = defineEmits<{
    (e: 'pageChange', page: number): void;
}>();

const handlePageChange = (newPage: number) => {
    emit('pageChange', newPage);
};
</script>

<template>
    <nav class="flex items-center gap-1 text-sm" role="navigation" aria-label="Pagination">
        <button @click="handlePageChange(currentPage - 1)" :disabled="currentPage === 1"
            class="p-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-800 disabled:opacity-50 disabled:cursor-not-allowed"
            :class="currentPage === 1 ? 'text-gray-400 dark:text-gray-600' : 'text-gray-600 dark:text-gray-400'">
            Previous
        </button>

        <div class="flex gap-1">
            <button v-for="pageNum in lastPage" :key="pageNum" @click="handlePageChange(pageNum)"
                class="min-w-[2rem] h-8 rounded font-medium"
                :class="pageNum === currentPage ? 'bg-blue-600 text-white dark:bg-blue-500' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800'">
                {{ pageNum }}
            </button>
        </div>

        <button @click="handlePageChange(currentPage + 1)" :disabled="currentPage === lastPage"
            class="p-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-800 disabled:opacity-50 disabled:cursor-not-allowed"
            :class="currentPage === lastPage ? 'text-gray-400 dark:text-gray-600' : 'text-gray-600 dark:text-gray-400'">
            Next
        </button>
    </nav>
</template>
