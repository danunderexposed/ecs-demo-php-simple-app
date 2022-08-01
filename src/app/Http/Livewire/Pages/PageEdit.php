<?php

namespace App\Http\Livewire\Pages;

use App\Models\Page;
use Livewire\Component;
use WireUi\Traits\Actions;

class PageEdit extends Component
{
    use Actions;

    public $page, $pageId;

    protected $rules = [
        'page.title' => 'required|string|min:2',
        'page.slug' => '',
        'page.content' => '',
        'page.status' => 'required',
    ];

    public function mount($id)
    {
        $this->page = Page::find($id);
        $this->pageId = $id;
    }

    public function render()
    {
        return view('livewire.pages.page-edit', [ 'page' => $this->page, ]);
    }

    public function store()
    {

        $validatedData = $this->validate($this->rules);

        $id = $this->pageId == 'new' ? false : $this->pageId;
        $data = $validatedData['page'];


        $page = Page::updateOrCreate(['id' => $id], $data);

        if ($page){
            if (!$id){
                $this->pageId = $page->id;
            }

            $this->notification()->notify([
                'title'       => 'Page saved!',
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
