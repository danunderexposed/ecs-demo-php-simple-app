<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
        @if ($competitionId != 'new')
            {{ __('Edit Competition') }}
        @else
            {{ __('Add Competition') }}
        @endif
    </x-page-header>

    <div class="max-w-5xl mx-auto mt-8">

        <form wire:submit.prevent="store">

            <div class="p-4">
                <x-input wire:model.defer="competition.name" label="Competition Name / Title" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="competition.slug" label="Competition Link (Leave Blank For None)" />
            </div>

            <div class="p-4">
                <x-select label="Competition Status" placeholder="Select status" :searchable="false" wire:model.lazy="competition.status">
                    <x-select.option label="Open For Submission" value="submission"></x-select.option>
                    <x-select.option label="Display Only (No Entries)" value="display"></x-select.option>
                    <x-select.option label="Closed For Review" value="review"></x-select.option>
                    <x-select.option label="Open For Voting" value="voting"></x-select.option>
                    <x-select.option label="Winner Announced" value="winner"></x-select.option>
                    <x-select.option label="Shortlist Announced" value="shortlist"></x-select.option>
                    <x-select.option label="Competition Finished (Status: Winner Announced)" value="finished-winner"></x-select.option>
                </x-select>
            </div>

            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Display In Profile Dropdown</x-label>
                <x-toggle lg wire:model.defer="competition.profiledisplay" />
            </div>

            <div class="p-4">
                <x-label>Competition image</x-label>
                <x-image-cropper wire:ignore
                    :image="$competitionImage ? $competitionImage : $competition->image"
                    :viewportWidth="1185"
                    :viewportHeight="508"
                    :boundaryWidth="1200"
                    :boundaryHeight="550"
                    :inputName="'competitionImage'"
                    :listenerName="'updateImage'"
                ></x-image-cropper>
            </div>

            <div class="p-4">
                <x-rich-text class="description" model="about" label="Competition Description / Details" placeholder="Type text...">
                    {!! $competition->description !!}
                </x-rich-text>
            </div>

            <div class="w-64 p-4">
                <x-datetime-picker
                    without-timezone
                    label="Competition Start Date"
                    placeholder="Competition Start Date"
                    wire:model="competition.start_date"
                />
            </div>
            <div class="w-64 p-4">
                <x-datetime-picker
                    without-timezone
                    label="Competition End Date"
                    placeholder="Competition End Date"
                    wire:model="competition.end_date"
                />
            </div>
            <div class="w-64 p-4">
                <x-datetime-picker
                    without-timezone
                    label="Submission Deadline Date"
                    placeholder="Submission Deadline Date"
                    wire:model="competition.deadline"
                />
            </div>
            <div class="w-64 p-4">
                <x-datetime-picker
                    without-timezone
                    label="Voting Start Date"
                    placeholder="Voting Start Date"
                    wire:model="competition.votestart"
                />
            </div>
            <div class="w-64 p-4">
                <x-datetime-picker
                    without-timezone
                    label="Voting End Date"
                    placeholder="Voting End Date"
                    wire:model="competition.voteend"
                />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Preview</x-label>
                <x-toggle lg wire:model.defer="competition.voteoverride" />
            </div>
            <div class="w-64 p-4">
                <x-datetime-picker
                    without-timezone
                    label="Winner Announced Date"
                    placeholder="Winner Announced Date"
                    wire:model="competition.winnerdate"
                />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Competition Active</x-label>
                <x-toggle lg wire:model.defer="competition.active" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Display Competition Entries</x-label>
                <x-toggle lg wire:model.defer="competition.entrydisplay" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Display Voting Entries</x-label>
                <x-toggle lg wire:model.defer="competition.entrydisplayvote" />
            </div>
            <div class="p-4">
                <x-input wire:model.defer="competition.entrytitle" label="Competition Entries Section Title" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Featured Competition</x-label>
                <x-toggle lg wire:model.defer="competition.featured" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Display Other Competitions In Sidebar</x-label>
                <x-toggle lg wire:model.defer="competition.compdisplay" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Display Adverts In Sidebar</x-label>
                <x-toggle lg wire:model.defer="competition.addisplay" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Display Competition Winners</x-label>
                <x-toggle lg wire:model.defer="competition.winnerdisplay" />
            </div>
            <div class="p-4">
                <x-input wire:model.defer="competition.winnertitle" label="Winners Section Title" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Hide Competition Details</x-label>
                <x-toggle lg wire:model.defer="competition.hidedetails" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Only Show In Portfolio</x-label>
                <x-toggle lg wire:model.defer="competition.onlyportfolio" />
            </div>
            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Display Sort Filters If Applicable</x-label>
                <x-toggle lg wire:model.defer="competition.displayfilters" />
            </div>

            <div class="p-4"><hr></div>
            <h3 class="p-4">Voting Selection</h3>

            <div class="p-4">
                <x-rich-text class="headexcerpt" model="about" label="Competition Header Excerpt (Voting / Winners Only)" placeholder="Type text...">
                    {!! $competition->headexcerpt !!}
                </x-rich-text>
            </div>

            <div class="p-8 bg-white rounded-md mb-8">
                <h3 class="mb-5 text-xl font-bold">Projects Selected for Voting</h3>
                <div class="flex flex-wrap">
                    @forelse ($competition->votingEntries() as $p)
                        <div class="w-48 p-3" id="module-{{ $p->id }}">
                            <x-card title="" padding="" shadow="" >
                                <x-slot name="header">
                                    <div class="p-3">
                                        <p class="text-sm">{!! $p->project->title !!}</p>
                                        <p class="text-xs">{!! $p->project->user->name !!}</p>
                                    </div>
                                </x-slot>
                                <div class="relative">
                                    <img src="{{ $p->project->cover_small }}" alt="" class="object-none object-center w-48 h-40">
                                    <x-button xs wire:click="removeEntry('{{ $p->id }}')" negative icon="trash" class="absolute bottom-2 right-2"></x-button>
                                </div>
                            </x-card>
                        </div>
                    @empty
                        <p class="my-4">No entries yet</p>
                    @endforelse
                </div>
                <x-button primary label="Add Project" wire:click="showAdd('voting')"></x-button>
            </div>

            <h3 class="mb-5 text-xl font-bold py-4">Winners / Runner Ups / Shortlisted & Popular Entries</h3>

            <div class="p-8 bg-white rounded-md mb-8">
                <h3 class="mb-5 text-xl font-bold">Winners</h3>
                <div class="flex flex-wrap">
                    @forelse ($competition->winnerEntries() as $p)
                        <div class="w-48 p-3" id="module-{{ $p->id }}">
                            <x-card title="" padding="" shadow="" >
                                <x-slot name="header">
                                    <p class="p-3 text-xs">{!! $p->project->title !!}</p>
                                </x-slot>
                                <x-slot name="footer">
                                    <x-button xs wire:click="removeEntry('{{ $p->id }}')" negative icon="trash" class="float-right"></x-button>
                                </x-slot>
                                <img src="{{ $p->project->cover_small }}" alt="" class="object-none object-center w-48 h-40">
                            </x-card>
                        </div>
                    @empty
                        <p class="my-4">No entries yet</p>
                    @endforelse
                </div>
                <x-button secondary label="Add Project" wire:click="showAdd('winner')"></x-button>
            </div>

            <div class="p-8 bg-white rounded-md mb-8">
                <h3 class="mb-5 text-xl font-bold">Runner Ups</h3>
                <div class="flex flex-wrap">
                    @forelse ($competition->runnerupEntries() as $p)
                        <div class="w-48 p-3" id="module-{{ $p->id }}">
                            <x-card title="" padding="" shadow="" >
                                <x-slot name="header">
                                    <p class="p-3 text-xs">{!! $p->project->title !!}</p>
                                </x-slot>
                                <x-slot name="footer">
                                    <x-button xs wire:click="removeEntry('{{ $p->id }}')" negative icon="trash" class="float-right"></x-button>
                                </x-slot>
                                <img src="{{ $p->project->cover_small }}" alt="" class="object-none object-center w-48 h-40">
                            </x-card>
                        </div>
                    @empty
                        <p class="my-4">No entries yet</p>
                    @endforelse
                </div>
                <x-button secondary label="Add Project" wire:click="showAdd('runnerup')"></x-button>
            </div>

            <div class="p-8 bg-white rounded-md mb-8">
                <h3 class="mb-5 text-xl font-bold">Shortlisted</h3>
                <div class="flex flex-wrap">
                    @forelse ($competition->shortlistEntries() as $p)
                        <div class="w-48 p-3" id="module-{{ $p->id }}">
                            <x-card title="" padding="" shadow="" >
                                <x-slot name="header">
                                    <p class="p-3 text-xs">{!! $p->project->title !!}</p>
                                </x-slot>
                                <x-slot name="footer">
                                    <x-button xs wire:click="removeEntry('{{ $p->id }}')" negative icon="trash" class="float-right"></x-button>
                                </x-slot>
                                <img src="{{ $p->project->cover_small }}" alt="" class="object-none object-center w-48 h-40">
                            </x-card>
                        </div>
                    @empty
                        <p class="my-4">No entries yet</p>
                    @endforelse
                </div>
                <x-button secondary label="Add Project" wire:click="showAdd('shortlist')"></x-button>
            </div>

            <div class="p-8 bg-white rounded-md mb-8">
                <h3 class="mb-5 text-xl font-bold">Popular</h3>
                <div class="flex flex-wrap">
                    @forelse ($competition->popularEntries() as $p)
                        <div class="w-48 p-3" id="module-{{ $p->id }}">
                            <x-card title="" padding="" shadow="" >
                                <x-slot name="header">
                                    <p class="p-3 text-xs">{!! $p->project->title !!}</p>
                                </x-slot>
                                <x-slot name="footer">
                                    <x-button xs wire:click="removeEntry('{{ $p->id }}')" negative icon="trash" class="float-right"></x-button>
                                </x-slot>
                                <img src="{{ $p->project->cover_small }}" alt="" class="object-none object-center w-48 h-40">
                            </x-card>
                        </div>
                    @empty
                        <p class="my-4">No entries yet</p>
                    @endforelse
                </div>
                <x-button secondary label="Add Project" wire:click="showAdd('popular')"></x-button>
            </div>

            <div class="flex flex-wrap justify-between max-w-md p-4">
                <x-label>Preview</x-label>
                <x-toggle lg wire:model.defer="competition.preview" />
            </div>
            <div class="p-4">
                <x-button primary label="Save competition" type="submit" ></x-button>
            </div>

        </form>

    </div>

    <x-modal.card title="Search Projects" blur wire:model.defer="isAdding" align="center" fullscreen="true">

        <form class="w-full">

            <div class="p-4">
                <x-input wire:model.debounce="projectSearch" label="Search Projects" />
            </div>

            <div class="flex flex-wrap p-4 py-4">

                @foreach ($projectSearchResults as $p)
                    <div class="max-w-xs p-2">
                        <x-card title="{!! $p->title !!}" padding="" >
                            <x-slot name="footer">
                                <x-button wire:click="addProject('{{ $p->id }}', '{{ $addSection }}')" positive icon="plus" class="float-right">Add</x-button>
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
