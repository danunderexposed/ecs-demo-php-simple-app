
<div>
    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
            {{ __('Messages') }}
    </x-page-header>

    <div class="flex flex-wrap px-4 pt-6 mx-auto max-w-7xl search xl:px-0">
        <div class="w-full md:w-1/4">
            <x-input wire:model.debounce="search" icon="search" label="" placeholder="Search..." />
        </div>
    </div>
    <div class="py-6 ">
        <div class="px-4 mx-auto max-w-7xl xl:px-0">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <x-table cols="">
                    <x-slot name="head">
                        <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortDirection" sortBy="name" :currentSortBy="$sortBy">Username</x-table.heading>
                        <x-table.heading>Messager Name</x-table.heading>
                        <x-table.heading>Subject</x-table.heading>
                        <x-table.heading>Category</x-table.heading>
                        <x-table.heading>Message Preview</x-table.heading>
                        <x-table.heading class="w-40">Actions</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @forelse($messages as $m)
                            <x-table.row wire:loading.class.delay="opacity-75 w-full" class="{{ $loop->odd ?: 'bg-gray-50' }}">
                                <x-table.cell>
                                    <p class="">{{ $m->username }}</p>
                                </x-table.cell>
                                 <x-table.cell>
                                    <p class="text-xs">{{ $m->messagername }}</p>
                                </x-table.cell>
                                <x-table.cell>
                                    <p class="text-xs">{{ $m->subject }}</p>
                                </x-table.cell>
                                <x-table.cell>
                                    <p class="text-xs">{{ $m->category }}</p>
                                </x-table.cell>
                                <x-table.cell>
                                    <p class="text-xs">{!! Str::words($m->message, 25,'...'); !!}</p>
                                </x-table.cell>
                                <x-table.cell class="w-40">
                                    <div class="flex space-x-2">
                                        <x-button wire:click="edit({{ $m->id }})" primary label="View" icon="pencil" />
                                        <x-button
                                            wire:click="delete({{ $m->id }})"
                                            label="Delete"
                                            icon="trash"
                                            />
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row wire:loading.class.delay="opacity-75" class="">
                                <x-table.cell class="py-8 text-center" colspan="6">
                                    {{ __('No messages found')}}
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
            {{ $messages->links() }}
        </div>
    </div>

</div>
