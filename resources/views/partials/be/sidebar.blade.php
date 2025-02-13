<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-center">
                <div class="logo">
                    <!-- <center>
                        <a href="index.html"><img src="{{ asset('be/dist/assets/images/logo/logo-arsi.png') }}" alt="Logo" style="width: 120px !important; height: 50px;" srcset=""></a>
                    </center> -->
                    <center> <span class="text-sm">E-CAMPUS</span></center>

                    <div class="avatar bg-warning me-3 mt-2">
                        <img src="{{ asset('be/dist/assets/images/faces/1.jpg') }}" style="height: 40px; width:40px;" alt="" srcset="">
                    </div>
                    <span style="font-size: 14px !important;">{{ Auth::user()->name }}</span>
                    <br>
                    <center>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf

                            <button class="btn btn-sm btn-danger text-sm" type="submit">
                                Logout
                            </button>
                        </form>
                    </center>

                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle px-2"></i></a>
                </div>
            </div>
        </div>
        <hr style="border: solid 1px;">
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ setActive('internal/dashboard') }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                <li class="sidebar-title">Master Data</li>
                <li class="sidebar-item {{ setActive('internal/fakultas') }}">
                    <a href="{{ route('fakultas') }}" class='sidebar-link'>
                        <i class="bi bi-house"></i>
                        <span>Fakultas</span>
                    </a>
                </li>

                <li class="sidebar-title">E-Arsip Akreditasi</li>
                <li class="sidebar-item {{ setActive('internal/arsip-akreditasi') }}">
                    <a href="{{ route('arsip_akreditasi') }}" class='sidebar-link'>
                        <i class="bi bi-house"></i>
                        <span>Manajemen Akreditasi</span>
                    </a>

                </li>



                <li class="sidebar-title">Pengaturan</li>

                <li class="sidebar-item {{ setActive('internal/visi-misi') }}">
                    <a href="{{ route('visi_misi') }}" class='sidebar-link'>
                        <i class="bi bi-gear"></i>
                        <span>Visi Misi</span>
                    </a>
                </li>


                <li class="sidebar-item ">
                    <a href="{{ route('kerja_sama') }}" class='sidebar-link'>
                        <i class="bi bi-gear"></i>
                        <span>Kerja Sama</span>
                    </a>
                </li>

                <li class="sidebar-item ">
                    <a href="{{ route('penelitian') }}" class='sidebar-link'>
                        <i class="bi bi-gear"></i>
                        <span>Penelitian</span>
                    </a>
                </li>


                <li class="sidebar-item {{ setActive('internal/permission') }}">
                    <a href="{{ route('permission') }}" class='sidebar-link'>
                        <i class="bi bi-gear"></i>
                        <span>Permission</span>
                    </a>
                </li>

                <li class="sidebar-item {{ setActive('internal/role') }}">
                    <a href="{{ route('role') }}" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Role</span>
                    </a>
                </li>

                <li class="sidebar-item {{ setActive('internal/users') }} ">
                    <a href="{{ route('users') }}" class='sidebar-link'>
                        <i class="bi bi-people"></i>
                        <span>Users</span>
                    </a>
                </li>


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
