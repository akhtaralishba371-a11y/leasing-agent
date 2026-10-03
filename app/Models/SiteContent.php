<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $fillable = [
        'key',
        'group',
        'label',
        'type',
        'sort',
        'value',
    ];
}
