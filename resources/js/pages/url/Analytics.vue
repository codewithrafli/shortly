<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { DateTime } from 'luxon';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

interface Props {
    url: {
        id: number;
        original_url: string;
        short_url: string;
    };
    analytics: {
        [key: string]: Array<{
            browser: string;
            device_type: string;
            os: string;
            country: string;
            city: string;
            created_at: string;
        }>;
    };
    totalClicks: number;
    uniqueVisitors: number;
    topBrowsers: Array<{
        browser: string;
        total: number;
    }>;
    topDevices: Array<{
        device_type: string;
        total: number;
    }>;
    topCountries: Array<{
        country: string;
        total: number;
    }>;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tautan',
        href: '/dashboard/url',
    },
    {
        title: 'URL Analytics',
        href: '#',
    },
];

const formatDate = (date: string) => {
    return DateTime.fromISO(date).toFormat('MMM d, yyyy HH:mm');
};
</script>

<template>

    <Head title="URL Analytics" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <h1 class="text-2xl font-bold mb-6">Analytics for {{ url.short_url }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <Card>
                    <CardHeader>
                        <CardTitle>Total Clicks</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <p class="text-3xl font-bold">{{ totalClicks }}</p>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Unique Visitors</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <p class="text-3xl font-bold">{{ uniqueVisitors }}</p>
                    </CardContent>
                </Card>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <Card>
                    <CardHeader>
                        <CardTitle>Top Browsers</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Browser</TableHead>
                                    <TableHead>Visits</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="browser in topBrowsers" :key="browser.browser">
                                    <TableCell>{{ browser.browser }}</TableCell>
                                    <TableCell>{{ browser.total }}</TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Top Devices</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Device</TableHead>
                                    <TableHead>Visits</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="device in topDevices" :key="device.device_type">
                                    <TableCell>{{ device.device_type }}</TableCell>
                                    <TableCell>{{ device.total }}</TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>

                <Card>
                    <CardHeader>
                        <CardTitle>Top Countries</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Country</TableHead>
                                    <TableHead>Visits</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="country in topCountries" :key="country.country">
                                    <TableCell>{{ country.country }}</TableCell>
                                    <TableCell>{{ country.total }}</TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>

            <Card>
                <CardHeader>
                    <CardTitle>Recent Activity</CardTitle>
                </CardHeader>
                <CardContent>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead>Date</TableHead>
                                <TableHead>Browser</TableHead>
                                <TableHead>Device</TableHead>
                                <TableHead>OS</TableHead>
                                <TableHead>Location</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="(visits, date) in analytics" :key="date">
                                <template v-for="(visit, index) in visits" :key="`${date}-${index}`">
                                    <TableCell>{{ formatDate(visit.created_at) }}</TableCell>
                                    <TableCell>{{ visit.browser }}</TableCell>
                                    <TableCell>{{ visit.device_type }}</TableCell>
                                    <TableCell>{{ visit.os }}</TableCell>
                                    <TableCell>{{ visit.city }}, {{ visit.country }}</TableCell>
                                </template>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
