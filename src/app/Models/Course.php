<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, Searchable;

    protected $table = "courses";
    protected $fillable = [
            'id',
            'email',
            'name',
            'slug',
            'about',
            'studylevel_id',
            'division',
            'address1',
            'address2',
            'postcode',
            'leadertitle',
            'leadername',
            'contactemail',
            'contacturl',
            'admissionemail',
            'admissionurl',
            'tel',
            'school_id',
            'sector',
            'sector2',
            'sector3',
            'specialism',
            'specialism2',
            'specialism3',
            'country_id',
            'city_id',
            'image',
            'image_small',
            'image_medium',
            'website',
            'active',
            'profiledisplaytype',
            'profiles',
            'instagram_display',
            'instagram_url',
            'instagram_username',
            'courseorder',
            'coursenotify',
            'main_image_link',
            'logo_link'
    ];
    protected $casts = [
        'active' => 'boolean',
        'instagram_display' => 'boolean',
        'coursenotify' => 'boolean'
    ];

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function school(){
        return $this->belongsTo(School::class, 'school_id');
    }

    public function sectorObj(){
        return $this->belongsTo(Sector::class, 'sector');
    }

    public function specialismObj(){
        return $this->belongsTo(Specialism::class, 'specialism');
    }

    public function studylevel(){
        return $this->belongsTo(StudyLevel::class, 'studylevel_id');
    }
}
