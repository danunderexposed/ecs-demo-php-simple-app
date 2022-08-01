<section>
<div id="filter-form" class="filter filter--events" :class="filterOpen ? 'showing-filters' : ''" x-data="{filterOpen: false, activeNav: null}">

  <div class="filter__header filter__header--hide-lrg">
    <button class="filter__mobile js-toggle-filters" @click="filterOpen = true"><span>&lt;</span> Filter</button>
  </div>

  <div class="filter__items">

    <button class="filter__mobile-close js-toggle-filters" @click="filterOpen = false"><span>&lt;</span> Close</button>

    <div class="filter__items__flex filter__items__flex--with-title">


      <div class="filter__items__item">
        <h4 class="h4-no-filter">Filter <strong>Events/Exhibitions</strong></h4>
      </div>

            <div class="filter__items__item js-filter-accordion filter-accordion" :class="open && activeNav == 1 ? 'is-showing' : ''" x-data="{open: false}">
        <h4 class="js-filter-accordion-btn " :class="activeNav == 1 && open ? 'is-active' : ''" @click="open = !open; activeNav = 1">Search <span>&gt;</span></h4>

        <div class="filter__items__item__level1 filter-accordion__inner">
          <div class="filter__container">
            <button class="filter-accordion__back js-filter-accordion-back" @click="open = false"><span>&lt;</span> Back</button>

            <div class="filter__form-wrap">
              <input class="filter__input" type="text" name="filter-input-keywords" value="" placeholder="Search keywords" wire:model="search">
              <button class="filter__form-btn js-filter-submit" type="button">Filter results</button>
            </div>

          </div>
        </div>
      </div>


      <!-- End of filter__items__flex -->
    </div>

    <button class="filter__dofilter js-do-filtering">View Items</button>
    <!-- End of filter__items -->
  </div>

    <div class="filter__clear-filters js-clear-filters-wrap ">
    <div class="filter__container">
      <button class="js-clear-filters" type="button"><span class="close-icon"></span><span class="clear-text">Clear filters</span></button>
    </div>
  </div>

  <!-- End of filter -->
</div>
<div class="competition-content">
<div class="container column">
    <div class="at-featured">
        <div class="at-featured-gallery swiper" data-project-slider>
            <div class="gallery swiper-wrapper">

                @foreach ($featured as $f)

                <div class="item swiper-slide">

					<a href="/events/{{ $f->slug }}/" title="{{ $f->name }}"><img class="active" src="{{ $f->image }}" alt="ArtsThread - {{ $f->name }}" title="ArtsThread - {{ $f->name }}" /></a>

					<div class="details">

						@php
						$startdate=date('jS M Y',strtotime($f->start_date));
						$enddate=date('jS M Y',strtotime($f->end_date));
						@endphp

						<div class="container">
                            <h3>{{ $f->name }}</h3>
                        </div>
						<div class="container">
						    <div class="five columns span2 alpha">&nbsp;</div>
						    <div class="five columns deadline">Starts: <div class="deadline-date">{{ $startdate }}</div>Ends: <div
						            class="deadline-date">{{ $enddate }}</div>
						    </div>
						    <div class="five columns span2 omega content">
						        <div class="contentpad">{!! \Str::words($f->description, 50) !!}<br /><br />
						            <a href="/events/{{ $f->slug }}">{{ $f->name }}</a>
						        </div>
						    </div>
						</div>
					</div>';
				</div>

                @endforeach
            </div>

            <a href="#prev" title="Previous Image" class="nav prev"><</a>
			<a href="#next" title="Next Image" class="nav next">></a>
        </div>
    </div>
</div>
</div>


<div class="competition-list-content page-template-artsthread-events">
    <!-- Courses Display //-->

    <div id="course-html" class="wrapper">
    @foreach ($events as $e)
        <div class="event-item">
            <div class="row">
                <div class="col-xs-12 col-sm-5">
                    <a href="/events/{{ $e->slug ?? null }}/" class="comp-module no-0">
                        <img
                            src="{{ $e->image ?? null }}"
                            alt=" - Melbourne Fashion Hub 2022"
                            title=" - Melbourne Fashion Hub 2022"
                            class="comp-image-mini"
                        />
                    </a>
                </div>
                <div class="col-xs-12 col-sm-7 comp-module-details">
                    <h3><a href="/events/{{ $e->slug ?? null }}/">{{ $e->name ?? null }}</a></h3>
                    <div class="deadline">
                        Starts:
                        <div class="deadline-date">{{ $e->start_date->format('jS M, Y') ?? null }}</div>
                        Ends:
                        <div class="deadline-date">{{ $e->end_date->format('jS M, Y') ?? null }}</div>
                    </div>
                    <div class="content">
                    {{ \Illuminate\Support\Str::limit(strip_tags($e->description ?? null), 350, $end='...') }}
                    </div>
                    <div class="clear"></div>
                    <div class="bottom-menu">
                        <a href="/events/{{ $e->slug ?? null }}/">View Event</a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@php
    $current = $events->currentPage();
    $first = $current - 2;
    $first = $first > 0 ? $first : 1;
    $last = $first + 4;
    $last = $last > $events->lastPage() ? $events->lastPage() : $last;
@endphp
@if($events->lastPage() > 1)
<div class="banner mid competitions events paging active" id="pagination-holder" style="display: block;">

    <div class="toprow">

        <div class="container" id="course-pagination">
        <div id="pagination">

            @foreach(range($first, $last) as $i)
                <button class="button pagination @if($i == $current) active @endif" wire:click="gotoPage({{$i}})"><span>{{ $i }}</span></button>
            @endforeach
            <button class="button pagination arrow" wire:click="nextPage">&gt;</button>
            <div class="clear"></div>
        </div>
        </div>

    </div>

</div>
@endif
</section>
