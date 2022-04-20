<li class="nav-item">
  <a href="{{ url('/kontrak')}}" class="nav-link">
    <i class="nav-icon fas fa-file-signature"></i>
    <p class="text">Kontrak</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ url('/bast')}}" class="nav-link">
    <i class="nav-icon fas fa-file"></i>
    <p class="text">BAST</p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ url('/kontrak?sesi=rekap')}}" class="nav-link">
    <i class="nav-icon fas fa-copy"></i>
    <p class="text">REKAP PROGRESS</p>
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
        <a href="{{ url('/timteknis')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-user-tie nav-icon"></i>
          <p>Tim Teknis</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/pekerjaan')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-briefcase nav-icon"></i>
          <p>Pekerjaan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/perusahaan')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-hotel nav-icon"></i>
          <p>Perusahaan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/datapokok')}}" class="nav-link">
          &nbsp;&nbsp;<i class="fas fa-file nav-icon"></i>
          <p>Data Pokok</p>
        </a>
      </li>
    </ul>
</li>