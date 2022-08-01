<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory, Searchable;
    protected $table = "cities";
    protected $fillable = [ 'id', 'name', 'country_id' ];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

}
