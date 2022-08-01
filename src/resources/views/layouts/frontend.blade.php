<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
    navActive: false,
    mainAccountDropdown: false
}"  :class="navActive ? 'nav-toggled' : ''">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/tailwind.css') }}">
    <link rel="stylesheet" href="{{ mix('css/main.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/croppie.js') }}" defer></script>
    <script src="{{ mix('js/main.js') }}" defer></script>
    <!-- Google Translate Scripts //-->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT,
                multilanguagePage: true,
                gaTrack: true,
                gaId: 'UA-9810743-1'
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    @wireUiScripts
    @livewireStyles
    @livewireScripts

</head>

<body id="top">
    <header class="mainheader @auth at-loggedin @endauth" id="headernav">

        <h1 class="mainheader__logo">
            <a href="/" title="Homepage">Arts Thread</a></h1>
        </h1>

        <button class="mainheader__togglenav" :class="navActive ? 'is-active' : ''" aria-controls="primary-menu" :aria-expanded="navActive" @click="navActive = !navActive">
            <span class="mainheader__togglenav__burger"></span>
        </button>

        <div class="mainheader__overlay"></div>

        <nav class="visiblenav-left">
            <div class="visiblenav-left__inner">
                <a href="/portfolios/"
                    class="a-portfolios @if(Request::is('/portfolios'))is-active @endif">Portfolios</a>
                <a href="/schools/"
                    class="a-schools  @if(Request::is('/schools'))is-active @endif">Universities/Schools</a>
                <a href="/competitions/"
                    class="a-competitions  @if(Request::is('/competitions'))is-active @endif">Competitions/Challenges</a>
                <a href="/events/globaldesigngraduateshow/"
                    class="a-gdgs  @if(Request::is('/events/globaldesigngraduateshow'))is-active @endif">GLOBAL DESIGN
                    GRADUATE SHOW</a>
            </div>
        </nav>

        <style>
            #account-svg {
                display: block;
                width: 18px;
                height: auto;
            }

            #account-svg #account-svg-path {
                transition: fill .2s ease;
            }

            #account-svg:hover #account-svg-path {
                fill: #e91515;
            }

            .visiblenav__newsletter .icon--newsletter {
                margin-top: -4px;
            }
        </style>

        <nav class="visiblenav">
            <div class="visiblenav__inner">
                <div class="hide-sml">
                    <x-at.socials/>
                </div>
                <a href="http://eepurl.com/6SL6D" target="_blank" class="visiblenav__newsletter"><i
                        class="icon--newsletter"></i> <span>Newsletter</span></a>
                <a class="visiblenav__account js-dropdown"
                @click.prevent="mainAccountDropdown = !mainAccountDropdown"
                 href=""
                    title="Registration &amp; Login">
                    @auth
                    <svg id="account-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path id="account-svg-path"
                            d="M19 7.001A7 7 0 1 1 4.999 7 7 7 0 0 1 19 7zm-1.598 7.18A8.937 8.937 0 0 1 12 16.001a8.953 8.953 0 0 1-5.407-1.822C2.521 15.972 0 21.555 0 24h24c0-2.423-2.6-8.006-6.598-9.819z"
                            fill="#fff" /></svg>
                    @endauth
                    @guest
                    Login
                    @endguest
                </a>
            </div>
        </nav>

        <nav class="slidernav" :aria-expanded="navActive">
            <ul>
            <li id="menu-item-109" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="/portfolios/" class="mlink portfolio" title="Portfolios">Portfolios</a></li>
<li id="menu-item-110" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="/schools/" class="mlink schools" title="Universities/Schools">Universities/Schools</a></li>
<li id="menu-item-107" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="/competitions/" class="mlink competition" title="Competitions/Challenges">Competitions/Challenges</a></li>
<li id="menu-item-78440" class="menu-item menu-item-type-custom menu-item-object-custom"><a href="https://artsthread.com/events/globaldesigngraduateshow/" class="mlink" title="GLOBAL DESIGN GRADUATE SHOW">GLOBAL DESIGN GRADUATE SHOW</a></li>
<li id="menu-item-83460" class="menu-item menu-item-type-custom menu-item-object-custom"><a href="/events/fashion-graduate-italia" class="mlink" title="Fashion Graduate Italia 2021">Fashion Graduate Italia 2021</a></li>
<li id="menu-item-108" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="/events/" class="mlink events" title="Events/Exhibitions">Events/Exhibitions</a></li>
<li id="menu-item-83542" class="menu-item menu-item-type-custom menu-item-object-custom"><a href="/news/" class="mlink" title="News/Editorial">News/Editorial</a></li>
<li id="menu-item-106" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="/jobs/" class="mlink jobs" title="Jobs">Jobs</a></li>
<li id="menu-item-73738" class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="/category/practical/opportunities/" class="mlink" title="Opportunities">Opportunities</a></li>
<li id="menu-item-73739" class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="/category/practical/practical-guides/" class="mlink" title="CAREERS/Business START UP">CAREERS/Business START UP</a></li>
<li id="menu-item-104" class="menu-item menu-item-type-post_type menu-item-object-page page_item page-item-99"><a href="/partners/" class="mlink partners perm" title="Partners">Partners</a></li>

                        <li><a class="news grey" href="http://eepurl.com/6SL6D" title="Newsletter" target="_blank">Newsletter</a></li>


        <li class="hide-med-lrg">
            <ul class="socials">
    <li><a class="icon--instagram" href="http://instagram.com/artsthread" target="_blank" title="Instagram">Instagram</a></li>
    <li><a class="icon--youtube" href="https://www.youtube.com/channel/UCSf4iWyiVVfNR7c6uvw3fJA" target="_blank" title="Youtube">Youtube</a></li>
    <li><a class="icon--linkedin" href="https://www.linkedin.com/company/arts-thread" target="_blank" title="LinkedIn">LinkedIn</a></li>
    <li><a class="icon--facebook" href="https://www.facebook.com/pages/ARTS-THREAD/59872431441" target="_blank" title="Facebook">Facebook</a></li>
    <li><a class="icon--vimeo" href="http://vimeo.com/artsthread" target="_blank" title="Vimeo">Vimeo</a></li>
    <li><a class="icon--twitter" href="https://twitter.com/artsthread" target="_blank" title="Twitter">Twitter</a></li>
    <li><a class="icon--pinterest" href="http://www.pinterest.com/artsthread/" target="_blank" title="Pinterest">Pinterest</a></li>
            </ul>
        </li>
                @auth
                <li id="menu-item-12" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="/logout"
                        class="mlink practical" title="Logout">Logout</a></li>
                @endauth

                <!-- Translate Bar //-->
                <li class="slidernav__translate">
                    <x-at.translate-select />
                </li>
                <!-- Translate Bar //-->


                <li class="hide-med-lrg">
                    <x-at.socials/>
                </li>
            </ul>
        </nav>

    </header>

    <!-- Account Dropdown //-->
    <div id="mainmenu-account" class="account-dropdown header-dropdown @auth loggedin @endauth" :class="mainAccountDropdown && !navActive ? 'is-visible' : ''">
        @auth

        <div class="account-dropdown__divider">

            <div class="container-fluid wrapper nopad">

                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <h4>Welcome Back <span class="bgblack">@if(auth()->user()->firstname) {{ auth()->user()->firstname }} @endif</span></h4>
                        <form id="logout-form" method="post" action="/logout" style="display: inline">
                            @csrf
                            <button class="account-dropdown__notyou" title="Not You?  Click Here To Logout">
                                Not You?
                            </button>
                        </form>
                    </div>

                    <div class="col-xs-12 col-sm-3">
                        <a class="account-dropdown__updateprofile" href="/profile/">View Profile</a>
                    </div>
                </div>

            </div>

        </div>

        <div class="account-dropdown__bottom-bar">
            <div class="container-fluid wrapper">
                <h5>Profile Options</h5>
                <a href="/profile?edit=true">Edit Profile</a>
                <a id="add-project-header-link" href="/profile?addproject=true"
                    @guest style="display:none;"
                   @endguest>&#43; Project</a>
                <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </div>
        </div>

        @endauth
        @guest
        <div class="container-fluid wrapper nopad">
            <form action="{{ route('login') }}" id="loginform" class="js-ajax-login" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="remember" value="1">
                <input type="hidden" name="frontend" value="1">
                <input type="submit" style="position:absolute;left:-9999px" />
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="account-dropdown__loginform">
                            <h4><span class="bgblack">Login</span> To ArtsThread</h4>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <input type="email" id="login-user" name="email"
                                        placeholder="Enter Email or Username" required />
                                    <label for="login-name" class="account-dropdown__error"
                                        id="frontend-login-error">
                                    </label>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="password" id="login-pass" name="password"
                                        placeholder="Enter Password" required />
                                    <a href="{{ route('frontend.forgot-password') }}" title="Forgotten Your Password?"
                                        class="forgotten">Forgotten Password?</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6" id="account-buttons">
                        <div class="row">
                            <div class="col-xs-12 col-md-4 account-dropdown__login">
                                <input type="submit" value="login" class="bgblack" id="login-submit" />
                            </div>
                            <div class="col-xs-12 col-md-4 account-dropdown__register">
                                <div>
                                    <a href="{{ route('frontend.register') }}" id="account-register"
                                        title="Register With ArtsThread">
                                        <h4><span class="bgblack">Register</span></h4>
                                        <p>With ArtsThread</p>
                                    </a>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-4 account-dropdown__sociallogin">
                                <div id="account-social">
                                    <h4><span class="bgblack">Login</span> Using</h4>
                                    <div id="social-logins">
                                        {{-- <a href="Twitter/" id="login-twitter"
                                            class="icon--login-twitter" title="Login With Your Twitter Account">Login
                                            With Your Twitter Account</a> --}}
                                        <a href="{{ route('facebook-redirect') }}" id="login-facebook"
                                            title="Login With Your Facebook Account" class="icon--login-facebook">Login
                                            With Your Facebook Account</a>
                                        <a href="{{ route('google-redirect') }}" id="login-linkedin"
                                            title="Login With Your Google Account" class="icon--login-google">Login
                                            With Your Google Account</a>
                                        {{-- <a href="LinkedIn/" id="login-linkedin"
                                            title="Login With Your LinkedIn Account" class="icon--login-linkedin">Login
                                            With Your LinkedIn Account</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        @endguest
    </div>
    <!-- Account Dropdown //-->

    <!-- Search Dropdown //-->
    <div id="mainmenu-search" class="search-dropdown header-dropdown">
        <div class="search-dropdown__inner">
            <form action="/" id="searchform" method="post">
                <div class="wrapper">
                    <div class="row">
                        <div class="col-xs-8 col-sm-9">
                            <input type="text" id="s" name="filter-input-keywords" placeholder="Search Portfolios"
                                value="" required />
                            <input type="hidden" name="filter-main-search" value="1" />
                        </div>
                        <div class="col-xs-4 col-sm-3">
                            <input type="submit" id="searchsubmit" value="Search" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Search Dropdown //-->


    <div id="maincontent">
        @yield('content')
    </div>

    <footer id="footer-container">

		<div id="footer" class="mainfooter">
			<div class="container">

				<div class="five columns alpha">
					<h4>Arts Thread</h4>
                    <a href="/portfolios/" class="" title="Portfolios">Portfolios</a>
                    <a href="/schools/" class="" title="Schools">Schools</a>
                    <a href="/competitions/" class="" title="Competitions">Competitions</a>
                    <a href="/events/globaldesigngraduateshow/" class="" title="GDGS 2020">GDGS 2020</a>
                    <a href="/events/" class="" title="Events">Events</a>
                    <a href="/jobs/" class="" title="Jobs">Jobs</a>
                    <a href="/partners/" class="" title="Partners">Partners</a>
                    <a href="/category/practical/opportunities/" class="" title="Opportunities">Opportunities</a>
                    <a href="/category/practical/practical-guides/" class="" title="CAREERS/BUSINESS START UP">CAREERS/BUSINESS START UP</a>
                    <a href="/login/" class=" loginbutton" title="Login"  @click.prevent="mainAccountDropdown = !mainAccountDropdown">Login</a>
                    <a href="https://artsthread.us1.list-manage.com/subscribe?u=901ab97ac0c7d309037d82bc1&id=a989606bb2" class=" newsletterbutton" title="Newsletter">Newsletter</a>

				</div>

				<div class="five columns">
					<h4>Company Info</h4>
                    <a href="/how-arts-thread-works/" class="" title="How Arts Thread Works">How Arts Thread Works</a>
                    <a href="/arts-thread-success-stories/" class="" title="ARTS THREAD Success Stories">ARTS THREAD Success Stories</a>
                    <a href="/category/industry-endorsements/" class="" title="Industry Endorsements">Industry Endorsements</a>
                    <a href="/arts-thread-education-board/" class="" title="ARTS THREAD EDUCATION BOARD">ARTS THREAD EDUCATION BOARD</a>
                    <a href="/category/arts-thread-advisory-board/" class="" title="Advisory Board">Advisory Board</a>
                    <a href="/arts-thread-creative-career-workshops/" class="" title="Creative Career Workshops">Creative Career Workshops</a>
                    <a href="/support-faq/" class="" title="Support &amp; FAQ">Support &amp; FAQ</a>
                    <a href="/contact-us/" class="" title="Contact Us">Contact Us</a>
                    <a href="/sitemap/" class="" title="Sitemap">Sitemap</a>
                    <a href="/accessibility/" class="" title="Accessibility">Accessibility</a>
                    <a href="/our-cookies/" class="" title="Our Cookies">Our Cookies</a>
                    <a href="/security-privacy/" class="" title="Security &amp; Privacy">Security &amp; Privacy</a>
                    <a href="/terms-conditions/" class="" title="Terms &amp; Conditions">Terms &amp; Conditions</a>
				</div>

				<div class="five columns">
					<h4>Arts Thread News</h4>
					<p class="newstxt">Receive the ARTS THREAD weekly newsletter with all our latest competitions, featured designers and events.</p>
					<br/>
					<p class="newstxt small"><a href="http://eepurl.com/6SL6D" target="_blank">Click here to signup to the ARTS THREAD Newsletter</a></p>
				</div>

				<div class="five columns">
					<h4>Follow Arts Thread</h4>
					<x-at.socials/>
				</div>

				<div class="five columns omega">
					<a href="/" class="full-logo" title="Arts Thread">Arts Thread</a>
					<p class="copyright">&copy; {{ Carbon\Carbon::now()->format('Y') }} Arts Thread Limited.<br/>All Rights Reserved</p>
				</div>

			</div>

			<a href="#top" id="backtotop" class="js-scrollto" >Back To Top</a>

		</div>

	</footer>

    <script>

		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create','UA-9810743-1','artsthread.com');
        @if($user ?? false)
		@auth
			//Set GA Logged In User Var
			ga('set','contentGroup1','Logged In');

			//Set GA User ID Metric
			ga('set','metric1','{{ $user->id }}"');

			//Set GA User ID Dimension
			ga('set','dimension1','{{ $user->id }}"');
        @endauth
        @endif
        @guest
			//Set GA Not Logged In User Var
			ga('set','contentGroup2','Logged Out');
        @endguest
		ga('send','pageview');

	</script>

    @stack('modals')
</body>

</html>
