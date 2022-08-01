<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Sector;
use App\Models\Country;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class Sectors extends Component
{
    use WithPagination, Actions, WithSorting;

    public $search = "";
    public $sector, $sector_id;
    public $isEditing = false;
    public $editModalTitle = "Edit Sector";
    public $allCountries;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'sortBy',
        'sortDirection'
    ];

    public function render()
    {
        $this->sortBy = $this->sortBy ?: 'sectors.sector';

        return view('livewire.sectors', [
            'sectors' => Sector::search($this->search, ['sector'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->editModalTitle = "Add Sector";
        $this->isEditing = true;
    }

    private function resetInputFields()
    {
        $this->sector = '';
        $this->sector_id = null;
    }

    public function store()
    {

        $this->validate([
            'sector' => 'required',
        ]);

        Sector::updateOrCreate(['id' => $this->sector_id], [
            'sector' => $this->sector,
        ]);

        $this->notification()->notify([
            'title'       => 'Sector Saved!',
            'icon'        => 'success'
        ]);

        $this->isEditing = false;
        $this->resetInputFields();

    }

    public function edit($id)
    {
        $sector = Sector::findOrFail($id);
        $this->sector_id = $id;
        $this->sector = $sector->sector;
        $this->editModalTitle = "Edit Sector";
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
        Sector::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Sector Deleted!',
            'icon'        => 'success'
        ]);
    }
}
