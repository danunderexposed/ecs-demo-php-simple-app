<?php

namespace App\Http\Livewire\Homepage;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\HomepageHero;
use App\Utilities\Base64ImageToS3;

class HomepageHeroEdit extends Component
{
    use Actions;

    public $hero;
    public $image = false;
    public $mobileImage = false;
    public $heroId;

    protected $rules = [
        'hero.title' => 'required|string|min:2',
        'hero.pre_title' => 'required',
        'image' => '',
        'mobileImage' => '',
        'hero.link' => '',
        'hero.button_text' => '',
    ];

    protected $listeners = ['updateImage', 'updateMobileImage'];

    public function mount($id)
    {
        $this->heroId = $id;
        if ($id != 'new'){
            $this->hero = HomepageHero::find($id);
        } else {
            $this->hero = new HomepageHero();
        }
    }

    public function render()
    {
        return view('livewire.homepage.hero-edit', ['hero' => $this->hero]);
    }


    public function updateImage(string $image)
    {
        $this->image = $image;
    }

    public function updateMobileImage(string $image)
    {
        $this->homepageMobileImage = $image;
    }

    public function store()
    {
        $validatedData = $this->validate($this->rules);

        $id = $this->heroId == 'new' ? false : $this->heroId;

        $data = $validatedData['hero'];

        // image processing
        if ($this->image){
            $file = Base64ImageToS3::uploadToS3($this->image, 'homepage-hero');
            $data['image'] = $file;
        }

        if ($this->mobileImage){
            $file = Base64ImageToS3::uploadToS3($this->mobileImage, 'homepage-hero');
            $data['mobile_image'] = $file;
        }

        $hero = HomepageHero::updateOrCreate(['id' => $id], $data);

        $this->notification()->notify([
            'title'       => 'Homepage Hero Saved!',
            'icon'        => 'success'
        ]);

    }
}
