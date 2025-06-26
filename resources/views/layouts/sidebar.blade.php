<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ url('/') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{asset('backend/dist/assets/img/AdminLTELogo.png')}}" alt="INFOTANI-KK"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">INFOTANI-KK</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                @if (auth()->user()->can('panen'))
                <li class="nav-item">
                    <a href="{{ url('/panen') }}" class="nav-link">
                        <i class="nav-icon bi bi-basket-fill"></i>
                        <p>Panen</p>
                    </a>
                </li>
                @endif
                @if (auth()->user()->can('laporan'))
                <li class="nav-item">
                    <a href="{{ url('/laporan') }}" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-data"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-gear-fill text-primary"></i>
                        <p>
                            Master Data
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->can('list-users'))
                            <li class="nav-item">
                                <a href="{{ url('/users') }}" class="nav-link">
                                    <i class="bi bi-person-fill text-secondary nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->can('list-roles'))
                        <li class="nav-item">
                            <a href="{{ url('/roles') }}" class="nav-link">
                                <i class="bi bi-shield-lock-fill text-secondary nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('list-permissions'))
                        <li class="nav-item">
                            <a href="{{ url('/permissions') }}" class="nav-link">
                                <i class="bi bi-key-fill text-secondary nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endif       
                        @if (auth()->user()->can('tanaman'))            
                        <li class="nav-item">
                            <a href="{{ url('/tanaman') }}" class="nav-link">
                                <i class="bi bi-flower1 text-success nav-icon"></i>
                                <p>Tanaman</p>
                            </a>
                        </li>
                        @endif
                        @if (auth()->user()->can('harga-jual'))
                        <li class="nav-item">
                            <a href="{{ url('/harga-jual') }}" class="nav-link">
                                <i class="bi-cash-coin text-warning nav-icon"></i>
                                <p>Harga Jual</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>                             
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
