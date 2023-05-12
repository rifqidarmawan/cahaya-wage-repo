<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">Cahaya Wage</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link {{ ($active === "home") ? 'active' : '' }}" aria-current="page" href="/">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ ($active === "products") ? 'active' : '' }}" href="/products">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ ($active === "about") ? 'active' : '' }}" href="/about">Tentang</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Welcome back, {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu">
                    @if(Auth::user()->roles == '1')
                        <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
                    @else
                        <li><a class="dropdown-item" href="/dashboard_pelanggan"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
                    @endif
                    <li><hr class="dropdown-divider"></li>
                    <li>

                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-in-right"></i> Logout</button>
                        </form>

                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <button class="btn btn-secondary bg-transparent" style="border:none;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-cart4"></i>
                ({{ Cart::count() }})
                </button>
            </li>

            @else
            <li class="nav-item">
                <a href="/login" class="nav-link"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
            </li>
            @endauth
            </ul>
        </div>
      </div>
    </nav>
</header>
