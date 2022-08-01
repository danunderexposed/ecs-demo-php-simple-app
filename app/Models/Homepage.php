<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    use HasFactory, Searchable;

    protected $table = "homepage";
    protected $fillable = [
            'id',
            'name',
            'type',
            'image',
            'link',
            'headtxt',
            'headclr',
            'headbg',
            'copytxt',
            'copyclr',
            'copybg',
            'modulebg',
            'videoid',
            'videotype',
            'mobile_image'
    ];

}
