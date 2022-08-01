<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomepageHero;
use App\Models\User;
use App\Models\Option;
use App\Models\Sponsor;
use Log;

class IndexController extends Controller
{

    public function index()
    {
        $user = User::find(1);
        $gridLayout = Option::byOptionName('artsthread_homepage_grid')->first();
        $grid = $gridLayout->getGridObjects();

        $featured1 = Option::byOptionName('artsthread_homepage_feat_sector1')->first();
        $featured2 = Option::byOptionName('artsthread_homepage_feat_sector2')->first();
        $featured3 = Option::byOptionName('artsthread_homepage_feat_sector3')->first();
        $featured4 = Option::byOptionName('artsthread_homepage_feat_sector4')->first();

        $featuredHtml = $this->gridPortfolioFeatured($featured1->getProjectObjects());
        $slides = HomepageHero::all();

        $sponsors = Sponsor::where('display', 1)->orderBy('sort_order', 'asc')->get();

        return view('frontend.index', [
            "user" => $user,
            "grid" => $grid,
            "featured" => $featuredHtml,
            "slides" => $slides,
            "sector1" => $featured1 ? $featured1->getProjectObjects() : false,
            "sector2" => $featured2 ? $featured2->getProjectObjects() : false,
            "sector3" => $featured3 ? $featured3->getProjectObjects() : false,
            "sector4" => $featured4 ? $featured4->getProjectObjects() : false,
            "sponsors" => $sponsors
        ]);
    }

    private function gridPortfolioFeatured($projects) {

        //Clear HTML
        $html='';

        //If We Have An Array Of Projects
        if(is_array($projects)) {

            //Set Counter
            $counter=0;

            //Loop Through Each Project & Write It Out
            foreach($projects as $project) {

                //Add 1 To Counter
                $counter++;

                //New Name
                $name=htmlspecialchars($project->firstname).' '.htmlspecialchars($project->surname);

                //Sort Image
                $image='';
          if($project->cover_medium) {
            if(strpos($project->cover_medium, 'amazonaws.com') !== false){
              $image=$project->cover_medium;
            } else {
              $image='/'.$project->cover_medium;
            }
          }
          elseif($project->cover_large) {
            if(strpos($project->cover_large, 'amazonaws.com') !== false){
              $image=$project->cover_large;
            } else {
              $image='/'.$project->cover_large;
            }
          }
          elseif($project->cover_small) {
            if(strpos($project->cover_small, 'amazonaws.com') !== false){
              $image=$project->cover_small;
            } else {
              $image='/'.$project->cover_small;
            }
          }
                else { $image='/images/projects/ava1.png'; }

                //Grab / Sort Specialisms
                $specialism1='';
                $specialism2='';
                $specialism3='';
                /*
                if($project->specialism) { if(is_numeric($project->specialism)) { $specialism1=artsThreadSpecialism($project->specialism); } else { $specialism1=ucfirst(strtolower($project->specialism)); } }
                if($project->specialism2) { if(is_numeric($project->specialism2)) { $specialism2=artsThreadSpecialism($project->specialism2); } else { $specialism2=ucfirst(strtolower($project->specialism2)); } }
                if($project->specialism3) { if(is_numeric($project->specialism3)) { $specialism3=artsThreadSpecialism($project->specialism3); } else { $specialism3=ucfirst(strtolower($project->specialism3)); } }

                //if No Specialist Deets, Look Them Up From Profile
                if(!$specialism1 && $project->userspecialism) { if(is_numeric($project->userspecialism)) { $specialism1=artsThreadSpecialism($project->userspecialism); } else { $specialism1=ucfirst(strtolower($project->userspecialism)); } }
                if(!$specialism2 && $project->userspecialism2) { if(is_numeric($project->userspecialism2)) { $specialism2=artsThreadSpecialism($project->userspecialism2); } else { $specialism2=ucfirst(strtolower($project->userspecialism2)); } }
                if(!$specialism3 && $project->userspecialism3) { if(is_numeric($project->userspecialism3)) { $specialism3=artsThreadSpecialism($project->userspecialism3); } else { $specialism3=ucfirst(strtolower($project->userspecialism3)); } }

                //Set Specialist String
                if($specialism1 || $specialism2 || $specialism3) { $specialiststring='<small>Specialist:</small><small><span>'.htmlspecialchars($specialism1).'</span> <span>'.htmlspecialchars($specialism2).'</span> <span>'.htmlspecialchars($specialism3).'</span></small>'; } else { $specialiststring=''; }
                */

                //If First Or Second
                if($counter==1 || $counter==2) { $xtraclass=' active current'; } else { $xtraclass=''; }

                //Write Out Entry
                $html.='<a href="'.'/portfolios/'.$project->slug.'" class="hpgportfolio'.$xtraclass.'">';
          $html.= '<img src="'.$image.'">';
                $html.='	<div class="content"><h3>'.$name.'</h3><br class="clear" /><p>'.htmlspecialchars(strip_tags($project->title)).'</p></div>';
                $html.='</a>';

            //End Loop
            }

        //End If We Have An Array
        }

        //If HTML
        if($html) { return $html; }

    //End Homepage Featured Portfolio Pull
    }

    public function test()
    {
      return view('frontend.profile.register');
    }

}
