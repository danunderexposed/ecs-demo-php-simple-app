@extends('layouts.frontend')

@section('content')
{{-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/pell/dist/pell.min.css"> --}}
<link rel="stylesheet" type="text/css" href="/css/pell.css">
<div x-data="{
    readProfile: false,
    sendMessage: false
}">
    @if(Auth::user())
    <div id="firstlogin">
        <div class="wrapper">

            <div class="row">
                <div class="col-xs-12 col-sm-9">
                    <h4>Welcome Back <span class="bgblack">{{ Auth::user()->firstname }}</span></h4><a id="notyoulinkhead"
                        href="/logout" title="Not You?  Click Here To Logout">Not You?</a>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <a id="updateprofilehead" href="/profile/{{ Auth::user()->slug ?? '' }}">View Profile</a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div id="profile-head" data-specialismurl="">
        <div class="container flex flex-wrap">
            <div class="five columns span3 alpha" id="profile-head-main">
                <div class="padder">
                    <h2>
                        <span class="bgblack" id="displayname">
                            {{ $user->firstname }} {{ $user->surname }}
                        </span>
                        <br>
                        <span id="coursename">{{ $user->coursetitle }}</span>
                    </h2>
                </div>
                <div class="five columns span2 alpha omega">
                    <div class="summary">
                        <p id="schoolname">{{ $user->schoolname }}</p>
                        <p>Specialisms: <span class="items">
                            @php
                            $spec1 = Helper::specialism($user->specialism);
                            $spec2 = Helper::specialism($user->specialism2);
                            $spec3 = Helper::specialism($user->specialism3);
                            @endphp
                            @if ($spec1)
                            <span class="specialism-click" data-specialism="">
                                {{ $spec1 }}
                            </span>
                            @endif
                            @if ($spec2)
                            / <span class="specialism-click" data-specialism="">
                                {{ $spec2 }}
                            </span> /
                            @endif
                            @if ($spec3)
                            <span class="specialism-click" data-specialism="">
                                {{ $spec3 }}
                            </span>
                            @endif
                            </span>
                        </p>
                        <p id="top-location">Location: <span class="items" id="locationstring">{{ $user->cityname }}, {{ $user->countryname }}</span>
                        </p>
                    </div>
                </div>
                <div class="five columns alpha omega">
                    <div class="px-8 social">
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
            <div class="five columns profile-photo omega" id="profile-head-photo">
                <img id="headerprofileimage" src="{{ $user->profile_image ?? asset('img/ava1.png') }}"
                    alt="{{ $user->name }} ArtsThread Profile" title="{{ $user->name }} ArtsThread Profile" />
            </div>
            <div class="five columns alpha omega" id="profile-head-right">
                <img id="schoolimage" src="{{ $user->schoolimage }}" alt="{{'$user->schoolname'}}" title="{{'$user->schoolname'}}" />
            </div>
        </div>
    </div>
    <div id="profile-mininav">
        <div class="whitey" style="width: max(20vw, calc((100vw - 1185px) / 2))"></div>
        <div class="container">
            <div class="five columns span3 alpha fl-left">
                <a href="#profile" id="full-profile" title="" class="profile" :class="readProfile ? 'active': ''"
                    @click.prevent="readProfile = !readProfile">Read <span class="bgblack">Full</span> Profile <span
                        class="downarrow">></span></a>
                @if(Auth::user() && $user->id != Auth::user()->id)
                <a href="#" title="" id="message-user" :class="sendMessage ? 'active': ''"
                    @click.prevent="sendMessage = !sendMessage">Message <span class="mobilehide">{{ $user->firstname }}</span> <span class="downarrow mobilehide">&gt;</span></a>
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
    @guest
    <div id="message-content" x-show="sendMessage">
        <div class="container">

          <h2>Message {{ $user->firstname }}</h2>

          <h4 class="noline">Please <a href="/login" class="loginbutton">Login</a> or <a href="/register">Register</a> to message {{ $user->firstname }}.</h4>

        </div>
    </div>
    <div class="clear"></div>
    @endguest
    @auth
    @if(Auth::user()->messagesendallow && $user->messagesend)
    <div id="message-content" x-show="sendMessage">
        <form action="{{ route('frontend.profile.sendmessage', $user->id) }}" method="post" class="container">
            @csrf
            <h2>Message {{ $user->firstname }}</h2>
            <div class="alert-box success nosidemargin hide"><span>Success: </span>Your message has been sent
                successfully.</div>
            <div class="alert-box err nosidemargin hide"><span>Error: </span>Please ensure all fields have been filled
                in.</div>
            <p class="infostrip">Fill in the fields below and click send message. {{ $user->firstname }} will receive your message
                instantly in their email inbox.</p>
            <div class="message-left">
                <h4>Subject:</h4>
                <div><input type="text" name="subject" id="message-subject" value="" autocomplete="off"
                        placeholder="Enter Subject"></div>
                <h4 class="topgap">Category:</h4>
                <div><select name="category" id="message-category">
                        <option value="">-- Please Select A Category --</option>
                        <option value="Recruitment/Freelance">Recruitment/Freelance</option>
                        <option value="Opportunities">Opportunities</option>
                        <option value="Press">Press</option>
                        <option value="Networking">Networking</option>
                        <option value="Other">Other</option>
                    </select></div>
            </div>
            <div class="message-right">
                <div class="details">
                    <h4>Message:</h4>
                    <div class="about">
                        <textarea name="message" id="message-message" class="redactor-messager message-me"
                                    placeholder="Enter Message" dir="ltr"></textarea>
                    </div>
                    <button type="submit" class="message-user" id="message-user-button">Send Message</button>
                </div>
            </div>
        </form>
    </div>
    @else
    <div id="message-content" x-show="sendMessage">
        <div class="container">

          <h2>Message {{ $user->firstname }}</h2>

          <h4 class="noline">You are not currently authorised to send messages.  Please <a href="/contact" title="Contact Arts Thread">contact Arts Thread</a> for more information.</h4>

        </div>
    </div>
    <div class="clear"></div>
    @endif
    @endauth
    <div id="profile-content" x-show="readProfile">
        <div class="container">
            <h2>{{ $user->firstname }} {{ $user->surname }}</h2>
            <div class="five columns profile-photo alpha"> <img class="profileimg"
                    src="{{ $user->profile_image ?? asset('img/ava1.png') }}"
                    alt="{{ $user->displayname }} ArtsThread Profile" title="{{ $user->displayname }} ArtsThread Profile"> </div>
            <div class="five columns span2">
                <div class="details">
                    <p>First Name: <span class="items">{{ $user->firstname }}</span></p>
                    <p>Last Name: <span class="items">{{ $user->surname }}</span></p>
                    <p>Specialisms: <span class="items">
                        @php
                        $spec1 = Helper::specialism($user->specialism);
                        $spec2 = Helper::specialism($user->specialism2);
                        $spec3 = Helper::specialism($user->specialism3);
                        @endphp
                        @if ($spec1)
                        <span class="specialism-click" data-specialism="">
                            {{ $spec1 }}
                        </span>
                        @endif
                        @if ($spec2)
                        / <span class="specialism-click" data-specialism="">
                            {{ $spec2 }}
                        </span>
                        @endif
                        @if ($spec3)
                        / <span class="specialism-click" data-specialism="">
                            {{ $spec3 }}
                        </span>
                        @endif
                        </span>
                    </p>
                    <p>Sectors: <span class="items">
                        @php
                        $sec1 = Helper::sector($user->sector);
                        $sec2 = Helper::sector($user->sector2);
                        $sec3 = Helper::sector($user->sector3);
                        @endphp
                        @if ($sec1)
                        <span class="sector-click" data-specialism="">
                            {{ $sec1 }}
                        </span>
                        @endif
                        @if ($sec2)
                        / <span class="sector-click" data-specialism="">
                            {{ $sec2 }}
                        </span>
                        @endif
                        @if ($sec3)
                        / <span class="sector-click" data-specialism="">
                            {{ $sec3 }}
                        </span>
                        @endif
                        </span>
                    </p>
                    <p>My Location: <span class="items">{{ $user->cityname }}, {{ $user->countryname }}</span></p>
                    <p>University / College: <span class="items">{{ $user->schoolname }}</span></p>
                    <p>Course / Program Title: <span class="items">{{ $user->coursetitle }}</span></p>
                </div>
            </div>
            <div class="five columns span2 omega">
                <h4>About:</h4>
                <div class="about">
                    <p>{!! $user->profile !!}</p>
                </div>
            </div>
        </div>
    </div>

    <div id="project-holder">
        @foreach ($user->projects as $project)
        <div class="at-project">
            <div class="at-project-gallery swiper" data-portfolio-slider>
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
                <a title="Previous Image" class="nav prev"><</a>
                <a title="Next Image" class="nav next">><a>
            </div>
            <div class="at-project-info">
                <div class="container flex flex-wrap">
                    <div class="five columns span2 alpha">
                        <h2>{{ $project->title }}</h2>
                        <div class="share-project"><a href="/portfolios/{{$project->slug}}" title="View This Project Page" class="first">View This Project Page</a></div>
                        <livewire:frontend.portfolio-project-stats :project="$project">
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
@endsection
