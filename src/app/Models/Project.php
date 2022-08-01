<?php

namespace App\Models;

use App\Traits\Searchable;
use function PHPSTORM_META\map;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, Searchable;
    protected $table = "projects";
    protected $fillable = [
        'id',
        'user_id',
        'slug',
        'title',
        'description',
        'cover_small',
        'cover_medium',
        'cover_large',
        'display',
        'type',
        'specialism',
        'specialism2',
        'specialism3',
        'sort_order',
        'oldgalleryid',
        'views',
        'likes',
        'comments',
        'ytag_link'
    ];

    protected $casts = [
        'display' => 'boolean',
    ];

    /**
     * Project media
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function media()
    {
        return $this->hasMany(ProjectMedia::class, 'project_id', 'id')->orderBy('sort_order');
    }

    public function specialismOne() {
        return $this->hasOne(Specialism::class, 'id', 'specialism');
    }

    public function specialismTwo() {
        return $this->hasOne(Specialism::class, 'id', 'specialism2');
    }

    public function specialismThree() {
        return $this->hasOne(Specialism::class, 'id', 'specialism3');
    }

    public function competitionEntry() {
        return $this->hasOne(CompetitionEntry::class, 'projectid');
    }

    public function competitions() {
        return $this->hasManyThrough(Competition::class, CompetitionEntry::class, 'projectid', 'id', 'id', 'compid');

    }

    /**
     * Project users
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function delete()
    {
        foreach ($this->media as $m){
            // delete s3 images
            $s3path = ltrim(str_replace(config('filesystems.disks.s3.bucket'), '', parse_url($m->image_large, PHP_URL_PATH)), '/');
            Storage::disk('s3')->delete($s3path);
            $m->delete();
        }
        return parent::delete();
    }

    public function eventEntry() {
        return $this->hasOne(EventEntry::class, 'projectid');
    }

    public function events() {
        return $this->hasManyThrough(Event::class, EventEntry::class, 'projectid', 'id', 'id', 'eventid');

    }

    public function like() {
        return $this->where('id',$this->id)->update(['likes'=>++$this->likes]);
    }
}
