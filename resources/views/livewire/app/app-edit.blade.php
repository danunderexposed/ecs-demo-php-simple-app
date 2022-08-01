<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
        @if ($appId != 'new')
            {{ __('Edit App') }}
        @else
            {{ __('Add App') }}
        @endif
    </x-page-header>

    <div class="max-w-5xl mx-auto mt-8">

        <form wire:submit.prevent="store">

            <div x-data="{ openTab: 1 }" class="relative bg-white shadow">
                <ul class="flex border-b">
                    <li @click="openTab = 1" :class="openTab == 1 ? 'border-indigo-400 border-b' : ' border-transparent'">
                        <a class="inline-flex items-center justify-center px-8 py-4 text-sm font-medium text-gray-600 transition" href="#">Setup Details</a>
                    </li>
                    <li @click="openTab = 2" :class="openTab == 2 ? 'border-indigo-400 border-b' : ' border-transparent'">
                        <a class="inline-flex items-center justify-center px-8 py-4 text-sm font-medium text-gray-600 transition" href="#">Introduction texts</a>
                    </li>
                    <li @click="openTab = 3" :class="openTab == 3 ? 'border-indigo-400 border-b' : ' border-transparent'">
                        <a class="inline-flex items-center justify-center px-8 py-4 text-sm font-medium text-gray-600 transition" href="#">Content modules</a>
                    </li>
                    <li @click="openTab = 4" :class="openTab == 4 ? 'border-indigo-400 border-b' : ' border-transparent'">
                        <a class="inline-flex items-center justify-center px-8 py-4 text-sm font-medium text-gray-600 transition" href="#">Styling</a>
                    </li>
                    <li @click="openTab = 5" :class="openTab == 5 ? 'border-indigo-400 border-b' : ' border-transparent'">
                        <a class="inline-flex items-center justify-center px-8 py-4 text-sm font-medium text-gray-600 transition" href="#">Analytics</a>
                    </li>
                </ul>
                <div class="w-full pt-4">
                    <!-- setup details tab -->
                    <div class="p-4" x-show="openTab === 1">
                        <div class="p-4">
                            <x-input wire:model.defer="app.title" label="App Name / Title" />
                        </div>
                        <div class="p-4">
                            <x-input wire:model.defer="app.app_id" label="App ID" />
                        </div>
                        <div class="p-4">
                            <x-select label="App type" placeholder="Select App type" wire:model.lazy="app.app_type" :searchable="false">
                                <x-select.option label="Event" value="event" />
                                <x-select.option label="School" value="school" />
                                <x-select.option label="Competition" value="competition" />
                            </x-select>
                        </div>
                        @if ($app->app_type == 'event')
                            <div class="p-4">
                                <x-input wire:model.defer="app.event_id" label="Event ID" />
                            </div>
                        @endif
                        @if ($app->app_type == 'school')
                            <div class="p-4">
                                <x-input wire:model.defer="app.school_id" label="School ID" />
                            </div>
                            <div class="p-4">
                                <x-input wire:model.defer="app.courses_exclude" label="Courses to exclude" />
                                <small class="text-gray-500">Comma separated list of Course IDs you don't want visible in the school app.</small>
                            </div>
                        @endif
                        @if ($app->app_type == 'competition')
                            <div class="p-4">
                                <x-input wire:model.defer="app.competition_id" label="Competition ID" />
                            </div>
                            <div class="p-4">
                                <x-toggle wire:model.defer="app.allow_voting" left-label="Allow voting"/>
                            </div>
                        @endif

                        <div class="p-4">
                            <x-toggle wire:model.defer="app.hide_projects" left-label="Hide projects"/>
                            <small class="text-gray-500">Hides all profiles on the app if ticked.</small>
                        </div>
                        <div class="p-4">
                            <x-toggle wire:model.defer="app.show_course_index" left-label="Show course index"/>
                            <small class="text-gray-500">If checked the first page of the app will be a listing of the courses related to the school or event.</small>
                        </div>
                        <div class="p-4">
                            <x-input wire:model.defer="app.graduation_year" label="Graduation year" />
                        </div>
                        <div class="p-4">
                            <x-toggle wire:model.defer="app.enable_year_filter" left-label="Enable Filter By Year"/>
                        </div>
                        <div class="p-4">
                            <x-input wire:model.defer="app.projects_per_page" label="Projects per page" />
                        </div>
                        <div class="p-4">
                            <x-toggle wire:model.lazy="app.override_filters" left-label="Override filters"/>
                            <small class="text-gray-500">If checked the filters for specialisms can be set manually by including a title for the filter drop down and a comma separated list of IDs for the sectors.</small>
                        </div>
                        @if ($app->override_filters)
                            <div class="p-4">
                                <x-label for="">Filters override</x-label>
                                @if ($filterOverride)
                                <x-table cols="" class="mt-5">
                                    <x-slot name="head">
                                        <x-table.heading >Sector title</x-table.heading>
                                        <x-table.heading >Sector ID</x-table.heading>
                                        <x-table.heading >Override Specialisms</x-table.heading>
                                        <x-table.heading >Actions</x-table.heading>
                                    </x-slot>
                                    <x-slot name="body">
                                        @foreach ($filterOverride as $index => $filter_sector)
                                            <x-table.row wire:loading.class.delay="opacity-75 w-full" class="{{ $loop->odd ?: 'bg-gray-50' }}">
                                                <x-table.cell>
                                                    <x-input wire:model.lazy="filterOverride.{{ $index }}.sector_title" />
                                                </x-table.cell>
                                                <x-table.cell>
                                                    <x-input wire:model.lazy="filterOverride.{{ $index }}.sector_id" />
                                                </x-table.cell>
                                                <x-table.cell>
                                                    <x-table cols="" class="mt-5">
                                                        <x-slot name="head">
                                                            <x-table.heading >Sector title</x-table.heading>
                                                            <x-table.heading >Sector ID</x-table.heading>
                                                            <x-table.heading ></x-table.heading>
                                                        </x-slot>
                                                        <x-slot name="body">
                                                        @foreach ($filter_sector['specialisms'] as $sIndex => $specialism)

                                                            <x-table.row wire:loading.class.delay="opacity-75 w-full" class="{{ $loop->odd ?: 'bg-gray-50' }}">
                                                                <x-table.cell>
                                                                    <x-input wire:model.lazy="filterOverride.{{ $index }}.specialisms.{{ $sIndex }}.specialism_id" />
                                                                </x-table.cell>
                                                                <x-table.cell>
                                                                    <x-input wire:model.lazy="filterOverride.{{ $index }}.specialisms.{{ $sIndex }}.specialism_name" />
                                                                </x-table.cell>
                                                                <x-table.cell class="w-8">
                                                                    <x-button sm negative icon="x" wire:click="removeOverrideFilterSpecialism({{ $index }}, {{ $sIndex }})" />
                                                                </x-table.cell>
                                                            </x-table.row>
                                                        @endforeach
                                                        </x-slot>
                                                    </x-table>
                                                </x-table.cell>
                                                <x-table.cell class="w-16">
                                                    <x-button class="mb-5 " positive wire:click="addOverrideFilterSpecialism({{ $index }})">Add</x-button>
                                                    <x-button sm negative icon="x" wire:click="removeOverrideFilterSector({{ $index }})" />
                                                </x-table.cell>
                                            </x-table.row>
                                        @endforeach
                                    </x-slot>
                                </x-table>
                                @endif
                                <x-button class="mt-5 " positive wire:click="addOverrideFilterSector()">Add</x-button>

                            </div>
                        @else
                            <div class="p-4">
                                <x-label class="mb-5" for="">Filter sector(s)</x-label>

                                @if ($filterSectors)
                                @foreach ($filterSectors as $index => $filter_sector)
                                    <div class="flex items-center mb-3">
                                        <div class="flex-1">
                                            <x-select placeholder="Select Sector" wire:model.lazy="filterSectors.{{ $index }}" :searchable="false">
                                                @foreach ($all_sectors as $s)
                                                    <x-select.option label="{{ $s->sector }}" value="{{ $s->id }}" />
                                                @endforeach
                                            </x-select>
                                        </div>
                                        <div class="pl-5">
                                            <x-button sm negative icon="x" wire:click="removeFilterSector({{ $index }})" />
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                                <x-button class="mt-5 " positive wire:click="addFilterSector()">Add</x-button>

                            </div>
                        @endif

                    </div>
                    <!-- introduction texts -->
                    <div class="p-4" x-show="openTab === 2">
                        <div class="p-4">
                            <x-input wire:model.defer="app.index_title" label="Index title" />
                        </div>
                        <div class="p-4">
                            <x-textarea wire:model.defer="app.index_text" label="Index text" />
                        </div>
                        <div class="p-4">
                            <x-input wire:model.defer="app.listings_title" label="Listings title" />
                        </div>
                        <div class="p-4">
                            <x-textarea wire:model.defer="app.listings_text" label="Listings text" />
                        </div>
                    </div>
                    <!-- content modules -->
                    <div class="p-4" x-show="openTab === 3">
                        <x-select placeholder="Content Modules" wire:model.lazy="addContentModule" :searchable="false">
                            @foreach ($contentModulesList as $module)
                                <x-select.option label="{{ $module['name'] }}" value="{{ $module['slug'] }}" :searchable="false" />
                            @endforeach
                        </x-select>
                        <x-button class="mt-5 " positive wire:click="addContentModule()">Add Module</x-button>

                        @if (count($contentModules) > 0)
                            <div wire:sortable="updateContentModulesOrder">
                            @foreach ($contentModules as $module)
                                <div class="" wire:sortable.item="{{ $module['key'] }}" wire:key="{{ $module['key'] }}" id="module-{{ $module['key'] }}">
                                    @livewire('app.content-module',
                                        [
                                            'type' => $module['type'],
                                            'index' => $module['key'],
                                            'values' => isset($module['values']) ? $module['values'] : []
                                        ]
                                        , key($module['key']))
                                </div>

                            @endforeach
                            </div>
                        @else
                            <p class="text-center text-gray-700">Click the "Add Module" button below to start creating your layout</p>
                        @endif
                    </div>
                    <!-- styling -->
                    <div class="p-4" x-show="openTab === 4">
                        <div class="p-4">
                            <x-toggle wire:model.defer="app.capitalise_buttons" left-label="Capitalise buttons"/>
                            <small class="text-gray-500">If checked all buttons in the app will appear capitalised.</small>
                        </div>
                        <div class="p-4">
                            <x-input wire:model.defer="app.padding_left" label="Padding left" />
                        </div>
                        <div class="p-4">
                            <x-input wire:model.defer="app.padding_right" label="Padding right" />
                        </div>
                        <div class="p-4">
                            <x-input wire:model.defer="app.padding_top" label="Padding top" />
                        </div>
                        <div class="p-4">
                            <x-input wire:model.defer="app.padding_bottom" label="Padding bottom" />
                        </div>
                    </div>
                    <!-- analytics -->
                    <div class="p-4" x-show="openTab === 5">
                        <div class="p-4">
                            <x-input wire:model.defer="app.google_analytics" label="Google analytics ID" />
                        </div>
                        <div class="p-4">
                            <x-toggle wire:model.defer="app.google_analytics_global" left-label="Google Analytics from global"/>
                        </div>
                    </div>
                </div>
            </div>



            <div class="flex justify-end py-4">
                <x-button primary label="Save app" type="submit" ></x-button>
            </div>

        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
</div>
