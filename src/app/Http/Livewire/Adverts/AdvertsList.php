<?php

namespace App\Http\Livewire\Adverts;

use App\Models\Event;
use App\Models\Advert;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class AdvertsList extends Component
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

        return view('livewire.adverts.adverts-list', [
            'adverts' => Advert::search($this->search, ['name'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20)
        ]);
    }


    public function edit($id)
    {
        return redirect()->route('advert-edit', ['id' => $id]);
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
        Advert::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Advert Deleted!',
            'icon'        => 'success'
        ]);
    }
}
