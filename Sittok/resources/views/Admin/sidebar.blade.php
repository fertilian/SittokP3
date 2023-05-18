<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src=" assets/img/logo/sittok-gambar.png">
        </div>
        <div class="sidebar-brand-text mx-3">SITTOK</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item active">
        <a class="nav-link" href="../Admin/indexadmin.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Data Master
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="fa fa-database"></i>
          <span>Data Master</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sittok</h6>
            <a class="collapse-item" href="/Admin/barang/list">Barang</a>
            <a class="collapse-item" href="{{ route('kategori.index')}}">Kategori</a>
            <a class="collapse-item" href="/Admin/customers/list">Customers</a>
            <a class="collapse-item" href="{{ route('supplier.index')}}">Supplier</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Data User
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap1"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="fa fa-user"></i>
          <span>Data User</span>
        </a>
        <div id="collapseBootstrap1" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Sittok</h6>
            <a class="collapse-item" href="{{ route('user.index')}}">User</a>
            <a class="collapse-item" href="/Admin/jual/list">Jual</a>
          </div>
        </div>
      </li>
      <!-- <hr class="sidebar-divider"> -->
      <div class="sidebar-heading">
      </div>
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>