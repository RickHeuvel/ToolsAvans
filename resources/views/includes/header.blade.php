<nav class="navbar navbar-expand-lg nav-avans">
        <div class="container">
            <a target="_blank" href="http://avans.nl"><img class="img-fluid logo-avans" alt="Avans logo" src="{{ asset('img/logo-avans-white.png') }}"></a>
        </div>
    </nav>
<nav class="navbar navbar-expand-lg nav-group">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav group">
                <li class="@if(Route::is('home')) active @endif"><a class="nav-item nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="@if(Route::is('tools.index')) active @endif"><a class="nav-item nav-link" href="{{ route('tools.index') }}">Tools</a></li>
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">Inloggen</a></li>
                @else
                    <li class="@if(Route::is('portal')) active @endif"><a class="nav-item nav-link" href="{{ route('portal') }}">Mijn portaal</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Uitloggen
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                <li><a class="nav-link" href="{{ route('contact.index') }}">Contact</a></li>
            </ul>
            <a class="navbar-brand ml-auto" href="{{ route('home') }}"><img class="img-fluid" alt="Toolhub logo" src="{{ asset('img/full-logo-toolhub.png') }}"></a>
        </div>
    </div>
</nav>
