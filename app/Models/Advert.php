<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advert extends Model
{
    use HasFactory, Searchable;

    protected $table = "adverts";
    protected $fillable = [
        'id',
        'name',
        'link',
        'image_small',
        'image_medium',
        'image_large',
        'start_date',
        'end_date',
        'impressions',
        'clicks',
        'type',
        'display',
        'adorder'
    ];
    protected $casts = [
        'display' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date'
    ];
}
