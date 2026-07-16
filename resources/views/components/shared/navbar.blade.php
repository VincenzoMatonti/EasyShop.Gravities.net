<nav class="navbar navbar-expand-lg shadow mynavbg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand mytextcolor" href="{{ route('home.index') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-nowrap">
                <li class="nav-item">
                    <a class="nav-link active d-flex align-items-center text-nowrap mytextcolor" aria-current="page" href="{{ route('home.index') }}">
                        Home <i class="fa-solid fa-house-chimney ms-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center text-nowrap mytextcolor" href="">
                        example <i class="fa-solid fa-newspaper ms-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center text-nowrap mytextcolor" href="">
                        example <i class="fa-solid fa-map-pin ms-1"></i>
                    </a>
                </li>

                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-nowrap mytextcolor" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       Ciao! {{ Auth::user()->name }} <i class="fa-solid fa-robot ms-1"></i>
                    </a>
                    <ul class="dropdown-menu mynavbg">
                        <li>
                            <a class="dropdown-item mynavbg mytextcolor d-flex align-items-center text-nowrap" href="#"
                                onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">
                                Log out <i class="fa-solid fa-right-from-bracket ms-1"></i>
                            </a>
                        </li>
                        <form action="{{ route('logout') }}" method="POST" class="d-none" id="form-logout">@csrf</form>
                    </ul>
                </li>
                @else
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-nowrap mytextcolor" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user ms-1"></i>
                    </a>
                    <ul class="dropdown-menu mynavbg">
                        <li>
                            <a class="dropdown-item mynavbg mytextcolor d-flex align-items-center text-nowrap" href="{{ route('login') }}">
                                Log in <i class="fa-solid fa-door-open ms-1"></i>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item mynavbg mytextcolor d-flex align-items-center text-nowrap" href="{{ route('register') }}">
                                Registrati <i class="fa-solid fa-id-card ms-1"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>