@extends('layouts.frontend')

@section('content')
<div class="single-nav single-nav--school">
  <div class="single-nav__inner">
    <a href="/schools/"><i>&lt;</i> View all <span>Universities &amp; Schools</span></a>
  </div>
</div>


    <!-- Courses Display //-->

    <div class="courses-content nopad featured" x-data="{ show: false }">

		<!-- Courses Display //-->

		<div class="container column single" id="course-html">

			<div id="course-content" class="single-school">

				<div class="two-thirds column alpha omega" id="course-details" x-ref="header">

					<div class="summary nopad">
						<h2><span class="bgblack">{{ $school->school ?? null }}</span></h2>
					</div>

					<div class="links">
						<a class="website ga-track" data-click-type="School" data-click-title="{{ $school->school ?? null }} - {{ $school->website ?? null }}" href="{{ $school->website ?? null }}" title="{{ $school->school ?? null }}" target="_blank">Visit School Website</a>
						<div class="social">
							@if($school->twitter ?? false)
								<a class="twitter" href="{{ $school->twitter ?? null }}" title="{{ $school->school ?? null }} Twitter" target="_blank">Twitter</a>
							@endif
							@if($school->facebook ?? false)
							<a class="facebook" href="{{ $school->facebook ?? null }}" title="{{ $school->school ?? null }} Facebook" target="_blank">Facebook</a>
							@endif
							@if($school->linkedin ?? false)
							<a class="linkedin" href="{{ $school->linkedin ?? null }}" title="{{ $school->school ?? null }} LinkedIn" target="_blank">LinkedIn</a>
							@endif
							@if($school->youtube ?? false)
							<a class="youtube" href="{{ $school->youtube ?? null }}" title="{{ $school->school ?? null }} YouTube" target="_blank">YouTube</a>
							@endif
							@if($school->instagram ?? false)
							<a class="instagram" href="{{ $school->instagram ?? null }}" title="{{ $school->school ?? null }} Instagram" target="_blank">Instagram</a>
							@endif
							<div class="clear"></div>
						</div>
					</div>

					<div class="clear"></div>

					<div class="summary excerpt">
						{{ \Illuminate\Support\Str::limit(strip_tags($school->description ?? null), 450, $end='...') }}
					</div>

					<a href="#profile" title="" class="profile" id="full-profile" @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }">Read <span class="bgblack">Full</span> Profile&nbsp;&nbsp;<span class="downarrow">&gt;</span></a>

				</div>

				<div class="flex one-third column alpha omega" id="course-school" style="" x-data="{ height: $refs.header.offsetHeight + 'px' }" :style="`height: ${height};display: flex;align-items: center;justify-content: center;`">
					<img class="school-image" src="{{ $school->image ?? null }}" alt="" title="" >
				</div>

				<div class="clear"></div>

			</div>

			<!-- Main Header //-->


			<!-- Full Profile //-->

			<div id="profile-content" class="courses" x-show="show">

				<div class="container">

					<h2><span class="bgblack"></span></h2>


					<div class="five columns span2">

						<div class="details">


							<p>School / University: <span class="items">{{ $school->school ?? null }}</span></p><p>City: <span class="items">{{ $school->city->name ?? null }}</span></p>
							<p>Country: <span class="items">{{ $school->country->name ?? null }}</span></p>			<p><span class="items"><a href="{{ $school->website ?? null }}" title="{{ $school->school ?? null }} Website" target="_blank" class="ga-track" data-click-type="School" data-click-title="School Link: {{ $school->school ?? null }} - {{ $school->website ?? null }}">Visit School Website</a></span></p>
						</div>

					</div>

					<div class="five columns span3 omega">

						<div class="standard">
							{!! $school->description ?? null !!}
						</div>

					</div>

				</div>

			</div>

</div>

            <div class="at-project-gallery swiper" data-project-slider>
                <div class="gallery popup-gallery swiper-wrapper">
                    <a class="media-item image swiper-slide" href="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/schools/5ac9fd07dbd48340356ebc4de4dc649a.jpg" title=""  tabindex="-1">
                            <div class="hover"><div class="icon"></div></div>
                            <img class="active" src="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/schools/5ac9fd07dbd48340356ebc4de4dc649a.jpg" alt="" title="" />
                        </a>
                        <a class="media-item image swiper-slide" href="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/schools/5ac9fd07dbd48340356ebc4de4dc649a.jpg" title="" tabindex="-1">
                            <div class="hover"><div class="icon"></div></div>
                            <img class="active" src="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/schools/5ac9fd07dbd48340356ebc4de4dc649a.jpg" alt="" title="" />
                        </a>
                </div>
                <a title="Previous Image" class="nav prev"><</a>
                <a title="Next Image" class="nav next">></a>
            </div>
        </div>
        <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: block;">Next</button>
    </div>
</div>
@if ($school->courses())
    <div id="course-portfolio-html">
        <div id="school-course-container">
            <div class="container">
                <h2>Related Programs</h2>

                @foreach ($school->courses() as $course)
                    <a href="{{ $course->slug }}" class="course-module">
                        <img src="{{ $course->image_small }}" alt="{{ $school->school }} - {{ $course->name }}" title="{{ $school->school }} - {{ $course->name }}" class="course-image-mini">
                        <div class="course-info">
                            <p class="course-name">{{ $course->name }}</p>
                            <p class="course-school">{{ $school->school }}</p>
                        </div>
                    </a>



                @endforeach
            </div>
        </div>
    </div>
@endif

        		{{-- <a href="https://www.artsthread.com/schools/pearl-academy-delhi-fashion-media-communication-program/" class="course-module no-2"><img src="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/courses/34ced092540e89c6cdf022d5d682d4d4_small.jpg" alt="Pearl Academy Delhi - Fashion Media Communication Program" title="Pearl Academy Delhi - Fashion Media Communication Program" class="course-image-mini"><div class="course-info"><p class="course-name">Fashion Media Communication Program</p><p class="course-school">Pearl Academy Delhi</p></div></a><a href="https://www.artsthread.com/schools/pearl-academy-delhi-fashion-styling-image-design-program/" class="course-module no-3"><img src="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/courses/bdfc194f4c0847ddedb453e763352be5_small.jpg" alt="Pearl Academy Delhi - Fashion Styling &amp; Image Design Program" title="Pearl Academy Delhi - Fashion Styling &amp; Image Design Program" class="course-image-mini"><div class="course-info"><p class="course-name">Fashion Styling &amp; Image Design Program</p><p class="course-school">Pearl Academy Delhi</p></div></a><a href="https://www.artsthread.com/schools/pearl-academy-delhi-graphics-communication-design-program/" class="course-module no-1"><img src="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/courses/0e0e2e1958b4798be1af103ed9b8d3de_small.jpg" alt="Pearl Academy Delhi - Graphics &amp; Communication Design Program" title="Pearl Academy Delhi - Graphics &amp; Communication Design Program" class="course-image-mini"><div class="course-info"><p class="course-name">Graphics &amp; Communication Design Program</p><p class="course-school">Pearl Academy Delhi</p></div></a><a href="https://www.artsthread.com/schools/pearl-academy-delhi-interior-architecture-design-styling-program/" class="course-module no-2"><img src="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/courses/205aa487edc06db04bd9bce5c68ba0dc_small.jpg" alt="Pearl Academy Delhi - Interior Architecture Design &amp; Styling Program" title="Pearl Academy Delhi - Interior Architecture Design &amp; Styling Program" class="course-image-mini"><div class="course-info"><p class="course-name">Interior Architecture Design &amp; Styling Program</p><p class="course-school">Pearl Academy Delhi</p></div></a><a href="https://www.artsthread.com/schools/pearl-academy-delhi-journalism-media-communication-program/" class="course-module no-3"><img src="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/courses/7f4590ff844d4e6cb09cedb862fdce1f_small.jpg" alt="Pearl Academy Delhi - Journalism Media &amp; Communication Program " title="Pearl Academy Delhi - Journalism Media &amp; Communication Program " class="course-image-mini"><div class="course-info"><p class="course-name">Journalism Media &amp; Communication Program </p><p class="course-school">Pearl Academy Delhi</p></div></a><a href="https://www.artsthread.com/schools/pearl-academy-delhi-product-design-program/" class="course-module no-1"><img src="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/courses/2a4e159c1bfcc7081b7674a7df0777ec_small.jpg" alt="Pearl Academy Delhi - Product Design Program" title="Pearl Academy Delhi - Product Design Program" class="course-image-mini"><div class="course-info"><p class="course-name">Product Design Program</p><p class="course-school">Pearl Academy Delhi</p></div></a><div class="clear"></div></div></div>		</div> --}}

	<!-- Pagination //-->

	<div class="banner mid schools paging inactive" id="pagination-holder" style="display: none;">

		<div class="toprow">

			<div class="container" id="course-pagination">


			</div>

		</div>

	</div>

	<!-- Pagination //-->

</div>

@endsection
