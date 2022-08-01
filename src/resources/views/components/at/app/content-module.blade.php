<div class="bg-">
    @switch($type)

        @case ("full-width-text")
            <div class="p-4">
                <x-input wire:model.defer="" label="Title" />
            </div>
            <div class="p-4">
                <x-label for="">Title Colour</x-label>
                <div class="py-4">
                    <input type="color" wire:model.defer="" />
                </div>
            </div>
            <div class="p-4">
                <x-rich-text class="title" model="title" label="Text" placeholder="Type text...">
                    {{-- {!!  !!} --}}
                </x-rich-text>
            </div>
            <div class="p-4">
                <x-textarea wire:model.defer="" label="Custom CSS" />
            </div>
            <div class="p-4">
                <x-toggle wire:model.defer="" left-label="Hide module"/>
            </div>
        @break

        @case("2-col-text")
            <div class="p-4">
                <x-input wire:model.defer="" label="Title" />
            </div>
            <div class="p-4">
                <x-label for="">Title Colour</x-label>
                <div class="py-4">
                    <input type="color" wire:model.defer="" />
                </div>
            </div>
            <div class="p-4">
                <x-rich-text class="text1" model="text1" label="Text 1" placeholder="Type text...">
                    {{-- {!!  !!} --}}
                </x-rich-text>
            </div>
            <div class="p-4">
                <x-rich-text class="text2" model="text2" label="Text 2" placeholder="Type text...">
                    {{-- {!!  !!} --}}
                </x-rich-text>
            </div>
            <div class="p-4">
                <x-textarea wire:model.defer="" label="Custom CSS" />
            </div>
            <div class="p-4">
                <x-toggle wire:model.defer="" left-label="Hide module"/>
            </div>
        @break

        @case("full-width-image")
            <div class="p-4">
                <x-input wire:model.defer="" label="Title" />
            </div>
            <div class="p-4">
                <x-label for="">Title Colour</x-label>
                <div class="py-4">
                    <input type="color" wire:model.defer="" />
                </div>
            </div>
            <div class="p-4">
                <x-rich-text class="text1" model="text" label="Text" placeholder="Type text...">
                    {{-- {!!  !!} --}}
                </x-rich-text>
            </div>
            <!-- image -->

            <div class="p-4">
                <x-input wire:model.defer="" label="Image alt tag" />
                <small class="text-gray-500">Needed for accessibility. Add a small description of what is in the image for visually impaired users.</small>
            </div>
            <div class="p-4">
                <x-input wire:model.defer="" label="Image link" />
                <small class="text-gray-500">Add an optional link to the image. So users can click it and be taken to a new tab outside of the app. Useful for banners!</small>
            </div>
            <div class="p-4">
                <x-textarea wire:model.defer="" label="Custom CSS" />
            </div>
            <div class="p-4">
                <x-toggle wire:model.defer="" left-label="Hide module"/>
            </div>
        @break

        @case("full-width-video-carousel")
            <div class="p-4">
                <x-input wire:model.defer="" label="Title" />
            </div>
            <div class="p-4">
                <x-label for="">Title Colour</x-label>
                <div class="py-4">
                    <input type="color" wire:model.defer="" />
                </div>
            </div>
            <div class="p-4">
                <x-rich-text class="title" model="title" label="Text" placeholder="Type text...">
                    {{-- {!!  !!} --}}
                </x-rich-text>
            </div>

            <!-- videos -->


            <div class="p-4">
                <x-textarea wire:model.defer="" label="Custom CSS" />
            </div>
            <div class="p-4">
                <x-toggle wire:model.defer="" left-label="Hide module"/>
            </div>
        @break

        @case("portrait-video-carousel")
            <div class="p-4">
                <x-input wire:model.defer="" label="Title" />
            </div>
            <div class="p-4">
                <x-label for="">Title Colour</x-label>
                <div class="py-4">
                    <input type="color" wire:model.defer="" />
                </div>
            </div>
            <div class="p-4">
                <x-rich-text class="title" model="title" label="Text" placeholder="Type text...">
                    {{-- {!!  !!} --}}
                </x-rich-text>
            </div>

            <!-- videos -->


            <div class="p-4">
                <x-textarea wire:model.defer="" label="Custom CSS" />
            </div>
            <div class="p-4">
                <x-toggle wire:model.defer="" left-label="Hide module"/>
            </div>
        @break

        @case("landscape-video-carousel")
            <div class="p-4">
                <x-input wire:model.defer="" label="Title" />
            </div>
            <div class="p-4">
                <x-label for="">Title Colour</x-label>
                <div class="py-4">
                    <input type="color" wire:model.defer="" />
                </div>
            </div>
            <div class="p-4">
                <x-rich-text class="title" model="title" label="Text" placeholder="Type text...">
                    {{-- {!!  !!} --}}
                </x-rich-text>
            </div>

            <!-- videos -->


            <div class="p-4">
                <x-textarea wire:model.defer="" label="Custom CSS" />
            </div>
            <div class="p-4">
                <x-toggle wire:model.defer="" left-label="Hide module"/>
            </div>
        @break
        @default

    @endswitch
</div>
