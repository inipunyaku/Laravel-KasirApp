<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item ">
        <a href="/" class="nav-link {{ request()-> is('/') ? 'active' : ' '}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
             Dashboard
            </p>
        </a>
        </li>
        <li class="nav-item">
            <a href="/menu" class="nav-link {{ request()-> is('/menu') ? 'active' : ' '}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                 Pemesanan
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/transaksi/blmbyr" class="nav-link {{ request()-> is('/transaksi/blmbyr') ? 'active' : ' '}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                 Belum Bayar
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/transaksi/proses" class="nav-link {{ request()-> is('/transaksi/proses') or ('/transaksi/proses2') ? 'active' : ' '}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                 Proses
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/transaksi/selesai" class="nav-link {{ request()-> is('/transaksi/selesai') ? 'active' : ' '}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                 transaksi selesai
                </p>
            </a>
        </li>
    </ul>
  </nav>