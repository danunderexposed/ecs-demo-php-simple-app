<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
            @if ($sponsorId == 'new')
                {{ __('Add Sponsor') }}
            @else
                {{ __('Edit Sponsor') }}
            @endif
    </x-page-header>

    <div class="max-w-5xl mx-auto my-8 ">
        <form wire:submit.prevent="store">

            <div class="p-4">
                <x-input wire:model.defer="sponsor.name" label="Name" />
            </div>

            <div class="p-4">
                <x-label>Image</x-label>

                <x-image-cropper
                    :image="$image ? $image : $sponsor->image_large"
                    :viewportWidth="840"
                    :viewportHeight="200"
                    :boundaryWidth="900"
                    :boundaryHeight="250"
                    :enableResize="'false'"
                    :inputName="'image'"
                    :listenerName="'updateImage'"
                ></x-image-cropper>

            </div>

            <div class="p-4">
                <x-input wire:model.defer="sponsor.url" label="Link" />
            </div>

            <div class="p-4">
                <x-input label="Sort Order" placeholder="" wire:model.defer="sponsor.sort_order"></x-input>
            </div>

            <div class="p-4">
                <x-button primary label="Save Sponsor" type="submit" ></x-button>
            </div>


        </form>


    </div>



</div>
