<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory, Searchable;
    protected $table = "pages";
    protected $fillable = [
        'id',
        'title',
        'slug',
        'content',
        'status',
        'link',
        'parent_page_id',
    ];

}
