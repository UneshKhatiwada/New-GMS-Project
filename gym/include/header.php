<?php include('header1.php') ?>
<header>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">
            <!-- logo -->
            <a class="navbar-brand ps-4 " href="front.php"><img src="img/logoo.png" alt="" style="height: 50px; "></a>
            <!-- toggler btn -->
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- sidebar -->
            <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <!-- sidebar header -->
                    <h5 class="offcanvas-title text-black border-bottom border-bottom-black" id="offcanvasNavbarLabel">
                        <img src="img/logos1.png" alt="" style="height: 50px; "></h5>
                    <button type="button" class="btn-close btn-close-black shadow-none" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- sidebar body -->
                <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                    <ul class="navbar-nav justify-content-center align-item-center flex-grow-1 pe-3">
                        <li id="main-nav" class="nav-item  d-flex">
                            <a class="nav-link" href="index.php">Home</a>

                            <a class="nav-link" href="#About">About</a>

                            <a class="nav-link" href="#Classes">Classes</a>

                            <a class="nav-link" href="admin">Admin</a>

                        </li>
                    </ul>
                    <!-- user login -->
                    <div class="d-flex flex-column justify-content-center align-item-center">
                        <ul class="navbar-nav ml-auto nav-flex-icons">
                            <li class="nav-item dropdown">
                                <a href="login.php" class="btn btn-primary me-3" id="btn1">
                                    <i class="fa fa-user me-1"></i>Login</a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex flex-column justify-content-center align-item-center">
                        <ul class="navbar-nav ml-auto nav-flex-icons">
                            <li class="nav-item dropdown">
                                <a href="registration.php" class="btn btn-primary me-3" id="btn1">
                                    <i class="fa fa-user me-1"></i>Register</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>