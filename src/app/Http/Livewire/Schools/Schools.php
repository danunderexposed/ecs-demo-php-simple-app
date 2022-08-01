<?php

namespace App\Http\Livewire\Schools;

use App\Models\School;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class Schools extends Component
{
    use WithPagination, Actions, WithSorting;

    public $search = "";
    public $isEditing = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'sortBy',
        'sortDirection'
    ];

    public function render()
    {
        $this->sortBy = $this->sortBy ?: 'schools.school';

        return view('livewire.schools.index', [
            'schools' => School::search($this->search, ['school', 'country.name', 'city.name'])
                ->select('schools.*')
                ->join('countries', 'schools.country_id', '=', 'countries.id')
                ->join('cities', 'schools.city_id', '=', 'cities.id')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20),
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('schools.edit', ['id' => $id]);
    }

    public function add()
    {
        return redirect()->route('schools.edit', ['id' => 'new']);
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
        $school = School::find($id);

        // delete images TDB **

        $school->delete();

        $this->notification()->notify([
            'title'       => 'School Deleted!',
            'icon'        => 'success'
        ]);
    }

}
