<div>

    <x-notifications />
    <x-dialog />
    <x-page-header name="header">
        {{ __('View Message') }}
    </x-page-header>

    <div class="max-w-5xl mx-auto mt-8">

        <div class="flex flex-col p-4 space-y-4">
            <div>
                <p class="font-bold">User (Message Sent To):</p>
                <p>{{ $message->username; }} - (<a class="underline" href="mailto:{{ $message->useremail }}">{{ $message->useremail }}</a>)</p>
            </div>
            <div>
                <p class="font-bold">Sender (Message Sent From):</p>
                <p>{{ $message->messagername; }} - (<a class="underline" href="mailto:{{ $message->messageremail }}">{{ $message->messageremail }}</a>)</p>
            </div>
            <div>
                <p class="font-bold">User IP Address:</p>
                <p>{{ $message->ip }}</p>
            </div>
            <div>
                <p class="font-bold">Subject:</p>
                <p>{{ $message->subject }}</p>
            </div>
            <div>
                <p class="font-bold">Category:</p>
                <p>{{ $message->category }}</p>
            </div>
            <div>
                <p class="font-bold">Message:</p>
                <p>{!! $message->message !!}</p>
            </div>
        </div>

        <div class="p-4">
            <div class="flex space-x-2">
                <x-button label="Back" icon="chevron-left" wire:click="back()"/>
                <x-button
                    wire:click="delete({{ $message->id }})"
                    label="Delete"
                    icon="trash"
                    negative
                    />
            </div>
        </div>
    </div>

</div>
