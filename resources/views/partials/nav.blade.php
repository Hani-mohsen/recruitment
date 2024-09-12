<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('candidate*') ? 'active' : '' }}" href="{{ route('candidates.index') }}">Candidates </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('available*') ? 'active' : '' }}" href="{{ route('available.index') }}">Available Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('jobapply*') ? 'active' : '' }}" href="{{ route('jobapply.index') }}">Jobapply</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('interview*') && !request()->is('interviewreview*') ? 'active' : '' }}" href="{{ route('interview.index') }}">Interview</a></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('interviewreview*') ? 'active' : '' }}" href="{{ route('interviewreview.index') }}">InterviewReview</a></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('jobcandidate*') ? 'active' : '' }}" href="{{ route('jobcandidate.index') }}">JobCandidate</a></a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>