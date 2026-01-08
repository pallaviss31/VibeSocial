<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable =[
        'user_id',
        'title',
        'description',
        'branch',
        'semester',
        'subject',
        'type',
        'file_path',
        'thumbnail',
        'views',
        'downloads',
    ];
}
