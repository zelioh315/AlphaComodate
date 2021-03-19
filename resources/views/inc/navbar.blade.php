
  <nav class="navbar navbar-expand-md  fixed-top  navbar-dark ">
  {{-- <nav class="navbar navbar-expand-lg "> --}}
    {{-- <nav class="navbar "> --}}
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'AlphaComodate') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="/properties">For Rent<span class="sr-only">(current)</span></a>
              </li>
              {{-- <li class="nav-item active">
                <a class="nav-link" href="/propertiesForRent">Rent</a>
              </li> --}}
              <li class="nav-item active">
                <a class="nav-link" href="/students">Student</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/servicedAccomodations">Serviced Accomodations</a>
              </li>

              <ul class = "nav navbar-nav navbar-right">
               
            </ul> 
                <!-- Authentication Links -->
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
                    <li class="nav-item active">
                        <a class="nav-link" href="/properties/create">Add a listing </a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="/chat">Chat</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <a class="dropdown-item" href="/profile">
                              My Profile
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
<br>


  