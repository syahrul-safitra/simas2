<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fas fa-envelope-open-text me-2"></i>SIMAS</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('img/logo_fst.jpeg') }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <span>Master</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ url('/') }}" class="nav-item nav-link"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

            <a href="{{ url('dashboard/suratmasuk') }}"
                class="nav-item nav-link {{ (Request::is('dashboard/suratmasuk*') ? 'active' : '' || Request::is('dashboard/diteruskan*') || Request::is('dashboard/disposisi*')) ? 'active' : '' }}"><i
                    class="fa fa-envelope me-2"></i>Surat Masuk</a>

            <a href="{{ url('dashboard/suratkeluar') }}"
                class="nav-item nav-link {{ Request::is('dashboard/suratkeluar*') ? 'active' : '' }}"><i
                    class="fa fa-reply me-2"></i>Surat Keluar</a>

            @can('kasubag')
                <a href="{{ url('/dashboard/user') }}"
                    class="nav-item nav-link {{ Request::is('dashboard/user*') ? 'active' : '' }}"><i
                        class="fas fa-users"></i>User</a>
            @endcan

            @can('kasubag')
                <a href="{{ url('/dashboard/informasi') }}"
                    class="nav-item nav-link {{ Request::is('dashboard/informasi*') ? 'active' : '' }}"><i
                        class="far fa-newspaper"></i>Informasi</a>
            @endcan

            @can('permission')
                <a href="{{ url('/dashboard/pengguna') }}"
                    class="nav-item nav-link {{ Request::is('dashboard/pengguna*') ? 'active' : '' }}"><i
                        class="bi bi-file-earmark-text-fill me-2"></i>Surat dari KSBG</a>

                <a href="{{ url('/dashboard/suratdisampaikan') }}"
                    class="nav-item nav-link {{ Request::is('dashboard/suratdisampaikan*') ? 'active' : '' }}"><i
                        class="bi bi-file-earmark-text-fill me-2"></i>Lanjutan Disposisi</a>
            @endcan
    </nav>
</div>
