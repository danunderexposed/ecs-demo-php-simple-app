<div
    x-data="richText('{{ $class }}', '{{ $input }}')"
    {{-- x-init="model = @entangle($attributes->wire('model'))" --}}
    wire:ignore
>

        <x-label for="" class="mb-5">{{ $label }}</x-label>
        <div class="richText{{ $class }}" style="height:175px">
            {!! $slot !!}
        </div>

</div>
