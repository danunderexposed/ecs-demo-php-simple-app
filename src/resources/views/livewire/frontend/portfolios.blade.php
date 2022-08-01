<section>
    <div id="filter-form" class="filter" :class="filterOpen ? 'showing-filters' : ''" x-data="{filterOpen: false, activeNav: null}">

        <div class="filter__header">
            <button class="filter__mobile js-toggle-filters" @click="filterOpen = true"><span>&lt;</span> Filter</button>

            <div class="filter__by">
                <div class="filter__container">
                    <div class="filter__by__flex">
                        <h5>Filter by:</h5>
                        <div class="filter__by__items">
                            <button type="button" @if($filterBy == 'projects')class="is-selected"@endif data-filterby="projects" wire:click="setType('projects')">Projects</button>
                            <button type="button" @if($filterBy == 'profiles')class="is-selected"@endif data-filterby="students" wire:click="setType('profiles')">Profiles</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="filterby" id="filterby" value="projects">
            </div>
            <!-- End of filter__header -->
        </div>


        <div class="filter__items">

            <button class="filter__mobile-close js-toggle-filters" @click="filterOpen = false"><span>&lt;</span> Close</button>

            <div class="filter__items__flex">

                <div class="filter__items__item js-filter-accordion filter-accordion" :class="open && activeNav == 1 ? 'is-showing' : ''" x-data="{open: false}">
                    <h4 class="js-filter-accordion-btn" :class="activeNav == 1 && open ? 'is-active' : ''" @click="open = !open; activeNav = 1">Name <span>&gt;</span></h4>

                    <div class="filter__items__item__level1 filter-accordion__inner">
                        <div class="filter__container">
                            <button class="filter-accordion__back js-filter-accordion-back" @click="open = false"><span>&lt;</span>
                                Back</button>

                            <div class="filter__form-wrap">
                                <input class="filter__input" type="text" name="filter-input-keywords" value=""
                                    placeholder="Search By Artist Name" wire:model.lazy="name">
                                <button class="filter__form-btn js-filter-submit" type="button">Filter results</button>
                            </div>

                        </div>
                    </div>
                    <!-- End of filter__items__item -->
                </div>

                <div class="filter__items__item js-filter-accordion filter-accordion" :class="open && activeNav == 2 ? 'is-showing' : ''" x-data="{open: false}">
                    <h4 class="js-filter-accordion-btn" :class="open && activeNav == 2 ? 'is-active' : ''" @click="open = !open; activeNav = 2">Sector/Specialism <span>&gt;</span></h4>
                    <div class="filter__items__item__level1 filter-accordion__inner">
                        <div class="filter__container">
                            <button class="filter-accordion__back js-filter-accordion-back" @click="open = false"><span>&lt;</span>
                                Back</button>
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

                <div class="filter__items__item js-filter-accordion filter-accordion" :class="open && activeNav == 3 ? 'is-showing' : ''" x-data="{open: false}">
                    <h4 class="js-filter-accordion-btn" :class="open && activeNav == 3 ? 'is-active' : ''" @click="open = !open; activeNav = 3">Graduation year <span>&gt;</span></h4>
                    <div class="filter__items__item__level1 filter-accordion__inner">
                        <div class="filter__container">
                            <button class="filter-accordion__back js-filter-accordion-back" @click="open = false"><span>&lt;</span>
                                Back</button>
                            <!-- Inner accordion -->
                            <h5>Please select a Graduation year</h5>
                            <div class="filter__checkboxes" id="filter-graduation-year">
                                <div class="filter__checkboxes__checkbox">
                                    <label class="checkbox-custom checkbox-custom--checkbox">Select all
                                        <input type="checkbox" data-parent-filter="filter-graduation-year"
                                            class="js-filter-select-all" wire:model="gradYearsAll">
                                        <div class="checkbox-custom__indicator"></div>
                                    </label>
                                </div>

                                <div class="filter__checkboxes__checkbox">
                                    <label class="checkbox-custom checkbox-custom--checkbox">2025 <input type="checkbox"
                                            name="filter-graduation-year[]" wire:model="gradYears.2025">
                                        <div class="checkbox-custom__indicator"></div>
                                    </label>
                                </div>
                                <div class="filter__checkboxes__checkbox">
                                    <label class="checkbox-custom checkbox-custom--checkbox">2024 <input type="checkbox"
                                            name="filter-graduation-year[]" wire:model="gradYears.2024">
                                        <div class="checkbox-custom__indicator"></div>
                                    </label>
                                </div>
                                <div class="filter__checkboxes__checkbox">
                                    <label class="checkbox-custom checkbox-custom--checkbox">2023 <input type="checkbox"
                                            name="filter-graduation-year[]" wire:model="gradYears.2023">
                                        <div class="checkbox-custom__indicator"></div>
                                    </label>
                                </div>
                                <div class="filter__checkboxes__checkbox">
                                    <label class="checkbox-custom checkbox-custom--checkbox">2022 <input type="checkbox"
                                            name="filter-graduation-year[]" wire:model="gradYears.2022">
                                        <div class="checkbox-custom__indicator"></div>
                                    </label>
                                </div>
                                <div class="filter__checkboxes__checkbox">
                                    <label class="checkbox-custom checkbox-custom--checkbox">2021 <input type="checkbox"
                                            name="filter-graduation-year[]" wire:model="gradYears.2021">
                                        <div class="checkbox-custom__indicator"></div>
                                    </label>
                                </div>
                                <div class="filter__checkboxes__checkbox">
                                    <label class="checkbox-custom checkbox-custom--checkbox">2020 <input type="checkbox"
                                            name="filter-graduation-year[]" wire:model="gradYears.2020">
                                        <div class="checkbox-custom__indicator"></div>
                                    </label>
                                </div>
                                <div class="filter__checkboxes__checkbox">
                                    <label class="checkbox-custom checkbox-custom--checkbox">2019 <input type="checkbox"
                                            name="filter-graduation-year[]" wire:model="gradYears.2019">
                                        <div class="checkbox-custom__indicator"></div>
                                    </label>
                                </div>
                            </div> <!-- End of inner accordion -->
                        </div>
                    </div>
                    <!-- End of filter__items__item -->
                </div>


                <div class="filter__items__item js-filter-accordion filter-accordion" :class="open && activeNav == 4 ? 'is-showing' : ''" x-data="{open: false}">
                    <h4 class="js-filter-accordion-btn" :class="open && activeNav == 4 ? 'is-active' : ''" @click="open = !open; activeNav = 4">University/School <span>&gt;</span></h4>

                    <div class="overflow-visible filter__items__item__level1 filter-accordion__inner">
                        <div class="filter__container">
                            <button class="filter-accordion__back js-filter-accordion-back" @click="open = false"><span>&lt;</span>
                                Back</button>
                            <div class="filter__form-wrap filter__form-wrap--with-search ">
                                <input class="filter__input js-search-suggestions" type="text" name="filter-school"
                                    data-action="school_search" data-search-type="portfolio" value=""
                                    placeholder="Search University/School"
                                    wire:model.lazy="school">
                                <button class="filter__form-btn js-filter-submit" type="button">Filter results</button>
                                <div class="filter__form-wrap__loading"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End of filter__items__item -->
                </div>

                <div class="filter__items__item js-filter-accordion filter-accordion" :class="open && activeNav == 5 ? 'is-showing' : ''" x-data="{open: false}">
                    <h4 class="js-filter-accordion-btn" :class="open && activeNav == 5 ? 'is-active' : ''" @click="open = !open; activeNav = 5">My Location <span>&gt;</span></h4>

                    <div class="overflow-visible filter__items__item__level1 filter-accordion__inner">
                        <div class="filter__container">
                            <button class="filter-accordion__back js-filter-accordion-back" @click="open = false"><span>&lt;</span>
                                Back</button>

                            <div class="filter__form-wrap filter__form-wrap--with-search">
                                <input class="filter__input js-search-suggestions" type="text"
                                    placeholder="Search Location" name="filter-location-keywords"
                                    data-action="location_search" data-search-type="portfolio" wire:model.lazy="location">
                                <button type="button" class="filter__form-btn js-filter-submit">Filter results</button>
                                <div class="filter__form-wrap__loading"></div>
                            </div>

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
                <button class="js-clear-filters" type="button"><span class="close-icon"></span><span
                        class="clear-text">Clear filters</span></button>
            </div>
        </div>

        <!-- End of filter -->
    </div>


    <div class="portfolio-content">
        <div id="course-html">
            @if($filterBy == 'projects')
            <div id="portfolio-content">
                <div class="wrapper">
                    <div class="row">
                        @foreach ($entries as $e)
                        <a href="/portfolios/{{ $e->slug ?? null }}/" class="portfolio col-xs-12 col-ss-6 col-md-4">
                            <div class="portfolio-image-wrap">
                                <div class="hover">
                                    <div class="icon"></div>
                                </div>
                                <img class="portfolio-image" src="{{ $e->cover_medium ?? null }}" alt="{{ $e->title ?? null }}" title="{{ $e->title ?? null }}">
                            </div>
                            <div class="maintitle">
                                <h4 class="name">{{ $e->title ?? null }}</h4>
                                <h5 class="course">{{ $e->firstname ?? null }} {{ $e->surname ?? null }}</h5>
                            </div>
                            <div class="portfolio-meta">
                                <div class="header  box-content">
                                <div>
                                    <small>
                                    <strong>@if(is_numeric($e->school))
                                            {{ App\Models\School::find($e->school)->school }}
                                        @else
                                            {{ $e->school }}
                                        @endif</strong>
                                    </small>
                                </div>
                                <small>Specialism:</small>
                                <small>
                                    <span class="specialism-click" data-specialism="{{ Helper::specialism($e->specialism3) }}">
                                        {{ Helper::specialism($e->specialism) }}
                                    </span>
                                    &nbsp;
                                    <span class="specialism-click" data-specialism="{{ Helper::specialism($e->specialism3) }}">
                                        {{ Helper::specialism($e->specialism2) }}
                                    </span>
                                    &nbsp;
                                    <span class="specialism-click" data-specialism="{{ Helper::specialism($e->specialism3) }}">
                                        {{ Helper::specialism($e->specialism3) }}
                                    </span>
                                </small>
                                </div>
                                <div class="header location">
                                <small>Graduated: {{ $e->gradyear ?? null }}
                                <br>My location: @if(is_numeric($e->city))
                                    {{ App\Models\City::find($e->city)->name }},
                                @else
                                    {{ $e->city }},
                                @endif
                                @if(is_numeric($e->country))
                                    {{ App\Models\Country::find($e->country)->name }}
                                @else
                                    {{ $e->country }}
                                @endif</small>
                                </div>
                                <div class="project-stats">
                                    <p class="views">
                                        <span class="bgblack" id="viewcount">{{ $e->views ?? null }}</span>
                                    </p>
                                    <p class="appreciations">
                                        <span class="bgblack" id="likecount">{{ $e->likes ?? null }}</span>
                                    </p>
                                    <p class="comments">
                                        <span class="bgblack" id="commentcount">{{ $e->comments ?? null }}</span>
                                    </p>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            </a>
                            @endforeach
                    </div>
                </div>
            </div>
            @elseif($filterBy == 'profiles')
            @foreach ($entries as $i => $e)
            @php
            $e->projects = App\Models\Project::where('user_id', $e->id)->get();
            $e->projects->counts = $this->getProjectCounts($e->projects);
            @endphp
            <div class="studentrow {{ ($loop->iteration == 1) ? 'first' : '' }}{{ ($loop->iteration % 2 == 0) ? 'alternate' : '' }}">
                <div class="container">
                    @if(count($e->projects) > 2)
                    <div class="mini-nav" style="margin-top: 0px;">
                        <a class="left">&lt;</a>
                        <a class="right">&gt;</a>
                    </div>
                    @endif
                    <a href="/profile/{{ $e->slug ?? null }}/" title="{{ $e->firstname ?? null }} {{ $e->surname ?? null }} Arts Thread Profile">
                        <div class="five columns alpha profile-img-container">
                            <img src="{{ $e->profile_image_small ?? null }}" class="profile-mini-image" alt="{{ $e->firstname ?? null }} {{ $e->surname ?? null }}" title="{{ $e->firstname ?? null }} {{ $e->surname ?? null }}">
                        </div>
                        <div class="five columns span2">
                            <div class="padder">
                                <h4 class="name">{{ $e->firstname ?? null }} {{ $e->surname ?? null }}</h4>
                                <h5 class="course">{{ App\Models\Course::find($e->course)->name ?? null }} <br>{{ App\Models\School::find($e->school)->school ?? null }} </h5>
                                <div class="header box-content">
                                    <small>Specialisms:</small>
                                    <small>
                                        <span class="specialism-click" data-specialism="{{ Helper::specialism($e->specialism3) }}">
                                            {{ Helper::specialism($e->specialism) }}
                                        </span>
                                        &nbsp;
                                        <span class="specialism-click" data-specialism="{{ Helper::specialism($e->specialism3) }}">
                                            {{ Helper::specialism($e->specialism2) }}
                                        </span>
                                        &nbsp;
                                        <span class="specialism-click" data-specialism="{{ Helper::specialism($e->specialism3) }}">
                                            {{ Helper::specialism($e->specialism3) }}
                                        </span>
                                    </small>
                                </div>
                                <div class="header location">
                                    <small>Graduated: {{ $e->gradyear ?? null }}
                                    <br>My location: @if(is_numeric($e->city))
                                            {{ App\Models\City::find($e->city)->name }},
                                        @else
                                            {{ $e->city }},
                                        @endif
                                        @if(is_numeric($e->country))
                                            {{ App\Models\Country::find($e->country)->name }}
                                        @else
                                            {{ $e->country }}
                                        @endif</small>
                                </div>
                                <div class="project-stats">
                                    <p class="views">
                                        <span class="bgblack" id="viewcount">{{ $e->projects->counts['view'] ?? null }}</span>
                                    </p>
                                    <p class="appreciations">
                                        <span class="bgblack" id="likecount">{{ $e->projects->counts['like'] ?? null }}</span>
                                    </p>
                                    <p class="comments">
                                        <span class="bgblack" id="commentcount">{{ $e->projects->counts['comment'] ?? null }}</span>
                                    </p>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @if(count($e->projects) > 0)
                    <div class="five columns span2 omega projectcontainer hide-sml swiper" data-portfolio-slider>
                        <div class="projects swiper-wrapper">
                            @foreach($e->projects as $project)
                            <a href="/portfolios/{{ $project->slug }}/" class="five columns alpha omega project swiper-slide" title="{{ $project->title }}">	
                                <div class="hover" style="display: none;">
                                    <div class="icon"></div>
                                </div>
                                <img src="{{ $project->cover_small }}" class="profile-mini-image" alt="{{ $project->title }}" title="{{ $project->title }}s">	
                                <h5 class="project-title">{{ $project->title }}</h5>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

    @php
        $current = $entries->currentPage();
        $first = $current - 2;
        $first = $first > 0 ? $first : 1;
        $last = $first + 4;
        $last = $last > $entries->lastPage() ? $entries->lastPage() : $last;
    @endphp
    @if($entries->lastPage() > 1)
    <div class="banner mid portfolios paging active" id="pagination-holder" style="display: block;">

		<div class="toprow">

			<div class="container" id="course-pagination">
            <div id="pagination">

                @foreach(range($first, $last) as $i)
                    <button class="button pagination{{ ($i == $current) ? ' active' : '' }}" wire:click="gotoPage({{$i}})"><span>{{ $i }}</span></button>
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
