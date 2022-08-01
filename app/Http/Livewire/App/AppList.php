<?php

namespace App\Http\Livewire\App;

use App\Models\App;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class AppList extends Component
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

        return view('livewire.app.app-list', [
            'apps' => App::search($this->search, ['title'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20),
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('apps.edit', ['id' => $id]);
    }

    public function add()
    {
        return redirect()->route('apps.edit', ['id' => 'new']);
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
        App::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'App Deleted!',
            'icon'        => 'success'
        ]);
    }
}
