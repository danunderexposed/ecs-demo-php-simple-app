<div>
    <div x-data="{ 'isDialogOpen': @entangle('showImageModal') }"
      @keydown.escape="isDialogOpen = false"
      class="cursor-pointer">
        <div >
            <h4 style="margin-bottom:30px;"><span class="white">Image(s) / Video:</span></h4>
            <div class="clear"></div>
            <div id="item-sort-container">
                <div id="item-sorter" wire:sortable="updateImageOrder">
                    @foreach($project->media as $index => $media)
                    <div class="item" data-type="image" data-mediaid="" wire:sortable.item="{{ $media->id }}" wire:key="{{ $media->id }}" wire:loading.class.delay="opacity-75" >
                        <div class="close"></div>
                        <div class="item-head" wire:sortable.handle>
                            <div class="image">
                                @if ($media->image_small)
                                <img src="{{ $media->image_small }}" >
                                @else
                                <img src="https://s3-eu-west-1.amazonaws.com/artsthread-content/images/projects/97b45f443652ce8be908b720429d0fef_medium.png" alt="">
                                @endif
                            </div>
                            <div class="flex flex-col">
                                <input
                                    @if ($media->is_video)
                                    wire:model.debounce="project.media.{{ $index }}.vidurl"
                                    value="{{ $media->vidurl }}"
                                    @else
                                    value="{{ $media->title }}"
                                    wire:model.debounce="project.media.{{ $index }}.title"
                                    @endif
                                    wire:change="$emit('imageTitleUpdate', {{ $media->id }})"
                                    type="text"
                                    name="title"

                                    class="imagetitle"
                                    autocomplete="off"
                                    @if (!$media->image_small)
                                    placeholder="Enter Youtube or Vimeo URL"
                                    @else
                                    placeholder="Enter Title For Image"
                                    @endif
                                    />
                                <p class="instruction">Click &amp; Hold To Drag Into Order</p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
            <a @click="isDialogOpen = true" href="#" class="update-profile-button adder left dc-uploader"
                data-upload="https://www.artsthread.com/upload/?type=projectimagesadd">Add Image(s)</a>
            <a wire:click="addVideo()" href="#" class="update-profile-button adder right video">Add Video</a>
            <div class="clear"></div>
            <div class="selectline" style="margin-top:30px;margin-bottom:30px;"></div> <button type="submit"
                class="update-profile-button save-project-go">Save Project</button>
        </div>

        <!-- overlay -->
        <div
            class="overflow-auto"
            style="background-color: rgba(0,0,0,0)"
            x-show="isDialogOpen"
            :class="{ 'absolute inset-0 z-10 flex items-start justify-center': isDialogOpen }"
            x-cloak
        >
            <!-- dialog -->
            <div
                class="m-4 bg-white shadow-2xl min-w-min sm:m-8"
                x-show="isDialogOpen"
                @click.away="isDialogOpen = false"
            >
                <div class="flex items-center justify-end p-2 text-xl border-b">
                    <button type="button" @click="isDialogOpen = false">✖</button>
                </div>
                <div class="p-2">
                    <!-- content -->

                        <x-image-cropper-portfolio wire:ignore
                            :image="$imageMain"
                            :viewportWidth="600"
                            :viewportHeight="424"
                            :boundaryWidth="650"
                            :boundaryHeight="500"
                            :inputName="'portfolioGalleryImage'"
                            :listenerName="'updateImageGallery'"
                            :saveFunc="'savePortfolioImage'"
                            :enableResize="'true'"
                        ></x-image-cropper-portfolio>

                </div>
            </div><!-- /dialog -->
        </div><!-- /overlay -->

    </div>
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
</div>

