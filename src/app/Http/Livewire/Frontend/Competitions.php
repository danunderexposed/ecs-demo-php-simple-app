<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Competition;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\DB;
use Log;

class Competitions extends Component
{
    use Actions, WithPagination;

    public $status;

    public function render()
    {
        return view('livewire.frontend.competitions', [
            'competitions' => $this->filterCompetitions(),
            'featured' => Competition::where('featured', 1)->where('onlyportfolio', 0)->orderBy('comporder', 'asc')->get()
        ]);
    }

    public function updated($name, $value)
    {
        $this->resetPage();
        Log::info(print_r($this->status, true));
        $this->render();
    }

    private function filterCompetitions()
    {
        $query = Competition::where('active', 1)->where('onlyportfolio', 0);

        if($this->status) {
            $statuses = [];
            $add = false;
            foreach ($this->status as $s) {
                if($s) {
                    $add = true;
                    array_push($statuses, $s);
                }
            }
            if($add) {
                $query = $query->whereIn('status', $statuses);
            }
        }

        return $query->orderBy('deadline', 'desc')->orderBy('end_date', 'desc')->paginate(12);
    }
}
