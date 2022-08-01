<?php

namespace App\Http\Livewire\Frontend\Profile;

use Livewire\Component;
use App\Models\ProjectMedia;
use App\Utilities\LookupVideo;
use App\Utilities\Base64ImageToS3;
use Illuminate\Support\Facades\Auth;

class PortfolioImageGallery extends Component
{
    public $user, $project, $imageMain, $imageOrder;
    public $showImageModal, $orderUpdated = false;

    protected $listeners = ['updateImageGallery', 'savePortfolioImage', 'imageTitleUpdate'];

    protected $rules = [
        'project.media.*.title' => 'string',
        'project.media.*.vidurl' => 'string',
    ];

    public function mount()
    {
        $this->user = auth()->user();

    }

    public function updateImageGallery(string $image)
    {
        $this->imageMain = $image;
    }

    public function addVideo()
    {
        $projectMedia = ProjectMedia::create([
            'project_id' => $this->project->id,
            'vidurl' => '',
            'sort_order' => 0,
            'is_video' => true
        ]);
        $this->project->media()->save($projectMedia);
        $this->project->load('media');
        $this->mount();
        $this->render();
    }

    /**
     * Save profile images
     *
     * @return void
     */
    public function savePortfolioImage()
    {

        if ($this->imageMain){
            $file = Base64ImageToS3::uploadToS3($this->imageMain, 'portfolio-image');
            $projectMedia = ProjectMedia::create([
                'project_id' => $this->project->id,
                'image_small' => $file,
                'image_medium' => $file,
                'image_large' => $file,
                'sort_order' => 0
            ]);
            $this->project->media()->save($projectMedia);
        }
        $this->project->load('media');
        $this->mount();
        $this->render();
        $this->showImageModal = false;

    }

    public function updateImageOrder($updatedOrder)
    {
        $this->imageOrder = $updatedOrder;
        //dd($updatedOrder);
        // set order in DB
        foreach ($updatedOrder as $o){
            $media = ProjectMedia::find($o['value']);
            $media->sort_order = $o['order'];
            $media->save();
        }
        $this->project->load('media');
        $this->orderUpdated = true;
    }

    public function imageTitleUpdate($mediaId) {
        foreach ($this->project->media as $media) {
            if ($media->id == $mediaId){
                if ($media->is_video)
                    $media->image_small = LookupVideo::lookup($media->vidurl);
                $media->save();
            }
        }
    }

    public function render()
    {
        $this->user = Auth::user();

        return view('livewire.frontend.profile.portfolio-image-gallery', ['project' => $this->project]);
    }
}
