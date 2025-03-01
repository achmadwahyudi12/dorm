<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('') ?>">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">DORMS</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?= base_url('dashboard'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Master Data
</div>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('dorm'); ?>">
        <i class="fas fa-fw fa-home"></i>
        <span>Asrama</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('customer'); ?>">
        <i class="fas fa-fw fa-users"></i>
        <span>Pelanggan</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<div class="sidebar-heading">
    Transaksi
</div>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('booking'); ?>">
        <i class="fas fa-fw fa-shopping-basket"></i>
        <span>Pemesanan</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('payment'); ?>">
        <i class="fas fa-fw fa-money-check"></i>
        <span>Pembayaran</span></a>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Components</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
        </div>
    </div>
</li> -->

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<div class="m-2">
    <a href="#" data-toggle="modal" data-target="#logoutModal" class="btn btn-block btn-secondary">Keluar</a>
</div>

</ul>