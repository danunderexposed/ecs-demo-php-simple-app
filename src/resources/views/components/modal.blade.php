<div x-data="{
        show: @entangle($attributes->wire('model')).defer
    }"
    x-show="show"
    x-on:keydown.escape.window="show = false"
    {{ $attributes->merge(['class' => 'fixed inset-0 z-10 overflow-y-auto ease-out duration-400']) }} >
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
