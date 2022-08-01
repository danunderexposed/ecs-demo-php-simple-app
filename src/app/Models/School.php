<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory, Searchable;
    protected $table = "schools";
    protected $fillable = [
            'id',
            'slug',
            'country_id',
            'city_id',
            'school',
            'image',
            'image_medium',
            'image_small',
            'slider',
            'slider_medium',
            'slider_small',
            'excerpt',
            'description',
            'website',
            'twitter',
            'facebook',
            'linkedin',
            'youtube',
            'instagram',
            'vimeo',
            'pinterest',
            'featured',
            'separate',
            'display_instagram',
            'instagram_user',
            'instagram_title',
            'displaytype',
            'profiles',
            'projects',
            'courses',
            'schoolorder'
        ];
    protected $casts = [
        'featured' => 'boolean',
        'separate' => 'boolean',
        'display_instagram' => 'boolean',
    ];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function courses(){
        return $this->hasMany(Course::class, 'school_id', 'id')->orderBy('name')->get();
    }
}
