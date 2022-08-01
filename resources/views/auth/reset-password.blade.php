<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div class="block p-1">
                <svg width="110.151" height="48" xmlns="http://www.w3.org/2000/svg"><g fill="#000" fill-rule="evenodd"><path d="M19.644 11.659a5.484 5.484 0 100-10.968 5.484 5.484 0 000 10.968M19.425 14.2l-5.702 10.226h11.405L19.425 14.2M9.076 14.165H3.273l-2.901 5.15 2.901 5.152h5.803l2.901-5.151-2.901-5.151M6.175 0L0 6.174l6.175 6.175 6.174-6.175L6.175 0M95.388 16.866l-2.908 4.792c2.544 2.412 5.056 3.47 8.393 3.47 5.551 0 9.054-3.404 9.054-8.328 0-4.361-2.313-5.914-6.51-7.038-2.148-.562-3.767-.925-3.767-2.61 0-1.124 1.025-1.983 2.61-1.983 1.455 0 3.04.628 4.528 1.883l2.015-4.626c-2.048-1.42-4.361-2.114-7.005-2.114-4.956 0-8.162 3.271-8.162 7.666 0 3.7 2.082 5.419 6.345 6.542 2.676.694 3.965 1.256 3.965 3.14 0 1.387-1.157 2.445-2.94 2.445-1.885 0-3.735-1.09-5.618-3.239zM79.46 24.5h6.444V6.458h5.287V.873H74.207v5.585h5.254zm-24.583 0h6.046v-9.252l5.42 9.252h7.269l-6.443-9.516c3.436-.727 5.286-3.073 5.286-6.741 0-2.445-.925-4.46-2.643-5.782C67.797.906 65.286.873 62.015.873h-7.137zm6.046-12.457V5.83h1.29c2.675 0 3.898.793 3.898 3.271 0 2.082-1.288 2.941-3.998 2.941zm-23.658 3.635l2.38-7.799c.098-.363.396-1.42.825-3.172.43 1.752.694 2.81.793 3.172l2.412 7.799zm-9.02 8.822h6.41l1.222-4.23h9.153l1.19 4.23h6.41L44.47.873h-8.063zM92.274 48h5.524c3.303 0 6.052-.111 8.522-1.86 2.499-1.776 3.831-4.525 3.831-8.05 0-3.553-1.332-6.302-3.83-8.05-2.61-1.833-5.58-1.888-9.272-1.888h-4.775zm5.358-4.442V32.593h.916c4.08 0 6.107 1.555 6.107 5.497 0 3.886-1.971 5.468-6.107 5.468zm-20.43-2.97l1.998-6.55c.083-.306.333-1.195.694-2.666.36 1.471.583 2.36.666 2.665l2.026 6.551zM69.621 48h5.386l1.027-3.553h7.69L84.723 48h5.385l-6.856-19.848h-6.774zM55.66 48H67.82v-4.442h-6.884V40.2h6.495v-4.248h-6.495V32.51h6.884v-4.358H55.66zm-17.793 0h5.08v-7.773L47.499 48h6.108l-5.414-7.995c2.887-.61 4.442-2.581 4.442-5.663 0-2.054-.777-3.747-2.22-4.857-1.694-1.305-3.804-1.333-6.552-1.333h-5.996zm5.08-10.465v-5.219h1.082c2.249 0 3.276.666 3.276 2.748 0 1.749-1.083 2.47-3.359 2.47zM16.992 48h5.414v-8.078h7.217V48h5.413V28.152h-5.413v7.717h-7.217v-7.717h-5.414zM4.501 48h5.413V32.843h4.441v-4.69H.087v4.69h4.414z"></path></g></svg>
            </div>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
