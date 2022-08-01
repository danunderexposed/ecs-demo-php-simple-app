@extends('layouts.frontend')

@section('content')
<div class="default-header-content">
	<div class="container"><h1>Forgot Password</h1></div>
</div>
<div class="default-content">
	<div class="container">
		<div class="content">

        <div class="catmaincol">
        <article id="page" class="d1-d8 t-all m-all page single news">
            @if (session('status'))
                <h5>PASSWORD RESET PROCESSED. CHECK YOUR EMAIL FOR CONFIRMATION LINK. PLEASE ENSURE YOU ALSO CHECK YOUR SPAM OR JUNK FOLDER.</h5>
            @else
            <h5>FILL IN THE FORM BELOW TO RESET YOUR PASSWORD {{ isset($status) ? $status : '' }}</h5>
            <form method="POST" action="{{ route('frontend.forgot-password-submit') }}">
                @csrf
                <x-jet-validation-errors class="mb-4" />
                <div class="mt-4">
                    <x-jet-input id="email" class="block w-full mt-1" type="text" name="email" :value="old('email')" required autofocus autocomplete="firstname" placeholder="Enter email"/>
                </div>

                <div class="d2-d7 d-clear">
                    <input type="submit" name="reset" value="Reset Password" class="button no-top-margin">
                </div>

                {!! htmlScriptTagJsApi() !!}

            </form>
            @endif
        </article>
        </div>

    </div>
</div>
</div>
@endsection
