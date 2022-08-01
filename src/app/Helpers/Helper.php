<?php

namespace App\Helpers;

use App\Models\City;
use App\Models\School;
use App\Models\Country;
use App\Models\Specialism;
use App\Models\Sector;

class Helper
{
    /**
     * Returns string for specialism based on id or string
     *
     * @param string $id
     * @return void
     */
    public static function specialism(?string $id)
    {
        if (!$id)
            return;

        if (is_numeric($id)){
            $specialism = Specialism::find($id);
            if ($specialism){
                return $specialism->specialism;
            } else {
                return '';
            }
        } else {
            return $id;
        }
    }

    /**
     * Returns string for school based on id or string
     *
     * @param string $id
     * @return void
     */
    public static function school(string $id)
    {
        if (is_numeric($id)){
            $school = School::find($id);
            if ($school){
                return $school->school;
            } else {
                return '';
            }
        } else {
            return $id;
        }
    }

    /**
     * Returns string for city based on id or string
     *
     * @param string $id
     * @return void
     */
    public static function city(string $id)
    {
        if (is_numeric($id)){
            $city = City::find($id);
            if ($city){
                return $city->name;
            } else {
                return '';
            }
        } else {
            return $id;
        }
    }

    /**
     * Returns string for country based on id or string
     *
     * @param string $id
     * @return void
     */
    public static function country(string $id)
    {
        if (is_numeric($id)){
            $country = Country::find($id);
            if ($country){
                return $country->name;
            } else {
                return '';
            }
        } else {
            return $id;
        }
    }

    /**
     * Returns string for sector based on id or string
     *
     * @param string $id
     * @return void
     */
    public static function sector(?string $id)
    {
        if (!$id)
            return;

        if (is_numeric($id)){
            $sector = Sector::find($id);
            if ($sector){
                return $sector->sector;
            } else {
                return '';
            }
        } else {
            return $id;
        }
    }
}
