<?php

namespace App\Http\Livewire\Homepage;

use Livewire\Component;
use App\Models\Homepage;
use WireUi\Traits\Actions;
use App\Utilities\LookupVideo;
use App\Utilities\Base64ImageToS3;

class HomepageModule extends Component
{
    use Actions;

    public $homepage;
    public $image = false;
    public $mobileImage = false;
    public $moduleId, $videoUrl;

    protected $rules = [
        'homepage.name' => 'required|string|min:2',
        'homepage.type' => 'required',
        //'image' => '',
        //'mobileImage' => '',
        'homepage.link' => '',
        'homepage.headtxt' => '',
        'homepage.headclr' => '',
        'homepage.headbg' => '',
        'homepage.copytxt' => '',
        'homepage.copyclr' => '',
        'homepage.copybg' => '',
        'homepage.modulebg' => '',
    ];

    public $imageSizes = [
        'full1' => [192, 240],
        'full2' => [384, 240],
        'full3' => [576, 240],
        'half1' => [152, 97],
        'half2' => [304, 97],
        'port2' => [152, 194],
        'port1' => [304, 194],
    ];

    protected $listeners = ['updateImage', 'updateMobileImage'];

    public function mount($id)
    {
        $this->moduleId = $id;
        if ($id != 'new'){
            $this->homepage = Homepage::find($id);
        } else {
            $this->homepage = new Homepage();
        }
    }

    public function render()
    {
        return view('livewire.homepage.homepage-module', ['homepage' => $this->homepage]);
    }


    public function updateImage(string $image)
    {
        $this->image = $image;
    }

    public function updateMobileImage(string $image)
    {
        $this->homepageMobileImage = $image;
    }

    public function lookupVideo()
    {
        $this->homepage->image = LookupVideo::lookup($this->videoUrl);
    }

    public function store()
    {
        $validatedData = $this->validate($this->rules);
        //

       //dd($validatedData);

        $id = $this->moduleId == 'new' ? false : $this->moduleId;

        $data = $validatedData['homepage'];

        // image processing
        if ($this->image){
            $file = Base64ImageToS3::uploadToS3($this->image, 'homepage-module');
            $data['image'] = $file;
        }

        $homepage = Homepage::updateOrCreate(['id' => $id], $data);

        $this->notification()->notify([
            'title'       => 'Homepage Module Saved!',
            'icon'        => 'success'
        ]);

    }
}
