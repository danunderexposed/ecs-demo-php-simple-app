
<div>
    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
            {{ __('Schools') }}
    </x-page-header>

    <div class="flex flex-wrap px-4 pt-6 mx-auto max-w-7xl search xl:px-0">
        <div class="w-full md:w-1/4">
            <x-input wire:model.debounce="search" icon="search" label="" placeholder="Search..." />
        </div>
        <div class="w-full mt-4 text-right md:w-3/4 md:mt-0">
            <x-button positive md wire:click="add()" label="Add" icon="plus" class="float-right " />
        </div>
    </div>
    <div class="py-6 ">
        <div class="px-4 mx-auto max-w-7xl xl:px-0">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <x-table cols="">
                    <x-slot name="head">
                        <x-table.heading sortable wire:click="sortBy('schools.school')" :direction="$sortDirection" sortBy="schools.school" :currentSortBy="$sortBy">Name</x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('cities.name')" :direction="$sortDirection" sortBy="cities.name" :currentSortBy="$sortBy">City</x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('countries.name')" :direction="$sortDirection" sortBy="countries.name" :currentSortBy="$sortBy">Country</x-table.heading>
                        <x-table.heading class="w-40">Actions</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @forelse($schools as $school)
                            <x-table.row wire:loading.class.delay="opacity-75" class="{{ $loop->odd ?: 'bg-gray-50' }}">
                                <x-table.cell>
                                    {{ $school->school }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $school->city->name }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $school->country->name }}
                                </x-table.cell>
                                <x-table.cell class="w-40">
                                    <div class="flex space-x-2"">
                                        <x-button wire:click="edit({{ $school->id }})" primary label="Edit" icon="pencil" />
                                        <x-button
                                            wire:click="delete({{ $school->id }})"
                                            label="Delete"
                                            icon="trash"
                                            />
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row wire:loading.class.delay="opacity-75" class="">
                                <x-table.cell class="py-8 text-center" colspan="4">
                                    {{ __('No schools found')}}
                                </x-table.cell>
                            </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
    <div class="pb-6 ">
        <div class="px-4 mx-auto max-w-7xl xl:px-0">
            {{ $schools->links() }}
        </div>
    </div>

</div>
