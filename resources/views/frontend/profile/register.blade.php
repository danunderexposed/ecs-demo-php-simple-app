@extends('layouts.frontend')

@section('content')
<div class="default-header-content">
	<div class="container"><h1>Register</h1></div>
</div>
<div class="default-content">
	<div class="container">
		<div class="content">

        <div class="catmaincol">
        <article id="page" class="d1-d8 t-all m-all page single news">
				<h5>Fill in the form below to register an ArtsThread profile</h5>
				<div class="linebreak" style="margin-bottom:20px;"></div>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('frontend.register-submit') }}">
            @csrf

            <br/>
            <h5>Please Tell Us:</h5>
            <div x-data="{ accept: false }">
                <div class="d2-d7 d-clear atSquareCheckBoxRow">
                    <div class="atSquareCheckBoxHolder"><div class="atSquareCheckBox"><input x-model="accept" class="filter-check" type="checkbox" value="1" name="register-portfolio" id="register-portfolio"  /><label for="register-portfolio"></label></div></div>
                    <h4 id="register-portfolio-clicker" x-bind:style="!accept && { color: 'grey' }">I am registering to create a portfolio</h4>
                </div>

                <h5>Or:<br/><br/><span id="register-type-dropdown-text" x-bind:style="accept && { color: 'grey' }">I am registering to browse, message and appreciate projects as:</span></h5>
                <div class="d2-d7 d-clear">
                    <select class="registerFullWidth" name="register-usertype" id="register-usertype" x-bind:disabled="accept" x-bind:style="accept && { color: 'grey' }">
                        <option value="guest">Guest</option>
                        <option value="industry">Industry Professional</option>
                        <option value="educational">Education Professional</option>
                    </select>
                </div>
            </div>
            <div class="selectline"></div>


            <div class="mt-4">
                <x-jet-input id="firstname" class="block w-full mt-1" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" placeholder="Enter First Name"/>
            </div>
            <div class="mt-4">
                <x-jet-input id="surname" class="block w-full mt-1" type="text" name="surname" :value="old('surname')" required autocomplete="surname" placeholder="Enter Last Name" />
            </div>

            <div class="mt-4">
                <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required placeholder="Enter Email" />
            </div>

            <div class="mt-4">
                <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" placeholder="Enter Password"/>
            </div>

            <div class="mt-4">
                <x-jet-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
            </div>

            <div class="mt-4">
                <div class="d2-d7 d-clear atSquareCheckBoxRow">
					<div class="atSquareCheckBoxHolder">
                        <div class="atSquareCheckBox">
                            <input class="filter-check" type="checkbox" value="1" name="register-agreetc" id="register-agreetc"><label for="register-agreetc"></label>
                        </div>
                    </div>
					<h4 style="font-size:16px; line-height:22px;">Agree To <a href="/terms-conditions/">ArtsThread T&amp;C's</a>.  By registering, you also agree to join the ARTSTHREAD newsletter.  You can unsubscribe from this at any time by emailing us at <a href="/contact-us/">ARTSTHREAD.COM/CONTACT-US</a></h4>
			    </div>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-sm text-gray-600 underline hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-sm text-gray-600 underline hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif


            {!! htmlScriptTagJsApi() !!}


            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>


            </div>
            <input type="submit" name="register" class="button no-top-margin" value="Register">
        </form>
        </article>
        </div>

    </div>
</div>
</div>
@endsection
