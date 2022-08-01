<?php

namespace App\Http\Livewire\Homepage;

use Livewire\Component;
use App\Models\Homepage;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class HomepageModuleList extends Component
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
        $this->sortBy = $this->sortBy ?: 'homepage.name';

        $modules = Homepage::search($this->search, ['name', 'type', 'link'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(20);

        return view('livewire.homepage.homepage-module-list', [
            'modules' => $modules
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('homepage.module', ['id' => $id]);
    }

    public function add()
    {
        return redirect()->route('homepage.module', ['id' => 'new']);
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
        $homepage = Homepage::find($id);

        // delete images TDB **

        $homepage->delete();

        $this->notification()->notify([
            'title'       => 'Homepage Module deleted!',
            'icon'        => 'success'
        ]);
    }
}
