<?php

namespace App\Http\Livewire\Events;

use App\Models\Event;
use App\Models\Project;
use Livewire\Component;
use App\Models\EventEntry;
use WireUi\Traits\Actions;
use App\Utilities\LookupVideo;
use Illuminate\Support\Carbon;
use App\Utilities\Base64ImageToS3;

class EventEdit extends Component
{
    use Actions;

    public $event, $eventId, $eventImage, $imageBase64, $isAdding, $projects, $projectSearch, $projectSearchResults;
    public $showImageModal, $orderUpdated = false;

    protected $queryString = [
        'projectSearch' => ['except' => ''],
    ];

    protected $rules = [
        'event.name' => 'required|string|min:2',
        'event.slug' => '',
        'event.description' => '',
        'event.start_date' => '',
        'event.end_date' => '',
        'event.active' => '',
        'event.entrydisplay' => '',
        'event.featured' => '',
        'event.approvalrequired' => '',
        'event.eventorder' => '',
        'event.entrydisplay' => '',
        'event.addisplay' => '',
        'event.eventuseradd' => '',
        'event.eventdisplay' => '',
        'eventImage' => '',
    ];

    protected $listeners = ['updateImage'];

    public function updateImage(string $image)
    {
        $this->imageBase64 = $image;
    }

    public function mount($id)
    {
        if($id == 'new'){
            $this->event = new Event();
        } else {
            $this->event = Event::find($id);
        }
        $this->eventId = $id;
    }

    public function render()
    {
        if (strlen($this->projectSearch) > 1){
            $this->projectSearchResults = Project::search($this->projectSearch, ['title'])->get();
        } else {
            $this->projectSearchResults = [];
        }

        return view('livewire.events.event-edit',
            [
                'event' => $this->event,
        ]);
    }

    public function showAdd()
    {
        $this->isAdding = true;
    }

    public function removeProject($itemId)
    {
        EventEntry::find($itemId)->delete();
        $this->event->load('entries');

        $this->notification()->notify([
            'title'       => 'Project removed!',
            'icon'        => 'success'
        ]);
    }

    public function add($itemId)
    {
        $project = Project::find($itemId);
        EventEntry::create([
            'eventid' => $this->event->id,
            'userid' => $project->user_id,
            'entered' => Carbon::now(),
            'projectid' => $project->id,
            'active' => true,
        ]);
        $this->isAdding = false;
        $this->event->load('entries');
        $this->notification()->notify([
            'title'       => 'Project added!',
            'icon'        => 'success'
        ]);

    }

    public function store()
    {

        $validatedData = $this->validate($this->rules);

        $id = $this->eventId == 'new' ? false : $this->eventId;
        $data = $validatedData['event'];

        if ($this->imageBase64){
            $file = Base64ImageToS3::uploadToS3($this->imageBase64, 'events');
            $data['image'] = $file;
        }

        $event = Event::updateOrCreate(['id' => $id], $data);

        if ($event){
            if (!$id){
                $this->eventId = $event->id;
            }

            $this->notification()->notify([
                'title'       => 'Event saved!',
                'icon'        => 'success'
            ]);
        } else {
            $this->notification()->notify([
                'title'       => 'There was an error!',
                'icon'        => 'error'
            ]);
        }

    }
}
