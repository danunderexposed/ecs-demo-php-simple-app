<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class App extends Model
{
    use HasFactory, Searchable;
    protected $table = "apps";
    protected $fillable = [
        'id',
        'title',
        'app_id',
        'app_type',
        'school_id',
        'courses_exclude',
        'hide_projects',
        'show_course_index',
        'graduation_year',
        'enable_year_filter',
        'projects_per_page',
        'override_filters',
        'filter_sectors',
        'content_modules',
        'index_title',
        'index_text',
        'listings_title',
        'listings_text',
        'capitalise_buttons',
        'padding_left',
        'padding_right',
        'padding_top',
        'padding_bottom',
        'google_analytics',
        'google_analytics_global',
        'event_id',
        'competition_id',
        'allow_voting',
        'school_filters',
        'filters_override'
    ];

    protected $casts = [
        'hide_projects' => 'boolean',
        'show_course_index' => 'boolean',
        'enable_year_filter' => 'boolean',
        'override_filters' => 'boolean',
        'capitalise_buttons' => 'boolean',
        'google_analytics_global' => 'boolean',
        'allow_voting' => 'boolean',
        'filter_sectors' => 'array',
        'content_modules' => 'array',
        'school_filters' => 'array',
        'filters_override' => 'array',
    ];

}
