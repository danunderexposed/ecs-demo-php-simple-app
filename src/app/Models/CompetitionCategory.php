<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompetitionCategory extends Model
{
    use HasFactory, Searchable;

    protected $table = "competition_categories";
    protected $fillable = ['id', 'name'];

}
