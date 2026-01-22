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
            <form class="navbar-left navbar-form nav-search mr-md-3" action="{{ route('letters.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" placeholder="Cari Nomor Surat ..." class="form-control" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn p-0 bg-transparent border-0" style="box-shadow: none;">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="la la-search search-icon"></i>
                            </span>
                        </button>
                    </div>
                </div>                
            </form>
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-bell"></i>
                        @if($pendingNotificationCount > 0)
                            <span class="notification">{{ $pendingNotificationCount }}</span>
                        @endif
                    </a>
                    
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">
                                {{ Auth::user()->employee->role === 'employee' ? 'Update Status SPD Anda' : 'Ada ' . $pendingNotificationCount . ' surat perlu persetujuan' }}
                            </div>
                        </li>
                        <li>
                            <div class="notif-center">
                                @forelse($listNotifications as $notif)
                                    <a href="{{ route('letters.index', ['search' => $notif->letter_number]) }}" class="dropdown-item border-bottom p-3">
                                        {{-- Warna icon berubah sesuai status --}}
                                        <div class="notif-icon {{ $notif->status === 'approved' ? 'notif-success' : ($notif->status === 'rejected' ? 'notif-danger' : 'notif-primary') }}"> 
                                            <i class="la {{ $notif->status === 'approved' ? 'la-check' : ($notif->status === 'rejected' ? 'la-close' : 'la-file-text') }}"></i> 
                                        </div>
                                        <div class="notif-content">
                                            <span class="block font-weight-bold">
                                                {{ $notif->letter_number }}
                                            </span>
                                            <span class="time" style="font-size: 11px; display: block;">
                                                @if($notif->status === 'approved')
                                                    <span class="text-success">Selamat! Pengajuan Anda disetujui.</span>
                                                @elseif($notif->status === 'rejected')
                                                    <span class="text-danger">Maaf, pengajuan Anda ditolak.</span>
                                                @else
                                                    {{ $notif->subject }}
                                                @endif
                                            </span>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center p-3 text-muted">Belum ada notifikasi baru</div>
                                @endforelse
                            </div>
                        </li>
                    </ul>
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
                <li class="nav-item {{ request()->routeIs('budgets.*') ? 'active' : '' }}">
                    <a href="{{ route('budgets.index') }}">
                        <i class="la la-money"></i>
                        <p>Cetak Kwitansi</p>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>