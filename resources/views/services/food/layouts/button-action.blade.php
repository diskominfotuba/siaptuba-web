<div class="appBottomMenu">
    <a href="/user/dashboard" class="item {{ Request::is('user/dashboard') ? 'active' : '' }}">
        <div class="col">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="navbar-icon {{ Request::is('user/dashboard') ? 'navbar-icon-active' : '' }}" viewBox="0 0 512 512">
                <path
                    d="M80 212v236a16 16 0 0016 16h96V328a24 24 0 0124-24h80a24 24 0 0124 24v136h96a16 16 0 0016-16V212"
                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="32" />
                <path d="M480 256L266.89 52c-5-5.28-16.69-5.34-21.78 0L32 256M400 179V64h-48v69" fill="none"
                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
            </svg>

            <strong>Beranda</strong>
        </div>
    </a>

    <a href="/user/histories" class="item {{ Request::is('user/histories') ? 'active' : '' }}">
        <div class="col">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="navbar-icon {{ Request::is('user/histories') ? 'navbar-icon-active' : '' }}"
                viewBox="0 0 512 512">
                <path
                    d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z"
                    fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                <path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none" stroke="currentColor"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
            </svg>

            <strong>Riwayat</strong>
        </div>
    </a>
    <a href="/user/profile" class="item {{ Request::is('user/profile') ? 'active' : '' }}">
        <div class="col">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="navbar-icon {{ Request::is('user/profile') ? 'navbar-icon-active' : '' }}"
                viewBox="0 0 512 512">
                <path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z"
                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="32" />
                <path
                    d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z"
                    fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
            </svg>
            <strong>Profil</strong>
        </div>
    </a>
</div>
