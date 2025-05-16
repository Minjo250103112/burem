<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">SICUREM <sup>ADMIN</sup></div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Interface
    </div>
    @if (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ticket-customer.index') }}">
            <i class="fas fa-fw fa-flag"></i>
            <span>Keluhan / Laporan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('customer.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pelanggan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pilihan Menu :</h6>
                <a class="collapse-item" href="{{ route('departement.index') }}">Divisi</a>
                <a class="collapse-item" href="{{ route('package.index') }}">Paket Layanan</a>
                <a class="collapse-item" href="{{ route('user.index') }}">Manajemen User</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('report.index') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan</span></a>
    </li>
    @elseif (Auth::user()->role == 'user')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ticket-customer.index') }}">
            <i class="fas fa-fw fa-flag"></i>
            <span>Keluhan / Laporan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('customer.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pelanggan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('report.index') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan</span></a>
    </li>
    @else
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ticket.create') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Buat Laporan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('ticket.index') }}">
            <i class="fas fa-fw fa-history"></i>
            <span>Riwayat Laporan</span></a>
    </li>
    @endif
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
