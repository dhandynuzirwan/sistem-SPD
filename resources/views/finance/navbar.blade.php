<div class="main-header">
            <div class="logo-header">
                <a href="index.html" class="logo">
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
                                <span class="input-group-text">
									<i class="la la-search search-icon"></i>
								</span>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-bell"></i>
                                <span class="notification">3</span>
                            </a>
                            <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
                                <li>
                                    <div class="dropdown-title">You have 4 new notification</div>
                                </li>
                                <li>
                                    <div class="notif-center">
                                        <a href="#">
                                            <div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
													New user registered
												</span>
                                                <span class="time">5 minutes ago</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="la la-angle-right"></i> </a>
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
                        <img src="../../assets/img/profile.jpg">
                    </div>
                    <div class="info">
                        <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
									Nama Lengkap
									<span class="user-level">Finance</span>
                            <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>

                        <div class="collapse in" id="collapseExample" aria-expanded="true" style="">
                            <ul class="nav">
                                <li>
                                    <a href="#logout">
                                        <span class="link-collapse">logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
            <i class="la la-dashboard"></i>
            <p>Dashboard</p>
        </a>
    </li>

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

    <li class="nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
        <a href="{{ route('reports.index') }}">
            <i class="la la-file-text-o"></i>
            <p>Laporan Perjalanan Dinas</p>
            <span class="badge badge-danger">3</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('letters.*') ? 'active' : '' }}">
        <a href="{{ route('letters.index') }}">
            <i class="la la-file-archive-o"></i>
            <p>Surat Perjalanan Dinas</p>
            <span class="badge badge-success">2</span>
        </a>
    </li>
</ul>
            </div>
        </div>