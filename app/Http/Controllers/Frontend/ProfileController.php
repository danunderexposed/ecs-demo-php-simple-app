<?php

namespace App\Http\Controllers\Frontend;

use Log;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\School;
use App\Models\Sector;
use App\Models\Country;
use App\Models\City;
use App\Models\Message;
use App\Models\Project;
use App\Models\StudyLevel;
use App\Models\Competition;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Traits\UserAttributes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use UserAttributes;

    public function index(Request $request)
    {
        $user = Auth::user();
        if(!$user) {
            return redirect('/');
        }

        $user->projects = Project::where('user_id', $user->id)->with(['media', 'specialismOne', 'specialismTwo', 'specialismThree','events','competitions'])->get();
        $user->projects->counts = $this->getProjectCounts($user->projects);
        $user->schoolvalue = !is_numeric($user->school) ? 'other' : $user->school;
        $user->coursevalue = !is_numeric($user->course) ? 'other' : $user->course;
        $user->coursetitle = $this->getCourseTitle($user);
        $user->schoolimage = $this->getSchoolImage($user);
        $user->schoolname = $this->getSchoolName($user);
        $user->cityname = $this->getCityString($user);
        $user->countryname = $this->getCountryString($user);
        $user->specialisms = $this->getSpecialisms($user);

        $editproject = null;
        if($request->input('editproject')) {
            $editproject = Project::where('user_id', $user->id)->where('id', $request->input('editproject'))->first();
        }

        $competitions = Competition::where('active', 1)->where('status', 'submission')->whereDate('deadline', '>=', Carbon::now())->get();
        $events = Event::where('active',1)->whereDate('start_date','<=',Carbon::now())->whereDate('end_date','>=',Carbon::now())->orderBy('name')->get();

        // check previous url to see if edit buttons are to be shown
        $previousUrl = parse_url(url()->previous());
        $currentUrl = request()->segment(count(request()->segments()));
        $backToEditProfile = false;
        $backToEditProject = false;
        $projectQueryString = null;
        if(isset($previousUrl['query']) && $currentUrl == 'profile') {
            if(strtok($previousUrl['query'],'=') == 'editproject') {
                $backToEditProject = true;
                $projectQueryString = $previousUrl['query'];
            } elseif(strtok($previousUrl['query'],'=') == 'edit') {
                $backToEditProfile = true;
            }
        }

        return view('frontend.profile.index', [
            "user" => $user,
            "countries" => Country::with('cities')->orderBy('name')->get(),
            "courses" => Course::all(),
            "schools" => Country::with('schools')->orderBy('name')->get(),
            "sectors" => Sector::with('specialisms')->orderBy('sector')->get(),
            "studylevels" => StudyLevel::all(),
            "competitions" => $competitions,
            "events" => $events,
            "editproject" => $editproject,
            "editprofile" => $request->input('edit') ?? false,
            "addproject" => $request->input('addproject') ?? false,
            "backToEditProject" => $backToEditProject,
            "backToEditProfile" => $backToEditProfile,
            "projectQueryString" => $projectQueryString,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if(!$user) {
            return redirect()->back();
        }

        $user->firstname = $request->input('firstname');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->specialism = $request->input('specialism1');
        $user->specialism2 = $request->input('specialism2');
        $user->specialism3 = $request->input('specialism3');
        $user->school = $request->input('school') == 'other' ? $request->input('otherschool') : $request->input('school');
        $user->course = $request->input('course') == 'other' ? $request->input('othercourse') : $request->input('course');
        $user->studylevel = $request->input('studylevel');
        $user->gradyear = $request->input('gradyear');
        $user->nationality = is_numeric($request->input('nationality')) ? $request->input('nationality') : null;
        $user->city = $request->input('citycountry') == 'other' ? $request->input('othercity') : $request->input('citycountry');
        $user->country = $request->input('citycountry') == 'other' ? $request->input('othercountry') : Country::find(City::find($request->input('citycountry'))->country_id)->id;
        $user->dob = $request->input('dob');
        $user->gender = $request->input('gender');
        $user->website = $request->input('website');
        $user->facebook_url = $request->input('facebook');
        $user->linkedin_url = $request->input('linkedin');
        $user->vimeo_url = $request->input('vimeo');
        $user->pinterest_url = $request->input('pinterest');
        $user->instagram_url = $request->input('instagram');
        $user->twitter_url = $request->input('twitter');
        $user->profile = $request->input('about');
        $user->companyname = $request->input('companyname');
        $user->companyposition = $request->input('companyposition');
        $user->userType = $request->input('userType');
        $user->messagesend = $request->input('messagesendo') == 'yes' ? 1 : 0;

        $user->save();

        return redirect()->back();
    }

    public function saveProject(Request $request, int $id)
    {
        $user = Auth::user();
        if(!$user) {
            return redirect()->back();
        }

        // ** for dev
        //$project = Project::where('user_id', 407)->with('competitionEntry')->where('id', $id)->first();
        $project = Project::where('user_id', $user->id)->with('competitionEntry')->where('id', $id)->first();

        if($project) {
            $project->title = $request->input('project-title');
            $project->specialism = $request->input('specialism1');
            $project->specialism2 = $request->input('specialism2');
            $project->specialism3 = $request->input('specialism3');
            $project->display = $request->input('display') == 'yes' ? 1 : 0;
            $project->sort_order = $request->input('order');
            $project->description = $request->input('about');

            $project->save();

            $comp = $request->input('competition');
            if(is_numeric($comp)) {
                $project->competitionEntry()->updateOrCreate([
                    'projectid' => $project->id
                ], [
                    'compid' => $comp,
                    'userid' => $user->id,
                    'projectid' => $project->id,
                    'entered' => Carbon::now()
                ]);
            } elseif ($comp == 'clear') {
                if ($project->competitionEntry)
                    $project->competitionEntry->delete();
            }

            $event = $request->input('event');
            if(is_numeric($event)) {
                $project->eventEntry()->updateOrCreate([
                    'projectid' => $project->id
                ], [
                    'eventid' => $event,
                    'userid' => $user->id,
                    'projectid' => $project->id,
                    'entered' => Carbon::now()
                ]);
            }  elseif ($event == 'clear') {
                if ($project->eventEntry)
                    $project->eventEntry->delete();
            }
        }

        return redirect()->back();
    }

    public function addProject(Request $request)
    {
        $user = Auth::user();
        if(!$user) {
            return redirect()->back();
        }
        $project = new Project();
        //$project = Project::where('user_id', $user->id)->('id', $id)->first();

        $project->user_id = $user->id;
        $project->title = $request->input('title');
        $project->specialism = $request->input('specialism1');
        $project->specialism2 = $request->input('specialism2');
        $project->specialism3 = $request->input('specialism3');
        $project->display = $request->input('display') == 'yes' ? 1 : 0;
        $project->sort_order = $request->input('order');
        $project->description = $request->input('about');

        $project->save();

        return redirect()->route('frontend.profile.index', ['editproject' => $project->id]);
    }

    public function removeProject(Request $request, int $id)
    {
        $user = Auth::user();
        if(!$user) {
            return redirect()->back();
        }

        $project = Project::find($id);

        if (!$project){
            return redirect()->back();
        }

        $project->delete();

        return redirect()->back();
    }

    public function show(Request $request, string $slug)
    {
        $user = User::where('slug', $slug)->first();
        if(!$user) {
            return redirect('/');
        }
        //Temp for testing
        //$projects = Project::where('user_id', 407)->with(['media', 'specialismOne', 'specialismTwo', 'specialismThree', 'competitionEntry', 'competitions'])->orderBy('sort_order', 'ASC')->get();
        $user->projects = Project::where('user_id', $user->id)->with(['media', 'specialismOne', 'specialismTwo', 'specialismThree','competitions'])->get();
        $user->projects->counts = $this->getProjectCounts($user->projects);
        $user->coursetitle = $this->getCourseTitle($user);
        $user->schoolimage = $this->getSchoolImage($user);
        $user->schoolname = $this->getSchoolName($user);
        $user->cityname = $this->getCityString($user);
        $user->countryname = $this->getCountryString($user);

        return view('frontend.profile.show', [
            "user" => $user,
        ]);
    }

    public function sendMessage(Request $request, int $id)
    {
        $user = User::find($id);
        $messenger = Auth::user();
        if(!$user || !$messenger) {
            return redirect()->back();
        }

        Message::create([
            'userid' => $user->id,
            'useremail' => $user->email,
            'username' => $user->firstname,
            'messagerid' => $messenger->id,
            'messageremail' => $messenger->email,
            'messagername' => $messenger->firstname,
            'subject' => $request->input('subject'),
            'category' => $request->input('category'),
            'message' => $request->input('message'),
            'ip' => '127.0.0.1',
            'sentdate' => Carbon::now()
        ]);

        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        if(!$user) {
            return redirect()->back();
        }

        $validated = $request->validate([
            'password' => 'required|confirmed'
        ]);

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->back();
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        $this->redirect('frontend.index');
    }

}
