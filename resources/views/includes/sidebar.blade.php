<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
       
      
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item" id="nav-home">
        <a class="nav-link" href="{{ route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item" id="nav-anggota">
        <a class="nav-link" href="{{ route('pendakian.create')}}">
            <i class="fas fa-fw fa-check"></i>
            <span>Daftar Pendakian</span></a>
    </li>
    <li class="nav-item" id="nav-kriteria">
        <a class="nav-link" href="{{ route('pendakian.index')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Jadwal Pendakian</span></a>
    </li>
    <li class="nav-item" id="nav-alternative">
        <a class="nav-link" href=" ">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li> 




</ul>
<!-- End of Sidebar -->