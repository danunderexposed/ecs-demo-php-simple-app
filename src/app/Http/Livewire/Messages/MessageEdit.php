<?php

namespace App\Http\Livewire\Messages;

use App\Models\Event;
use App\Models\Message;
use App\Models\Project;
use Livewire\Component;
use App\Models\EventEntry;
use WireUi\Traits\Actions;
use App\Utilities\LookupVideo;
use Illuminate\Support\Carbon;
use App\Utilities\Base64ImageToS3;

class MessageEdit extends Component
{
    use Actions;

    public $message, $messageId;

    public function mount($id)
    {
        $this->message = Message::find($id);
        $this->messageId = $id;
    }

    public function render()
    {
        return view('livewire.messages.message-edit',
            [
                'message' => $this->message,
        ]);
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
        return redirect()->route('message-list');
    }

    public function back()
    {
        return redirect()->route('message-list');
    }

}
