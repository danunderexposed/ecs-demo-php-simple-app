<?php

namespace App\Http\Livewire\Courses;

use App\Models\Course;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class CoursesList extends Component
{
    use WithPagination, Actions, WithSorting;

    public $search = "";
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'sortBy',
        'sortDirection'
    ];

    public function render()
    {
        $this->sortBy = $this->sortBy ?: 'name';

        return view('livewire.courses.courses-list', [
            'courses' => Course::search($this->search, ['name'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20),
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('courses.edit', ['id' => $id]);
    }

    public function add()
    {
        return redirect()->route('courses.edit', ['id' => 'new']);
    }

    public function delete($id) : void
    {
        $this->dialog()->confirm([
            'title'       => 'Are you sure you want to delete?',
            'icon'        => 'warning',
            'accept'      => [
                'label'  => 'Yes, delete it',
                'method' => 'confirmDelete',
                'params' => $id,
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function confirmDelete($id)
    {
        Course::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Course Deleted!',
            'icon'        => 'success'
        ]);
    }
}
