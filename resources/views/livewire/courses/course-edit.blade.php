<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
        @if ($courseId != 'new')
            {{ __('Edit Course') }}
        @else
            {{ __('Add Course') }}
        @endif
    </x-page-header>

    <div class="max-w-5xl mx-auto mt-8">

        <form wire:submit.prevent="store">

            <div class="p-4">
                <x-input wire:model.defer="course.name" label="Course Name / Title" />
            </div>

            <div class="p-4">
                <x-select label="Study Level" placeholder="Select Study Level" wire:model.lazy="course.studylevel_id">
                    @foreach ($all_studylevels as $s)
                        <x-select.option label="{{ $s->studylevel }}" value="{{ $s->id }}" />
                    @endforeach
                </x-select>
            </div>

            <div class="p-4">
                <x-select label="Sector / Specialism" placeholder="Select Sector / Specialism" wire:model.lazy="course.specialism">
                    @foreach ($all_specialisms as $s)
                        <x-select.option label="{{ $s->specialism }}" value="{{ $s->id }}" />
                    @endforeach
                </x-select>
            </div>

            <div class="p-4">
                <x-select label="Sector / Specialism 2" placeholder="Select Sector / Specialism" wire:model.lazy="course.specialism2">
                    @foreach ($all_specialisms as $s)
                        <x-select.option label="{{ $s->specialism }}" value="{{ $s->id }}" />
                    @endforeach
                </x-select>
            </div>

            <div class="p-4">
                <x-select label="Sector / Specialism 3" placeholder="Select Sector / Specialism" wire:model.lazy="course.specialism3">
                    @foreach ($all_specialisms as $s)
                        <x-select.option label="{{ $s->specialism }}" value="{{ $s->id }}" />
                    @endforeach
                </x-select>
            </div>

            <div class="p-4">
                <x-label>Course image</x-label>

                <x-image-cropper wire:ignore
                    :image="$courseImage ? $courseImage : $course->image"
                    :viewportWidth="1185"
                    :viewportHeight="508"
                    :boundaryWidth="1200"
                    :boundaryHeight="550"
                    :inputName="'courseImage'"
                    :listenerName="'updateImage'"
                ></x-image-cropper>

            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.image" label="Main image link" />
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.image" label="Course Logo link" />
            </div>

            <div class="p-4">
                {{-- <input  type="hidden" name="about" wire:model.lazy="course.about" class="about-raw" /> --}}
                <x-rich-text class="about" model="about" label="About / Description" placeholder="Type text...">
                    {!! $course->about !!}
                </x-rich-text>
            </div>

            <div class="p-4">
                <x-select label="School / University" placeholder="Select School / University" wire:model.lazy="course.school_id">
                    @foreach ($all_schools as $s)
                        <x-select.option label="{{ $s->school }}" value="{{ $s->id }}" />
                    @endforeach
                </x-select>
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.division" label="Faculty / Division" />
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.address1" label="Address 1" />
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.address2" label="Address 2" />
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.postcode" label="Postcode / Zip" />
            </div>

            <div class="p-4">
                <x-select label="Select City" placeholder="Select City" wire:model.lazy="course.city_id">
                    @foreach ($all_cities as $c)
                        <x-select.option label="{{ $c->name }}" value="{{ $c->id }}" />
                    @endforeach
                </x-select>
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.leadertitle" label="Leader Title" />
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.leadername" label="Leader Name" />
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.contactemail" label="Contact Email" />
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.contacturl" label="Contact URL" />
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.admissionemail" label="Admission Email" />
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.admissionurl" label="Admission URL" />
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.tel" label="Telephone Number" />
            </div>

            <div class="p-4">
                <x-input wire:model.lazy="course.website" label="Website" />
            </div>

            <div class="p-4">
                <x-toggle lg left-label="Course Active" wire:model.defer="course.active" />
            </div>

            <div class="p-4">
                <x-toggle lg left-label="Notification When Someone Adds This Course" wire:model.defer="course.coursenotify" />
            </div>

            <div class="p-4">
                <x-button primary label="Save Course" type="submit" ></x-button>
            </div>

        </form>

    </div>

</div>
