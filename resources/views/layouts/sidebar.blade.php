<ul class="sidebar-menu">
    <li class="menu-header">Menu</li>
    <li class="nav-item dropdown">
        {{-- <a href="#" class="nav-link has-dropdown"><i class="fas fa-cubes"></i><span>Main Menu</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('customer') }}">Data Customer</a></li>       
            <li><a class="nav-link" href="{{ route('produk') }}">Produk</a></li>  
            <li><a class="nav-link" href="{{ route('penjualan') }}">Penjualan</a></li>  
        </ul> --}}
        <li><a class="nav-link" href="{{ route('customer') }}"><i class="fas fa-cubes"></i> <span>Data Customer</span></a></li>
        <li><a class="nav-link" href="{{ route('produk') }}"><i class="fas fa-cubes"></i> <span>Produk</span></a></li>
        <li><a class="nav-link" href="{{ route('stock') }}"><i class="fas fa-cubes"></i> <span>Tambah Stock</span></a></li>
        <li><a class="nav-link" href="{{ route('penjualan') }}"><i class="fas fa-cubes"></i> <span>Penjualan</span></a></li>
        <li><a class="nav-link" href="{{ route('lapstock') }}"><i class="fas fa-cubes"></i> <span>Laporan Stock</span></a></li>
        <li><a class="nav-link" href="{{ route('laporanpenjualan') }}"><i class="fas fa-cubes"></i> <span>Laporan Penjualan</span></a></li>
    </li>