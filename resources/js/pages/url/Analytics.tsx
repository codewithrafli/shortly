import { Head } from '@inertiajs/react';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { format } from 'date-fns';

interface AnalyticsProps {
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

export default function Analytics({ url, analytics, totalClicks, uniqueVisitors, topBrowsers, topDevices, topCountries }: AnalyticsProps) {
    return (
        <>
            <Head title="URL Analytics" />
            <div className="container mx-auto py-6">
                <h1 className="text-2xl font-bold mb-6">Analytics for {url.short_url}</h1>

                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <Card>
                        <CardHeader>
                            <CardTitle>Total Clicks</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <p className="text-3xl font-bold">{totalClicks}</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle>Unique Visitors</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <p className="text-3xl font-bold">{uniqueVisitors}</p>
                        </CardContent>
                    </Card>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
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
                                    {topBrowsers.map((browser) => (
                                        <TableRow key={browser.browser}>
                                            <TableCell>{browser.browser}</TableCell>
                                            <TableCell>{browser.total}</TableCell>
                                        </TableRow>
                                    ))}
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
                                    {topDevices.map((device) => (
                                        <TableRow key={device.device_type}>
                                            <TableCell>{device.device_type}</TableCell>
                                            <TableCell>{device.total}</TableCell>
                                        </TableRow>
                                    ))}
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
                                    {topCountries.map((country) => (
                                        <TableRow key={country.country}>
                                            <TableCell>{country.country}</TableCell>
                                            <TableCell>{country.total}</TableCell>
                                        </TableRow>
                                    ))}
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
                                {Object.entries(analytics).map(([date, visits]) => (
                                    visits.map((visit, index) => (
                                        <TableRow key={`${date}-${index}`}>
                                            <TableCell>{format(new Date(visit.created_at), 'MMM d, yyyy HH:mm')}</TableCell>
                                            <TableCell>{visit.browser}</TableCell>
                                            <TableCell>{visit.device_type}</TableCell>
                                            <TableCell>{visit.os}</TableCell>
                                            <TableCell>{visit.city}, {visit.country}</TableCell>
                                        </TableRow>
                                    ))
                                ))}
                            </TableBody>
                        </Table>
                    </CardContent>
                </Card>
            </div>
        </>
    );
}
