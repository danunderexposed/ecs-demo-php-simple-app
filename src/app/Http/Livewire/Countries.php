<?php

namespace App\Http\Livewire;

use App\Traits\WithSorting;
use App\Models\Country;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithPagination;

class Countries extends Component
{
    use WithPagination, Actions, WithSorting;

    public $search = "";
    public $name, $country_id;
    public $isEditing = false;
    public $editModalTitle = "Edit Country";

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'sortBy',
        'sortDirection'
    ];

    public function render()
    {
        $this->sortBy = $this->sortBy ?: 'name';

        return view('livewire.countries', [
            'countries' => Country::search($this->search, ['name'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20)
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
        $this->country_id = null;
    }

    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);

        Country::updateOrCreate(['id' => $this->country_id], [
            'name' => $this->name
        ]);

        $this->notification()->notify([
            'title'       => 'Country Saved!',
            'icon'        => 'success'
        ]);

        $this->isEditing = false;
        $this->resetInputFields();

    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        $this->country_id = $id;
        $this->name = $country->name;
        $this->editModalTitle = "Edit Country";
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
        Country::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Country Deleted!',
            'icon'        => 'success'
        ]);
    }
}
