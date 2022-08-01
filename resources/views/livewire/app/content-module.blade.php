<div class="my-3 bg-gray-100" x-data="{ hide: false }">
    @switch($type)

        @case ("full_width_text")
            <div class="flex px-4 py-2 border-b border-white cursor-pointer" wire:sortable.handle>
                <h4 x-on:click="hide = !hide" class="flex-1 font-bold uppercase">Full width text</h4>
                <x-button x-on:click="hide = !hide" x-show="hide" flat icon="chevron-down"></x-button>
                <x-button x-on:click="hide = !hide" x-show="!hide" flat icon="chevron-up"></x-button>
                <x-button wire:click="$emit('removeContentModule', '{{ $index }}')" flat danger icon="x"></x-button>
            </div>
            <div x-show="!hide">
                <div class="p-4">
                    <x-input wire:model="values.title" label="Title" />
                </div>
                <div class="p-4">
                    <x-label for="">Title Colour</x-label>
                    <div class="py-4">
                        <input type="color" wire:model="values.title_colour" />
                    </div>
                </div>
                <div class="p-4">
                    <x-quill class="{{ $index }}" input="text" label="Text">
                        {!! $values['text'] ?? "" !!}
                    </x-quill>
                </div>
                <div class="p-4">
                    <x-textarea wire:model="values.custom_css" label="Custom CSS" />
                </div>
                <div class="p-4">
                    <x-toggle wire:model="values.hide_module" left-label="Hide module"/>
                </div>

            </div>
        @break

        @case("2_col_text")
            <div class="flex px-4 py-2 border-b border-white cursor-pointer" wire:sortable.handle>
                <h4 x-on:click="hide = !hide" class="flex-1 font-bold uppercase">2 column text</h4>
                <x-button x-on:click="hide = !hide" x-show="hide" flat icon="chevron-down"></x-button>
                <x-button x-on:click="hide = !hide" x-show="!hide" flat icon="chevron-up"></x-button>
                <x-button wire:click="$emit('removeContentModule', '{{ $index }}')" flat danger icon="x"></x-button>
            </div>
            <div x-show="!hide">
                <div class="p-4">
                    <x-input wire:model="values.title" label="Title" />
                </div>
                <div class="p-4">
                    <x-label for="">Title Colour</x-label>
                    <div class="py-4">
                        <input type="color" wire:model="values.title_colour" />
                    </div>
                </div>
                <div class="p-4">
                    <x-quill class="{{ $index }}1" input="text1" label="Text 1" >
                        {!! $values['text1'] ?? "" !!}
                    </x-quill>
                </div>
                <div class="p-4">
                    <x-quill class="{{ $index }}2" input="text2" label="Text 2" >
                        {!! $values['text2'] ?? "" !!}
                    </x-quill>
                </div>
                <div class="p-4">
                    <x-textarea wire:model="values.custom_css" label="Custom CSS" />
                </div>
                <div class="p-4">
                    <x-toggle wire:model="values.hide_module" left-label="Hide module"/>
                </div>
            </div>
        @break

        @case("full_width_image")
            <div class="flex px-4 py-2 border-b border-white cursor-pointer" wire:sortable.handle>
                <h4 x-on:click="hide = !hide" class="flex-1 font-bold uppercase">Full width image</h4>
                <x-button x-on:click="hide = !hide" x-show="hide" flat icon="chevron-down"></x-button>
                <x-button x-on:click="hide = !hide" x-show="!hide" flat icon="chevron-up"></x-button>
                <x-button wire:click="$emit('removeContentModule', '{{ $index }}')" flat danger icon="x"></x-button>
            </div>
            <div x-show="!hide">
                <div class="p-4">
                    <x-input wire:model="" label="Title" />
                </div>
                <div class="p-4">
                    <x-label for="">Title Colour</x-label>
                    <div class="py-4">
                        <input type="color" wire:model="values.title_colour" />
                    </div>
                </div>
                <div class="p-4">
                    <x-quill class="{{ $index }}" input="text" label="Text" >
                        {!! $values['text'] ?? "" !!}
                    </x-quill>
                </div>
                <!-- image -->
                <!-- TBD -->

                <div class="p-4">
                    <x-input wire:model="values.image_alt_tag" label="Image alt tag" />
                    <small class="text-gray-500">Needed for accessibility. Add a small description of what is in the image for visually impaired users.</small>
                </div>
                <div class="p-4">
                    <x-input wire:model="values.image_link" label="Image link" />
                    <small class="text-gray-500">Add an optional link to the image. So users can click it and be taken to a new tab outside of the app. Useful for banners!</small>
                </div>
                <div class="p-4">
                    <x-textarea wire:model="values.custom_css" label="Custom CSS" />
                </div>
                <div class="p-4">
                    <x-toggle wire:model="values.hide_module" left-label="Hide module"/>
                </div>
            </div>
        @break

        @case("full_width_video_carousel")
            <div class="flex px-4 py-2 border-b border-white cursor-pointer" wire:sortable.handle>
                <h4 x-on:click="hide = !hide" class="flex-1 font-bold uppercase">Full width video carousel</h4>
                <x-button x-on:click="hide = !hide" x-show="hide" flat icon="chevron-down"></x-button>
                <x-button x-on:click="hide = !hide" x-show="!hide" flat icon="chevron-up"></x-button>
                <x-button wire:click="$emit('removeContentModule', '{{ $index }}')" flat danger icon="x"></x-button>
            </div>
            <div x-show="!hide">
                <div class="p-4">
                    <x-input wire:model="values.title" label="Title" />
                </div>
                <div class="p-4">
                    <x-label for="">Title Colour</x-label>
                    <div class="py-4">
                        <input type="color" wire:model="values.title_colour" />
                    </div>
                </div>
                <div class="p-4">
                    <x-quill class="{{ $index }}" input="text" label="Text" >
                        {!! $values['text'] ?? "" !!}
                    </x-quill>
                </div>

                <!-- videos -->
                <div class="p-4">
                    @if (isset($values['videos']) && is_array($values['videos']))
                        <div wire:sortable="updateVideoOrder">
                            @foreach ($values['videos'] as $index => $v)
                                <div class="py-2" wire:sortable.item="{{ $index }}">
                                    <div wire:sortable.handle><x-label >Video {{ $index + 1 }}</x-label></div>
                                    <div class="flex">
                                        <div class="flex-1">
                                        <x-input wire:model="values.videos.{{ $index }}.vimeo_url" label="" />
                                        </div>
                                        <x-button wire:click="removeVideo('{{ $index }}')" flat danger icon="x"></x-button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="py-2">
                        <x-button primary wire:click="showVideoModal('new')">Add video</x-button>
                    </div>
                </div>

                <div class="p-4">
                    <x-textarea wire:model="" label="Custom CSS" />
                </div>
                <div class="p-4">
                    <x-toggle wire:model="values.hide_module" left-label="Hide module"/>
                </div>
            </div>
        @break

        @case("portrait_video_carousel")
            <div class="flex px-4 py-2 border-b border-white cursor-pointer" wire:sortable.handle>
                <h4 x-on:click="hide = !hide" class="flex-1 font-bold uppercase">Portrait video carousel</h4>
                <x-button x-on:click="hide = !hide" x-show="hide" flat icon="chevron-down"></x-button>
                <x-button x-on:click="hide = !hide" x-show="!hide" flat icon="chevron-up"></x-button>
                <x-button wire:click="$emit('removeContentModule', '{{ $index }}')" flat danger icon="x"></x-button>
            </div>
            <div x-show="!hide">
                <div class="p-4">
                    <x-input wire:model="values.title" label="Title" />
                </div>
                <div class="p-4">
                    <x-label for="">Title Colour</x-label>
                    <div class="py-4">
                        <input type="color" wire:model="values.title_colour" />
                    </div>
                </div>
                <div class="p-4">
                    <x-quill class="{{ $index }}" input="text" label="Text" >
                        {!! $values['text'] ?? "" !!}
                    </x-quill>
                </div>

                <!-- videos -->
                <div class="p-4">
                    @if (isset($values['videos']) && is_array($values['videos']))
                        <div wire:sortable="updateVideoOrder">
                            @foreach ($values['videos'] as $index => $v)
                                <div class="py-2" wire:sortable.item="{{ $index }}">
                                    <div wire:sortable.handle><x-label >Video {{ $index + 1 }}</x-label></div>
                                    <div class="flex">
                                        <div class="flex-1">
                                        <x-input wire:model="values.videos.{{ $index }}.vimeo_url" label="" />
                                        </div>
                                        <x-button wire:click="removeVideo('{{ $index }}')" flat danger icon="x"></x-button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="py-2">
                        <x-button primary wire:click="showVideoModal('new')">Add video</x-button>
                    </div>
                </div>
                <div class="p-4">
                    <x-textarea wire:model="" label="Custom CSS" />
                </div>
                <div class="p-4">
                    <x-toggle wire:model="values.hide_module" left-label="Hide module"/>
                </div>
            </div>
        @break

        @case("landscape_video_carousel")
            <div class="flex px-4 py-2 border-b border-white cursor-pointer" wire:sortable.handle>
                <h4 x-on:click="hide = !hide" class="flex-1 font-bold uppercase">Landscape video carousel</h4>
                <x-button x-on:click="hide = !hide" x-show="hide" flat icon="chevron-down"></x-button>
                <x-button x-on:click="hide = !hide" x-show="!hide" flat icon="chevron-up"></x-button>
                <x-button wire:click="$emit('removeContentModule', '{{ $index }}')" flat danger icon="x"></x-button>
            </div>
            <div x-show="!hide">
                <div class="p-4">
                    <x-input wire:model="values.title" label="Title" />
                </div>
                <div class="p-4">
                    <x-label for="">Title Colour</x-label>
                    <div class="py-4">
                        <input type="color" wire:model="values.title_colour" />
                    </div>
                </div>
                <div class="p-4">
                    <x-quill class="{{ $index }}" input="text" label="Text" >
                        {!! $values['text'] ?? "" !!}
                    </x-quill>
                </div>

                <!-- videos -->
                <div class="p-4">
                    @if (isset($values['videos']) && is_array($values['videos']))
                        <div wire:sortable="updateVideoOrder">
                            @foreach ($values['videos'] as $index => $v)
                                <div class="py-2" wire:sortable.item="{{ $index }}">
                                    <div wire:sortable.handle><x-label >Video {{ $index + 1 }}</x-label></div>
                                    <div class="flex">
                                        <div class="flex-1">
                                        <x-input wire:model="values.videos.{{ $index }}.vimeo_url" label="" />
                                        </div>
                                        <x-button wire:click="removeVideo('{{ $index }}')" flat danger icon="x"></x-button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="py-2">
                        <x-button primary wire:click="showVideoModal('new')">Add video</x-button>
                    </div>
                </div>

                <div class="p-4">
                    <x-textarea wire:model="values.custom_css" label="Custom CSS" />
                </div>
                <div class="p-4">
                    <x-toggle wire:model="values.hide_module" left-label="Hide module"/>
                </div>
            </div>
        @break
        @default

    @endswitch

    <!-- for full width video carousel -->
    <x-modal.card
        title="Edit Video"
        blur wire:model.defer="showVideoModal"
        max-width="2xl"
        align="center"
        >
        <div class="py-4">
            <x-input label="Video URL" placeholder="" wire:model="newVideoUrl" />
        </div>
        <x-button primary wire:click="storeVideo()">
            {{ $videoId == "new" ? "Add video" : "Edit video" }}
        </x-button>
    </x-modal.card>

    {{-- <x-button wire:click="debug()">debug</x-button> --}}

</div>
