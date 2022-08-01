<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
        @if ($pageId != 'new')
            {{ __('Edit Page') }}
        @else
            {{ __('Add Page') }}
        @endif
    </x-page-header>

    <div class="max-w-5xl mx-auto mt-8">

        <form wire:submit.prevent="store">

            <div class="p-4">
                <x-input wire:model.defer="page.title" label="Page Name / Title" />
            </div>

            <div class="p-4">
                <x-input wire:model.defer="page.slug" label="Page Link (Leave Blank For None)" />
            </div>

            <div class="p-4">
                <x-rich-text class="content" model="page.content" label="Page Content" placeholder="Type text...">
                    {!! $page->content !!}
                </x-rich-text>
            </div>

            <div class="p-4">
                <x-select label="Status" placeholder="Status" :searchable="false" wire:model.defer="page.status">
                    <x-select.option label="Published" value="publish"></x-select.option>
                    <x-select.option label="Private" value="private"></x-select.option>
                </x-select>
            </div>

            <div class="p-4">
                <x-button primary label="Save Page" type="submit" ></x-button>
            </div>

        </form>

    </div>
</div>
