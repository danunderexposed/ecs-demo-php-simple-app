<?php

namespace App\Models;

use App\Models\CompetitionCategory as ModelsCompetitionCategory;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompetitionCatAssign extends Model
{
    use HasFactory, Searchable;

    protected $table = "competitions_catassign";
    protected $fillable = ['id', 'catid', 'compid'];

    public function competition(){
        return $this->belongsTo(Competition::class, 'compid');
    }

    public function category(){
        return $this->belongsTo(ModelsCompetitionCategory::class, 'catid');
    }
}
