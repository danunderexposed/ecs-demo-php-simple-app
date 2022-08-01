<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{
    use HasFactory, Searchable;

    protected $table = "competitions";
    protected $fillable = ['id', 'slug', 'name', 'link', 'description', 'image', 'image_medium', 'image_small', 'start_date', 'end_date', 'active', 'entrydisplay', 'entrydisplayvote', 'entrytitle', 'featured', 'displayads', 'displaycomps', 'displayfilters', 'winnerdisplay', 'winnertitle', 'hidedetails', 'preview', 'preview_description', 'preview_displayentry', 'preview_displaycomps', 'preview_displayads', 'preview_displaywinners', 'preview_hidedetails', 'onlyportfolio', 'status', 'deadline', 'votestart', 'voteend', 'voteoverride', 'winnerdate', 'headexcerpt', 'profiledisplay', 'comporder'];
    protected $casts = [
        'active' => 'boolean',
        'entrydisplay' => 'boolean',
        'entrydisplayvote'  => 'boolean',
        'featured'  => 'boolean',
        'displayads'  => 'boolean',
        'displaycomps'  => 'boolean',
        'displayfilters'  => 'boolean',
        'winnerdisplay'  => 'boolean',
        'hidedetails'  => 'boolean',
        'preview'  => 'boolean',
        'preview_displayentry'  => 'boolean',
        'preview_displaycomps'  => 'boolean',
        'preview_displayads'  => 'boolean',
        'preview_displaywinners'  => 'boolean',
        'preview_hidedetails'  => 'boolean',
        'onlyportfolio'  => 'boolean',
        'voteoverride'  => 'boolean',
        'profiledisplay'  => 'boolean',
        'start_date' => 'datetime:Y-m-d H:i:s',
        'end_date' => 'datetime:Y-m-d H:i:s',
        'deadline' => 'datetime:Y-m-d H:i:s',
        'votestart' => 'datetime:Y-m-d H:i:s',
        'voteend' => 'datetime:Y-m-d H:i:s',
        'winnerdate' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Entries relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entries()
    {
        return $this->hasMany(CompetitionEntry::class, 'compid', 'id');
    }

    /**
     * Voting entries relationship
     *
     */
    public function votingEntries()
    {
        return $this->entries()->where('voting', true)->get();
    }

    /**
     * Winner entries relationship
     *
     */
    public function winnerEntries()
    {
        return $this->entries()->where('winner', true)->get();
    }

    /**
     * Shortlist entries relationship
     *
     */
    public function shortlistEntries()
    {
        return $this->entries()->where('shortlist', true)->get();
    }

    /**
     * Runnerup entries relationship
     *
     */
    public function runnerupEntries()
    {
        return $this->entries()->where('runnerup', true)->get();
    }

    /**
     * Popular entries relationship
     *
     */
    public function popularEntries()
    {
        return $this->entries()->where('popular', true)->get();
    }
}
