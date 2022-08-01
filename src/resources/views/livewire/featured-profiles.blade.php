<div>
    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
            {{ __('Featured Profiles') }}
    </x-page-header>
    <div class="flex justify-end py-10 mx-auto space-x-2 max-w-7xl ">

    </div>
    <div class="max-w-5xl mx-auto my-8 ">
        <div class="py-4">
            <div class="flex flex-wrap"  wire:sortable="updateOrder">
                @forelse ($profiles as $p)
                    <div class="max-w-xs p-3" wire:sortable.item="{{ $p->id }}" wire:key="{{ $p->id }}" wire:sortable.handle id="module-{{ $p->id }}">
                        <x-card title="{{ $p->title }}" padding="" shadow="" >
                            <x-slot name="footer">
                                <x-button wire:click="remove('{{ $p->id }}')" negative icon="trash" class="float-right"></x-button>
                            </x-slot>
                            <img src="{{ $p->profile_image }}" alt="" class="object-none object-center h-72 w-96">
                        </x-card>
                    </div>
                @empty
                    <div class="w-full p-4 text-center">
                        {{ __('No items yet')}}
                    </div>
                @endforelse
            </div>
            <div class="flex space-x-3">
                <x-button wire:click="showAdd()" positive class="">Add Item</x-button>
                @if (isset($order)) <x-button wire:click="saveOrder()" primary class="">Save Order</x-button> @endif
            </div>
        </div>
    </div>

    <x-modal.card title="Add Profile" blur wire:model.defer="isAdding" align="center" fullscreen="true">

        <form class="w-full">

            <div class="p-4">
                <x-input wire:model.debounce="profileSearch" label="Search Profiles" />
            </div>

            <div class="flex flex-wrap p-4 py-4">

                @foreach ($profileSearchResults as $p)
                    <div class="max-w-xs p-2">
                        <x-card title="{{ $p->name }}" padding="" >
                            <x-slot name="footer">
                                <x-button wire:click="add('{{ $p->id }}')" positive icon="plus" class="float-right">Add</x-button>
                            </x-slot>
                            <img src="{{ $p->profile_image }}" alt="" class="object-none object-center h-72 w-96">
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

    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
</div>
