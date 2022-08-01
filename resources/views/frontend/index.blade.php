@extends('layouts.frontend')

@section('content')
<div class="home-top-banner">
    <div class="swiper" data-home-hero-slider>
        <div class="swiper-wrapper">
            @if($slides)
                @foreach($slides as $slide)
                <div class="home-slide swiper-slide">
                    <div class="home-slide__inner">
                    <div class="home-slide__media">
                        <img src="{{ $slide->image }}">
                    </div>
                    <div class="home-slide__text">
                        <div class="home-slide__container">
                        @if($slide['pre_title'] != '')
                        <p>{{ $slide->pre_title }}</p>
                        @endif
                        <h2>{{ $slide->title }}</h2>
                        <a href="{{ $slide->link }}">{{ $slide->link_text }}</a>
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<div class="homepage-community">
  <div class="homepage-community__inner">
    <div><p>Be part of the Artsthread community</p></div>
    <div class="homepage-community__btn1">
      <a href="/register/">Upload a portfolio</a>
    </div>
    <div class="homepage-community__divider"></div>
    <div class="homepage-community__btn2">
      <a href="/portfolios/" class="last">View portfolios</a>
    </div>
  </div>
</div>

<div class="home-content">
	<div class="container column desktop-grid" id="home-grid">
		@foreach ($grid as $g)
            @php
                //Sort Image
                if($g->image && $g->image != '') {
                    $desktop_image = '<img class="" src="' . $g->image . '" alt="'.$g->name.' - ArtsThread" title="'.$g->name.' - ArtsThread" />';
                    } else {
                        $desktop_image = '';
                    }

                //Sort Link
                $link = '';
                if(!is_numeric($g->link)) $link = htmlspecialchars($g->link);

                //Define Styles
                $stylemodule = '';
                $styleheader = '';
                $stylecopy = '';

                //Create Styles
                if($g->headclr) {
                    $styleheader .= 'color:' . htmlspecialchars($g->headclr) . ';';
                }
                if($g->headbg) {
                    $styleheader .= 'background:' . htmlspecialchars($g->headbg) . ';';
                }
                if($g->copyclr) {
                    $stylecopy .= 'color:' . htmlspecialchars($g->copyclr) . ';';
                }
                if($g->copybg) {
                    $stylecopy .= 'background:' . htmlspecialchars($g->copybg) . ';';
                }
                if($g->modulebg) {
                    $stylemodule .= 'background:' . htmlspecialchars($g->modulebg) . ';';
                }

                //Set Styles
                if($stylemodule) {
                    $stylemodule = ' style="' . $stylemodule . '"';
                }
                if($styleheader) {
                    $styleheader = ' style="' . $styleheader . '"';
                }
                if($stylecopy) {
                    $stylecopy = ' style="' . $stylecopy . '"';
                }

                //Work Out Colspan
                $colspan = 1;
                if($g->type == 'full2' || $g->type == 'half2' || $g->type == 'video2' || $g->type == 'port2') {
                    $colspan = 2;
                }
                if($g->type == 'full3') {
                    $colspan = 3;
                }
                if (strpos($link, 'artsthread.com') !== false) {
                $target = '';
                } else {
                    $target = 'target="_blank"';
                }
            @endphp

            @if($g->type == 'port1' || $g->type == 'port2')
                <div id="module-{{ $g->id }}" target="_blank"{{ $stylemodule }} class="module grid-slider__container col-span-{{ str_replace('port', '', $g->type) }}">
                    <div class="headerimage"><img src="/images/main/featured-grid-header.png" alt="Featured Portfolios" title="Featured Portfolios" /></div>
                    <div class="gridslider" x-data="gridSlider" style="left: 0;">
                        {!! $featured !!}
                    </div>
                </div>
            @else
                <a
                href="{{ $link }}"
                id="module-{{ $g->id }}"
                {{ $target }}
                {{ $stylemodule }}
                class="module col-{{ $colspan }} {{ $g->type }}">
                    {!! $desktop_image !!}
                    <div class="content">
                        <h3 {{ $styleheader }}>{{ $g->headtxt }}</h3>
                        <p {{ $stylecopy }}>{{ $g->copytxt }}</p>
                    </div>
                </a>
            @endif
        @endforeach

	</div>
	<div id="mobile-grid">


	</div>
</div>

<div class="home-latest-portfolio-header">
	<div class="container column">
		<h3><a href="#" title="Latest Portfolios">Featured Portfolios</a></h3>
		<div class="menu">
			<h4 data-portfolio-slider-header>Fashion / Textiles / Accessories</h4>
            <div class="portfolio-pagination swiper" data-home-portfolio-controller>
                <div class="swiper-wrapper">
                    <span class="swiper-slide bullet diamond">Fashion / Textiles / Accessories</span>
                    <span class="swiper-slide bullet circle">Visual Communication</span>
                    <span class="swiper-slide bullet hexagon">Product / Industrial / Interiors</span>
                    <span class="swiper-slide bullet triangle">Ceramics / Jewellery / Glass</span>
                </div>
            </div>
		</div>
	</div>
</div>

<div class="home-latest-portfolio" data-home-portfolio-nested-controller>

	{{-- <div class="mini-nav">
		<a href="#prev" class="left swiper-button-prev"><</a>
		<a href="#next" class="right swiper-button-next">></a>
	</div> --}}
    <div class="mini-nav "><a href="#prev" class="left">&lt;</a><a href="#next" class="right">&gt;</a></div>

	<div class="container column">
		<div class="portfolio-list swiper" data-home-portfolio-slider>
			<div class="portfolio-full swiper-wrapper">
                @if($sector1)
				<div class="portfolio-selection swiper-slide list1">
                    <div class="swiper" data-home-portfolio-nested-slider>
                        <div class="swiper-wrapper">
                            @foreach ($sector1 as $project)
                                @php
                                    $name = htmlspecialchars($project->firstname) . ' ' . htmlspecialchars($project->surname);
                                    $specialism1 = $project->specialismOne->specialism ?? false;
                                    $specialism2 = $project->specialismTwo->specialism ?? false;
                                    $specialism3 = $project->specialismThree->specialism ?? false;
                                    if($specialism1 || $specialism2 || $specialism3) { $specialiststring = '<small>Specialist:</small><small><span>'.htmlspecialchars($specialism1).'</span> <span>'.htmlspecialchars($specialism2).'</span> <span>'.htmlspecialchars($specialism3).'</span></small>'; } else { $specialiststring=''; }
                                @endphp
                                <a href="/portfolios/{{ $project->slug }}" class="portfolio swiper-slide">
                                    <div class="hover"><div class="icon"></div></div>
                                    <img class="portfolio-image-home" src="{{ $project->cover_medium }}" alt="{{ $name }} - {{ $project->title }}" title="{{ $name }} - {{ $project->title }}" >
                                    <div class="header"><h5>{{ $name }}</h5><p>{{ strip_tags($project->title) }}</p>{!! $specialiststring !!}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
				</div>
                @endif

				@if($sector2)
				<div class="portfolio-selection swiper-slide list2">
                <div class="swiper" data-home-portfolio-nested-slider>
                        <div class="swiper-wrapper">
                            @foreach ($sector2 as $project)
                                @php
                                    $name = htmlspecialchars($project->firstname) . ' ' . htmlspecialchars($project->surname);
                                    $specialism1 = $project->specialismOne->specialism ?? false;
                                    $specialism2 = $project->specialismTwo->specialism ?? false;
                                    $specialism3 = $project->specialismThree->specialism ?? false;
                                    if($specialism1 || $specialism2 || $specialism3) { $specialiststring = '<small>Specialist:</small><small><span>'.htmlspecialchars($specialism1).'</span> <span>'.htmlspecialchars($specialism2).'</span> <span>'.htmlspecialchars($specialism3).'</span></small>'; } else { $specialiststring=''; }
                                @endphp
                                <a href="/portfolios/{{ $project->slug }}" class="portfolio swiper-slide">
                                    <div class="hover"><div class="icon"></div></div>
                                    <img class="portfolio-image-home" src="{{ $project->cover_medium }}" alt="{{ $name }} - {{ $project->title }}" title="{{ $name }} - {{ $project->title }}" >
                                    <div class="header"><h5>{{ $name }}</h5><p>{{ $project->title }}</p>{!! $specialiststring !!}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
				</div>
                @endif

                @if($sector3)
				<div class="portfolio-selection swiper-slide list3">
                <div class="swiper" data-home-portfolio-nested-slider>
                        <div class="swiper-wrapper">
                            @foreach ($sector3 as $project)
                                @php
                                    $name = htmlspecialchars($project->firstname) . ' ' . htmlspecialchars($project->surname);
                                    $specialism1 = $project->specialismOne->specialism ?? false;
                                    $specialism2 = $project->specialismTwo->specialism ?? false;
                                    $specialism3 = $project->specialismThree->specialism ?? false;
                                    if($specialism1 || $specialism2 || $specialism3) { $specialiststring = '<small>Specialist:</small><small><span>'.htmlspecialchars($specialism1).'</span> <span>'.htmlspecialchars($specialism2).'</span> <span>'.htmlspecialchars($specialism3).'</span></small>'; } else { $specialiststring=''; }
                                @endphp
                                <a href="/portfolios/{{ $project->slug }}" class="portfolio swiper-slide">
                                    <div class="hover"><div class="icon"></div></div>
                                    <img class="portfolio-image-home" src="{{ $project->cover_medium }}" alt="{{ $name }} - {{ $project->title }}" title="{{ $name }} - {{ $project->title }}" >
                                    <div class="header"><h5>{{ $name }}</h5><p>{{ $project->title }}</p>{!! $specialiststring !!}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
				</div>
                @endif

                @if($sector4)
				<div class="portfolio-selection swiper-slide list4">
                    <div class="swiper" data-home-portfolio-nested-slider>
                        <div class="swiper-wrapper">
                            @foreach ($sector4 as $project)
                                @php
                                    $name = htmlspecialchars($project->firstname) . ' ' . htmlspecialchars($project->surname);
                                    $specialism1 = $project->specialismOne->specialism ?? false;
                                    $specialism2 = $project->specialismTwo->specialism ?? false;
                                    $specialism3 = $project->specialismThree->specialism ?? false;
                                    if($specialism1 || $specialism2 || $specialism3) { $specialiststring = '<small>Specialist:</small><small><span>'.htmlspecialchars($specialism1).'</span> <span>'.htmlspecialchars($specialism2).'</span> <span>'.htmlspecialchars($specialism3).'</span></small>'; } else { $specialiststring=''; }
                                @endphp
                                <a href="/portfolios/{{ $project->slug }}" class="portfolio swiper-slide">
                                    <div class="hover"><div class="icon"></div></div>
                                    <img class="portfolio-image-home" src="{{ $project->cover_medium }}" alt="{{ $name }} - {{ $project->title }}" title="{{ $name }} - {{ $project->title }}" >
                                    <div class="header"><h5>{{ $name }}</h5><p>{{ $project->title }}</p>{!! $specialiststring !!}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
				</div>
                @endif

			</div>
		</div>
	</div>
</div>

<div class="home-sponsors-header" data-home-sponsor-controller>

	<div class="mini-nav home-sponsors-nav">
		<a href="#prev" class="left"><</a>
		<a href="#next" class="right">></a>
	</div>

	<div class="container column">
		<h3><a>Sponsors &amp; Partners</a></h3>
	</div>
</div>

<div class="home-sponsors">
	<div class="container column">
		<div class="sponsor-list swiper" data-home-sponsor-slider>
			<div class="sponsor-full swiper-wrapper">
				@foreach($sponsors as $sponsor)
                <div class="swiper-slide">
				<a href="{{ $sponsor->url }}" target="_blank" title="{{ $sponsor->name }}" class="sponsor"><img src="{{ $sponsor->image_large }}" alt="{{ $sponsor->name }}" title={{ $sponsor->name }}"></a>
                </div>
				@endforeach
			</div>
		</div>
	</div>
</div>

@endsection
