<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
        @if ($schoolId != 'new')
            {{ __('Edit School') }} - {{ $school->school }}
        @else
            {{ __('Add School') }}
        @endif
    </x-page-header>

    <div class="max-w-5xl mx-auto">

        <form wire:submit.prevent="store()">

            <div class="p-4 mt-8">
                <x-input wire:model.defer="school.school" label="School Name / Title" />
            </div>

            <div class="p-4">
                <x-select label="Select City" placeholder="Select City" wire:model="school.city_id">
                    @foreach ($all_cities as $c)
                        <x-select.option label="{{ $c->name }}" value="{{ $c->id }}" />
                    @endforeach
                </x-select>
            </div>

            <div class="p-4">
                <x-label>School image</x-label>

                <x-image-cropper wire:ignore
                    :image="$schoolImage ? $schoolImage : $school->image"
                    :viewportWidth="500"
                    :viewportHeight="500"
                    :boundaryWidth="800"
                    :boundaryHeight="800"
                    :inputName="'schoolImage'"
                    :listenerName="'updateImage'"
                ></x-image-cropper>

            </div>

            <div class="p-4">
                <x-toggle lg left-label="Give School Separate Page?" wire:model.defer="school.separate" />
            </div>

            <div class="p-4">
                <x-toggle lg left-label="Feature On Schools Slider?" wire:model.defer="school.featured" />
            </div>

            <div class="p-4">
                <x-label>Slider image</x-label>

                <x-image-cropper wire:ignore
                    :image="$sliderImage ? $sliderImage : $school->slider"
                    :viewportWidth="1185"
                    :viewportHeight="508"
                    :boundaryWidth="1200"
                    :boundaryHeight="600"
                    :inputName="'sliderImage'"
                    :listenerName="'updateSliderImage'"
                    :enableResize="'false'"
                ></x-image-cropper>

            </div>

            <div class="p-4" >
                <x-rich-text class="excerpt" model="excerpt" label="Excerpt" placeholder="Type text...">
                    {!! $school->excerpt !!}
                </x-rich-text>
            </div>

            <div class="p-4" >
                <x-rich-text class="description" model="description" label="Description" placeholder="Type text...">
                    {!! $school->description !!}
                </x-rich-text>

            </div>

            <div class="p-4">
                <x-input wire:model.defer="school.website" label="Website Link" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="school.twitter" label="Twitter Link" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="school.facebook" label="Facebook Link" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="school.linkedin" label="LinkedIn Link" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="school.youtube" label="YouTube Link" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="school.instagram" label="Instagram Link" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="school.vimeo" label="Vimeo Link" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="school.pinterest" label="Pinterest Link" />
            </div>

            <div class="p-4">
                <x-toggle lg left-label="Display Instagram Images In Slider?" wire:model.defer="school.display_instagram" />
            </div>

            <div class="p-4">
                <x-button primary label="Save School" type="submit" ></x-button>
            </div>

        </form>

    </div>



</div>
