<li class="nav-item">
  <a href="{{ url('/halaman/kontrakfisik')}}" class="nav-link">
    <i class="nav-icon fas fa-file"></i>
    <p class="text">Kontrak Fisik</p>
  </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-layer-group"></i>
      <p>
        Data Master
        <i class="fas fa-angle-left right"></i>
        {{-- <span class="badge badge-info right">6</span> --}}
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ url('/user')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-user nav-icon"></i>
          <p>User</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/halaman/timlokus')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-user nav-icon"></i>
          <p>Tim Lokus</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/halaman/pekerjaan')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-user nav-icon"></i>
          <p>Pekerjaan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/halaman/perusahaan')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-chart-bar nav-icon"></i>
          <p>Perusahaan</p>
        </a>
      </li>
    </ul>
</li>