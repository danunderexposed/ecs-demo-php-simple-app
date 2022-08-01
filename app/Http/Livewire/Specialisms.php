<?php

namespace App\Http\Livewire;

use App\Models\Sector;
use Livewire\Component;
use App\Models\Specialism;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class Specialisms extends Component
{
    use WithPagination, Actions, WithSorting;

    public $search = "";
    public $specialism, $specialism_id, $sector_id, $slug;
    public $isEditing = false;
    public $editModalTitle = "Edit Specialism";
    //public $sortBy = 'cities.name';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'sortBy',
        'sortDirection'
    ];

    public function render()
    {
        $this->sortBy = $this->sortBy ?: 'specialisms.specialism';

        return view('livewire.specialisms', [
            'specialisms' => Specialism::search($this->search, ['sector.sector', 'specialism', 'slug'])
                ->select('specialisms.*')
                ->join('sectors', 'specialisms.sector_id', '=', 'sectors.id')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20),
            'all_sectors' => Sector::all()
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->editModalTitle = "Add Specialism";
        $this->isEditing = true;
    }

    private function resetInputFields()
    {
        $this->specialism = '';
        $this->slug = '';
        $this->sector_id = '';
        $this->specialism_id = null;
    }

    public function store()
    {

        $this->validate([
            'specialism' => 'required',
            'slug' => 'required',
            'sector_id' => 'required',
        ]);

        Specialism::updateOrCreate(['id' => $this->specialism_id], [
            'specialism' => $this->specialism,
            'slug' => $this->slug,
            'sector_id' => $this->sector_id
        ]);

        $this->notification()->notify([
            'title'       => 'Specialism Saved!',
            'icon'        => 'success'
        ]);

        $this->isEditing = false;
        $this->resetInputFields();

    }

    public function edit($id)
    {
        $specialism = Specialism::findOrFail($id);
        $this->specialism_id = $id;
        $this->specialism = $specialism->specialism;
        $this->slug = $specialism->slug;
        $this->sector_id = $specialism->sector_id;
        $this->editModalTitle = "Edit Specialism";
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
        Specialism::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Specialism Deleted!',
            'icon'        => 'success'
        ]);
    }
}
