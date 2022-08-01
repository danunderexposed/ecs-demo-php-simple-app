<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
        {{-- @if ($projectId != 'new')
            {{ __('Edit Project') }}
        @else
            {{ __('Add Project') }}
        @endif --}}
    </x-page-header>

    <div class="max-w-5xl mx-auto mt-8">

        <form wire:submit.prevent="store">

            <div class="p-4">
                <x-input wire:model.defer="project.title" label="Project Name / Title" />
            </div>

            <div class="p-4">
                <x-textarea label="Description" placeholder="" wire:model.defer="project.description"></x-textarea>
            </div>

            <div class="p-4">
                <x-select label="Sector / Specialism" placeholder="Select Sector / Specialism" wire:model.lazy="project.specialism">
                    @foreach ($all_specialisms as $s)
                        <x-select.option label="{{ $s->specialism }}" value="{{ $s->id }}" />
                    @endforeach
                </x-select>
            </div>

            <div class="p-4">
                <x-select label="Sector / Specialism 2" placeholder="Select Sector / Specialism" wire:model.lazy="project.specialism2">
                    @foreach ($all_specialisms as $s)
                        <x-select.option label="{{ $s->specialism }}" value="{{ $s->id }}" />
                    @endforeach
                </x-select>
            </div>

            <div class="p-4">
                <x-select label="Sector / Specialism 3" placeholder="Select Sector / Specialism" wire:model.lazy="project.specialism3">
                    @foreach ($all_specialisms as $s)
                        <x-select.option label="{{ $s->specialism }}" value="{{ $s->id }}" />
                    @endforeach
                </x-select>
            </div>

            <div class="p-4">
                <x-label>Project images</x-label>
                <div class="py-4">
                    <table class="min-w-full divide-y divide-gray-200" cols="">
                        <tbody class="bg-white divide-y divide-gray-200" wire:sortable="updateImageOrder">
                            @forelse ($projectImages as $media)
                                <x-table.row wire:sortable.item="{{ $media->id }}" wire:key="{{ $media->id }}" wire:loading.class.delay="opacity-75" class="{{ $loop->odd ?: 'bg-gray-50' }}">
                                    <x-table.cell class="w-16">
                                        <x-button icon="selector" wire:sortable.handle></x-button>
                                    </x-table.cell>
                                    <x-table.cell class="w-32">
                                        <img src="{{ $media->image_large }}" alt="{{ $media->title }}" class="object-contain w-16 mr-3">
                                    </x-table.cell>
                                    <x-table.cell>
                                        <p>{{ $media->title }}</p>
                                        <p class="text-xs">{{ $media->description }}</p>
                                    </x-table.cell>
                                    <x-table.cell class="w-32">
                                        <div class="flex space-x-2">
                                            <x-button primary wire:click="editImage({{ $media->id }})">Edit</x-button>
                                            <x-button wire:click="deleteImage({{ $media->id }})" label="Delete" icon="trash" />
                                        </div>
                                    </x-table.cell>
                                </x-table.row>
                            @empty
                                <p class="py-4 text-sm">No images added to project yet.</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="flex space-x-2">
                    <x-button primary wire:click="editImage('new')">Add image</x-button>
                    @if ($orderUpdated)
                        <x-button secondary wire:click="saveImageOrder()">Save image order</x-button>
                    @endif
                </div>
            </div>

            <div class="p-4">
                <x-toggle lg left-label="Display to public" wire:model.defer="project.display" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="project.sort_order" label="Order in profile" />
            </div>

            <div class="p-4">
                <x-button primary label="Save project" type="submit" ></x-button>
            </div>

        </form>

    </div>

    <x-modal.card
        title="Edit image"
        blur wire:model.defer="showImageModal"
        max-width="5xl"
        align="center"
        >

        <div class="px-4">
            <div class="py-4">
                <x-input wire:model.defer="image.title" label="Title" />
            </div>
            <div class="py-4">
                <x-input wire:model.defer="image.slug" label="Slug" />
            </div>
            <div class="py-4">
                <x-textarea label="Description" placeholder="" wire:model.defer="image.description"></x-textarea>
            </div>
            <div class="py-4">
                <x-toggle lg left-label="Video" wire:model="video" />
            </div>

            <div class="@if ($video || (isset($image->vidurl) && $image->vidurl)) hidden @endif ">
                <x-image-cropper wire:ignore
                    :image="$image->image_large ?? $imageBase64"
                    :viewportWidth="500"
                    :viewportHeight="600"
                    :boundaryWidth="800"
                    :boundaryHeight="800"
                    :inputName="'image'"
                    :listenerName="'updateImage'"
                ></x-image-cropper>
            </div>
            @if ($video)
                <div class="py-4">
                    <x-input wire:model="image.vidurl" label="Video URL (YouTube or Vimeo Only)" />
                    <x-button wire:click="lookupVideo()" primary class="my-3">Lookup Video</x-button>
                </div>
            @endif
            <x-button primary wire:click="storeImage()">
                {{ $imageId == "new" ? "Add image" : "Edit image" }}
            </x-button>
        </div>
    </x-modal>
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
</div>
