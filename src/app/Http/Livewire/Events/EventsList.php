<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class EventsList extends Component
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

        return view('livewire.events.events-list', [
            'events' => Event::search($this->search, ['name'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20)
        ]);
    }


    public function edit($id)
    {
        return redirect()->route('event-edit', ['id' => $id]);
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
        Event::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Event Deleted!',
            'icon'        => 'success'
        ]);
    }
}
