<?php

namespace App\Http\Livewire;

use App\Models\StudyLevel;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class StudyLevels extends Component
{
    use WithPagination, Actions, WithSorting;

    public $search = "";
    public $studylevel, $studylevel_id;
    public $isEditing = false;
    public $editModalTitle = "Edit Study Level";

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
        'sortBy',
        'sortDirection'
    ];

    public function render()
    {
        $this->sortBy = $this->sortBy ?: 'studylevel';

        return view('livewire.study-levels', [
            'studylevels' => StudyLevel::search($this->search, ['studylevel'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->editModalTitle = "Add Study Level";
        $this->isEditing = true;
    }

    private function resetInputFields()
    {
        $this->studylevel = '';
        $this->studylevel_id = null;
    }

    public function store()
    {

        $this->validate([
            'studylevel' => 'required',
        ]);

        StudyLevel::updateOrCreate(['id' => $this->studylevel_id], [
            'studylevel' => $this->studylevel,
        ]);

        $this->notification()->notify([
            'title'       => 'Study Level Saved!',
            'icon'        => 'success'
        ]);

        $this->isEditing = false;
        $this->resetInputFields();

    }

    public function edit($id)
    {
        $s = StudyLevel::findOrFail($id);
        $this->studylevel_id = $id;
        $this->studylevel = $s->studylevel;
        $this->editModalTitle = "Edit Study Level";
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
        StudyLevel::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Study Level Deleted!',
            'icon'        => 'success'
        ]);
    }
}
