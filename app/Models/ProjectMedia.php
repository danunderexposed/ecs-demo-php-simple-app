<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectMedia extends Model
{
    use HasFactory;

    protected $table = "projects_media";
    protected $fillable = [
        'id',
        'project_id',
        'slug',
        'title',
        'description',
        'type',
        'display',
        'sort_order',
        'image_small',
        'image_medium',
        'image_large',
        'vidurl',
        'is_video',
        'oldmediaid',
    ];
    protected $casts = [
        'display' => 'boolean',
        'is_video' => 'boolean',
    ];

}
