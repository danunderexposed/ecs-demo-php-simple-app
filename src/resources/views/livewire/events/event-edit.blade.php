<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
        @if ($eventId != 'new')
            {{ __('Edit Event') }}
        @else
            {{ __('Add Event') }}
        @endif
    </x-page-header>

    <div class="max-w-5xl mx-auto mt-8">

        <form wire:submit.prevent="store">

            <div class="p-4">
                <x-input wire:model.defer="event.name" label="Event Name / Title" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="event.slug" label="Event Link (Leave Blank For None)" />
            </div>

            <div class="p-4">
                <x-label>Event image</x-label>
                <x-image-cropper wire:ignore
                    :image="$eventImage ? $eventImage : $event->image"
                    :viewportWidth="1185"
                    :viewportHeight="508"
                    :boundaryWidth="1200"
                    :boundaryHeight="550"
                    :inputName="'eventImage'"
                    :listenerName="'updateImage'"
                ></x-image-cropper>
            </div>

            <div class="p-4">
                <x-rich-text class="description" model="event.description" label="Event Description / Details" placeholder="Type text...">
                    {!! $event->description !!}
                </x-rich-text>
            </div>

            <div class="w-64 p-4">
                <x-datetime-picker
                    without-timezone
                    label="Event Start Date"
                    placeholder="Event Start Date"
                    wire:model="event.start_date"
                />
            </div>
            <div class="w-64 p-4">
                <x-datetime-picker
                    without-timezone
                    label="Event End Date"
                    placeholder="Event End Date"
                    wire:model="event.end_date"
                />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Event Active</x-label>
                <x-toggle lg wire:model.defer="event.active" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Display Projects Associated To Event?</x-label>
                <x-toggle lg wire:model.defer="event.entrydisplay" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Featured Event</x-label>
                <x-toggle lg wire:model.defer="event.featured" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Projects Require Admin Approval?</x-label>
                <x-toggle lg wire:model.defer="event.approvalrequired" />
            </div>
            <div class="p-4">
                <x-select label="Order In Slider" placeholder="Order In Slider" :searchable="false" wire:model="event.eventorder">
                    <x-select.option label="Select Order" value="0"></x-select.option>
                    <x-select.option label="1st place" value="1"></x-select.option>
                    <x-select.option label="2nd place" value="2"></x-select.option>
                    <x-select.option label="3rd place" value="3"></x-select.option>
                </x-select>
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Display Other Events In Sidebar</x-label>
                <x-toggle lg wire:model.defer="event.eventdisplay" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Display Adverts In Sidebar</x-label>
                <x-toggle lg wire:model.defer="event.addisplay" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Allow Users To Add Their Projects To This Event</x-label>
                <x-toggle lg wire:model.defer="event.eventuseradd" />
            </div>
            <div class="p-8 bg-white rounded-md">
                <h3 class="mb-5 text-xl font-bold">Projects Assigned To Event</h3>
                <div class="flex flex-wrap">
                    @forelse ($event->entries as $p)
                        <div class="max-w-xs p-3" id="module-{{ $p->id }}">
                            <x-card title="{!! $p->project->title !!}" padding="" shadow="" >
                                <x-slot name="footer">
                                    <x-button wire:click="removeProject('{{ $p->id }}')" negative icon="trash" class="float-right"></x-button>
                                </x-slot>
                                <img src="{{ $p->project->cover_small }}" alt="" class="object-none object-center h-72 w-96">
                            </x-card>
                        </div>
                    @empty
                        <p class="my-4">No projects Assigned yet</p>
                    @endforelse
                </div>

                <x-button secondary label="Add Project" wire:click="showAdd()"></x-button>

            </div>
            <div class="p-4">
                <x-button primary label="Save Event" type="submit" ></x-button>
            </div>

        </form>

    </div>

    <x-modal.card title="Add Project" blur wire:model.defer="isAdding" align="center" fullscreen="true">

        <form class="w-full">

            <div class="p-4">
                <x-input wire:model.debounce="projectSearch" label="Search Projects" />
            </div>

            <div class="flex flex-wrap p-4 py-4">

                @foreach ($projectSearchResults as $p)
                    <div class="max-w-xs p-2">
                        <x-card title="{!! $p->title !!}" padding="" >
                            <x-slot name="footer">
                                <x-button wire:click="add('{{ $p->id }}')" positive icon="plus" class="float-right">Add</x-button>
                            </x-slot>
                            <img src="{{ $p->cover_small }}" alt="" class="object-none object-center h-72 w-96">
                        </x-card>
                    </div>
                @endforeach

            </div>

            <x-slot name="footer">
                <div class="flex justify-between gap-x-4">
                    <x-button  x-on:click="close" label="Cancel" />
                </div>
            </x-slot>
        </form>
    </x-modal>

</div>
