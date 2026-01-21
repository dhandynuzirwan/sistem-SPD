<div class="main-header">
    <div class="logo-header">
        <a href="{{ route(Auth::user()->employee->role . '.dashboard') }}" class="logo">
            PT Arsa Jaya Prima
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
    </div>
    <nav class="navbar navbar-header navbar-expand-lg">
        <div class="container-fluid">
            <form class="navbar-left navbar-form nav-search mr-md-3" action="">
                <div class="input-group">
                    <input type="text" placeholder="Search ..." class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="la la-search search-icon"></i></span>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-bell"></i>
                        <span class="notification">3</span>
                    </a>
                    </li>
            </ul>
        </div>
    </nav>
</div>

<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{ asset('assets/img/profile.jpg') }}">
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        {{ Auth::user()->employee->full_name }}
                        <span class="user-level">
                            @if(Auth::user()->employee->role == 'director') Pimpinan 
                            @elseif(Auth::user()->employee->role == 'employee') Pegawai
                            @else {{ ucfirst(Auth::user()->employee->role) }} @endif
                        </span>
                        <span class="caret"></span>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse in" id="collapseExample" aria-expanded="true">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="link-collapse">Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <ul class="nav">
            @php $dash = Auth::user()->employee->role . '.dashboard'; @endphp
            <li class="nav-item {{ request()->routeIs($dash) ? 'active' : '' }}">
                <a href="{{ route($dash) }}">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            @if(Auth::user()->employee->role == 'finance')
                <li class="nav-item {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                    <a href="{{ route('employees.index') }}">
                        <i class="la la-users"></i>
                        <p>Data Pegawai</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('budgets.*') ? 'active' : '' }}">
                    <a href="{{ route('budgets.index') }}">
                        <i class="la la-money"></i>
                        <p>Data Anggaran</p>
                    </a>
                </li>
            @endif

            <li class="nav-item {{ request()->routeIs('letters.*') ? 'active' : '' }}">
                <a href="{{ route('letters.index') }}">
                    <i class="la la-file-archive-o"></i>
                    <p>Surat Perjalanan Dinas</p>
                    @if(isset($unreadLettersCount) && $unreadLettersCount > 0)
                        <span class="badge badge-success">{{ $unreadLettersCount }}</span>
                    @endif
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <a href="{{ route('reports.index') }}">
                    <i class="la la-file-text-o"></i>
                    <p>Laporan Perjalanan</p>
                </a>
            </li>

            @if(Auth::user()->employee->role == 'employee')
                <li class="nav-item {{ request()->routeIs('budgets.index') && request()->is('*employee*') ? 'active' : '' }}">
                    <a href="{{ route('budgets.index') }}">
                        <i class="la la-money"></i>
                        <p>Cetak Kwitansi</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>