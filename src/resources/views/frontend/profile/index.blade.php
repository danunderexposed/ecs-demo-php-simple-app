@extends('layouts.frontend')

@section('content')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/pell/dist/pell.min.css">
<div x-data="{
    editProfile: {{ $editprofile ? 1 : 0 }},
    editProject: {{ $editproject || $addproject ? 1 : 0 }},
    school: '{{ $user->schoolvalue }}',
    course: '{{ $user->coursevalue }}',
    nationality: '{{ $user->nationality }}',
    city: '{{ $user->city }}',
    type: '{{ $user->userType }}'
}">

    <div id="firstlogin">
        <div class="wrapper">

            <div class="row">
                <div class="col-xs-12 col-sm-9">
                    <h4>Welcome Back <span class="bgblack">{{ $user->firstname }}</span></h4>
                    <form method="post" action="/logout" style="display: inline">
                    @csrf
                    <button class="account-dropdown__notyou" title="Not You?  Click Here To Logout">
                        Not You?
                    </button>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <a id="updateprofilehead" href="/profile/{{ $user->slug ?? '' }}">View Profile</a>
                </div>
            </div>
        </div>
    </div>

    <div id="profile-head" data-specialismurl="">
        <div class="container flex flex-wrap">
            <div class="five columns span3 alpha" id="profile-head-main">
                <div class="padder">
                    <h2>
                        <span class="bgblack" id="displayname">
                            {{ $user->firstname }} {{ $user->surname }}
                        </span>
                        @if($user->userType == 'student')
                        <br>
                        <span id="coursename">{{ $user->coursetitle }}</span>
                        @endif
                    </h2>
                </div>
                <div class="five columns span2 alpha omega">
                    <div class="summary" x-show="type == 'student'">
                        <p id="schoolname">{{ $user->schoolname }}</p>
                        <p id="top-specialisms">Specialisms: <span class="items"
                                id="specialismstring">{{ $user->specialisms }}</span></p>
                        <p id="top-location">Location: <span class="items" id="locationstring">{{ $user->cityname }}, {{ $user->countryname }}</span>
                        </p>
                    </div>
                </div>
                <div class="five columns alpha omega">
                    <div class="social" x-show="type == 'student'">
                        @if($user->instagram_url ?? false)
                        <a class="instagram" href="{{ $user->instagram_url }}" title="{{ $user->firstname }} {{ $user->surname }} Instagram" target="_blank">Instagram</a>
                        @endif
                        @if($user->linkedin_url ?? false)
                        <a class="linkedin" href="{{ $user->linkedin_url }}" title="{{ $user->firstname }} {{ $user->surname }} LinkedIn" target="_blank">LinkedIn</a>
                        @endif
                        @if($user->vimeo_url ?? false)
                        <a class="vimeo" href="{{ $user->vimeo_url }}" title="{{ $user->firstname }} {{ $user->surname }} Vimeo" target="_blank">Vimeo</a>
                        @endif
                        @if($user->facebook_url ?? false)
                        <a class="facebook" href="{{ $user->facebook_url }}" title="{{ $user->firstname }} {{ $user->surname }} Facebook" target="_blank">Facebook</a>
                        @endif
                        @if($user->twitter_url ?? false)
                        <a class="twitter" href="{{ $user->twitter_url }}" title="{{ $user->firstname }} {{ $user->surname }} Twitter" target="_blank">Twitter</a>
                        @endif
                        @if($user->pinterest_url ?? false)
                        <a class="pinterest" href="{{ $user->pinterest_url }}" title="{{ $user->firstname }} {{ $user->surname }} Pinterest" target="_blank">Pinterest</a>
                        @endif
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            @if($user->userType == 'student' || $user->userType == 'industry' || $user->userType == 'educational')
            <div class="five columns profile-photo omega" id="profile-head-photo">
                <img id="headerprofileimage" src="{{ $user->profile_image ?? asset('img/ava1.png') }}"
                    alt="{{ $user->name }} ArtsThread Profile" title="{{ $user->name }} ArtsThread Profile" />
            </div>
            @endif
            @if($user->userType == 'student')
            <div class="five columns alpha omega" id="profile-head-right">
                <img id="schoolimage" src="{{ $user->schoolimage }}" alt="{{ $user->schoolname }}" title="{{ $user->schoolname }}" />
            </div>
            @endif
        </div>
    </div>
    <div id="profile-mininav">
        <div class="whitey" style="width: max(20vw, calc((100vw - 1185px) / 2))"></div>
        <div class="container">
            <div class="five columns span3 alpha fl-left">
                <a href="#profile" id="full-profile" title="" class="profile" :class="editProfile ? 'active': ''"
                    @click.prevent="editProfile = !editProfile"><span class="bgblack">Edit My</span> Profile <span
                        class="downarrow">></span></a>
                @if($user->userType == 'student')
                <a href="#addproject" title="" class="project" :class="editProject ? 'active': ''"
                    @click.prevent="editProject = !editProject; editProfile = !editProfile" id="add-project">+ Project <span
                        class="downarrow">></span></a>
                @endif
                @if($user->userType != 'guest')
                <a href="/profile/{{ $user->slug }}" title="Profile URL" id="profile-link" class="project">Profile URL</a>
                    @if($backToEditProfile)
                        <a href="/profile/?edit=true" title="Back to Edit Profile" id="edit-profile-link" class="project">Back to Edit Profile</a>
                    @endif
                    @if($backToEditProject)
                        <a href="/profile/?{{ $projectQueryString }}" title="Back to Edit Project" id="edit-profile-link" class="project">Back to Edit Project</a>
                    @endif
                @endif
            </div>
            <div class="five columns span2 omega fl-left" id="profile-stats">
                <p class="views"><span class="text">Views&nbsp;&nbsp;</span><span class="bgblack"
                        id="viewcount">{{ $user->projects->counts["view"] }}</span></p>
                <p class="appreciations"><span class="text">Appreciations&nbsp;&nbsp;</span><span class="bgblack"
                        id="likecount">{{ $user->projects->counts["like"] }}</span></p>
                <p class="comments"><span class="text">Comments&nbsp;&nbsp;</span><span class="bgblack"
                        id="commentcount">{{ $user->projects->counts["comment"] }}</span></p>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="profile-content" class="edit" :class="editProfile ? 'display' : ''">
        <div class="container">
            <p class="infostrip">Simply click on the fields below to edit them. Once you are finished, click on the
                Update
                Profile button to save your changes.</p>
            <div class="alert-box success nosidemargin hide"><span>Success: </span>Your Profile Details Have Been
                Updated
            </div>
            <div class="alert-box err nosidemargin hide"><span>Error: </span>Your Profile Details Have Been Updated
            </div>
            <form method="post" action="{{ route('frontend.profile.update') }}" name="editprofileform"
                id="editprofileform">
                @method('PUT')
                @csrf
                <h2 id="displayname2">{{ $user->name }}</h2>
                <div class="five columns profile-photo alpha" x-show="type != 'guest'"> <span id="profileImage"
                        style="text-decoration:none;margin:0;padding:0;">
                        <h4>Profile Image:</h4>
                        @livewire('frontend.profile.upload-profile-image')
                        <p class="about" style="margin-top:20px;">Your profile requires one image to be uploaded but cropped twice. One for your main profile and one for the profile search listings.<br><br>Please click the image above to upload your image and launch the cropping tool.</p>
                    </span> </div>
                <div class="five columns span2">
                    <div class="details">
                        <h4>Your Details:</h4>
                        <div><span class="heady">Account Type: </span><select name="userType" id="userType" x-model="type">
                                <option value="student" @if($user->userType ==
                                    'student')selected="selected"@endif>Emerging Creatives - Graduate / Student</option>
                                <option value="guest" @if($user->userType == 'guest')selected="selected"@endif>Guest -
                                    No Portfolio</option>
                                <option value="industry" @if($user->userType ==
                                    'industry')selected="selected"@endif>Industry Professional - No Portfolio</option>
                                <option value="educational" @if($user->userType ==
                                    'educational')selected="selected"@endif>Education Professional - No Portfolio
                                </option>
                            </select>
                            <div class="selectline"></div>
                        </div>
                        <div><span class="heady" style="margin-top:10px;">First Name:</span><br><input type="text"
                                name="firstname" value="{{ $user->firstname }}" autocomplete="off"
                                placeholder="Enter Firstname">
                        </div>
                        <div><span class="heady">Last Name: </span><br><input type="text" name="surname"
                                value="{{ $user->surname }}" autocomplete="off" placeholder="Enter Surname"></div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Specialism 1: </span><select
                                name="specialism1">
                                <x-at.specialism-options :sectors="$sectors" :id="$user->specialism" />
                            </select>
                            <div class="selectline"></div>
                        </div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Specialism 2: </span><select
                                name="specialism2">
                                <x-at.specialism-options :sectors="$sectors" :id="$user->specialism2" />
                            </select>
                            <div class="selectline"></div>
                        </div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Specialism 3: </span><select
                                name="specialism3">
                                <x-at.specialism-options :sectors="$sectors" :id="$user->specialism3" />
                            </select>
                            <div class="selectline"></div>
                        </div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Address: Country / City:
                            </span><select name="citycountry" id="city-select" x-model="city">
                                <x-at.country-city-options :countries="$countries" />
                            </select>
                            <div class="selectline"></div>
                        </div>
                        <div x-show="city == 'other' && type == 'student'" class="country">
                            <p><span>COUNTRY: </span> <input type="text" name="othercountry"
                                    value="{{ !is_numeric($user->country) ?? '' }}" autocomplete="off" placeholder="Enter Country"></p>
                            <p><span>CITY: </span><br><input type="text" name="othercity" value="{{ !is_numeric($user->city) ?? '' }}"
                                    autocomplete="off" placeholder="Enter City"></p>
                        </div>
                        <div><span class="heady">Email (Not Public):</span><br><input type="text" name="email"
                                value="{{ $user->email }}" autocomplete="off" placeholder="Enter Email"></div>
                        <div class="showEducational" x-show="type == 'educational' || type == 'student'"><span class="heady">School:</span>
                            <select name="school" id="school-select" x-model="school">
                                <x-at.school-options :schools="$schools" />
                            </select>
                            <div class="selectline"></div>
                        </div>
                        <div class="showEducational" x-show="type == 'student'" id="courses-select-holder"><span
                                class="heady">Program:</span>
                            <select name="course" id="course-select" x-model="course">
                                @foreach($courses as $c)
                                <option x-show="school == '{{ $c->school_id }}'" value="{{ $c->id }}"
                                    @if($user->coursevalue==$c->id)selected="selected"@endif>{{ $c->name }}</option>
                                @endforeach
                                <option value="other">Other / Not Listed</option>
                            </select>
                            <div class="selectline"></div>
                        </div>
                        <div class="hidden showStudent" x-show="type == 'student'"><span class="heady">Course / Program Study Level:
                            </span><select name="studylevel">
                                <option value="">--- Please Select --</option>
                                @foreach($studylevels as $sl)
                                <option value="{{ $sl->id }}" @if($user->studylevel ==
                                    $sl->id)selected="selected"@endif>{{ $sl->studylevel }}</option>
                                @endforeach
                            </select>
                            <div class="selectline"></div>
                        </div>
                        <div x-show="school == 'other'" class="showEducational" x-show="type == 'educational' || type == 'student'">
                            <div class="school">
                                <p><span>SCHOOL: </span> <input type="text" name="otherschool"
                                        value="{{ $user->school }}" autocomplete="off" placeholder="Enter School"></p>
                            </div>
                        </div>
                        <div x-show="course == 'other'" class="showEducational" x-show="type == 'educational' || type == 'student'">
                            <div class="course">
                                <p><span>PROGRAM: </span><br><input type="text" name="othercourse"
                                        value="{{ $user->course }}" autocomplete="off" placeholder="Enter Course"></p>
                            </div>
                        </div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Year Of
                                Graduation:</span><select name="gradyear" id="gradyear-select">
                                <option value="">--- Please Select --</option>
                                @foreach (array_reverse(range(1970, 2030)) as $y)
                                <option value="{{ $y }}" @if($user->gradyear == $y)selected="selected"@endif>{{ $y }}
                                </option>
                                @endforeach
                            </select>
                            <div class="selectline"></div>
                        </div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Gender (Not
                                Public):</span><select name="gender" id="gender-select">
                                <option value="">--- Please Select --</option>
                                <option value="male" @if($user->gender == 'male')selected="selected"@endif>Male</option>
                                <option value="female" @if($user->gender == 'female')selected="selected"@endif>Female
                                </option>
                                <option value="non-binary" @if($user->gender ==
                                    'non-binary')selected="selected"@endif>Non-Binary</option>
                                <option value="other" @if($user->gender == 'other')selected="selected"@endif>Other
                                </option>
                                <option value="rather-not-say" @if($user->gender ==
                                    'rather-not-say')selected="selected"@endif>Rather Not Say</option>
                            </select>
                            <div class="selectline"></div>
                        </div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Date Of Birth (Not
                                Public):</span><br>
                            <input type="date" name="dob" value="{{ $user->dob }}">
                            <div class="selectline"></div>
                        </div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Country Of Birth (Not
                                Public):</span>
                            <select name="nationality" id="nationality" x-model="nationality">
                                <x-at.country-options :countries="$countries" />
                            </select>
                            <div class="selectline"></div>
                        </div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Website:</span><br><input
                                type="text" name="website" value="{{ $user->website }}" autocomplete="off"
                                placeholder="Enter Website"></div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Instagram
                                Link:</span><br><input type="text" name="instagram" value="{{ $user->instagram_url }}"
                                autocomplete="off" placeholder="Enter Instagram URL">
                        </div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">LinkedIn
                                Link:</span><br><input type="text" name="linkedin" value="{{ $user->linkedin_url }}"
                                autocomplete="off" placeholder="Enter LinkedIn URL"></div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Vimeo Link:</span><br><input
                                type="text" name="vimeo" value="{{ $user->vimeo_url }}" autocomplete="off"
                                placeholder="Enter Vimeo URL"></div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Facebook
                                Link:</span><br><input type="text" name="facebook" value="{{ $user->facebook_url }}"
                                autocomplete="off" placeholder="Enter Facebook URL">
                        </div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Twitter
                                Link:</span><br><input type="text" name="twitter" value="{{ $user->twitter_url }}"
                                autocomplete="off" placeholder="Enter Twitter URL">
                        </div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Pinterest
                                Link:</span><br><input type="text" name="pinterest" value="{{ $user->pinterest_url }}"
                                autocomplete="off" placeholder="Enter Pinterest URL">
                        </div>
                        <div class="showIndustry" x-show="type == 'industry'"><span class="heady">Company Name:
                            </span><br><input type="text" name="companyname" value="" autocomplete="off"
                                placeholder="Enter Company Name">
                        </div>
                        <div class="showIndustry" x-show="type == 'industry'"><span class="heady">Position In Company:
                            </span><br><input type="text" name="companyposition" value="" autocomplete="off"
                                placeholder="Enter Company Position"></div>
                        <div class="showStudent" x-show="type == 'student'"><span class="heady">Receive Messages From Other
                                Users?</span><br><select name="messagesendo" id="messagesend-select">
                                <option value="yes" @if($user->messagesend)selected="selected"@endif>Yes</option>
                                <option value="no" @if(!$user->messagesend)selected="selected"@endif>No</option>
                            </select>
                        </div>
                        <div class="showStudent" x-show="type == 'student'">
                            <span class="header">
                                <div class="about">
                                    <h4>About:</h4>

                                    <div id="editor" class="pell"></div>
                                    <textarea id="html-output" type="text" name="about" style="opacity:0;position:absolute;pointer-events:none">{{ $user->profile }}</textarea>
                                    <div class="hidden" data-editor-content>{!! $user->profile !!}</div>
                                </div>
                            </span>
                        </div>
                        <div>
                            <div class="selectline"></div>
                            <button type="submit" class="update-profile-button" id="update-profile-button">Update Profile</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="five columns span2 omega"> <span class="showStudent header" x-show="type == 'student'">
            <form method="post" action="{{ route('frontend.profile.updatepassword') }}" id="changepassform">
                @csrf
                <h4 id="change-password">Change Password:</h4>
                <p class="about">If you would like to change your password, please enter the new password into both boxes below and click the change password button below.<br><br>Your password must be at least 7 characters &amp; must contain letters and numbers.</p>
                <p><span class="heady">Password:</span><br><input type="password" name="password"
                        id="password1" value="" autocomplete="off" placeholder="Enter New Password">
                </p>
                <p><span class="heady">Confirm Password:</span><br><input type="password" name="password_confirmation"
                        id="password2" value="" autocomplete="off" placeholder="Confirm New Password">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
                </p> <input type="hidden" name="editpass" value="edit"> <button type="submit"
                    class="update-profile-button" id="update-password-button">Change Password</button>
            </form>
        </div>
        </div>
    </div>

    <div id="project-edit" data-type="add" x-show="editProject && type == 'student'">
        <div class="container">
            <p class="infostrip">Simply click on the fields below to edit them. Add your images and video on the right.
                Once
                you are finished, click on the Save Project button to save your changes.</p>
            <div class="alert-box success nosidemargin hide"><span>Success: </span>Your Profile Details Have Been
                Updated
            </div>
            <div class="alert-box err nosidemargin hide"><span>Error: </span>Your Profile Details Have Been Updated
            </div>
            <form method="post"
                action="{{ $editproject ? route('frontend.profile.saveproject', $editproject->id) : route('frontend.profile.addproject') }}"
                name="editprojectform" id="editprojectform">
                @csrf
                <h2><input type="text" name="project-title" value="{{ $editproject->title ?? null }}" autocomplete="off"
                        id="project-title" placeholder="Enter Project Title"></h2>
                <div class="five columns profile-photo alpha">
                    @if ($editproject)
                        <h4 style="margin-bottom:30px;"><span class="white">Cover Image:</span></h4>
                        <div class="clear"></div>
                        <div class="grid">
                            @livewire('frontend.profile.upload-portfolio-image', ['project' => $editproject], , key('cover' . $editproject->id))
                        </div>
                    @endif
                    @if ($editproject)
                    <a href="{{ route('frontend.profile.removeproject', ['id' => $editproject->id]) }}" class="update-profile-button leftcol delete" id="delete-project" onclick="return confirm('Are you sure you want to delete this project?')">Delete Project</a>
                    @endif
                    <a href="{{ Request::url() }}" class="update-profile-button leftcol" id="cancel-project"
                        @click="editProject = false">Cancel Add / Edit</a>
                    <button type="submit" class="update-profile-button leftcol save-project-go">Save Project</button>
                </div>
                <div class="five columns span2">
                    <div class="details">
                        <h4><span class="white">Description:</span></h4>
                        <div class="clear"></div>
                        <p class="about"></p>
                        <div class="redactor-container"><textarea name="about" id="project-about"
                                placeholder="Enter Project Description Here">{{ $editproject->description ?? null }}</textarea>
                        </div>
                        <p></p>
                        <p><span>Specialism 1: </span><select name="specialism1" id="project-specialism1">
                                <x-at.specialism-options :sectors="$sectors" :id="$editproject->specialism ?? null" />
                            </select></p>
                        <div class="selectline"></div>
                        <p></p>
                        <p><span>Specialism 2: </span><select name="specialism2" id="project-specialism2">
                                <x-at.specialism-options :sectors="$sectors" :id="$editproject->specialism2 ?? null" />
                            </select></p>
                        <div class="selectline"></div>
                        <p></p>
                        <p><span>Specialism 3: </span><select name="specialism3" id="project-specialism3">
                                <x-at.specialism-options :sectors="$sectors" :id="$editproject->specialism3 ?? null" />
                            </select></p>
                        <div class="selectline"></div>
                        <p></p>
                        <p><span>Display To Public: </span><select name="display" id="project-display">
                                <option value="yes" @if(isset($editproject) && $editproject->display ==
                                    1)selected="selected"@endif>Yes</option>
                                <option value="no" @if(isset($editproject) && $editproject->display ==
                                    0)selected="selected"@endif>No</option>
                            </select></p>
                        <div class="selectline"></div>
                        <p></p>
                        <p><span>Order In Profile: </span><select name="order" id="project-order">
                                @php
                                function ordinal($num) {
                                $ends = array('th','st','nd','rd','th','th','th','th','th','th');
                                $num = intval($num);
                                if ((($num % 100) >= 11) && (($num % 100) <= 13)) { return $num . 'th' ; } else { return
                                    $num . $ends[$num % 10]; } } @endphp @foreach (range(1, count($user->projects)) as $order)
                                    <option value="{{ $order }}" @if(isset($editproject) && $editproject->sort_order ==
                                    $order)selected="selected"@endif> {{ ordinal($order) }} Place</option>
                                    @endforeach
                                    @unless($editproject)
                                    <option value="{{ count($user->projects) + 1 }}"> {{ ordinal(count($user->projects) + 1) }}
                                        Place</option>
                                    @endunless
                            </select></p>
                        <div class="selectline"></div>
                        <p></p>
                        <p id="project-comp-add"><span>Add To Current Competition: </span><select name="competition"
                                id="project-competition">
                                <option value="clear">-- Not Entered Into Current Competition --</option>
                                @foreach($competitions as $comp)
                                @php
                                    $check = false;
                                    if(isset($editproject)) {
                                    $check = $editproject->competitionEntry()->where('compid', $comp->id)->first();
                                    }
                                @endphp
                                <option value="{{ $comp->id }}" @if($check)selected="selected"@endif>{{ $comp->name }}</option>
                                @endforeach
                            </select></p>
                        <div class="selectline project-comp-add"></div>
                        <p></p>
                        <p id="project-comp-added" style="display:none;"><span>Competition: </span></p>
                        <p id="project-event-add"><span>Add To Current Event: </span><select name="event"
                                id="project-event">
                                <option value="clear">--- Not Entered Into Current Event --</option>
                                @foreach($events as $e)
                                @php
                                $check = false;
                                if(isset($editproject)) {
                                    $check = $editproject->eventEntry()->where('eventid', $e->id)->first();
                                }
                                @endphp
                                <option value="{{ $e->id }}" @if($check)selected="selected"@endif>{{ $e ->name }}</option>
                                @endforeach
                            </select></p>
                        <div class="selectline project-event-add"></div>
                        <p></p>
                        <p id="project-event-added" style="display:none;"><span>Event: </span></p>
                    </div>
                </div>
                <div class="five columns span2 omega">
                    @if ($editproject)
                        @livewire('frontend.profile.portfolio-image-gallery', ['project' => $editproject], key('gallery' . $editproject->id))
                    @else
                        <h4 style="margin-bottom:30px;"><span class="white">Image(s) / Video:</span></h4>
                        <p>Please enter project details and save before adding images and video.</p>
                    @endif

                </div>
            </form>
        </div>
    </div>

    <div id="project-holder" x-show="!editProject && type == 'student'">
        @foreach ($user->projects as $project)
        <div class="at-project">
            @if (count($project->media) > 0)
            <div class="at-project-gallery swiper" data-project-slider>
                <div class="gallery popup-gallery swiper-wrapper">
                    @foreach ($project->media as $media)
                    @if($media->type == 'video')
                    @if(str_contains($media->vidurl, 'youtu'))
                    @php
                    $pattern = '/(youtu).+(.co).+(\/\d+)/';
                    preg_match($pattern, $media->vidurl, $matches);
                    if (count($matches)) {
                    $vidId = str_replace('/', '', $matches[3]);
                    }
                    @endphp
                    @if($vidId ?? false)
                    <a class="media-item youtube swiper-slide" href="http://www.youtube.com/watch?v={{ $vidId }}"
                        title="{{ $media->title }}">
                        <div class="hover">
                            <div class="icon"></div>
                        </div><img class="active" src="{{$media->image}}" alt="{{ $media->title }}"
                            title="{{ $media->title }}" />
                    </a>
                    @endif
                    @else
                    @php
                    $pattern = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
                    preg_match($pattern, $media->vidurl, $matches);
                    if (count($matches)) {
                    $vidId = str_replace('/', '', $matches[2]);
                    }
                    @endphp
                    @if($vidId ?? false)
                    <a class="media-item vimeo swiper-slide" href="http://vimeo.com/{{ $vidId }}" title="{{ $media->title }}">
                        <div class="hover">
                            <div class="icon"></div>
                        </div><img class="active" src="{{ $media->image }}" alt="{{ $media->title }}"
                            title="{{ $media->title }}" />
                    </a>
                    @endif
                    @endif
                    @else
                    <a class="media-item image @if($loop->first) active @endif swiper-slide" href="{{$media->image_large}}"
                        title="{{$media->title}}">
                        <div class="hover">
                            <div class="icon"></div>
                        </div><img class="active" src="{{$media->image_large}}" alt="{{$media->title}}"
                            title="{{$media->title}}" />
                    </a>
                    @endif
                    @endforeach
                </div>
                <a href="#prev" title="Previous Image" class="nav prev"><</a>
                <a href="#next" title="Next Image" class="nav next">></a>
            </div>
            @endif
            <div class="at-project-info">
                <div class="container flex flex-wrap">
                    <div class="five columns span2 alpha">
                        <h2>{{ $project->title }}</h2>
                        <div class="share-project"><a href="/portfolios/{{$project->slug}}" title="View This Project Page"
                                class="first">View This Project Page</a></div>
                        <div class="share-project action">
                            <a class="first addthis_button_compact" href="#"
                                addthis:url="/portfolios/{{ $portfolioslug ?? null }}"
                                addthis:title="{{ $project->title }} - ArtsThread Portfolio From {{ $user->firstname }} {{ $user->surname }}"
                                addthis:url="/portfolios/{{ $portfolioslug ?? null }}"
                                addthis:title="{{ $project->title }} - ArtsThread Portfolio From {{ $user->firstname }} {{ $user->surname }}"
                                data-url="/portfolios/{{ $portfolioslug ?? null }}"
                                data-title="{{ $project->title }} - ArtsThread Portfolio From {{ $user->firstname }} {{ $user->surname }}"
                                title="Share {{ $project->title }} - ArtsThread Portfolio From {{ $user->firstname }} {{ $user->surname }}"><span>Share
                                    Project</span></a>
                            <a href="{{ Request::url() }}?editproject={{$project->id}}" title="Edit This Project"
                                class="editprojectbutton" data-project="{{$project->id}}">Edit This Project</a>
                            <div class="clear"></div>
                        </div>
                        <div class="project-stats">
                            <p class="views">Views&nbsp;&nbsp;<span class="bgblack projectviewcount">{{$project->views}}</span></p>
                            <p class="appreciations appreciate" data-project="{{$project->id}}">Appreciations&nbsp;&nbsp;<span class="bgblack" id="projectlikecount">{{$project->likes ?? 0}}</span></p>
                            <p class="comments">Comments&nbsp;&nbsp;<span class="bgblack" id="projectcommentcount-{{$project->id}}">{{$project->comments}}</span></p>
                            <div class="clear"></div>
                        </div>
                        <div class="topics">
                            <p>Specialisms: </p>
                            @if($project->specialismOne ?? false)
                            <a href="#" class="specialism-click"
                                data-specialism="{{$project->specialismOne->specialism}}">{{$project->specialismOne->specialism}}</a>
                            @endif
                            @if($project->specialismTwo ?? false)
                            <a href="#" class="specialism-click"
                                data-specialism="{{$project->specialismTwo->specialism}}">{{$project->specialismTwo->specialism}}</a>
                            @endif
                            @if($project->specialismThree ?? false)
                            <a href="#" class="specialism-click"
                                data-specialism="{{$project->specialismThree->specialism}}">{{$project->specialismThree->specialism}}</a>
                            @endif
                            <div class="clear"></div>
                        </div>

                        <div class="clear"></div>
                    </div>

                    <div class="five columns span2">
                        <div class="details">
                            <p>{!! $project->description !!}</p>
                        </div>
                    </div>
                    @if(count($project->events) > 0 || count($project->competitions) > 0)
                    <div class="five columns omega">
                        @if(count($project->events) > 0)
                        <div class="portfolio">
                            <h5>Events:</h5>
                            @foreach ($project->events as $event)
                            @php
                            $event = (object) $event;
                            @endphp
                            <a href="/{{$event->slug}}"><img src="{{$event->image}}" alt="{{$event->name}}"
                                    title="{{$event->name}}" />
                                <h4>{{$event->name}}</h4>
                            </a>
                            @endforeach
                        </div>
                        @endif
                        @if(count($project->competitions) > 0)
                        <div class="competition">
                            <h5>Competitions:</h5>
                            @foreach($project->competitions as $comp)
                            <a href="/{{$comp->slug}}"><img src="{{$comp->image}}" alt="{{$comp->name}}"
                                    title="{{$comp->name}}" />
                                <h4>{{$comp->name}}</h4>
                            </a>
                            @endforeach
                        </div>
                        @endif
                        <div class="clear"></div>

                    </div>
                    @endif

                    <!--x-at.comment /-->
                </div>
            </div>
        </div>
        @endforeach

        @if(count($user->projects) == 0)
        <div class="whitecontainer profile">
            <div class="container full-width column">
                <h2 class="noresults black projects" id="no-results"><span>No Available Projects</span></h2>
            </div>
        </div>
        @endif
    </div>

</div>
<script src="{{ mix('js/pell.js') }}" ></script>

{{-- <script src="https://unpkg.com/pell"></script> --}}
<script>
const editor = pell.init({
  element: document.getElementById('editor'),
  actions: [
    'bold',
    'italic',
    'underline',
    'strikethrough'
  ],
  onChange: html => {
    document.getElementById('html-output').textContent = html
  },
  defaultParagraphSeparator: 'p'
});
var editorContent = document.querySelector('[data-editor-content]').textContent;
editor.content.innerHTML = editorContent;
</script>
@endsection
