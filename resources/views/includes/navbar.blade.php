<nav class="navbar navbar-expand-sm navbar-light bg-light shadow-sm rounded">
  <a class="navbar-brand" href="/"><i class="fas fa-feather-alt"></i>{{config('app.name', 'Blabber')}}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles">Articles</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::guest())
        <li class="nav-item">
          <a class="nav-link" href="/login">Log in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/authors/create">Register</a>
        </li>
      @else
        <li class="dropdown">
          <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="buton" aria-expanded="false">
            {{ Auth::user()->screenName }}
          </a>
          <ul class="dropdown-menu dropdown-menu-right" role="menu">
            <li class="dropdown-item">
              <a href="/articles/create" class="nav-link">Create Article</a>
            </li>
            <div class="dropdown-divider"></div>
            <li class="dropdown-item">
              <a href="/logout" class="nav-link"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              Log out
              </a>
              <form id="logout-form" action="/logout" method="POST" style="display:none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </li>
      @endif
    </ul>
  </div>
</nav>