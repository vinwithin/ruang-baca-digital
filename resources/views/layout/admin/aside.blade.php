<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <div class="d-flex justify-content-between align-items-center my-3 mx-4 ">
            <a href="/assets/unja.png" class="navbar-brand d-flex align-items-center">
                <img src="" alt="Logo" style="height: 40px;">
            </a>
            <div class="d-flex flex-column justify-content-center mt-2">
                <h1 class="text-aside mb-0">Ruang Baca Digital</h1>
                <h1 class="text-aside">Fakultas Sains dan Teknologi</h1>
            </div>
        </div>
        <div class="text-center my-3">
            <img class="img-thumbnail rounded-circle" src="/storage/{{Auth::user()->foto_profil}}" alt=""
                style="width: 6rem; height: 6rem; object-fit: cover;">
            <h5 class="mt-2">{{ auth()->user()->name }}</h5>
            <h5 class="text-muted">{{ auth()->user()->identifier }}</h5>
        </div>


        <ul class="sidebar-nav ">
            <div class="border-top border-bottom">
                <div class="d-flex justify-content-around mx-3 my-3  ">
                    <a href="/profil" class="sidebar-baseline text-dark"><i class="me-2"
                            data-feather="settings"></i><span>Pengaturan</span></a>
                    <a href="/logout" class="sidebar-baseline text-dark"><i class="me-2"
                            data-feather="log-out"></i><span>Keluar</span></a>

                </div>
            </div>



            <li class="sidebar-item {{ Request::is('dashboard*') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard">
                    <i class="fa-solid fa-house"></i><span class="align-middle">Dashboard</span>
                </a>
            </li>
            @role('admin')
                <li class="sidebar-item {{ Request::is('admin/dokumen*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/admin/dokumen">
                        <i class="fa-regular fa-clipboard-check"></i> <span class="align-middle">Validasi Dokumen</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('admin/kelola-dokumen*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('admin.kelola-dokumen') }}">
                        <i class="fa-solid fa-database"></i> <span class="align-middle">Kelola Dokumen</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('admin/berita*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/admin/berita">
                        <i class="fa-solid fa-newspaper"></i> <span class="align-middle">Kelola Informasi/Berita</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('admin/kelola-pengguna*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/admin/kelola-pengguna">
                        <i class="fa-regular fa-circle-user"></i> <span class="align-middle">Kelola Pengguna</span>
                    </a>
                </li>
            @endrole

            @role('mahasiswa')
                <li class="sidebar-item {{ Request::is('dokumen*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/dokumen">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i><span class="align-middle">Upload Dokumen
                            Anda</span>
                    </a>
                </li>



                <li class="sidebar-item {{ Request::is('informasi*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/informasi/dokumen">
                        <i class="fa-regular fa-circle-info"></i> <span class="align-middle">Informasi Status Upload</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('search*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('cari-dokumen') }}">
                        <i class="fa-solid fa-magnifying-glass"></i> <span class="align-middle">Cari Dokumen Bacaan</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('bookmarks*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="/bookmarks">
                        <i class="fa-regular fa-star"></i> <span class="align-middle">Dokumen Favorit</span>
                    </a>
                </li>
            @endrole

            <li class="sidebar-item {{ Request::is('panduan*') ? 'active' : '' }}">
                <a class="sidebar-link" href="/panduan">
                    <i class="fa-solid fa-wand-sparkles"></i> <span class="align-middle">Panduan</span>
                </a>
            </li>


        </ul>

    </div>
</nav>
