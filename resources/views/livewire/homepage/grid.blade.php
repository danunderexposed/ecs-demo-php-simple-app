<div>
    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
            {{ __('Homepage Grid') }}
    </x-page-header>
    <div class="flex justify-end py-10 mx-auto space-x-2 max-w-7xl ">
        <x-button wire:click="saveOrder({{ json_encode($homepageGrid) }})" primary class="">Save Order</x-button>
        <x-button wire:click="showAdd()" primary class="">Add Item</x-button>
    </div>
    <div wire:sortable="updateOrder" id="home-grid" class="mx-auto my-10" >
        @forelse ($homepageGrid as $item)
            <div wire:sortable.item="{{ $item->id }}" wire:key="{{ $item->id }}" wire:sortable.handle id="module-{{ $item->id }}" >
                <x-homepage-module :item="$item" :image="$item->image" :showRemove="true"></x-homepage-module>
            </div>
        @empty
            {{ __('No grid items')}}
        @endforelse
    </div>

    <x-modal.card title="Add Module" blur wire:model.defer="isAdding" align="center">

        <form>
            <div class="p-4">
                <x-select label="Select Module" placeholder="Select Module" wire:model.defer="newItemId">
                    @foreach ($allHomepageItems as $i)
                        <x-select.option label="{{ $i->name }}" value="{{ $i->id }}" />
                    @endforeach
                </x-select>
            </div>

            <x-slot name="footer">
                <div class="flex justify-between gap-x-4">
                    <x-button  x-on:click="close" label="Cancel" />
                    <x-button primary wire:click.prevent="add()" label="Add" />
                </div>
            </x-slot>
        </form>
    </x-modal>


    <style>
    #home-grid {
        width: 1185px;
        padding-bottom: 50px;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
</div>
