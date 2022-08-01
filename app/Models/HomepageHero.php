<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageHero extends Model
{
    use HasFactory, Searchable;

    protected $table = "homepage_hero";
    protected $fillable = [
            'id',
            'pre_title',
            'title',
            'image',
            'mobile_image',
            'link',
            'button_text',
    ];

}
