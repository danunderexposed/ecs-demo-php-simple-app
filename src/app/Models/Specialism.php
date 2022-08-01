<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialism extends Model
{
    use HasFactory, Searchable;
    protected $table = "specialisms";
    protected $fillable = [
            'id',
            'specialism',
            'slug',
            'sector_id'
    ];

    public function sector(){
        return $this->belongsTo(Sector::class, 'sector_id');
    }
}
