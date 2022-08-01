<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('dashboard') }}" class="block p-1 ">
                        <svg width="110.151" height="48" xmlns="http://www.w3.org/2000/svg"><g fill="#000" fill-rule="evenodd"><path d="M19.644 11.659a5.484 5.484 0 100-10.968 5.484 5.484 0 000 10.968M19.425 14.2l-5.702 10.226h11.405L19.425 14.2M9.076 14.165H3.273l-2.901 5.15 2.901 5.152h5.803l2.901-5.151-2.901-5.151M6.175 0L0 6.174l6.175 6.175 6.174-6.175L6.175 0M95.388 16.866l-2.908 4.792c2.544 2.412 5.056 3.47 8.393 3.47 5.551 0 9.054-3.404 9.054-8.328 0-4.361-2.313-5.914-6.51-7.038-2.148-.562-3.767-.925-3.767-2.61 0-1.124 1.025-1.983 2.61-1.983 1.455 0 3.04.628 4.528 1.883l2.015-4.626c-2.048-1.42-4.361-2.114-7.005-2.114-4.956 0-8.162 3.271-8.162 7.666 0 3.7 2.082 5.419 6.345 6.542 2.676.694 3.965 1.256 3.965 3.14 0 1.387-1.157 2.445-2.94 2.445-1.885 0-3.735-1.09-5.618-3.239zM79.46 24.5h6.444V6.458h5.287V.873H74.207v5.585h5.254zm-24.583 0h6.046v-9.252l5.42 9.252h7.269l-6.443-9.516c3.436-.727 5.286-3.073 5.286-6.741 0-2.445-.925-4.46-2.643-5.782C67.797.906 65.286.873 62.015.873h-7.137zm6.046-12.457V5.83h1.29c2.675 0 3.898.793 3.898 3.271 0 2.082-1.288 2.941-3.998 2.941zm-23.658 3.635l2.38-7.799c.098-.363.396-1.42.825-3.172.43 1.752.694 2.81.793 3.172l2.412 7.799zm-9.02 8.822h6.41l1.222-4.23h9.153l1.19 4.23h6.41L44.47.873h-8.063zM92.274 48h5.524c3.303 0 6.052-.111 8.522-1.86 2.499-1.776 3.831-4.525 3.831-8.05 0-3.553-1.332-6.302-3.83-8.05-2.61-1.833-5.58-1.888-9.272-1.888h-4.775zm5.358-4.442V32.593h.916c4.08 0 6.107 1.555 6.107 5.497 0 3.886-1.971 5.468-6.107 5.468zm-20.43-2.97l1.998-6.55c.083-.306.333-1.195.694-2.666.36 1.471.583 2.36.666 2.665l2.026 6.551zM69.621 48h5.386l1.027-3.553h7.69L84.723 48h5.385l-6.856-19.848h-6.774zM55.66 48H67.82v-4.442h-6.884V40.2h6.495v-4.248h-6.495V32.51h6.884v-4.358H55.66zm-17.793 0h5.08v-7.773L47.499 48h6.108l-5.414-7.995c2.887-.61 4.442-2.581 4.442-5.663 0-2.054-.777-3.747-2.22-4.857-1.694-1.305-3.804-1.333-6.552-1.333h-5.996zm5.08-10.465v-5.219h1.082c2.249 0 3.276.666 3.276 2.748 0 1.749-1.083 2.47-3.359 2.47zM16.992 48h5.414v-8.078h7.217V48h5.413V28.152h-5.413v7.717h-7.217v-7.717h-5.414zM4.501 48h5.413V32.843h4.441v-4.69H.087v4.69h4.414z"/></g></svg>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>

                    <div class="inline-flex items-center">
                        <x-jet-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                        Homepage
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <x-jet-dropdown-link href="{{ route('homepage.hero-list') }}" :active="request()->routeIs('homepage.hero-list')">
                                    {{ __('Homepage Hero') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('homepage.grid') }}" :active="request()->routeIs('homepage.grid')">
                                    {{ __('Homepage Grid') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('homepage.module', ['id' => 'new']) }}" :active="request()->routeIs('homepage.module')">
                                    {{ __('Create Module') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('homepage.module-list') }}" :active="request()->routeIs('homepage.module-list')">
                                    {{ __('Edit Modules') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('homepage.sponsor', ['id' => 'new']) }}" :active="request()->routeIs('homepage.sponsor')">
                                    {{ __('Add Sponsor') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('homepage.sponsor-list') }}" :active="request()->routeIs('homepage.sponsor-list')">
                                    {{ __('Edit Sponsors') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('homepage.featured-projects') }}" :active="request()->routeIs('homepage.featured-projects')">
                                    {{ __('Featured Projects') }}
                                </x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                        <x-jet-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                        Locations
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <x-jet-dropdown-link href="{{ route('countries') }}" :active="request()->routeIs('countries')">
                                    {{ __('Countries') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('cities') }}" :active="request()->routeIs('cities')">
                                    {{ __('Cities') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('schools.index') }}" :active="request()->routeIs('schools.index')">
                                    {{ __('Schools') }}
                                </x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                        <x-jet-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                        Courses
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <x-jet-dropdown-link href="{{ route('sectors') }}" :active="request()->routeIs('sectors')">
                                    {{ __('Sectors') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('courses.list') }}" :active="request()->routeIs('courses.list')">
                                    {{ __('Courses') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('study-levels') }}" :active="request()->routeIs('study-levels')">
                                    {{ __('Study Levels') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('specialisms') }}" :active="request()->routeIs('specialisms')">
                                    {{ __('Specialisms') }}
                                </x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                        <x-jet-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                        Competitions
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <x-jet-dropdown-link href="{{ route('competition-list') }}" :active="request()->routeIs('competition-list')">
                                    {{ __('Competitions') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('competition-categories') }}" :active="request()->routeIs('competition-categories')">
                                    {{ __('Competition Categories') }}
                                </x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                        <x-jet-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                        Users
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <x-jet-dropdown-link href="{{ route('projects.list') }}" :active="request()->routeIs('projects.list')">
                                    {{ __('Projects') }}
                                </x-jet-dropdown-link>

                            </x-slot>
                        </x-jet-dropdown>
                        <x-jet-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                        Misc
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <x-jet-dropdown-link href="{{ route('featured-projects') }}" :active="request()->routeIs('featured-projects')">
                                    {{ __('Featured Projects') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('featured-profiles') }}" :active="request()->routeIs('featured-profiles')">
                                    {{ __('Featured Profiles') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('events-list') }}" :active="request()->routeIs('events-list')">
                                    {{ __('Events') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('event-approval') }}" :active="request()->routeIs('event-approval')">
                                    {{ __('Event Approval') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('adverts-list') }}" :active="request()->routeIs('adverts-list')">
                                    {{ __('Adverts') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('message-list') }}" :active="request()->routeIs('message-list')">
                                    {{ __('Messages') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('pages-list') }}" :active="request()->routeIs('pages-list')">
                                    {{ __('Pages') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('blog-list') }}" :active="request()->routeIs('blog-list')">
                                    {{ __('Blog') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('apps.list') }}" :active="request()->routeIs('apps.list')">
                                    {{ __('Apps') }}
                                </x-jet-dropdown-link>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <!-- Settings Dropdown -->
                <div class="relative ml-3">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                    <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('countries') }}" :active="request()->routeIs('countries')">
                {{ __('Countries') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('schools.index') }}" :active="request()->routeIs('schools.index')">
                {{ __('Schools') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="object-cover w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>
</nav>
