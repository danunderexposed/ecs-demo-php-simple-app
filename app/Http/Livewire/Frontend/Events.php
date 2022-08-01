<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\DB;
use Log;

class Events extends Component
{
    use Actions, WithPagination;

    public $search;

    public function render()
    {
        return view('livewire.frontend.events', [
            'events' => $this->filterEvents(),
            'featured' => Event::where('featured', 1)->orderBy('eventorder', 'asc')->get()
        ]);
    }

    public function updated($name, $value)
    {
        $this->resetPage();
        $this->render();
    }

    private function filterEvents()
    {
        $query = Event::where('active', 1)->where('is_hidden', '!=', 1);

        if($this->search && $this->search != '') {
            $search = $this->search;
            $query = $query->where(function($query) use ($search) {
                $query->orWhere('name', 'LIKE', '%%' . $search . '%%')
                    ->orWhere('description', 'LIKE', '%%' . $search . '%%');
            });
        }

        return $query->orderBy('start_date', 'desc')->paginate(20);
    }
}
