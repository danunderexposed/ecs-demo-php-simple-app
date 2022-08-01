<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudyLevel extends Model
{
    use HasFactory, Searchable;
    protected $table = "study_levels";
    protected $fillable = [
            'id',
            'studylevel',
    ];
}
