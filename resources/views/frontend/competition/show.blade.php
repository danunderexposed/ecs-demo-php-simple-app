@extends('layouts.frontend')

@section('content')
<div class="single-nav single-nav--comps">
    <div class="single-nav__inner">
        <a href="/competitions/"><i>&lt;</i> View all <span>Competitions/Challenges</span></a>
    </div>
</div>
<div class="competition-content" style="overflow:hidden;">


    <!-- Courses Display //-->

    <div class="container column single">

        <!-- Main Header //-->

        <a href="{{ $competition->link }}" target="_blank"><img class="full-width-course-image" src="{{ $competition->image }}"
                alt="{{ $competition->name }}" title="{{ $competition->name }}"></a>
        <div id="competition-content">


            <div class="two-thirds column alpha omega" id="competition-header-details" x-ref="header">
                <h3>{{ $competition->name }}</h3>

                <div class="deadline">Deadline: <div class="deadline-date">{{ date('jS M Y',strtotime($competition->deadline)) }}</div>
                </div>
            </div>

            <div class="one-third column alpha omega" x-data="{ height: $refs.header.offsetHeight + 'px' }">
                <a href="/login/" id="competition-enter-login" class="entered loginbutton" :style="`height: ${height};`">
                    <div class="competition-enter-pad">Login Or Register To Enter</div>
                </a>
            </div>


        </div>

        <!-- Main Header //-->

    </div>

    <!-- Enter Competition  //-->

    <div class="competition-enter">
			<div class="container">

				<div class="full-width column">

					<h3><a class="addprojectizzle" href="/profile/?addproject=true">You Must Create A Project To Enter<br>Click Here To Create A Project For This Competition</a></h3>
				</div>

			</div>

		</div>

    <!-- Enter Competition  //-->

    <div class="competition-content">

        <!-- Main Content //-->

        <div id="competition-content-main">

            <div class="full-page-sharebar">
                <div class="container">
                    <div class="contentpad">
                        <div class="sharebar">
                            <a class="first addthis_button_compact at300m" href="#"
                                addthis:url="/competitions/"
                                addthis:title=" - ArtsThread Competition"
                                data-url="/competitions/"
                                data-title=" - ArtsThread Competition"
                                title="Share  - ArtsThread Competition"><span><span class="bgmedium">Share</span> <span
                                        class="mobilehide">Competition</span></span></a>



                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="competition-content-drop">
            <div class="singlecomp-sidebar"></div>
                <div class="container singlecomp-main">

                    <div class="two-thirds column alpha omega maincontent">

                        <div class="contentpad padtop">
                            <div class="clear"></div>
                            <div class="details">
                                {!! $competition->description !!}
                            </div>
                        </div>

                        <div class="clear"></div>

                    </div>

                    <div class="one-third column alpha omega sidebar" style="height: 1560px;">

                        @foreach ($sidebarCompetitions as $c)

                        <a href="https://www.artsthread.com/events/{{ $c->slug }}" class="mini-comp"><img
                                src="{{ $c->image }}"
                                alt="{{ $c->name }}" title="{{ $c->name }}">
                            <h4>{{ $c->name }}</h4>
                            <div class="deadline">Deadline: <div
                                    class="deadline-date">{{ date('jS M Y',strtotime($c->dealine)) }}</div>
                            </div>
                        </a>

                        @endforeach

                        <div class="clear"></div>

                    </div>

                    <div class="clear"></div>

                </div>

            </div>

        </div>

        <!-- Main Content //-->


    </div>

    <!-- Competition Display //-->


</div>
@endsection
