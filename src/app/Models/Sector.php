<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sector extends Model
{
    use HasFactory, Searchable;
    protected $table = "sectors";
    protected $fillable = [
            'id',
            'sector'
    ];

    public function specialisms()
    {
        return $this->hasMany(Specialism::class, 'sector_id', 'id')->orderBy('specialism');
    }
}
