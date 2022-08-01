<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
        @if ($advertId != 'new')
            {{ __('Edit Advert') }}
        @else
            {{ __('Add Advert') }}
        @endif
    </x-page-header>

    <div class="max-w-5xl mx-auto mt-8">

        <form wire:submit.prevent="store">

            <div class="p-4">
                <x-input wire:model.defer="advert.name" label="Advert Name / Title" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="advert.link" label="Advert Link / URL" />
            </div>

            <div class="p-4">
                <x-select label="Advert Type" placeholder="Advert Type" :searchable="false" wire:model="advert.type">
                    <x-select.option label="Select Type" value="0"></x-select.option>
                    <x-select.option label="Landscape" value="landscape"></x-select.option>
                    <x-select.option label="Microblock" value="microblock"></x-select.option>
                </x-select>
            </div>

            <div class="p-4">
                <x-label>Advert image</x-label>
                <x-image-cropper wire:ignore
                    :image="$advertImage ? $advertImage : $advert->image_small"
                    :viewportWidth="1185"
                    :viewportHeight="508"
                    :boundaryWidth="1200"
                    :boundaryHeight="550"
                    :inputName="'advertImage'"
                    :listenerName="'updateImage'"
                ></x-image-cropper>
            </div>

            <div class="w-64 p-4">
                <x-datetime-picker
                    without-timezone
                    label="Advert Start Date"
                    placeholder="Advert Start Date"
                    wire:model="advert.start_date"
                />
            </div>
            <div class="w-64 p-4">
                <x-datetime-picker
                    without-timezone
                    label="Advert End Date"
                    placeholder="Advert End Date"
                    wire:model="advert.end_date"
                />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Advert Active</x-label>
                <x-toggle lg wire:model.defer="advert.active" />
            </div>

            <div class="p-4">
                <x-button primary label="Save Advert" type="submit" ></x-button>
            </div>

        </form>

    </div>


</div>
