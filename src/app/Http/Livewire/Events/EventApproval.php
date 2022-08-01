<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use App\Models\EventEntry;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class EventApproval extends Component
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
        $this->sortBy = $this->sortBy ?: 'events.name';

        return view('livewire.events.event-approval', [
            'entries' => EventEntry::search($this->search, ['events.name'])
                ->with('project')
                ->with('user')
                ->with('event')
                ->where('events_entry.active', false)
              //  ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20)
        ]);
    }


    public function approve($id)
    {
        $eventEntry = EventEntry::find($id);
        $eventEntry->active = true;
        $eventEntry->save();

        $this->notification()->notify([
            'title'       => 'Entry approved!',
            'icon'        => 'success'
        ]);
    }

    public function delete($id) : void
    {
        $this->dialog()->confirm([
            'title'       => 'Are you sure you want to remove?',
            'icon'        => 'warning',
            'accept'      => [
                'label'  => 'Yes, remove it',
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
        EventEntry::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Entry removed!',
            'icon'        => 'success'
        ]);
    }
}
