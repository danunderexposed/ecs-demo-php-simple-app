<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Likes;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PortfolioProjectStats extends Component
{
    public $project;
    public $count;

    public function mount($project)
    {
        $this->project = $project;
        $this->count = $project->likes;
    }

    /**
     * Increments likes field in projects table and adds row to likes table
     */
    public function like()
    {
        $userid = Auth::user() ? Auth::user()->id : null;
        $projectid = $this->project->id;
        $ip = request()->ip();
        if(!$this->isLiked($projectid)) {
            $this->project->like();

            $like = new Likes;
            $like->userid = $userid;
            $like->projectid = $projectid;
            $like->ip = $ip;

            $like->save();
            ++$this->count;
        }
    }

    /**
     *  Check if project has already been liked. If user is not logged in then it checks the ip address, otherwise it uses the user id
     * 
     * @return bool projectIsLiked
     */
    public function isLiked($projectid) 
    {
        if(Auth::user()) {
            $userid = Auth::user()->id;
            $existingLikes = Likes::where('userid',$userid)->where('projectid',$projectid)->get();
        } else {
            $existingLikes = Likes::where('ip',request()->ip())->where('projectid',$projectid)->get();
        }

        return count($existingLikes) > 0 ? true : false;
    }
}
