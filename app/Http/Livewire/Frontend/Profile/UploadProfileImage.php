<?php

namespace App\Http\Livewire\Frontend\Profile;

use Livewire\Component;
use App\Utilities\Base64ImageToS3;
use Illuminate\Support\Facades\Auth;

class UploadProfileImage extends Component
{
    public $user, $imageMain, $imageMini;
    public $showImageModal = false;

    protected $listeners = ['updateImageMain', 'updateImageMini', 'saveProfileImages'];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function updateImageMain(string $image)
    {
        $this->imageMain = $image;
    }

    public function updateImageMini(string $image)
    {
        $this->imageMini = $image;
    }

    /**
     * Save profile images
     *
     * @return void
     */
    public function saveProfileImages()
    {
        // dimensions:
        // profile_image: 840 × 628 (420 x 314)
        // profile_image_small: 840 × 1088 (420 x 544)
        if ($this->imageMain){
            $file = Base64ImageToS3::uploadToS3($this->imageMain, 'profile-image');
            $this->user->profile_image = $file;
        }
        if ($this->imageMini){
            $file = Base64ImageToS3::uploadToS3($this->imageMini, 'profile-image-mini');
            $this->user->profile_image_small = $file;
        }
        $this->user->save();
        $this->showImageModal = false;

    }

    public function render()
    {
        $this->user = Auth::user();

        return view('livewire.frontend.profile.upload-profile-image');
    }
}
