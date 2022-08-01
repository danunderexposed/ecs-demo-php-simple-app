<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class ProjectsList extends Component
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
        $this->sortBy = $this->sortBy ?: 'title';

        return view('livewire.projects.projects-list', [
            'projects' => Project::search($this->search, ['title'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20),
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('projects.edit', ['id' => $id]);
    }

    public function add()
    {
        return redirect()->route('projects.edit', ['id' => 'new']);
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
        Project::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Project Deleted!',
            'icon'        => 'success'
        ]);
    }
}
