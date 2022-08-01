<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <div class="block p-1">
                <svg width="110.151" height="48" xmlns="http://www.w3.org/2000/svg"><g fill="#000" fill-rule="evenodd"><path d="M19.644 11.659a5.484 5.484 0 100-10.968 5.484 5.484 0 000 10.968M19.425 14.2l-5.702 10.226h11.405L19.425 14.2M9.076 14.165H3.273l-2.901 5.15 2.901 5.152h5.803l2.901-5.151-2.901-5.151M6.175 0L0 6.174l6.175 6.175 6.174-6.175L6.175 0M95.388 16.866l-2.908 4.792c2.544 2.412 5.056 3.47 8.393 3.47 5.551 0 9.054-3.404 9.054-8.328 0-4.361-2.313-5.914-6.51-7.038-2.148-.562-3.767-.925-3.767-2.61 0-1.124 1.025-1.983 2.61-1.983 1.455 0 3.04.628 4.528 1.883l2.015-4.626c-2.048-1.42-4.361-2.114-7.005-2.114-4.956 0-8.162 3.271-8.162 7.666 0 3.7 2.082 5.419 6.345 6.542 2.676.694 3.965 1.256 3.965 3.14 0 1.387-1.157 2.445-2.94 2.445-1.885 0-3.735-1.09-5.618-3.239zM79.46 24.5h6.444V6.458h5.287V.873H74.207v5.585h5.254zm-24.583 0h6.046v-9.252l5.42 9.252h7.269l-6.443-9.516c3.436-.727 5.286-3.073 5.286-6.741 0-2.445-.925-4.46-2.643-5.782C67.797.906 65.286.873 62.015.873h-7.137zm6.046-12.457V5.83h1.29c2.675 0 3.898.793 3.898 3.271 0 2.082-1.288 2.941-3.998 2.941zm-23.658 3.635l2.38-7.799c.098-.363.396-1.42.825-3.172.43 1.752.694 2.81.793 3.172l2.412 7.799zm-9.02 8.822h6.41l1.222-4.23h9.153l1.19 4.23h6.41L44.47.873h-8.063zM92.274 48h5.524c3.303 0 6.052-.111 8.522-1.86 2.499-1.776 3.831-4.525 3.831-8.05 0-3.553-1.332-6.302-3.83-8.05-2.61-1.833-5.58-1.888-9.272-1.888h-4.775zm5.358-4.442V32.593h.916c4.08 0 6.107 1.555 6.107 5.497 0 3.886-1.971 5.468-6.107 5.468zm-20.43-2.97l1.998-6.55c.083-.306.333-1.195.694-2.666.36 1.471.583 2.36.666 2.665l2.026 6.551zM69.621 48h5.386l1.027-3.553h7.69L84.723 48h5.385l-6.856-19.848h-6.774zM55.66 48H67.82v-4.442h-6.884V40.2h6.495v-4.248h-6.495V32.51h6.884v-4.358H55.66zm-17.793 0h5.08v-7.773L47.499 48h6.108l-5.414-7.995c2.887-.61 4.442-2.581 4.442-5.663 0-2.054-.777-3.747-2.22-4.857-1.694-1.305-3.804-1.333-6.552-1.333h-5.996zm5.08-10.465v-5.219h1.082c2.249 0 3.276.666 3.276 2.748 0 1.749-1.083 2.47-3.359 2.47zM16.992 48h5.414v-8.078h7.217V48h5.413V28.152h-5.413v7.717h-7.217v-7.717h-5.414zM4.501 48h5.413V32.843h4.441v-4.69H.087v4.69h4.414z"></path></g></svg>
            </div>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>

        <div class="flex flex-col items-center my-5 space-y-2">
            <a href="{{ route('google-redirect') }}" class="px-6 py-3 mt-4 font-semibold text-center text-gray-900 bg-white border-2 border-gray-500 rounded-md shadow outline-none w-80 hover:bg-blue-50 hover:border-blue-400 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-3 text-gray-900 fill-current" viewBox="0 0 48 48" width="48px" height="48px"><path fill="#fbc02d" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12 s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20 s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#e53935" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039 l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4caf50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36 c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1565c0" d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571 c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path></svg>
                Login with Google
            </a>
            <a href="{{ route('facebook-redirect') }}" class="px-6 py-3 mt-4 font-semibold text-center text-gray-900 bg-white border-2 border-gray-500 rounded-md shadow outline-none hover:bg-blue-50 hover:border-blue-400 focus:outline-none w-80">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="inline w-4 h-4 mr-3 text-gray-900 fill-current"  width="48px" height="48px" viewBox="0 0 48 48" version="1.1">
                    <g id="surface1">
                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(23.137255%,34.901961%,59.607843%);fill-opacity:1;" d="M 45.207031 47.839844 C 46.660156 47.839844 47.839844 46.660156 47.839844 45.207031 L 47.839844 2.792969 C 47.839844 1.339844 46.660156 0.160156 45.207031 0.160156 L 2.792969 0.160156 C 1.335938 0.160156 0.160156 1.339844 0.160156 2.792969 L 0.160156 45.207031 C 0.160156 46.660156 1.335938 47.839844 2.792969 47.839844 Z M 45.207031 47.839844 "/>
                    <path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 33.058594 47.839844 L 33.058594 29.375 L 39.257812 29.375 L 40.183594 22.179688 L 33.058594 22.179688 L 33.058594 17.585938 C 33.058594 15.503906 33.636719 14.082031 36.625 14.082031 L 40.433594 14.082031 L 40.433594 7.644531 C 39.777344 7.558594 37.515625 7.363281 34.882812 7.363281 C 29.386719 7.363281 25.628906 10.714844 25.628906 16.875 L 25.628906 22.179688 L 19.414062 22.179688 L 19.414062 29.375 L 25.628906 29.375 L 25.628906 47.839844 Z M 33.058594 47.839844 "/>
                    </g>
                </svg>
                Login with Facebook
            </a>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
