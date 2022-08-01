<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $table = "options";
    protected $fillable = [
            'id',
            'option_name',
            'option_value'
    ];

    public function scopeByOptionName($query, String $name)
    {
        return $query->where('option_name', $name);
    }

    public function getJsonValue()
    {

        if ($this->option_value && $items = json_decode(stripslashes($this->option_value), true)){
            return $items;
        } else {
            return [];
        }
    }

    /**
     * Return array of sector objects based on JSON value
     *
     * @return array
     */
    public function getProjectObjects()
    {
        if ($this->option_value && $items = json_decode(stripslashes($this->option_value), true)){
            $projects = [];

            foreach ($items as $id){
                $itemId = $id;
                if (is_array($id)){
                    $itemId = $id['value'];
                }

                $project = Project::where('id', $itemId)->with(['specialismOne', 'specialismTwo', 'specialismThree'])->first();
                if ($project)
                    $projects[] = $project;
            }

            return $projects;
        } else {
            return [];
        }
    }

    public function getGridObjects()
    {
        if ($this->option_value && $items = json_decode(stripslashes($this->option_value), true)){
            $projects = [];

            foreach ($items as $id){
                $itemId = $id;
                if (is_array($id)){
                    $itemId = $id['value'];
                }

                $project = Homepage::find($itemId);
                if ($project)
                    $projects[] = $project;
            }

            return $projects;
        } else {
            return [];
        }
    }
}
