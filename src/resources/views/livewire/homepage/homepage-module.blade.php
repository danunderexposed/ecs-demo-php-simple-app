<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
            @if ($moduleId == 'new')
                {{ __('Add Module') }}
            @else
                {{ __('Edit Module') }}
            @endif
    </x-page-header>

    <div class="flex flex-wrap max-w-5xl mx-auto my-8 ">
        <div class="w-full md:w-1/2">
            <form wire:submit.prevent="store">

                <div class="p-4">
                    <x-textarea wire:model.defer="homepage.name" label="Name" />
                </div>

                <div class="p-4">
                    <x-select label="Select Type" placeholder="Select Type" wire:model="homepage.type" wire:change="$refresh()">
                        <x-select.option label="Select Type" value="" disabled/>
                        <x-select.option label="1 Column Feature" value="full1" />
                        <x-select.option label="2 Column Feature" value="full2" />
                        <x-select.option label="2 Column Video" value="video2" />
                        <x-select.option label="3 Column Main Feature" value="full3" />
                        <x-select.option label="1 Column Half Feature" value="half1" />
                        <x-select.option label="2 Column Half Feature" value="half2" />
                        <x-select.option label="2 Column Featured Portfolios" value="port2" />
                        <x-select.option label="1 Column Featured Portfolios" value="port1" />
                    </x-select>
                </div>

                <div class="@if ($homepage->type == 'video2') hidden @endif ">
                    <div class="p-4">
                        <x-label>Image - {{ isset($imageSizes[$homepage->type][0]) ? $imageSizes[$homepage->type][0] : 300 }} </x-label>

                        <x-image-cropper
                            :image="$image ? $image : $homepage->image"
                            :viewportWidth="isset($imageSizes[$homepage->type][0]) ? $imageSizes[$homepage->type][0] : 300"
                            :viewportHeight="isset($imageSizes[$homepage->type][1]) ? $imageSizes[$homepage->type][1] : 300"
                            :boundaryWidth="isset($imageSizes[$homepage->type][0]) ? $imageSizes[$homepage->type][0] + 50 : 350"
                            :boundaryHeight="isset($imageSizes[$homepage->type][1]) ? $imageSizes[$homepage->type][1] + 50 : 350"
                            :enableResize="'false'"
                            :inputName="'homepageImage'"
                            :listenerName="'updateImage'"
                        ></x-image-cropper>

                    </div>

                    <div class="p-4">
                        <x-label>Mobile Image</x-label>

                        <x-image-cropper wire:ignore
                            :image="$mobileImage ? $mobileImage : $homepage->mobile_image"
                            :viewportWidth="500"
                            :viewportHeight="600"
                            :boundaryWidth="800"
                            :boundaryHeight="800"
                            :enableResize="'false'"
                            :inputName="'mobileImage'"
                            :listenerName="'updateMobileImage'"
                        ></x-image-cropper>

                    </div>
                </div>

                @if ($homepage->type == 'video2')
                    <div class="p-4">
                        <x-input wire:model.lazy="videoUrl" label="Video URL (YouTube or Vimeo Only)" />
                        <x-button wire:click="lookupVideo()" primary class="my-3">Lookup Video</x-button>
                    </div>
                @endif


                <div class="p-4">
                    <x-input wire:model.defer="homepage.link" label="Link" />
                </div>

                <div class="p-4">
                    <x-textarea label="Header Text" placeholder="Enter Header Text here" wire:model="homepage.headtxt"></x-textarea>
                </div>

                <div class="p-4">
                    <x-label for="">Header Text Colour</x-label>
                    <div class="py-4">
                        <input type="color" wire:model.defer="homepage.headclr" />
                    </div>
                </div>

                <div class="p-4">
                    <x-label for="">Header BG Colour</x-label>
                    <div class="py-4">
                        <input type="color" wire:model.defer="homepage.headbg" />
                    </div>
                </div>

                <div class="p-4">
                    <x-textarea label="Copy Text" placeholder="Enter Copy Text here" wire:model="homepage.copytxt"></x-textarea>
                </div>

                <div class="p-4">
                    <x-label for="">Copy Text Colour</x-label>
                    <div class="py-4">
                        <input type="color" wire:model.defer="homepage.copyclr" />
                    </div>
                </div>

                <div class="p-4">
                    <x-label for="">Copy Text Background Colour</x-label>
                    <div class="py-4">
                        <input type="color" wire:model.defer="homepage.copybg" />
                    </div>
                </div>

                <div class="p-4">
                    <x-label for="">Module Background Colour</x-label>
                    <div class="py-4">
                        <input type="color" wire:model.defer="homepage.modulebg" />
                    </div>
                </div>

                <div class="p-4">
                    <x-button primary label="Save Module" type="submit" ></x-button>
                </div>


            </form>
        </div>
        <div class="w-full md:w-1/2">
            <div class="sticky top-0 p-8 ">
                <h3 class="mb-5">Module Preview:</h3>
                <x-homepage-module :item="$homepage" :image="$image ? $image : $homepage->image"></x-homepage-module>
            </div>
        </div>

    </div>



</div>
