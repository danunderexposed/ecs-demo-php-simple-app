@extends('layouts.frontend')

@section('content')
<div class="single-nav single-nav--events">
    <div class="single-nav__inner">
        <a href="/events/"><i>&lt;</i> View all <span>Events/Exhibitions</span></a>
    </div>
</div>
<div class="competition-content" style="overflow:hidden;">


    <!-- Courses Display //-->

    <div class="container column single page-template-artsthread-events">

        <!-- Main Header //-->

        <a href="{{ $event->link }}" target="_blank"><img class="full-width-course-image" src="{{ $event->image }}"
                alt="{{ $event->name }}" title="{{ $event->name }}"></a>
        <div id="competition-content">

            <div class="fullwidth column" id="competition-header-details">
                <h3>{{ $event->name }}</h3>
                <div class="deadline">Starts: <div class="deadline-date">
                        {{ date('jS M Y',strtotime($event->start_date)) }}</div>Ends: <div class="deadline-date">
                        {{ date('jS M Y',strtotime($event->end_date)) }}</div>
                </div>
            </div>



        </div>

        <!-- Main Header //-->

    </div>

    <!-- Enter Competition  //-->

    <div class="competition-enter event">
        <div class="container">

            <div class="full-width column">

                <h3>You Must Create A Project To Enter</h3>
            </div>

        </div>

    </div>

    <!-- Enter Competition  //-->

    <div class="competition-content events">

        <!-- Main Content //-->

        <div id="competition-content-main" x-data="{ openTab: 1 }">

            <div class="full-page-sharebar">
                <div class="container">
                    <div class="contentpad">
							<div class="sharebar">
									<a class="first voting-content-switcher active" @click="openTab = 1" :class="{ 'active': openTab != 2 }" id="comp-voting-view-entry"><span class="bgmedium"><span class="mobilehide">View</span></span> Exhibitors</a>

									<a class="voting-content-switcher" id="comp-voting-view-brief" @click="openTab = 2" :class="{ 'active': openTab != 1 }"><span class="bgmedium"><span class="mobilehide">View</span></span> Event Info</a>

								    <!--<div class="sorter mobilehide js-filter" style="display: block;">
									<span>Sort By:</span>
									<a href="#" class="sort active" data-sort="random" data-page="1" data-seed="1092871652" data-url="https://www.artsthread.com/events/id-international-emerging-designer-awards-2021/">Random</a>
									<a href="#" class="sort" data-sort="latest" data-page="1" data-seed="1092871652" data-url="https://www.artsthread.com/events/id-international-emerging-designer-awards-2021/">Latest</a>
									<a href="#" class="sort" data-sort="name" data-page="1" data-seed="1092871652" data-url="https://www.artsthread.com/events/id-international-emerging-designer-awards-2021/">Name</a>
								</div>-->

								<div class="clear"></div>
							</div>
						</div>
                </div>
            </div>

            <div id="competition-content-drop" class="event-main-content-dropper" x-show="openTab === 2">
            <div class="singlecomp-sidebar"></div>
                <div class="container singlecomp-main">

                    <div class="two-thirds column alpha omega maincontent">

                        <div class="contentpad padtop">
                            <div class="clear"></div>
                            <div class="details">
                                {!! $event->description !!}
                            </div>
                        </div>

                        <div class="clear"></div>

                    </div>

                    <div class="one-third column alpha omega sidebar">

                        @foreach ($sidebarEvents as $e)

                        <a href="https://www.artsthread.com/events/{{ $e->slug }}" class="mini-comp"><img
                                src="{{ $e->image }}"
                                alt="{{ $e->name }}" title="{{ $e->name }}">
                            <h4>{{ $e->name }}</h4>
                            <div class="deadline">Starts: <div class="deadline-date">{{ date('jS M Y',strtotime($e->start_date)) }}</div>Ends: <div
                                    class="deadline-date">{{ date('jS M Y',strtotime($e->end_date)) }}</div>
                            </div>
                        </a>

                        @endforeach

                        <div class="clear"></div>

                    </div>

                    <div class="clear"></div>

                </div>

            </div>

            <div class="clear entries"></div>

            <div id="course-html" class="events">
			<div id="latest-entries" class="events" x-show="openTab === 1">

				<div class="container winners">

					<h3>{{ $event->name }}</h3>

					<div id="latest-entry-js-display">

						<div id="portfolio-content">
                            <div class="wrapper">
                                <div class="row">
                                @foreach ($event->entries as $entry)
                                    <a href="/portfolios/{{ $entry->project->slug ?? null }}/" class="portfolio col-xs-12 col-ss-6 col-md-4">
                                        <div class="portfolio-image-wrap">
                                            <div class="hover">
                                                <div class="icon"></div>
                                            </div>
                                            <img class="portfolio-image" src="{{ $entry->project->cover_medium ?? null }}" alt="" title="">
                                        </div>
                                        <div class="maintitle">
                                            <h4 class="name">{{ $entry->project->title ?? null }}</h4>
                                            <h5 class="course">?? DISPLAY NAME ??</h5>
                                        </div>
                                        <div class="header">
                                            <small>Specialism:</small>
                                            <small>
                                                <span class="specialism-click" data-specialism="" data-url="">
                                                    @if(is_numeric($entry->project->specialism))
                                                        {{ App\Models\Specialism::find($entry->project->specialism)->specialism }}
                                                    @else
                                                     {{ $entry->project->specialism }}
                                                    @endif
                                                </span>

                                                <span class="specialism-click" data-specialism="" data-url="">
                                                    @if($entry->project->specialism2 && is_numeric($entry->project->specialism2))
                                                        {{ App\Models\Specialism::find($entry->project->specialism2)->specialism }}
                                                    @else
                                                    {{ $entry->project->specialism2 }}
                                                    @endif
                                                </span>
                                                <span class="specialism-click" data-specialism="" data-url="">
                                                @if($entry->project->specialism3 && is_numeric($entry->project->specialism3))
                                                        {{ App\Models\Specialism::find($entry->project->specialism3)->specialism }}
                                                    @else
                                                    {{ $entry->project->specialism3 }}
                                                    @endif
                                                </span>

                                            </small>
                                        </div>
                                        <div class="project-stats">
                                            <p class="views">
                                                <span class="bgblack" id="viewcount">{{ $entry->project->views ?? null }}</span>
                                            </p>
                                            <p class="comments">
                                                <span class="bgblack" id="viewcount">{{ $entry->project->comments ?? null }}</span>
                                            </p>
                                            <div class="clear"></div>
                                        </div>
                                    </a>
                                    @endforeach
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>

				</div>

			</div>

			<!-- Pagination //-->

			<div class="banner mid competitions events paging" style="display: block;">

				<div id="latest-entry-pagination-holder-events" style="display: block;">

					<div class="toprow">

						<div class="container" id="latest-entry-pagination">

							<div id="pagination"><a href="https://www.artsthread.com/events/id-international-emerging-designer-awards-2021/?sp=1&amp;order=random&amp;sd=1092871652" class="button pagination active"><span>1</span></a><a href="https://www.artsthread.com/events/id-international-emerging-designer-awards-2021/?sp=2&amp;order=random&amp;sd=1092871652" class="button pagination"><span>2</span></a><a href="https://www.artsthread.com/events/id-international-emerging-designer-awards-2021/?sp=2&amp;order=random&amp;sd=1092871652" class="button pagination arrow">&gt;</a><div class="clear"></div></div>
						</div>

					</div>

				</div>

			</div>
			<div class="clear"></div>

			<!-- Pagination //-->


			</div>


		</div>

        </div>

        <!-- Main Content //-->


    </div>

    <!-- Competition Display //-->


</div>
@endsection
