<div>
    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
            {{ __('Homepage Featured Projects') }}
    </x-page-header>
    <div class="flex justify-end py-10 mx-auto space-x-2 max-w-7xl ">

    </div>
    <div class="max-w-5xl mx-auto my-8 ">
        <x-select
                label="Select Sector"
                placeholder="Select Sector"
                wire:model="selectedOptionId"
                searchable="'false'"
            >
            @forelse ($options as $option)

                <x-select.option label="{{ $option['sector_name'] }}" value="{{ $option['option_id'] }}" />

            @empty
                {{ __('No options')}}
            @endforelse
        </x-select>

        <div class="py-4">

            <div class="flex flex-wrap"  wire:sortable="updateOrder">
                @forelse ($projects as $p)
                    <div class="max-w-xs p-3" wire:sortable.item="{{ $p->id }}" wire:key="{{ $p->id }}" wire:sortable.handle id="module-{{ $p->id }}">
                        <x-card title="{{ $p->title }}" padding="" shadow="" >
                            <x-slot name="footer">
                                <x-button wire:click="remove('{{ $p->id }}')" negative icon="trash" class="float-right"></x-button>
                            </x-slot>
                            <img src="{{ $p->cover_small }}" alt="" class="object-none object-center h-72 w-96">
                        </x-card>
                    </div>
                @empty
                    <div class="w-full p-4 text-center">
                        @if ($selectedOptionId)
                            {{ __('No items yet')}}
                        @else
                            {{ __('Choose a sector to edit featured projects')}}
                        @endif
                    </div>
                @endforelse
            </div>
            @if ($selectedOptionId)
            <div class="flex space-x-3">
                <x-button wire:click="showAdd('{{ $option['option_id'] }}')" positive class="">Add Item</x-button>
                @if (isset($order)) <x-button wire:click="saveOrder()" primary class="">Save Order</x-button> @endif
            </div>
            @endif
        </div>

    </div>

    <x-modal.card title="Add Project" blur wire:model.defer="isAdding" align="center" fullscreen="true">

        <form class="w-full">

            <div class="p-4">
                <x-input wire:model.debounce="projectSearch" label="Search Projects" />
            </div>

            <div class="flex flex-wrap p-4 py-4">

                @foreach ($projectSearchResults as $p)
                    <div class="max-w-xs p-2">
                        <x-card title="{{ $p->title }}" padding="" >
                            <x-slot name="footer">
                                <x-button wire:click="add('{{ $p->id }}')" positive icon="plus" class="float-right">Add</x-button>
                            </x-slot>
                            <img src="{{ $p->cover_small }}" alt="" class="object-none object-center h-72 w-96">
                        </x-card>
                    </div>
                @endforeach

            </div>

            <x-slot name="footer">
                <div class="flex justify-between gap-x-4">
                    <x-button  x-on:click="close" label="Cancel" />
                </div>
            </x-slot>
        </form>
    </x-modal>
    <style>

    </style>
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
</div>
