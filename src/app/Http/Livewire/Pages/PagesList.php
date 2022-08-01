<?php

namespace App\Http\Livewire\Pages;

use App\Models\Page;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Traits\WithSorting;
use Livewire\WithPagination;

class PagesList extends Component
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
        $this->sortBy = $this->sortBy ?: 'title';

        return view('livewire.pages.pages-list', [
            'pages' => Page::search($this->search, ['title', 'content'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(20)
        ]);
    }


    public function edit($id)
    {
        return redirect()->route('page-edit', ['id' => $id]);
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
        Page::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Page Deleted!',
            'icon'        => 'success'
        ]);
    }
}
