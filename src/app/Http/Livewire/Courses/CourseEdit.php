<?php

namespace App\Http\Livewire\Courses;

use App\Models\City;
use App\Models\Course;
use App\Models\School;
use Livewire\Component;
use App\Models\Specialism;
use App\Models\StudyLevel;
use WireUi\Traits\Actions;
use App\Utilities\Base64ImageToS3;

class CourseEdit extends Component
{
    use Actions;

    public $course, $courseImage, $courseId, $about;
    protected $rules = [
        'course.name' => 'required|string|min:2',
        'course.city_id' => 'required',
        'courseImage' => '',
        'course.studylevel_id' => '',
        'course.specialism' => '',
        'course.specialism2' => '',
        'course.specialism3' => '',
        'course.image' => '',
        'course.logo_link' => '',
        'about' => '',
        'course.school_id' => '',
        'course.city_id' => '',
        'course.division' => '',
        'course.address1' => '',
        'course.address2' => '',
        'course.postcode' => '',
        'course.leadertitle' => '',
        'course.leadername' => '',
        'course.contactemail' => '',
        'course.tel' => '',
        'course.admissionemail' => '',
        'course.admissionurl' => '',
        'course.website' => '',
        'course.active' => '',
        'course.coursenotify' => '',
        'course.contacturl' => '',
    ];
    protected $listeners = ['updateImage'];

    public function updateImage(string $image)
    {
        $this->courseImage = $image;
    }

    public function mount($id)
    {
        if($id == 'new'){
            $this->course = new Course();
        } else {
            $this->course = Course::find($id);
        }
        $this->courseId = $id;
    }

    public function render()
    {
        $cities = City::all();
        $studyLevels = StudyLevel::all();
        $specialisms = Specialism::all();
        $schools = School::all();

        return view('livewire.courses.course-edit',
            [
                'course' => $this->course,
                'all_cities' => $cities,
                'all_studylevels' => $studyLevels,
                'all_specialisms' => $specialisms,
                'all_schools' => $schools
            ]
        );
    }

    public function store()
    {
        $validatedData = $this->validate($this->rules);

        $id = $this->courseId == 'new' ? false : $this->courseId;
        $data = $validatedData['course'];

        if ($this->courseImage){
            $file = Base64ImageToS3::uploadToS3($this->courseImage, 'courses');
            $data['image'] = $file;
        }
        $data['about'] = $this->about;

        $course = Course::updateOrCreate(['id' => $id], $data);

        if ($course){
            if (!$id){
                $this->courseId = $course->id;
            }

            $this->notification()->notify([
                'title'       => 'Course saved!',
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
