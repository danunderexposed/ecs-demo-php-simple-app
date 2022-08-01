<?php

namespace App\Http\Livewire\Competitions;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;
use App\Models\CompetitionCategory;

class CompetitionCategories extends Component
{
    use WithPagination, Actions, WithSorting;

    public $search = "";
    public $name, $cat_id;
    public $isEditing = false;
    public $editModalTitle = "Edit Competition Category";

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'sortBy',
        'sortDirection'
    ];

    public function render()
    {
        $this->sortBy = $this->sortBy ?: 'name';

        return view('livewire.competitions.competition-categories', [
            'categories' => CompetitionCategory::search($this->search, ['name'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20)
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->editModalTitle = "Add Competition Category";
        $this->isEditing = true;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->cat_id = null;
    }

    public function store()
    {

        $this->validate([
            'name' => 'required',
        ]);

        CompetitionCategory::updateOrCreate(['id' => $this->cat_id], [
            'name' => $this->name
        ]);

        $this->notification()->notify([
            'title'       => 'Category Saved!',
            'icon'        => 'success'
        ]);

        $this->isEditing = false;
        $this->resetInputFields();

    }

    public function edit($id)
    {
        $cat = CompetitionCategory::findOrFail($id);
        $this->cat_id = $id;
        $this->name = $cat->name;
        $this->editModalTitle = "Edit Competition Category";
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
        CompetitionCategory::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Competition Category Deleted!',
            'icon'        => 'success'
        ]);
    }
}
