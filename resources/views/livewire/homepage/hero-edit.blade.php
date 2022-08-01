<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
            @if ($heroId == 'new')
                {{ __('Add Hero') }}
            @else
                {{ __('Edit Hero') }}
            @endif
    </x-page-header>

    <div class="max-w-5xl mx-auto my-8 ">
        <form wire:submit.prevent="store">

            <div class="p-4">
                <x-input wire:model.defer="hero.pre_title" label="Pre Title" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="hero.title" label="Title" />
            </div>


            <div class="p-4">
                <x-label>Image</x-label>

                <x-image-cropper
                    :image="$image ? $image : $hero->image"
                    :viewportWidth="960"
                    :viewportHeight="300"
                    :boundaryWidth="1000"
                    :boundaryHeight="350"
                    :resultWidth="1920"
                    :resultHeight="600"
                    :enableResize="'false'"
                    :inputName="'image'"
                    :listenerName="'updateImage'"
                ></x-image-cropper>

            </div>

            <div class="p-4">
                <x-label>Mobile Image</x-label>

                <x-image-cropper wire:ignore
                    :image="$mobileImage ? $mobileImage : $hero->mobile_image"
                    :viewportWidth="500"
                    :viewportHeight="600"
                    :boundaryWidth="800"
                    :boundaryHeight="800"
                    :enableResize="'false'"
                    :inputName="'mobileImage'"
                    :listenerName="'updateMobileImage'"
                ></x-image-cropper>

            </div>

            <div class="p-4">
                <x-input wire:model.defer="hero.link" label="Link" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="hero.button_text" label="Button Text" />
            </div>

            <div class="p-4">
                <x-button primary label="Save Module" type="submit" ></x-button>
            </div>


        </form>
    </div>
</div>
