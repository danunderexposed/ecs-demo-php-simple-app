<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory, Searchable;
    protected $table = "likes";
    protected $fillable = [
        'id',
        'userid',
        'projectid',
        'ip',
        'dateupdated',
    ];
}
