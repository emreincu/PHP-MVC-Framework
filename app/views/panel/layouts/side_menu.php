<div class="page-content d-flex align-items-stretch">
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <!-- Sidebar Header-->
        <div class="pt-4 pb-0">
                <h5 class="text-center"><?= $LANGUAGE['navigation'] ?></h5>
        </div>
        <!-- Sidebar Navidation Menus-->
        <ul class="list-unstyled menu">
            <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li>
            <li class="active"><a href="index.html"> <i class="icon-home"></i>Home </a></li>
            <li><a href="tables.html"> <i class="icon-grid"></i>Tables </a></li>
            <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
            <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                </ul>
            </li>
            <li><a href="login.html"> <i class="icon-interface-windows"></i>Login page </a></li>
        </ul>
        <span class="heading"><?= $LANGUAGE["system"] ?></span>
        <ul class="list-unstyled">
            <li> <a href="<?= URL_ROOT ?>/panel/uploads/images/1"><i class="fas fa-cloud-upload-alt"></i><?= $LANGUAGE["uploads"] ?></a></li>
            <li> <a href="<?= URL_ROOT ?>/panel/admin"><i class="fas fa-cog"></i><?= $LANGUAGE["admin_settings"] ?></a></li>
        </ul>
    </nav>

    <div class="content-inner">
