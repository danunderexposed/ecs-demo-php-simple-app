<?php

namespace App\Http\Livewire\Schools;

use App\Models\City;
use App\Models\School;
use App\Utilities\Base64ImageToS3;
use Livewire\Component;
use WireUi\Traits\Actions;

class SchoolsEdit extends Component
{
    use Actions;

    public $school, $schoolId, $excerpt, $description;
    public $schoolImage = false;
    public $sliderImage = false;

    protected $rules = [
        'school.school' => 'required|string|min:2',
        'school.city_id' => 'required',
        'excerpt' => '',
        'description' => '',
        'schoolImage' => '',
        'description' => '',
        'school.website' => '',
        'school.twitter' => '',
        'school.facebook' => '',
        'school.linkedin' => '',
        'school.youtube' => '',
        'school.instagram' => '',
        'school.pinterest' => '',
        'school.display_instagram' => '',
        'school.featured' => '',
        'school.separate' => '',
    ];

    protected $listeners = ['updateImage', 'updateSliderImage'];

    public function updateImage(string $image)
    {
        $this->schoolImage = $image;
    }

    public function updateSliderImage(string $image)
    {
        $this->sliderImage = $image;
    }

    public function mount($id)
    {
        if($id == 'new'){
            $this->school = new School();
        } else {
            $this->school = School::find($id);
        }
        $this->schoolId = $id;
    }

    public function render()
    {
        $cities = City::all();
        return view('livewire.schools.edit',
            [
                'school' => $this->school,
                'all_cities' => $cities
        ]);
    }

    public function store()
    {

        $validatedData = $this->validate($this->rules);

        $id = $this->schoolId == 'new' ? false : $this->schoolId;

        $data = $validatedData['school'];
        $data['excerpt'] = $this->excerpt;
        $data['description'] = $this->description;

        if ($this->schoolImage){
            $file = Base64ImageToS3::uploadToS3($this->schoolImage, 'schools');
            $data['image'] = $file;
        }

        if ($this->sliderImage){
            $file = Base64ImageToS3::uploadToS3($this->sliderImage, 'schools');
            $data['slider'] = $file;
        }


        $school = School::updateOrCreate(['id' => $id], $data);

        if ($school){
            if (!$id){
                $this->schoolId = $school->id;
            }

            $this->notification()->notify([
                'title'       => 'School saved!',
                'icon'        => 'success'
            ]);
        } else {
            $this->notification()->notify([
                'title'       => 'There was an error!',
                'icon'        => 'error'
            ]);
        }

    }
}
