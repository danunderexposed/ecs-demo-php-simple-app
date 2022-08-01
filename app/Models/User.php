<?php

namespace App\Models;

use App\Models\School;
use App\Traits\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'slug',
        'displayname',
        'firstname',
        'surname',
        'address1',
        'address2',
        'city',
        'postcode',
        'country',
        'tel',
        'school',
        'division',
        'course',
        'coursetitle',
        'studylevel',
        'sector',
        'sector2',
        'sector3',
        'specialism',
        'specialism2',
        'specialism3',
        'competitions',
        'ip',
        'registerdate',
        'verified',
        'utype',
        'profile',
        'profile_name',
        'profile_image',
        'profile_image_small',
        'website',
        'twitter_id',
        'twitter_url',
        'linkedin_id',
        'linkedin_url',
        'vimeo_url',
        'instagram_url',
        'googleplus_url',
        'pinterest_url',
        // 'olduserid',
        // 'oldcompetitions',
        // 'oldurl',
        'subscribed',
        'projects_last_updated',
        'userType',
        'companyname',
        'companyposition',
        'gender',
        'dob',
        'gradyear',
        'nationality',
        'messagesend',
        'messagesendallow',
        'google_id',
        'google_token',
        'google_refresh_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'google_id',
        'google_token',
        'google_refresh_token',
        'legacy_password',
        'legacy_salt'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function schoolName()
    {
        if (is_numeric($this->school)){
            $school = School::find($this->school);
            return $school->school;
        } else {
            return $this->school;
        }
    }

    /**
     * A user may be assigned many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Assign a new role to the user.
     *
     * @param  mixed  $role
     */
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }

        $this->roles()->sync($role, false);
    }

    /**
     * Fetch the user's abilities.
     *
     * @return array
     */
    public function abilities()
    {
        return $this->roles
            ->map->abilities
            ->flatten()->pluck('name')->unique();
    }
}
