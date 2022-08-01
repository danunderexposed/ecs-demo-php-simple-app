<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use App\Models\Specialism;
use App\Models\StudyLevel;
use WireUi\Traits\Actions;
use App\Models\ProjectMedia;
use App\Utilities\LookupVideo;
use App\Utilities\Base64ImageToS3;

class ProjectEdit extends Component
{
    use Actions;

    public $project, $projectId, $projectImage, $projectImages, $imageBase64, $image, $imageId, $imageOrder, $videoUrl;
    public $showImageModal, $orderUpdated, $video= false;

    protected $rules = [
        'project.title' => 'required|string|min:2',
        'project.description' => '',
        'project.slug' => '',
        'project.specialism' => '',
        'project.specialism2' => '',
        'project.specialism3' => '',
        'project.display' => '',
        'project.sort_order' => 'numeric',
        'image.title' => '',
        'image.description' => '',
        'image.slug' => '',
        'image.vidurl' => '',
    ];

    protected $listeners = ['updateImage'];

    public function updateImage(string $image)
    {
        $this->imageBase64 = $image;
    }

    public function mount($id)
    {
        if($id == 'new'){
            $this->project = new Project();
        } else {
            $this->project = Project::find($id);
        }
        $this->projectId = $id;
    }

    public function render()
    {
        $specialisms = Specialism::all();
        $this->projectImages = $this->getOrderedImages();

        return view('livewire.projects.project-edit',
            [
                'project' => $this->project,
                'all_specialisms' => $specialisms,
        ]);
    }

    public function editImage($id)
    {
        $this->showImageModal = true;
        $this->imageId = $id;
        if ($id != 'new'){
            $this->imageBase64 = '';
            $this->image = ProjectMedia::find($id);
            if ($this->image->vidurl)
                $this->video = true;
        } else {
            $this->image = new ProjectMedia();
        }
        //dd($this->imageId);
    }

    public function deleteImage($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Are you sure you want to delete?',
            'icon'        => 'warning',
            'accept'      => [
                'label'  => 'Yes, delete it',
                'method' => 'confirmDeleteImage',
                'params' => $id,
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function updateImageOrder($updatedOrder)
    {
        $this->imageOrder = $updatedOrder;
        $this->orderUpdated = true;
       // dd($this->imageOrder);
    }

    public function saveImageOrder()
    {
        foreach ($this->imageOrder as $order){
            $media = ProjectMedia::find($order['value']);
            $media->sort_order = $order['order'];
            $media->save();
        }

        $this->orderUpdated = false;
        $this->notification()->notify([
            'title'       => 'Image order saved!',
            'icon'        => 'success'
        ]);
    }

    public function confirmDeleteImage($id)
    {
        ProjectMedia::find($id)->delete();
        $this->project->load('media');
        $this->notification()->notify([
            'title'       => 'Project image Deleted!',
            'icon'        => 'success'
        ]);
    }

    public function storeImage()
    {

        $validatedData = $this->validate([
            'image.title' => 'required',
            'image.description' => '',
            'image.slug' => '',
            'image.vidurl' => ''
        ]);

        $data = $validatedData['image'];
        $data['project_id'] = $this->projectId;
        $data['sort_order'] = 0;

        if ($this->imageBase64){
            $file = Base64ImageToS3::uploadToS3($this->imageBase64, 'projects');
            $data['image_large'] = $file;
        }
        //dd($this->video);
        if ($this->video){
            $data['image_large'] = LookupVideo::lookup($this->image->vidurl);
        }

        $id = $this->imageId == 'new' ? false : $this->imageId;

        $projectMedia = ProjectMedia::updateOrCreate(['id' => $id], $data);

        if ($projectMedia){
            $this->notification()->notify([
                'title'       => $id ? 'Project image updated!' : 'Project image added!',
                'icon'        => 'success'
            ]);
            $this->showImageModal = false;
            $this->project->load('media');
        }
       // dd($data);
    }

    public function store()
    {

        $validatedData = $this->validate($this->rules);

        $id = $this->projectId == 'new' ? false : $this->projectId;
        $data = $validatedData['project'];

        $project = Project::updateOrCreate(['id' => $id], $data);

        if ($project){
            if (!$id){
                $this->projectId = $project->id;
            }

            $this->notification()->notify([
                'title'       => 'Project saved!',
                'icon'        => 'success'
            ]);
        } else {
            $this->notification()->notify([
                'title'       => 'There was an error!',
                'icon'        => 'error'
            ]);
        }

    }

    public function lookupVideo()
    {
        $this->videoUrl = $this->image->vidurl;
        $this->image->image_large = LookupVideo::lookup($this->videoUrl);
       // dd($this->image);
    }

    private function getOrderedImages()
    {
        if (is_array($this->imageOrder)){
            $projectImages = collect();
            foreach ($this->imageOrder as $item){
                $projectImages->push(ProjectMedia::find($item['value']));
            }
          //  dd($projectImages);
            return $projectImages;
        } else {
            return $this->project->media;
        }
    }
}
