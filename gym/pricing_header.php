<?php include('header1.php') ?>
<header>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-white">

        <div class="container-fluid">
            <!-- logo -->
            <a class="navbar-brand ps-4 " href="index.php"><img src="img/logoo.png" alt="" style="height: 50px; "></a>
            <!-- toggler btn -->
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- sidebar -->
            <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <!-- sidebar header -->
                    <h5 class="offcanvas-title text-black border-bottom border-bottom-black" id="offcanvasNavbarLabel">
                        <img src="img/logos1.png" alt="" style="height: 50px; ">
                    </h5>
                    <button type="button" class="btn-close btn-close-black shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <!-- sidebar body -->
                <?php session_start();
                error_reporting(0);
                include  'include/config.php';
                if (strlen($_SESSION['adminid'] == 0)) {
                }
                ?>
                <div class="header-top">
                    <div class="row m-0">
                        <div class="col-md-6 d-none d-md-block p-0">
                        </div>
                        <div class="col-md-6 text-left text-md-right p-0">
                            <?php if (strlen($_SESSION['uid']) == 0) : ?>
                                <div class="header-info d-none d-md-inline-flex">
                                    <a href="login.php" style="margin-right:10px; ">
                                        <button type="button" class="btn" style="color:white; background-color:#428f9d; margin-bottom:14px;">Login</button>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="header-info d-none d-md-inline-flex">
                                    <a href="profile.php" style=" text-decoration:none; width:110px; height:40px; padding-top:9px; display:flex; justify-content:center; ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="26" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" style="margin-right:3px; color:black; ">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                        </svg>
                                        <p style="color:black; ">My Profile</p>
                                    </a>
                                </div>
                                <div class="header-info d-none d-md-inline-flex">
                                    <a href="changepassword.php" style="text-decoration:none; width:160px; height:40px; padding-top:9px; margin-right:20px; display:flex; justify-content:center; ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16" style="color:black; margin-right:2px; padding:2px;">
                                            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                                        </svg>
                                        <p style="color:black; ">Change Password</p>
                                    </a>
                                </div>
                                <div class="header-info d-none d-md-inline-flex">
                                    <a href="logout.php">
                                        <button type="button" class="btn" style="color:white; background-color:#428f9d; margin-bottom:14px;">Logout</button>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>