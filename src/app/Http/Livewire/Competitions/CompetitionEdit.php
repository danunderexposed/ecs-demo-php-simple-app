<?php

namespace App\Http\Livewire\Competitions;

use App\Models\Project;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\Competition;
use App\Models\CompetitionEntry;
use App\Utilities\Base64ImageToS3;
use Illuminate\Support\Carbon;

class CompetitionEdit extends Component
{
    use Actions;

    public $competitions, $competitionId, $competitionImage, $competitionImages, $imageBase64, $isAdding, $projects, $projectSearch, $projectSearchResults, $addSection;
    public $showImageModal, $orderUpdated = false;

    protected $rules = [
        'competition.title' => 'required|string|min:2',
        'competition.slug' => '',
        'competition.name' => '',
        'competition.link' => '',
        'competition.description' => '',
        'competition.image' => '',
        'competition.start_date' => '',
        'competition.end_date' => '',
        'competition.active' => '',
        'competition.entrydisplay' => '',
        'competition.entrydisplayvote' => '',
        'competition.entrytitle' => '',
        'competition.featured' => '',
        'competition.displayads' => '',
        'competition.displaycomps' => '',
        'competition.displayfilters' => '',
        'competition.winnerdisplay' => '',
        'competition.winnertitle' => '',
        'competition.hidedetails' => '',
        'competition.preview' => '',
        'competition.preview_description' => '',
        'competition.preview_displayentry' => '',
        'competition.preview_displaycomps' => '',
        'competition.preview_displayads' => '',
        'competition.preview_displaywinners' => '',
        'competition.preview_hidedetails' => '',
        'competition.onlyportfolio' => '',
        'competition.status' => '',
        'competition.deadline' => '',
        'competition.votestart' => '',
        'competition.voteend' => '',
        'competition.voteoverride' => '',
        'competition.winnerdate' => '',
        'competition.headexcerpt' => '',
        'competition.profiledisplay' => '',
        'competition.comporder' => ''
    ];

    protected $listeners = ['updateImage'];

    public function updateImage(string $image)
    {
        $this->imageBase64 = $image;
    }

    public function showAdd($addSection)
    {
        $this->addSection = $addSection;
        $this->isAdding = true;
    }

    public function mount($id)
    {
        if($id == 'new'){
            $this->competition = new Competition();
        } else {
            $this->competition = Competition::find($id);
        }
        $this->competitionId = $id;
    }

    public function render()
    {
        if (strlen($this->projectSearch) > 1){
            $this->projectSearchResults = Project::search($this->projectSearch, ['title'])->limit(25)->get();
        } else {
            $this->projectSearchResults = [];
        }

        return view('livewire.competitions.competition-edit', [
            'competition' => $this->competition,
        ]);
    }

    public function removeEntry($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Are you sure you want to delete?',
            'icon'        => 'warning',
            'accept'      => [
                'label'  => 'Yes, delete it',
                'method' => 'confirmRemoveEntry',
                'params' => $id,
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function confirmRemoveEntry($id)
    {
        CompetitionEntry::find($id)->delete();
        $this->notification()->notify([
            'title'       => 'Entry Deleted!',
            'icon'        => 'success'
        ]);
    }

    public function addProject($projectId, $section)
    {
        $project = Project::find($projectId);
        $data = [
            'compid' => $this->competitionId,
            'userid' => $project->user_id,
            'entered' => Carbon::now(),
            'projectid' => $project->id,
            $section => true,
        ];
        CompetitionEntry::create($data);
        $this->isAdding = false;

        $this->notification()->notify([
            'title'       => 'Entry added!',
            'icon'        => 'success'
        ]);
    }

    public function store()
    {

        $validatedData = $this->validate($this->rules);

        $id = $this->competitionId == 'new' ? false : $this->competitionId;
        $data = $validatedData['competitions'];

        if ($this->imageBase64){
            $file = Base64ImageToS3::uploadToS3($this->imageBase64, 'competition');
            $data['image'] = $file;
        }

        $competition = Competition::updateOrCreate(['id' => $id], $data);

        if ($competition){
            if (!$id){
                $this->competitionId = $competition->id;
            }

            $this->notification()->notify([
                'title'       => 'Competition saved!',
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
