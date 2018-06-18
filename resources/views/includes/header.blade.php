<nav class="navbar navbar-expand-lg nav-avans">
        <div class="container">
            <a target="_blank" href="http://avans.nl"><img class="img-fluid logo-avans" alt="Avans logo" src="{{ asset('img/logo-avans-white.png') }}"></a>
        </div>
    </nav>
<nav class="navbar navbar-expand-lg nav-group navbar-light">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand order-lg-last" href="{{ route('home') }}">
            <img class="img-fluid" alt="Toolhub logo" src="{{ asset('img/full-logo-toolhub.png') }}">
        </a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav group mr-auto my-2 my-lg-0 text-center text-lg-left w-100">
                <li class="mr-0 mr-lg-4 @if(Route::is('home')) active @endif"><a class="nav-item nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="mr-0 mr-lg-4 @if(Route::is('tools.index')) active @endif"><a class="nav-item nav-link" href="{{ route('tools.index') }}">Alle Tools</a></li>
                <!-- Authentication Links -->
                @guest
                    <li class="mr-0 mr-lg-4"><a class="nav-link" href="{{ route('login') }}">Inloggen</a></li>
                @else
                    <li class="mr-0 mr-lg-4 @if(Route::is('portal')) active @endif"><a class="nav-item nav-link" href="{{ route('portal') }}">Mijn portaal</a></li>
                    <li class="mr-0 mr-lg-4 "><a class="nav-item nav-link" href="{{ route('logout') }}">Uitloggen</a></li>
                @endguest
                <li class="mr-0 mr-lg-4"><a class="nav-link" href="{{ route('contact.index') }}">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
