<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use App\Models\City;
use App\Models\Country;
use App\Models\Course;
use App\Models\Specialism;
use App\Models\School;
use App\Models\User;

trait UserAttributes
{
    /**
     * Get Specialisms in a formatted string
     * 'specialism / specialism / specialism'
     *
     * @param User $user
     * @return string
     */
    public function getSpecialisms(User $user): string
    {
        $specialismString = 'Not specified';

        $s1 = $user->specialism ?
            Specialism::find($user->specialism) :
            false;
        $s2 = $user->specialism2 ?
            Specialism::find($user->specialism2) :
            false;
        $s3 = $user->specialism3 ?
            Specialism::find($user->specialism3) :
            false;
        $specialisms = [];
        $s1 ? array_push($specialisms, $s1->specialism) : false;
        $s2 ? array_push($specialisms, $s2->specialism) : false;
        $s3 ? array_push($specialisms, $s3->specialism) : false;
        if(count($specialisms) > 0) {
            $specialismString = implode(' / ', $specialisms);
        }
        return $specialismString;
    }

    /**
     * Get users school name
     *
     * @param User $user
     * @return string|null
     */
    public function getSchoolName(User $user): ?string
    {
        $schoolname = $user->school;
        if(is_numeric($user->school)) {
            $school = School::find($user->school);
            if($school) {
                $schoolname = $school->school;
            }
        }

        return $schoolname;
    }

    /**
     * Get users course title
     *
     * @param User $user
     * @return string|null
     */
    public function getCourseTitle(User $user): ?string
    {
        $coursetitle = $user->course;
        if(is_numeric($user->course)) {
            $course = Course::find($user->course);
            if($course) {
                $coursetitle = $course->name;
            }
        }

        return $coursetitle;
    }

    /**
     * Get users course city
     *
     * @param User $user
     * @return string|null
     */
    public function getCityString(User $user): ?string
    {
        $citystring = $user->city;
        if(is_numeric($user->city)) {
            $city = City::find($user->city);
            if($city) {
                $citystring = $city->name;
            }
        }

        return $citystring;
    }

    /**
     * Get users country
     *
     * @param User $user
     * @return string|null
     */
    public function getCountryString(User $user): ?string
    {
        $countrystring = $user->country;
        if(is_numeric($user->country)) {
            $country = Country::find($user->country);
            if($country) {
                $countrystring = $country->name;
            }
        }

        return $countrystring;
    }

    /**
     * Get counts for like, views and comments
     *
     * @param Collection $projects
     * @return array
     */
    public function getProjectCounts(Collection $projects): array
    {
        $counts = [
            "view" => 0,
            "like" => 0,
            "comment" => 0
        ];

        foreach ($projects as $p) {
            $counts["view"] += $p->views;
            $counts["like"] += $p->likes;
            $counts["comment"] += $p->comments;
        }

        return $counts;
    }

    /**
     * Get image of school
     *
     * @param User $user
     * @return string
     */
    public function getSchoolImage(User $user): string
    {
        $schoolimage = 'https://s3-eu-west-1.amazonaws.com/artsthread-content/images/schools/ava1.png';

        if(is_numeric($user->school)) {
            $school = School::find($user->school);
            if($school) {
                $schoolimage = $school->image;
            }
        }

        return $schoolimage;
    }
}
