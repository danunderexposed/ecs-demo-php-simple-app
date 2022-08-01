<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, Searchable;
    protected $table = "countries";
    protected $fillable = [ 'id', 'name' ];

    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }

    public function schools()
    {
        return $this->hasMany(School::class, 'country_id', 'id')->orderBy('school');
    }
}
