
            <header class="header">
                <nav class="navbar">
                    <div class="container-fluid">
                        <div class="navbar-holder d-flex align-items-center justify-content-between">
                            <!-- Navbar Header-->
                            <div class="navbar-header">
                                <!-- Navbar Brand -->
                                <a href="index.html" class="navbar-brand">
                                <div class="brand-text brand-big"><span>Bootstrap </span><strong>Dashboard</strong></div>
                                <div class="brand-text brand-small"><strong>BD</strong></div></a>
                                <!-- Toggle Button-->
                                <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                            </div>
                            <!-- Navbar Menu -->
                            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                                <!-- Notifications-->
                                <li class="nav-item dropdown">
                                    <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                                        <i class="fas fa-bell"></i><span class="badge bg-red badge-corner">0</span>
                                    </a>
                                    <ul aria-labelledby="notifications" class="dropdown-menu">
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item">
                                                <div class="notification">
                                                    <div class="notification-content"><i class="fas fa-envelope bg-green"></i>You have 0 new messages </div>
                                                    <div class="notification-time"><small>0 minutes ago</small></div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Messages                                                -->
                                <li class="nav-item dropdown">
                                    <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
                                        <i class="fas fa-envelope"></i><span class="badge bg-orange badge-corner">0</span>
                                    </a>
                                    <ul aria-labelledby="notifications" class="dropdown-menu">
                                        <li>
                                            <a rel="nofollow" href="#" class="dropdown-item d-flex">
                                                <div class="msg-body">
                                                    <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Languages dropdown        -->
                                <li class="nav-item dropdown mr-0">
                                    <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle pl-2 pr-1">
                                        <span class="d-none d-sm-inline-block">
                                            <?= $LANGUAGE["language"] ?> <i class="fas fa-globe-asia"></i> (<?= $_language_shortLabel ?>) </span>
                                    </a>
                                    <ul aria-labelledby="languages" class="dropdown-menu">
                                        <li><a rel="nofollow" href="<?= URL_ROOT ?>/language/change/en" class="dropdown-item"> English</a></li>
                                        <li><a rel="nofollow" href="<?= URL_ROOT ?>/dil/degistir/tr" class="dropdown-item"> Türkçe</a></li>
                                    </ul>
                                </li>
                                <!-- Logout        -->
                                <li class="nav-item">
                                    <a href="<?= URL_ROOT ?>/admin/logout" class="nav-link logout pr-1 pl-1"><?= $LANGUAGE["logout"] ?><i class="fas fa-sign-out-alt"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
