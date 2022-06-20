<nav id="nav">

    <form id="logout-form" action="{{ url('logout') }}" method="post">
        @csrf
    </form>


    <ul class="main-menu nav navbar-nav navbar-right">
        <li><a href=" {{ route('home') }} ">@lang('web.home')</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false">@lang('web.cat') <span class="caret"></span></a>
            <ul class="dropdown-menu">
                @foreach ($cates as $cat)
                    <li><a href="{{ route('categories.show', $cat->id) }}"> {{ $cat->name() }} </a></li>
                @endforeach
            </ul>
        </li>
        <li><a href=" {{ route('contact.create') }} ">@lang('web.cont')</a></li>
        @guest
            <li><a href="{{ route('login') }}">@lang('web.signin')</a></li>
            <li><a href="{{ route('register') }}">@lang('web.signup')</a></li>
        @endguest
        @auth
            <li><a href="#" id="logout-link">Signout</a></li>
        @endauth

        @if (App::getLocale() == 'en')
            <li><a href=" {{ url('lang/ar') }}">ع</a></li>
        @else
            <li><a href=" {{ url('lang/en') }}">ُEN</a></li>
        @endif
    </ul>
</nav>
