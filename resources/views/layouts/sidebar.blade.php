<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link mt-3">
            <img src="{{ asset('assets/img/logo-tuba.png') }}" alt="" width="25px">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">SIAP TUBA</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        @if (auth()->user()->role == 'admin')
            <li class="menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="/admin/dashboard" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>

            <!-- master presensi -->
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon bx bxs-report'></i>
                    <div data-i18n="Layouts">Master presensi</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="/admin/presensi" class="menu-link">
                            <div data-i18n="Without menu">Kehadiran</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/admin/titik_kumpul" class="menu-link">
                            <div data-i18n="Without navbar">Titik kumpul</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/admin/subopd" class="menu-link">
                            <div data-i18n="Container">Titik tugas</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/admin/rekap_presensi" class="menu-link">
                            <div data-i18n="Fluid">Rekap presensi</div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Master kepegawaian -->
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div class="text-nowrap" data-i18n="Layouts">Master Kepegawaian</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="/admin/pegawai" class="menu-link">
                            <div data-i18n="Without menu">Pegawai</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/admin/profile" class="menu-link">
                            <div data-i18n="Without menu">Profile pegawai</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/admin/oprator" class="menu-link">
                            <div data-i18n="Without navbar">Operator</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('berkala.bkpp') }}" class="menu-link">
                            <div data-i18n="Container">Kenaikan gaji berkala</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('bkpp.dashboard') }}" class="menu-link">
                            <div data-i18n="Without menu">Layanan</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('bkpp.master.kategori') }}" class="menu-link">
                            <div data-i18n="Without menu">Kategori layanan</div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item {{ Request::is('admin/opd*') ? 'active' : '' }}">
                <a href="/admin/opd" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-data"></i>
                    <div data-i18n="Boxicons">Master OPD</div>
                </a>
            </li>

            {{-- Master role --}}
            <li class="menu-item {{ Request::is('admin/opd*') ? 'active' : '' }}">
                <a href="#" class="menu-link">
                    <i class='menu-icon bx bx-check-shield'></i>
                    <div data-i18n="Boxicons">Master role</div>
                </a>
            </li>

            {{-- <li class="menu-item {{ Request::is('admin/profile*') ? 'active' : '' }}">
                <a href="/admin/profile" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Boxicons">Master Profile</div>
                </a>
            </li> --}}
            {{-- <li class="menu-item {{ Request::is('admin/logfacecheck*') ? 'active' : '' }}">
                <a href="/admin/logfacecheck" class="menu-link">
                    <i class='menu-icon bx bx-error'></i>
                    <div data-i18n="Boxicons">Log face check</div>
                </a>
            </li> --}}
        @else
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Presensi</span></li>
            <li class="menu-item {{ Request::is('oprator/dashboard') ? 'active' : '' }}">
                <a href="/oprator/dashboard" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('oprator/pegawai*') ? 'active' : '' }}">
                <a href="/oprator/pegawai" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Boxicons">Master pegawai</div>
                </a>
            </li>
            {{-- <li class="menu-item {{ Request::is('oprator/statuspegawai*') ? 'active' : '' }}">
                <a href="/oprator/statuspegawai" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-pin"></i>
                    <div data-i18n="Boxicons">Status Pegawai</div>
                </a>
            </li> --}}
            <li class="menu-item {{ Request::is('oprator/presensi*') ? 'active' : '' }}">
                <a href="/oprator/presensi" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                    <div data-i18n="Boxicons">Master presensi</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('oprator/rekap_presensi*') ? 'active' : '' }}">
                <a href="/oprator/rekap_presensi" class="menu-link">
                    <i class='menu-icon bx bxs-report'></i>
                    <div data-i18n="Boxicons">Rekap presensi</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('oprator/cuti*') ? 'active' : '' }}">
                <a href="/oprator/cuti" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-confused"></i>
                    <div data-i18n="Boxicons">Master cuti</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('oprator/kegiatan*') ? 'active' : '' }}">
                <a href="{{ route('oprator.kegiatan') }}" class="menu-link">
                    <box-icon name='category'></box-icon>
                    <i class='menu-icon tf-icons bx bx-category'></i>
                    <div data-i18n="Boxicons">Master kegiatan</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('oprator/approval*') ? 'active' : '' }}">
                <a href="{{ route('oprator.approval') }}" class="menu-link">
                    <box-icon name='category'></box-icon>
                    <i class='menu-icon bx bx-key'></i>
                    <div data-i18n="Boxicons">Pemberi persetujuan</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase"><span class="menu-header-text">Laporan</span></li>
            <li class="menu-item {{ Request::is('oprator/riwayattpp*') ? 'active' : '' }}">
                <a href="{{ route('riwayattpp') }}" class="menu-link">
                    <box-icon name='category'></box-icon>
                    <i class='menu-icon bx bx-food-menu'></i>
                    <div data-i18n="Boxicons">Riwayat TPP</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('oprator/tugas_harian*') ? 'active' : '' }}">
                <a href="{{ route('operator.tugas_harian') }}" class="menu-link">
                    <i class='menu-icon bx bx-task'></i>
                    <div data-i18n="Boxicons">Tugas harian</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Kepegawaian</span></li>
            <li class="menu-item {{ Request::is('oprator/verifikasi_berkas*') ? 'active' : '' }}">
                <a href="{{ route('operator.verifikasi_berkas') }}" class="menu-link">
                    <box-icon name='category'></box-icon>
                    <i class='menu-icon bx bx-file'></i>
                    <div data-i18n="Boxicons">Verifikasi Berkas</div>
                </a>
            </li>
            @if (auth()->user()->opd_id == 44)
                <li class="menu-item {{ Request::is('oprator/lhkpn*') ? 'active' : '' }}">
                    <a href="{{ route('operator.lhkpn') }}" class="menu-link">
                        <i class='menu-icon bx bxs-report'></i>
                        <div data-i18n="Boxicons">LHKPN</div>
                    </a>
                </li>
            @endif
        @endif


        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Support</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="https://api.whatsapp.com/send?phone=6285741492045" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Basic">Support</div>
            </a>
        </li>
    </ul>
</aside>
