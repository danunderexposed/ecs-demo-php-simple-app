<?php

namespace App\Http\Livewire\Frontend\Profile;

use Livewire\Component;
use App\Utilities\Base64ImageToS3;
use Illuminate\Support\Facades\Auth;

class UploadPortfolioImage extends Component
{
    public $user, $project, $imageMain;
    public $showImageModal = false;

    protected $listeners = ['updateCoverImage', 'saveCoverImage'];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function updateCoverImage(string $image)
    {
        $this->imageMain = $image;
    }


    /**
     * Save profile images
     *
     * @return void
     */
    public function saveCoverImage()
    {
        // 600 x 424
        if ($this->imageMain){
            $file = Base64ImageToS3::uploadToS3($this->imageMain, 'portfolio-image');
            $this->project->cover_large = $file;
            $this->project->cover_small = $file;
            $this->project->cover_medium = $file;
        }

        $this->project->save();
        $this->showImageModal = false;

    }

    public function render()
    {
        $this->user = Auth::user();

        return view('livewire.frontend.profile.upload-portfolio-image');
    }
}
