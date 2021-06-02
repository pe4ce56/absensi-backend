<nav id="mainnav-container">
    <div id="mainnav">


        <!--OPTIONAL : ADD YOUR LOGO TO THE NAVIGATION-->
        <!--It will only appear on small screen devices.-->
        <!--================================
                    <div class="mainnav-brand">
                        <a href="index.html" class="brand">
                            <img src="img/logo.png" alt="Nifty Logo" class="brand-icon">
                            <span class="brand-text">Nifty</span>
                        </a>
                        <a href="#" class="mainnav-toggle"><i class="pci-cross pci-circle icon-lg"></i></a>
                    </div>
                    -->



        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">

                    <!--Profile Widget-->
                    <!--================================-->
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <img class="img-circle img-md" src="{{asset('assets/img/profile-photos/1.png')}}" alt="Profile Picture">
                            </div>
                            <div class="box-block">
                                <p class="mnp-name">Aaron Chavez</p>
                                <span class="mnp-desc">aaron.cha@themeon.net</span>
                            </div>
                        </div>
                    </div>


                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut" class="hidden">
                        <ul class="list-unstyled shortcut-wrap">
                            <li class="col-xs-3" data-content="My Profile">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                        <i class="demo-pli-male"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Messages">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                        <i class="demo-pli-speech-bubble-3"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Activity">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                        <i class="demo-pli-thunder"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Lock Screen">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                        <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->


                    <ul id="mainnav-menu" class="list-group">

                        <!--Category name-->
                        <li class="list-header">Main</li>
                        <!--Menu list item-->
                        <li class="{{ isset($data) ? ($data['pageInfo']['page'] === 'dashboard' ? 'active-link' : null) : null}}">
                            <a href="{{route('dashboard.index')}}">
                                <i class="ti-dashboard"></i>
                                <span class="menu-title">
                                    Dashboard
                                </span>
                            </a>
                        </li>

                        <li class="{{ isset($data) ? ($data['pageInfo']['page'] === 'absensi' ? 'active-link' : null) : null}}">
                            <a href="{{route('absensi.index')}}">
                                <i class="ti-agenda"></i>
                                <span class="menu-title">
                                    Absensi
                                </span>
                            </a>
                        </li>

                        <li class="list-divider"></li>

                        <!--Category name-->
                        <li class="list-header">Management Data</li>
                        <!--Menu list item-->
                        <li class="{{ isset($data) ? ($data['pageInfo']['page'] === 'kelas' ? 'active-link' : null) : null}}">
                            <a href="{{route('kelas.index')}}">
                                <i class="ti-blackboard"></i>
                                <span class="menu-title">
                                    Kelas
                                </span>
                            </a>
                        </li>
                        <li class="{{ isset($data) ? ($data['pageInfo']['page'] === 'siswa' ? 'active-link' : null) : null }}">
                            <a href="{{route('siswa.index')}}">
                                <i class="ti-user"></i>
                                <span class="menu-title">
                                    Siswa
                                </span>
                            </a>
                        </li>
                        <li class="{{ isset($data) ? ($data['pageInfo']['page'] === 'mapel' ? 'active-link' : null) : null }}">
                            <a href="{{route('mapel.index')}}">
                                <i class="ti-agenda"></i>
                                <span class="menu-title">
                                    Mapel
                                </span>
                            </a>
                        </li>
                        <li class="{{ isset($data) ? ($data['pageInfo']['page'] === 'guru' ? 'active-link' : null) : null }}">
                            <a href="{{route('guru.index')}}">
                                <i class="ti-user"></i>
                                <span class="menu-title">
                                    Guru
                                </span>
                            </a>
                        </li>
                        <li class="{{ isset($data) ? ($data['pageInfo']['page'] === 'jadwal' ? 'active-link' : null) : null }}">
                            <a href="{{route('jadwal.index')}}">
                                <i class="ti-bookmark-alt"></i>
                                <span class="menu-title">
                                    Jadwal
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>
