<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory, Searchable;

    protected $table = "sponsors";
    protected $fillable = [
            'id',
            'name',
            'url',
            'image_small',
            'image_medium',
            'image_large',
            'sort_order',
            'display',
    ];

}
