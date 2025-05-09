<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlAnalytic extends Model
{
    use HasFactory;

    protected $fillable = [
        'url_id',
        'ip_address',
        'user_agent',
        'browser',
        'browser_version',
        'device_type',
        'os',
        'os_version',
        'country',
        'city',
        'referer'
    ];

    public function url()
    {
        return $this->belongsTo(Url::class);
    }
}
