<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, Searchable;

    protected $table = "events";
    protected $fillable = ['id', 'slug', 'name', 'link', 'description', 'image', 'image_medium', 'image_small', 'start_date', 'end_date', 'active', 'entrydisplay', 'featured', 'displayads', 'displayevent', 'useradd', 'approvalrequired', 'eventorder', 'is_hidden'];
    protected $casts = [
        'active' => 'boolean',
        'entrydisplay' => 'boolean',
        'featured' => 'boolean',
        'displayads' => 'boolean',
        'displayevent' => 'boolean',
        'useradd' => 'boolean',
        'approvalrequired' => 'boolean',
        'is_hidden' => 'boolean',
        'start_date' => 'datetime:Y-m-d H:i:s',
        'end_date' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * Entries relationship
     *
     * @return void
     */
    public function entries()
    {
        return $this->hasMany(EventEntry::class, 'eventid', 'id');
    }

}
