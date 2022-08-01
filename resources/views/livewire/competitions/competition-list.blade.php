
<div>
    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
            {{ __('Competitions') }}
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
                        <x-table.heading>Image</x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortDirection" sortBy="name" :currentSortBy="$sortBy">Title</x-table.heading>
                        <x-table.heading>Start date</x-table.heading>
                        <x-table.heading>End date</x-table.heading>
                        <x-table.heading>Active</x-table.heading>
                        <x-table.heading>Display Entries?</x-table.heading>
                        <x-table.heading>Featured?</x-table.heading>
                        <x-table.heading>Created</x-table.heading>
                        <x-table.heading>No. of entries</x-table.heading>
                        <x-table.heading class="w-40">Actions</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @forelse($competitions as $c)
                            <x-table.row wire:loading.class.delay="opacity-75 w-full" class="{{ $loop->odd ?: 'bg-gray-50' }}">
                                <x-table.cell>
                                    <div class="flex">
                                        @if ($c->image)
                                        <img src="{{ $c->image }}" alt="" class="object-contain w-16 mr-3" >
                                        @endif
                                    </div>
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $c->name }}
                                </x-table.cell>
                                <x-table.cell>
                                    <p class="text-xs">{{ $c->start_date }}</p>
                                </x-table.cell>
                                <x-table.cell>
                                    <p class="text-xs">{{ $c->end_date }}</p>
                                </x-table.cell>
                                <x-table.cell>
                                    <p class="text-xs">{{ $c->active ? 'Active' : 'Not active' }}</p>
                                </x-table.cell>
                                <x-table.cell>
                                    <p class="text-xs">{{ $c->displayentries ? 'Displayed' : 'Not displayed' }}</p>
                                </x-table.cell>
                                <x-table.cell>
                                    <p class="text-xs">{{ $c->featured ? 'Featured' : 'Not featured' }}</p>
                                </x-table.cell>
                                <x-table.cell>
                                    <p class="text-xs">{{ $c->created_at }}</p>
                                </x-table.cell>
                                <x-table.cell>
                                    <p class="text-xs">{{ $c->entries()->count() }}</p>
                                </x-table.cell>

                                <x-table.cell class="w-40">
                                    <div class="flex space-x-2">
                                        <x-button wire:click="edit({{ $c->id }})" primary label="Edit" icon="pencil" />
                                        <x-button
                                            wire:click="delete({{ $c->id }})"
                                            label="Delete"
                                            icon="trash"
                                            />
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row wire:loading.class.delay="opacity-75" class="">
                                <x-table.cell class="py-8 text-center" colspan="9">
                                    {{ __('No competitions found')}}
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
            {{ $competitions->links() }}
        </div>
    </div>

</div>
