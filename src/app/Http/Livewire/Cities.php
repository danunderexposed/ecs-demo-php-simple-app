<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class Cities extends Component
{
    use WithPagination, Actions, WithSorting;

    public $search = "";
    public $name, $country_id, $city_id;
    public $isEditing = false;
    public $editModalTitle = "Edit Country";
    public $allCountries;
    //public $sortBy = 'cities.name';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'sortBy',
        'sortDirection'
    ];

    public function render()
    {
        $this->sortBy = $this->sortBy ?: 'cities.name';

        return view('livewire.cities', [
            'cities' => City::search($this->search, ['country.name', 'name'])
                ->select('cities.*')
                ->join('countries', 'cities.country_id', '=', 'countries.id')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20),
            'all_countries' => Country::all()
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->editModalTitle = "Add Country";
        $this->isEditing = true;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->country_id = '';
        $this->city_id = null;
    }

    public function store()
    {

        $this->validate([
            'name' => 'required',
            'country_id' => 'required',
        ]);

        City::updateOrCreate(['id' => $this->city_id], [
            'name' => $this->name,
            'country_id' => $this->country_id
        ]);

        $this->notification()->notify([
            'title'       => 'City Saved!',
            'icon'        => 'success'
        ]);

        $this->isEditing = false;
        $this->resetInputFields();

    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        $this->city_id = $id;
        $this->name = $city->name;
        $this->country_id = $city->country_id;
        $this->editModalTitle = "Edit City";
        $this->isEditing = true;
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
        City::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'City Deleted!',
            'icon'        => 'success'
        ]);
    }
}
