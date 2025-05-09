<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage, router } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Card } from '@/components/ui/card';
import QrcodeVue from 'qrcode.vue'
import { formatToClientTimezone } from '@/helpers/format';
import Pagination from '@/components/ui/pagination.vue';

const appDomain = import.meta.env.VITE_APP_DOMAIN;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tautan',
        href: '/url',
    },
];

interface Url {
    id: number;
    title: string;
    original_url: string;
    short_url: string;
    created_at: string;
}

interface PaginatedData {
    data: Url[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

const page = usePage();
const urls = computed(() => page.props.urls as PaginatedData);

const handlePageChange = (newPage: number) => {
    router.get('/dashboard/url', { page: newPage }, { preserveState: true });
};
</script>

<template>

    <Head title="Url" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 grid grid-cols-1 gap-4">
            <Card v-for="url in urls.data" :key="url.id" class="p-4 shadow-lg rounded-lg border">
                <div class="flex items-center gap-4">
                    <QrcodeVue :value="`${appDomain}/${url.short_url}`" :options="{ width: 100 }" />
                    <div class="flex flex-col">
                        <h6 class="font-medium text-sm" v-if="url.title">{{ url.title }}</h6>
                        <h3 class="font-semibold text-lg">{{ appDomain }}/{{ url.short_url }}</h3>
                        <p class="text-sm text-gray-500">{{ url.original_url }}</p>
                        <div class="mt-2">
                            <a :href="`/dashboard/url/${url.id}/analytics`"
                                class="text-sm text-blue-600 hover:text-blue-800">
                                View Analytics
                            </a>
                        </div>
                    </div>
                </div>
            </Card>

            <!-- Pagination -->
            <div class="flex justify-start mt-4">
                <Pagination :current-page="urls.current_page" :last-page="urls.last_page"
                    @page-change="handlePageChange" />
            </div>
        </div>
    </AppLayout>
</template>
