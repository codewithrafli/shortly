<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Card } from '@/components/ui/card';
import QrcodeVue from 'qrcode.vue'
import { format } from 'date-fns';

const appDomain = import.meta.env.VITE_APP_DOMAIN;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Url',
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

const page = usePage();
const urls = computed(() => page.props.urls as Url[]);
</script>

<template>

    <Head title="Url" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 grid grid-cols-1 gap-4">
            <Card v-for="url in urls" :key="url.id" class="p-4 shadow-lg rounded-lg border">
                <div class="flex items-center gap-4">
                    <QrcodeVue :value="`${appDomain}/${url.short_url}`" :options="{ width: 100 }" />
                    <div class="flex flex-col">
                        <h6 class="font-medium text-sm" v-if="url.title">{{ url.title }}</h6>
                        <h3 class="font-semibold text-lg">{{ appDomain }}/{{ url.short_url }}</h3>
                        <p class="text-sm text-gray-500">{{ url.original_url }}</p>
                        <p class="text-xs text-gray-400">{{ format(new Date(url.created_at), 'dd MMM yyyy HH:mm') }}</p>
                    </div>
                </div>
            </Card>
        </div>
    </AppLayout>
</template>
