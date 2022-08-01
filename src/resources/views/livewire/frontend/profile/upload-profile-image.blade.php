<div>
    <div x-data="{ 'isDialogOpen': @entangle('showImageModal') }"
      @keydown.escape="isDialogOpen = false"
      class="cursor-pointer">
        <div class="grid" style="margin-top:20px;" @click="isDialogOpen = true">
            <img
                    src="{{ $user->profile_image ?? asset('img/ava1.png') }}"
                    alt="{{ $user->name }} ArtsThread Profile"
                    title="{{ $user->name }} ArtsThread Profile" class="">
        </div>

        <!-- overlay -->
        <div
            class="overflow-auto"
            style="background-color: rgba(0,0,0,0)"
            x-show="isDialogOpen"
            :class="{ 'absolute inset-0 z-10 flex items-start justify-center': isDialogOpen }"
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

                        <x-image-cropper-profile wire:ignore
                            :image="$imageMain"
                            :viewportWidth="420"
                            :viewportHeight="314"
                            :boundaryWidth="480"
                            :boundaryHeight="550"
                            :viewportWidth2="420"
                            :viewportHeight2="544"
                            :boundaryWidth2="480"
                            :boundaryHeight2="550"
                            :inputName="'profileImage'"
                            :listenerName="'updateImageMain'"
                            :listenerName2="'updateImageMini'"
                            :enableResize="'false'"
                        ></x-image-cropper-profile>

                </div>
            </div><!-- /dialog -->
        </div><!-- /overlay -->

    </div>

</div>
