<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionEntry extends Model
{
    use HasFactory;

    protected $table = "competitions_entry";
    protected $fillable = [
        'id',
        'compid',
        'userid',
        'entered',
        'projectid',
        'category',
        'winner',
        'shortlist',
        'runnerup',
        'popular',
        'voting',
        'totalvotes',
        'specialism_id'
    ];
    protected $casts = [
        'entered' => 'boolean',
        'winner' => 'boolean',
        'shortlist' => 'boolean',
        'runnerup' => 'boolean',
        'popular' => 'boolean',
        'voting' => 'boolean',
    ];

    public function project() {
        return $this->hasOne(Project::class, 'id', 'projectid');
    }
  
    public function competition()
    {
        return $this->belongsTo(Competition::class, 'compid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

}
