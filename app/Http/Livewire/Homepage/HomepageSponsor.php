<?php

namespace App\Http\Livewire\Homepage;

use Livewire\Component;
use App\Models\Sponsor;
use WireUi\Traits\Actions;
use App\Utilities\Base64ImageToS3;

class HomepageSponsor extends Component
{
    use Actions;

    public $sponsor;
    public $image = false;
    public $sponsorId;

    protected $rules = [
        'sponsor.name' => 'required|string|min:2',
        'image' => '',
        'sponsor.url' => 'required',
        'sponsor.sort_order' => ''
    ];


    protected $listeners = ['updateImage'];

    public function mount($id)
    {
        $this->sponsorId = $id;
        if ($id != 'new'){
            $this->sponsor = Sponsor::find($id);
        } else {
            $this->sponsor = new Sponsor();
        }
    }

    public function render()
    {
        return view('livewire.homepage.homepage-sponsor', ['sponsor' => $this->sponsor]);
    }


    public function updateImage(string $image)
    {
        $this->image = $image;
    }

    public function store()
    {
        $validatedData = $this->validate($this->rules);

      // dd($validatedData);

        $id = $this->sponsorId == 'new' ? false : $this->sponsorId;

        $data = $validatedData['sponsor'];

        // image processing
        if ($this->image){
            $file = Base64ImageToS3::uploadToS3($this->image, 'homepage-sponsor');
            $data['image_large'] = $file;
        }

        //dd($data);

        $sponsor = Sponsor::updateOrCreate(['id' => $id], $data);

        $this->notification()->notify([
            'title'       => 'Homepage Sponsor Saved!',
            'icon'        => 'success'
        ]);

    }
}
