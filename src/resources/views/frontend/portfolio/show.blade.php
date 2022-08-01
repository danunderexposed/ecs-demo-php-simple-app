@extends('layouts.frontend')

@section('content')
<div class="single-nav single-nav--portfolio">
  <div class="single-nav__inner">
    <a href="https://www.artsthread.com/portfolios/"><i>&lt;</i> View all <span>Projects &amp; Profiles</span></a>
  </div>
</div>
<div class="portfolio-content nopad">
  <!-- Portfolio Content //-->
  <div id="course-html" x-data="{ tab: false }" @click.away="tab = false">
    <div id="profile-head">
      <div class="container">
        <div class="five columns span3 alpha" id="profile-head-main">
          <div class="padder">
            <h2>
              <span class="bgblack">{{ $portfolio->user->firstname ?? null }} {{ $portfolio->user->surname ?? null }}</span>
              <br>{{ $portfolio->user->coursetitle ?? null }}
            </h2>
          </div>
          <div class="five columns span2 alpha omega">
            <div class="summary">
              <p>{{ $portfolio->user->schoolname ?? null }}</p>
              <p>Graduates: <span class="items">{{ $portfolio->user->gradyear ?? null }}</span>
              </p>
              <p>Specialisms: <span class="items">
                  @php
                  $spec1 = Helper::specialism($portfolio->user->specialism);
                  $spec2 = Helper::specialism($portfolio->user->specialism2);
                  $spec3 = Helper::specialism($portfolio->user->specialism3);
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
              <p>My location: <span class="items"> {{ Helper::city($portfolio->user->city) }}, {{ Helper::country($portfolio->user->country) }} </span>
              </p>
            </div>
          </div>
          <div class="five columns alpha omega">
            <div class="social">
              @if($portfolio->user->linkedin_url ?? false)
              <a class="linkedin" href="{{ $portfolio->user->linkedin_url ?? null }}" title="{{ $portfolio->user->name ?? null }} LinkedIn" target="_blank">LinkedIn</a>
              @endif
              @if($portfolio->user->instagram_url ?? false)
              <a class="instagram" href="{{ $portfolio->user->instagram_url ?? null }}" title="{{ $portfolio->user->name ?? null }} Instagram" target="_blank">Instagram</a>
              @endif
              @if($portfolio->user->facebook_url ?? false)
              <a class="facebook" href="{{ $portfolio->user->facebook_url ?? null }}" title="{{ $portfolio->user->name ?? null }} Instagram" target="_blank">Facebook</a>
              @endif
              <div class="clear"></div>
            </div>
          </div>
        </div>
        <div class="five columns profile-photo omega" id="profile-head-photo">
          <img src="{{ $portfolio->user->profile_image ?? null }}" alt="{{ $portfolio->user->name ?? null }} ArtsThread Profile" title="{{ $portfolio->user->name ?? null }} ArtsThread Profile">
        </div>
        <div class="five columns alpha omega" id="profile-head-right">
          <img src="{{ $portfolio->user->schoolimage ?? null }}" alt="{{ $portfolio->user->schoolname ?? null }}" title="{{ $portfolio->user->schoolname ?? null }}" data-image="{{ $portfolio->user->schoolimage ?? null }}">
        </div>
      </div>
    </div>
    <div id="profile-mininav">
      <div class="whitey" style="width: max(15vw, calc((100vw - 1185px) / 2))"></div>
      <div class="container">
        <div class="five columns span3 alpha">
          <a href="#" title="" class="profile" id="full-profile" @click="tab = 'profile'">Read <span class="bgblack mobilehide">Full</span> Profile <span class="downarrow">&gt;</span>
          </a>
          <a href="/profile/{{ $portfolio->user->slug ?? null }}" title="View {{ $portfolio->user->firstname ?? null }} {{ $portfolio->user->surname ?? null }} Profile">View <span class="mobilehide">All</span> Projects </a>
          <a href="#" title="" id="message-user" @click="tab = 'message'">Message <span class="mobilehide">{{ $portfolio->user->firstname ?? null }}</span>
            <span class="downarrow mobilehide">&gt;</span>
          </a>
        </div>
        <div class="five columns span2 omega" id="profile-stats">
          <p class="views">
            <span class="text">Views&nbsp;&nbsp;</span>
            <span class="bgblack" id="viewcount">{{ $portfolio->views }}</span>
          </p>
          <p class="appreciations">
            <span class="text">Appreciations&nbsp;&nbsp;</span>
            <span class="bgblack" id="likecount">{{ $portfolio->likes }}</span>
          </p>
          <p class="comments">
            <span class="text">Comments&nbsp;&nbsp;</span>
            <span class="bgblack" id="commentcount">{{ $portfolio->comments }}</span>
          </p>
        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div id="message-content" x-show="tab === 'message'">
      <div class="container">
        <h2>Message {{ $portfolio->user->firstname ?? null }}</h2>
        <h4 class="noline">Please <a href="/login/" class="loginbutton">Login</a> or <a href="/register/">Register</a> to message {{ $portfolio->user->firstname ?? null }}. </h4>
      </div>
    </div>
    <div class="clear"></div>
    <div id="profile-content" x-show="tab === 'profile'">
      <div class="container">
        <h2>{{ $portfolio->user->firstname ?? null }} {{ $portfolio->user->surname ?? null }}</h2>
        <div class="five columns profile-photo alpha">
          <img class="profileimg" src="{{ $portfolio->user->profile_image ?? null }}" alt="{{ $portfolio->user->name ?? null }} ArtsThread Profile" title="{{ $portfolio->user->name ?? null }} ArtsThread Profile">
        </div>
        <div class="five columns span2">
          <div class="details">
            <p>First Name: <span class="items">{{ $portfolio->user->firstname ?? null }}</span>
            </p>
            <p>Last Name: <span class="items">{{ $portfolio->user->surname ?? null }}</span>
            </p>
            <p>University / College: <span class="items">{{ $portfolio->user->schoolname ?? null }}</span>
            </p>
            <p>Course / Program: <span class="items">{{ $portfolio->user->coursetitle ?? null }}</span>
            </p>
            <p>Graduates: <span class="items">{{ $portfolio->user->gradyear ?? null }}</span>
            </p>
            <p>Specialisms:
              <span class="items">
                @php
                $spec1 = Helper::specialism($portfolio->user->specialism);
                $spec2 = Helper::specialism($portfolio->user->specialism2);
                $spec3 = Helper::specialism($portfolio->user->specialism3);
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
            <p>My Location: <span class="items">{{ Helper::city($portfolio->user->city) }}, {{ Helper::country($portfolio->user->country) }}</span>
            </p>
            @if($portfolio->user->website)
            <p>Website: <span class="items">
                <a href=" {{ $portfolio->user->website }}" target="_blank">Click To See Website</a>
              </span>
            </p>
            @endif
          </div>
        </div>
        <div class="five columns span2 omega">
          <h4>About:</h4>
          <div class="about">
            <p>{!! $portfolio->user->profile !!}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="at-project">
      <div class="at-project-gallery swiper" data-project-slider>
        <div class="gallery popup-gallery swiper-wrapper">
          @foreach ($portfolio->media as $media)
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
          <a class="media-item youtube swiper-slide" href="http://www.youtube.com/watch?v={{ $vidId }}" title="{{ $media->title }}">
            <div class="hover">
              <div class="icon"></div>
            </div><img class="active" src="{{$media->image}}" alt="{{ $media->title }}" title="{{ $media->title }}" />
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
            </div><img class="active" src="{{ $media->image }}" alt="{{ $media->title }}" title="{{ $media->title }}" />
          </a>
          @endif
          @endif
          @else
          <a class="media-item image @if($loop->first) active @endif swiper-slide" href="{{$media->image_large}}" title="{{$media->title}}">
            <div class="hover">
              <div class="icon"></div>
            </div><img class="active" src="{{$media->image_large}}" alt="{{$media->title}}" title="{{$media->title}}" />
          </a>
          @endif
          @endforeach
        </div>
        <a title="Previous Image" class="nav prev"><</a>
        <a title="Next Image" class="nav next">></a>
      </div>
      <div class="at-project-info">
        <div class="container">
          <div class="five columns span2 alpha">
            <h2>{{ $portfolio->title }}</h2>
            <livewire:frontend.portfolio-project-stats :project="$portfolio">
            <div class="topics">
              <p>Specialisms: </p>
              @if($portfolio->specialismOne ?? false)
              <a href="#" class="specialism-click" data-specialism="{{$portfolio->specialismOne->specialism}}">{{$portfolio->specialismOne->specialism}}</a>
              @endif
              @if($portfolio->specialismTwo ?? false)
              <a href="#" class="specialism-click" data-specialism="{{$portfolio->specialismTwo->specialism}}">{{$portfolio->specialismTwo->specialism}}</a>
              @endif
              @if($portfolio->specialismThree ?? false)
              <a href="#" class="specialism-click" data-specialism="{{$portfolio->specialismThree->specialism}}">{{$portfolio->specialismThree->specialism}}</a>
              @endif
              <div class="clear"></div>
            </div>
            <div class="clear"></div>
          </div>

          <div class="five columns span2">
            <div class="details">
              <p>{!! $portfolio->description !!}</p>
            </div>
          </div>
          @if(count($portfolio->events) > 0 || count($portfolio->competitions) > 0)
          <div class="five columns omega">
            @if(count($portfolio->events) > 0)
            <div class="portfolio">
              <h5>Events:</h5>
              @foreach ($portfolio->events as $event)
              <a href="/{{$event->slug}}"><img src="{{$event->image}}" alt="{{$event->name}}" title="{{$event->name}}" />
                <h4>{{$event->name}}</h4>
              </a>
              @endforeach
            </div>
            @endif
            @if(count($portfolio->competitions) > 0)
            <div class="competition">
              <h5>Competitions:</h5>
              @foreach($portfolio->competitions as $comp)
              <a href="/{{$comp->slug}}"><img src="{{$comp->image}}" alt="{{$comp->name}}" title="{{$comp->name}}" />
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
  </div>
  <!-- Portfolio Content //-->
  <!-- Pagination //-->
  <div class="banner mid portfolios paging inactive" id="pagination-holder" style="display: none;">
    <div class="toprow">
      <div class="container" id="course-pagination"></div>
    </div>
  </div>
  <!-- Pagination //-->
</div>
@endsection