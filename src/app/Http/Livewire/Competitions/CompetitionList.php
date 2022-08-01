<?php

namespace App\Http\Livewire\Competitions;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\Competition;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class CompetitionList extends Component
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
        $this->sortBy = $this->sortBy ?: 'name';

        return view('livewire.competitions.competition-list', [
            'competitions' => Competition::search($this->search, ['name'])
                ->with('entries')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20),
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('competition-edit', ['id' => $id]);
    }

    public function add()
    {
        return redirect()->route('competition-edit', ['id' => 'new']);
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
        Competition::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Competition Deleted!',
            'icon'        => 'success'
        ]);
    }
}
