<section>

<form id="filter-form" class="filter filter--schools js-filter" action="https://www.artsthread.com/schools/" method="post" autocomplete="off" x-data="{filterOpen: false, activeNav: null}">
	<div class="filter__header filter__header--hide-lrg">
		<button class="filter__mobile js-toggle-filters" @click="filterOpen = true"><span>&lt;</span> Filter</button>
	</div>
	<div class="filter__items">
		<button class="filter__mobile-close js-toggle-filters" @click="filterOpen = false"><span>&lt;</span> Close</button>
		<div class="filter__items__flex filter__items__flex--with-title">
			<div class="filter__items__item">
				<h4 class="h4-no-filter">Filter</h4> </div>
			<div class="filter__items__item js-filter-accordion filter-accordion" :class="open ? 'is-showing' : ''" x-data="{open: false}">
				<h4 class="js-filter-accordion-btn " :class="open ? 'is-active' : ''" @click="open = !open">University/School <span>&gt;</span></h4>
				<div class="overflow-visible filter__items__item__level1 filter-accordion__inner">
					<div class="filter__container">
						<button class="filter-accordion__back js-filter-accordion-back" @click="open = false"><span>&lt;</span> Back</button>
						<div class="filter__form-wrap filter__form-wrap--with-search" x-show="open">
							<input class="filter__input js-search-suggestions" type="text" name="filter-school" data-action="school_search" data-search-type="school" value="" placeholder="Search University/School">
							<button class="filter__form-btn js-filter-submit" type="button">Filter results</button>
							<div class="filter__form-wrap__loading"></div>
						</div>
					</div>
				</div>
				<!-- End of filter__items__item -->
			</div>
			<div class="filter__items__item js-filter-accordion filter-accordion" :class="open ? 'is-showing' : ''" x-data="{open: false}">
				<h4 class="js-filter-accordion-btn " :class="open ? 'is-active' : ''" @click="open = !open">Location <span>&gt;</span></h4>
				<div class="overflow-visible filter__items__item__level1 filter-accordion__inner">
					<div class="filter__container">
						<button class="filter-accordion__back js-filter-accordion-back" @click="open = false"><span>&lt;</span> Back</button>
						<div class="filter__form-wrap filter__form-wrap--with-search"  x-show="open">
							<input class="filter__input js-search-suggestions" type="text" name="filter-input-keywords" data-action="location_search" data-search-type="school" value="" placeholder="Enter City Or Country">
							<button class="filter__form-btn js-filter-submit" type="button">Filter results</button>
							<div class="filter__form-wrap__loading"></div>
						</div>
					</div>
				</div>
				<!-- End of filter__items__item -->
			</div>
			<div class="filter__items__item js-filter-accordion filter-accordion" :class="open ? 'is-showing' : ''" x-data="{open: false}">
				<h4 class="js-filter-accordion-btn " :class="open ? 'is-active' : ''" @click="open = !open">Sector/Specialism <span>&gt;</span></h4>
				<div class="filter__items__item__level1 filter-accordion__inner">
					<div class="filter__container">
						<button class="filter-accordion__back js-filter-accordion-back" @click="open = false"><span>&lt;</span> Back</button>
						<!-- Inner accordion -->
            <div class="filter-sub-accordion">
                @foreach ($sectors as $sector)
                    <div class="filter-sub-accordion__item js-filter-accordion" :class="open ? 'is-showing' : ''" x-data="{open: false}">
                    <h4 class="js-filter-accordion-btn" :class="open ? 'is-active' : ''" @click="open = !open">{{ $sector->sector }}<span>&gt;</span></h4>
                    <div class="filter-sub-accordion__item__inner">


                        <div class="filter__checkboxes" id="filter-specialism-1">

                            <div class="filter__checkboxes__checkbox">
                                <label class="checkbox-custom checkbox-custom--checkbox">Select all
                                    <input type="checkbox" data-parent-filter="filter-specialism-1"
                                        class="js-filter-select-all">
                                    <div class="checkbox-custom__indicator"></div>
                                </label>
                            </div>

                            @foreach($sector->specialisms as $s)
                            <div class="filter__checkboxes__checkbox">
                                <label class="checkbox-custom checkbox-custom--checkbox">{{ $s->specialism }} <input
                                        type="checkbox" name="filter-specialism[]" wire:model="specialisms.{{$s->id}}">
                                    <div class="checkbox-custom__indicator"></div>
                                </label>
                            </div>

                        @endforeach

                        </div>

                    </div>

                </div>
                @endforeach

            </div> <!-- End of inner accordion -->
					</div>
				</div>
				<!-- End of filter__items__item -->
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
</form>

<div class="swiper school-slider groot" data-footer-slider>
  <div class="mini-nav schoolslider">
    <a href="#prev" class="left">&lt;</a>
    <a href="#next" class="right">&gt;</a>
  </div>
  <div class="swiper-wrapper">
    @foreach($featured as $s)
    <a class="item swiper-slide" href="/schools/{{ $s->slug }}/">
      <div class="details">
        <div class="image-container">
          <img src="{{ $s->image }}" alt="{{ $s->school ?? null }}" title="{{ $s->school ?? null }}">
        </div>
        <div class="content">
          <h4>Featured School</h4>
          <h3>{{ $s->school ?? null }}</h3>
          <div class="excerpt">
            {{ \Illuminate\Support\Str::limit(strip_tags($s->description ?? null), 230, $end='...') }}
          </div>
          <div class="profile">
            Read <span class="bgblack">Full</span> Profile&nbsp;&nbsp;<span class="downarrow">&gt;</span>
          </div>
        </div>
        <div class="mobile-clear"></div>
      </div>
      <div class="image-holder">
        <img src="{{ $s->slider }}">
      </div>
    </a>
    @endforeach
  </div>
</div>

<div class="courses-content nopad featured">		<!-- Courses Display //-->

		<div class="container column" id="course-html">
            @foreach ($courses as $c)
            <a href="/schools/{{ $c->school->slug ?? null }}/" class="course-module no-1">
                <img
                    src="{{ $c->image_medium ?? null }}"
                    alt="{{ $c->school->school ?? null }}"
                    title="{{ $c->school->school ?? null }}"
                    class="course-image-mini"
                />
                <div class="course-info">
                    <p class="course-name">{{ $c->name }}</p>
                    <p class="course-school">{{ $c->school->school ?? null }}</p>
                </div>
            </a>
            @endforeach
        </div>
        <div class="clear"></div>


		<!-- Courses Display //-->


	<!-- Pagination //-->

	@php
        $current = $courses->currentPage();
        $first = $current - 2;
        $first = $first > 0 ? $first : 1;
        $last = $first + 4;
        $last = $last > $courses->lastPage() ? $courses->lastPage() : $last;
    @endphp
    @if($courses->lastPage() > 1)
    <div class="banner mid schools paging active" id="pagination-holder" style="display: block;">

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

	<!-- Pagination //-->

</div>

<x-frontend.adverts />

</section>
