<div>
    <div x-data="{ 'isDialogOpen': @entangle('showImageModal') }"
      @keydown.escape="isDialogOpen = false"
      class="cursor-pointer">
        <div class="grid" @click="isDialogOpen = true">
            <img
                    src="{{ $project->cover_large ?? asset('img/ava1.png') }}"
                    alt="{{ $project->title }} ArtsThread Profile"
                    title="{{ $project->title }} ArtsThread Profile" class="profileimg upload-image-img" style="width: 100%; height: 100%">
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
                            :inputName="'portfolioImage'"
                            :listenerName="'updateCoverImage'"
                            :saveFunc="'saveCoverImage'"
                            :enableResize="'false'"
                        ></x-image-cropper-portfolio>

                </div>
            </div><!-- /dialog -->
        </div><!-- /overlay -->

    </div>

</div>
