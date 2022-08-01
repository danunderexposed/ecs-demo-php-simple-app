<?php

namespace App\Http\Livewire\Homepage;

use App\Models\Sponsor;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class HomepageSponsorList extends Component
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
        $this->sortBy = $this->sortBy ?: 'sponsors.name';

        $sponsors = Sponsor::search($this->search, ['name', 'url'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(20);

        return view('livewire.homepage.homepage-sponsor-list', [
            'sponsors' => $sponsors
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('homepage.sponsor', ['id' => $id]);
    }

    public function add()
    {
        return redirect()->route('homepage.sponsor', ['id' => 'new']);
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
        $sponsor = Sponsor::find($id);

        // delete images TDB **

        $sponsor->delete();

        $this->notification()->notify([
            'title'       => 'Homepage Sponsor deleted!',
            'icon'        => 'success'
        ]);
    }
}
