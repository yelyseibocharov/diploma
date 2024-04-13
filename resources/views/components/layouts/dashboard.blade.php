<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME', 'UNIVERSITY SYSTEM') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<meta name="theme-color" content="#7952b3">


<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
        z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
    }

</style>

</head>
<body>
<main class="d-flex flex-nowrap" style="height: 100vh;">
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi pe-none me-2" width="40" height="32">
                <use xlink:href="#bootstrap"/>
            </svg>
            <span class="fs-4">Sidebar</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column my-3">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                   aria-current="page">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="{{ route('dashboard') }}"/>
                    </svg>
                    Головна
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard_students') }}"
                   class="nav-link link-body-emphasis {{ request()->is('dashboard/students') ? 'active' : '' }}">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="{{ route('dashboard_students') }}"/>
                    </svg>
                    Студенти
                </a>
            </li>
            @auth
                @if(auth()->user()->permission === '1')
                    <li>
                        <a href="{{ route('dashboard_professors') }}"
                           class="nav-link link-body-emphasis {{ request()->is('dashboard/professors') ? 'active' : '' }}">
                            <svg class="bi pe-none me-2" width="16" height="16">
                                <use xlink:href="{{ route('dashboard_professors') }}"/>
                            </svg>
                            Викладачі
                        </a>
                    </li>
                @endif
            @endauth
            <li>
                <a href="{{ route('dashboard_grades') }}"
                   class="nav-link link-body-emphasis {{ request()->is('dashboard/grades') ? 'active' : '' }}">
                    <svg class="bi pe-none me-2" width="16" height="16">
                        <use xlink:href="{{ route('dashboard_grades') }}"/>
                    </svg>
                    Оцінювання
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown mt-auto">
            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
               data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>{{ Auth::user()->last_name }} {{ Auth::user()->first_name }}</strong>
            </a>
            <ul class="dropdown-menu text-small shadow">
                @if(auth()->user()->permission === '1')
                    <li><a class="dropdown-item" href="{{route('university_main_edit', ['id' => Auth::user()->university_id])}}">Налаштування ВНЗ</a></li>
                @endif
                <li><a class="dropdown-item" href="{{ route('profile', ['id' => Auth::user()->uid]) }}">Профіль</a></li>
                <li><a class="dropdown-item" href="#">Підтримка</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <form class="dropdown-item" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-secondary d-inline-flex align-items-center" type="submit">
                        Вийти з системи
                        <svg class="bi ms-1" width="20" height="20">
                            <use xlink:href="#arrow-right-short"></use>
                        </svg>
                    </button>
                </form>
            </ul>
        </div>
    </div>
    {{ $slot }}
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
