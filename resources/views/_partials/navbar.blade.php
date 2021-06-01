<header id="navbar">
    <div id="navbar-container" class="boxed">

        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="index.html" class="navbar-brand">
                <img src="{{asset('assets/img/logo.png')}}" alt="Nifty Logo" class="brand-icon">
                <div class="brand-title">
                    <span class="brand-text">Absensi</span>
                </div>
            </a>
        </div>
        <!--================================-->
        <!--End brand logo & name-->


        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content">
            <ul class="nav navbar-top-links">

                <!--Navigation toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#">
                        <i class="demo-pli-list-view"></i>
                    </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toogle button-->



                <!--Search-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li>
                    <div class="custom-search-form">
                        <label class="btn btn-trans" for="search-input" data-toggle="collapse" data-target="#nav-searchbox">
                            <i class="demo-pli-magnifi-glass"></i>
                        </label>
                        <div class="search-container collapse" id="nav-searchbox">
                            <input id="search-input" type="text" class="form-control" placeholder="Type for search...">
                        </div>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Search-->

            </ul>
            <ul class="nav navbar-top-links">

                <!--User dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li id="dropdown-user" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                        <span class="ic-user pull-right">
                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                            <!--You can use an image instead of an icon.-->
                            <!--<img class="img-circle img-user media-object" src="img/profile-photos/1.png" alt="Profile Picture">-->
                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                            <i class="demo-pli-male"></i>
                        </span>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--You can also display a user name in the navbar.-->
                        <!--<div class="username hidden-xs">Aaron Chavez</div>-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    </a>


                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                        <ul class="head-list">
                            <li>
                                <a href="#"><i class="demo-pli-male icon-lg icon-fw"></i> Profile</a>
                            </li>
                            <li>
                                <a href="#"><span class="badge badge-danger pull-right">9</span><i class="demo-pli-mail icon-lg icon-fw"></i> Messages</a>
                            </li>
                            <li>
                                <a href="#"><span class="label label-success pull-right">New</span><i class="demo-pli-gear icon-lg icon-fw"></i> Settings</a>
                            </li>
                            <li>
                                <a href="#"><i class="demo-pli-computer-secure icon-lg icon-fw"></i> Lock screen</a>
                            </li>
                            <li>
                                <a href="{{route('logout')}}"><i class="demo-pli-unlock icon-lg icon-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End user dropdown-->
            </ul>
        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->

    </div>
</header>
