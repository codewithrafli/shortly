import { DateTime } from 'luxon';

export function formatToClientTimezone(date: string): string {
    const originalDate = DateTime.fromISO(date, { zone: 'utc' });
    const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

    return originalDate
        .setZone(timezone)
        .setLocale('id')
        .toFormat('dd MMM yyyy HH:mm');
}

