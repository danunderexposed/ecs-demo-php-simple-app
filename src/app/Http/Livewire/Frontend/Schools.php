<?php

namespace App\Http\Livewire\Frontend;

use Log;
use App\Models\Course;
use App\Models\School;
use App\Models\Sector;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Schools extends Component
{
    use Actions, WithPagination;

    public $status;

    public function render()
    {
        return view('livewire.frontend.schools', [
            'courses' => $this->filterCourses(),
            'featured' => School::where('featured', 1)->orderBy('schoolorder', 'asc')->get(),
            "sectors" => Sector::with('specialisms')->get()
        ]);
    }

    public function updated($name, $value)
    {
        $this->resetPage();
        Log::info(print_r($this->status, true));
        $this->render();
    }

    private function filterCourses()
    {
        $query = Course::where('active', true)->whereNotNull('slug')->orderBy('courseorder')->paginate(12);

        return $query;

        $query = School::whereNotNull('slug');

        if($this->status) {
            $statuses = [];
            $add = false;
            foreach ($this->status as $s) {
                if($s) {
                    $add = true;
                    array_push($statuses, $s);
                }
            }
            if($add) {
                $query = $query->whereIn('status', $statuses);
            }
        }

        return $query->orderBy('id', 'desc')->orderBy('school', 'desc')->paginate(12);
    }
}
