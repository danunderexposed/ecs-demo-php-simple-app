<?php

namespace App\Http\Livewire\Messages;

use App\Models\Event;
use App\Models\Message;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class MessageList extends Component
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
        $this->sortBy = $this->sortBy ?: 'username';

        return view('livewire.messages.message-list', [
            'messages' => Message::search($this->search, ['username', 'messagername', 'subject'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20)
        ]);
    }


    public function edit($id)
    {
        return redirect()->route('message-edit', ['id' => $id]);
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
        Message::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Message Deleted!',
            'icon'        => 'success'
        ]);
    }
}
