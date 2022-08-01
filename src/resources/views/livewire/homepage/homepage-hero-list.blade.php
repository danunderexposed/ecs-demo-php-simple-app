
<div>
    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
            {{ __('Homepage Heroes') }}
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
                        <x-table.heading sortable wire:click="sortBy('homepage_hero.title')" :direction="$sortDirection" sortBy="homepage_hero.title" :currentSortBy="$sortBy">Title</x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('homepage_hero.link')" :direction="$sortDirection" sortBy="homepage_hero.link" :currentSortBy="$sortBy">Link</x-table.heading>
                        <x-table.heading class="w-40">Actions</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @forelse($heroes as $h)
                            <x-table.row wire:loading.class.delay="opacity-75 w-full" class="{{ $loop->odd ?: 'bg-gray-50' }}">
                                <x-table.cell>
                                    <div class="flex">
                                        @if ($h->image)
                                        <img src="{{ $h->image }}" alt="" class="object-contain w-16 mr-3" >
                                        @endif
                                        <p>{{ $h->title }}</p>
                                    </div>
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $h->link }}
                                </x-table.cell>
                                <x-table.cell class="w-40">
                                    <div class="flex space-x-2"">
                                        <x-button wire:click="edit({{ $h->id }})" primary label="Edit" icon="pencil" />
                                        <x-button
                                            wire:click="delete({{ $h->id }})"
                                            label="Delete"
                                            icon="trash"
                                            />
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row wire:loading.class.delay="opacity-75" class="">
                                <x-table.cell class="py-8 text-center" colspan="4">
                                    {{ __('No heroes found')}}
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
            {{ $heroes->links() }}
        </div>
    </div>
</div>
