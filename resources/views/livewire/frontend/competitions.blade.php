<section>
<div id="filter-form" class="filter filter--competitions" :class="filterOpen ? 'showing-filters' : ''" x-data="{filterOpen: false, activeNav: null}">

  <div class="filter__header filter__header--hide-lrg">
    <button class="filter__mobile js-toggle-filters" @click="filterOpen = true"><span>&lt;</span> Filter</button>
  </div>

  <div class="filter__items">

    <button class="filter__mobile-close js-toggle-filters" @click="filterOpen = false"><span>&lt;</span> Close</button>

    <div class="filter__items__flex filter__items__flex--with-title">


      <div class="filter__items__item">
        <h4 class="h4-no-filter">Filter <strong>Competitions/Challenges</strong></h4>
      </div>

            <div class="filter__items__item js-filter-accordion filter-accordion" :class="open && activeNav == 1 ? 'is-showing' : ''" x-data="{open: false}">
        <h4 class="js-filter-accordion-btn " :class="activeNav == 1 && open ? 'is-active' : ''" @click="open = !open; activeNav = 1">By Status <span>&gt;</span></h4>

        <div class="filter__items__item__level1 filter-accordion__inner">
          <div class="filter__container">
            <button class="filter-accordion__back js-filter-accordion-back" @click="open = false"><span>&lt;</span> Back</button>

            <h5>Please select Status(es)</h5>
            <div class="filter__checkboxes" id="filter-study-level">
                            <div class="filter__checkboxes__checkbox">
                <label class="checkbox-custom checkbox-custom--checkbox">Select all
                  <input type="checkbox" data-parent-filter="filter-study-level" class="js-filter-select-all">
                  <div class="checkbox-custom__indicator"></div>
                </label>
              </div>


              <div class="filter__checkboxes__checkbox">
                <label class="checkbox-custom checkbox-custom--checkbox"> Closed For Review <input type="checkbox" name="filter-status[]" wire:model="status.0" value="review">
                  <div class="checkbox-custom__indicator"></div>
                </label>
              </div>

              <div class="filter__checkboxes__checkbox">
                <label class="checkbox-custom checkbox-custom--checkbox"> Open For Submission                  <input type="checkbox" name="filter-status[]" wire:model="status.1" value="submission">
                  <div class="checkbox-custom__indicator"></div>
                </label>
              </div>

              <div class="filter__checkboxes__checkbox">
                <label class="checkbox-custom checkbox-custom--checkbox"> Winner(s) Announced                  <input type="checkbox" name="filter-status[]" wire:model="status.2" value="winner">
                  <div class="checkbox-custom__indicator"></div>
                </label>
              </div>
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


<div class="competition-content" style="overflow:hidden;">

    <div class="container column">
        <div class="at-featured">
            <div class="at-featured-gallery swiper" data-project-slider>
                <div class="gallery swiper-wrapper">
                    @foreach($featured as $c)
                    <div class="item swiper-slide">
                        <a href="/competitions/{{ $c->slug }}"
                            title="{{ $c->name }}"><img class="active"
                                src="{{ $c->image }}"
                                alt="ArtsThread - {{ $c->name }}"
                                title="ArtsThread - {{ $c->name }}"></a>
                        <div class="details">
                            <div class="container">
                                <h3>{{ $c->name }}</h3>
                            </div>
                            <div class="container">
                                <div class="five columns span2 alpha">&nbsp;</div>
                                <div class="five columns deadline featuretop">Deadline: <div class="deadline-date">
                                    {{ date('jS M Y',strtotime($c->deadline)) }}
                                </div>
                                </div>
                                <div class="five columns span2 omega content featuretop">
                                    <div class="contentpad">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($c->description ?? null), 327, $end='...') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="#prev" title="Previous Image" class="nav prev">&lt;</a>
                <a href="#next" title="Next Image" class="nav next">&gt;</a>
            </div>
        </div>

    </div>

</div>

<div class="competition-list-content">
  <div class="wrapper" id="course-html">
        @foreach ($competitions as $c)
        <div class="event-item">
          <div class="row">
            <div class="col-xs-12 col-sm-5">
              <a href="/competitions/{{ $c->slug ?? null }}/" class="comp-module no-0">
                <img src="{{ $c->image ?? null }}" alt="{{ $c->image ?? null }}" title="{{ $c->name ?? null }}" class="comp-image-mini">
              </a>
            </div>
            <div class="col-xs-12 col-sm-7 comp-module-details">
              <h3>
                <a href="/competitions/{{ $c->slug ?? null }}/">{{ $c->name ?? null }}</a>
              </h3>
              <div class="deadline">@if($c->status == 'review') closed @elseif($c->status == 'submission') Deadline: @endif  <div class="deadline-date">@if($c->status == 'winner' || $c->status == 'finished-winner') Winner(s) Announced @elseif($c->status == 'review') For Review @else {{ $c->deadline->format('j F, Y') ?? null }}@endif</div>
              </div>
              <div class="content">{{ \Illuminate\Support\Str::limit(strip_tags($c->description ?? null), 327, $end='...') }}</div>
              <div class="clear"></div>
              <div class="bottom-menu">
              @if($c->status == 'winner')
                <a href="/competitions/{{ $c->slug ?? null }}/" class="winner">View Winner(s) and shortlisted</a>
              @else
                <a href="/competitions/{{ $c->slug ?? null }}/">View Competition</a>
                <div class="share-main">Share</div>
              @endif
              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
        @endforeach
</div>
</div>
@php
    $current = $competitions->currentPage();
    $first = $current - 2;
    $first = $first > 0 ? $first : 1;
    $last = $first + 4;
    $last = $last > $competitions->lastPage() ? $competitions->lastPage() : $last;
@endphp
@if($competitions->lastPage() > 1)
<div class="banner mid competitions paging active" id="pagination-holder" style="display: block;">

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

<x-frontend.adverts />

</section>
