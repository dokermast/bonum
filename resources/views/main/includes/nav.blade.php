
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">BONUM</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            @auth
                <div class="">You have {{ Auth::user()->role->name }} status</div>

                @if( Auth::user()->role_id == 1 )
                    <a class="btn btn-warning marg-l-20" href="{{ route('admin') }}">Admin panel</a>
                @endif

                <span class="marg-l-20">{{ Auth::user()->name }}</span>
                <span class="marg-l-20">{{ Auth::user()->second_name }}</span>
                <a class="btn btn-secondary marg-l-20" href="{{ route('profile.show') }}">Profile</a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>

                @else

                <a href="{{ route('login') }}" class="marg-l-10">Login</a>
                <a href="{{ route('register') }}" class="marg-l-10">Register</a>

            @endif
        </div>
    </nav>

