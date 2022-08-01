<?php

namespace App\Http\Livewire\Homepage;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use App\Models\HomepageHero;
use Livewire\WithPagination;

class HomepageHeroList extends Component
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
        $this->sortBy = $this->sortBy ?: 'homepage_hero.title';

        $heroes = HomepageHero::search($this->search, ['title', 'pre_title', 'link'])
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(20);

        return view('livewire.homepage.homepage-hero-list', [
            'heroes' => $heroes
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('homepage.hero', ['id' => $id]);
    }

    public function add()
    {
        return redirect()->route('homepage.hero', ['id' => 'new']);
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
        $hero = HomepageHero::find($id);

        // delete images TDB **

        $hero->delete();

        $this->notification()->notify([
            'title'       => 'Homepage Hero deleted!',
            'icon'        => 'success'
        ]);
    }

}
