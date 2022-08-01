<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventEntry extends Model
{
    use HasFactory, Searchable;

    protected $table = "events_entry";
    protected $fillable = ['id', 'eventid', 'userid', 'projectid', 'active', 'entered' ];

    /**
     * User relationship
     *
     * @return void
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid');
    }

    /**
     * User relationship
     *
     * @return void
     */
    public function event()
    {
        return $this->hasOne(Event::class, 'id', 'eventid');
    }

    /**
     * Project realtionship
     *
     * @return void
     */
    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'projectid');
    }

}
