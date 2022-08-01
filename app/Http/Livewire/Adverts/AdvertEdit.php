<?php

namespace App\Http\Livewire\Adverts;

use App\Models\Advert;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Utilities\Base64ImageToS3;

class AdvertEdit extends Component
{
    use Actions;

    public $advert, $advertId, $advertImage, $imageBase64;
    public $showImageModal = false;

    protected $rules = [
        'advert.name' => 'required|string|min:2',
        'advert.link' => 'required|string|min:2',
        'advert.start_date' => '',
        'advert.end_date' => '',
        'advert.active' => '',
        'advert.type' => '',
        'advertImage' => '',
    ];

    protected $listeners = ['updateImage'];

    public function updateImage(string $image)
    {
        $this->imageBase64 = $image;
    }

    public function mount($id)
    {
        if($id == 'new'){
            $this->advert = new Advert();
        } else {
            $this->advert = Advert::find($id);
        }
        $this->advertId = $id;
    }

    public function render()
    {
        return view('livewire.adverts.advert-edit',
            [
                'advert' => $this->advert,
        ]);
    }

    public function store()
    {

        $validatedData = $this->validate($this->rules);

        $id = $this->advertId == 'new' ? false : $this->advertId;
        $data = $validatedData['advert'];

        if ($this->imageBase64){
            $file = Base64ImageToS3::uploadToS3($this->imageBase64, 'events');
            $data['image_large'] = $file;
        }

        $advert = Advert::updateOrCreate(['id' => $id], $data);

        if ($advert){
            if (!$id){
                $this->advertId = $advert->id;
            }

            $this->notification()->notify([
                'title'       => 'Advert saved!',
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
