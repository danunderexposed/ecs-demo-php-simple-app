
<div>
    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
            {{ __('Cities') }}
    </x-page-header>

    <div class="flex flex-wrap px-4 pt-6 mx-auto max-w-7xl search xl:px-0">
        <div class="w-full md:w-1/4">
            <x-input wire:model.debounce="search" icon="search" label="" placeholder="Search..." />
        </div>
        <div class="w-full mt-4 text-right md:w-3/4 md:mt-0">
            <x-button positive md wire:click="create()" label="Add" icon="plus" class="float-right " />
        </div>
    </div>
    <div class="py-6 ">
        <div class="px-4 mx-auto max-w-7xl xl:px-0">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <x-table cols="">
                    <x-slot name="head">
                        <x-table.heading sortable wire:click="sortBy('cities.name')" :direction="$sortDirection" sortBy="cities.name" :currentSortBy="$sortBy">Name</x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('countries.name')" :direction="$sortDirection" sortBy="countries.name" :currentSortBy="$sortBy">Country</x-table.heading>
                        <x-table.heading class="w-40">Actions</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @forelse($cities as $city)
                            <x-table.row wire:loading.class.delay="opacity-75" class="{{ $loop->odd ?: 'bg-gray-50' }}">
                                <x-table.cell>
                                    {{ $city->name }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $city->country->name }}
                                </x-table.cell>
                                <x-table.cell class="w-40">
                                    <div class="flex space-x-2"">
                                        <x-button wire:click="edit({{ $city->id }})" primary label="Edit" icon="pencil" />
                                        <x-button
                                            wire:click="delete({{ $city->id }})"
                                            label="Delete"
                                            icon="trash"
                                            />
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row wire:loading.class.delay="opacity-75" class="">
                                <x-table.cell class="py-8 text-center" colspan="2">
                                    {{ __('No cities found')}}
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
            {{ $cities->links() }}
        </div>
    </div>

    <x-modal.card title="{{ $editModalTitle }}" blur wire:model.defer="isEditing" align="center">

        <form wire:submit.prevent="store()">
            <div class="p-4">
                <x-input wire:model.lazy="name" label="Name" />
            </div>
            <div class="p-4">
                <x-select label="Select Country" placeholder="Select Country" wire:model.defer="country_id">
                    @foreach ($all_countries as $country)
                        <x-select.option label="{{ $country->name }}" value="{{ $country->id }}" />
                    @endforeach
                </x-select>
            </div>

            <x-slot name="footer">
                <div class="flex justify-between gap-x-4">
                    <x-button  x-on:click="close" label="Cancel" />
                    <x-button primary wire:click.prevent="store()" label="Save" />
                </div>
            </x-slot>
        </form>
    </x-modal>

</div>
