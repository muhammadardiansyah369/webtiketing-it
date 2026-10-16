<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="icon" sizes="128x128" href="/assets/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Stack+Sans+Text:wght@200..700&display=swap" rel="stylesheet">
    <script>
        window.WS_URL = (location.protocol === 'https:' ? 'wss://' : 'ws://') + location.host + '/ws/';
    </script>
    <style>
        body {
            overflow-x: hidden;
            background: #f5f6fa;
            font-family: "Poppins", sans-serif;

        }

        /* ================= SIDEBAR DESKTOP ================= */


        .subjudul {
            font-size: 17px;
            color: #6c757d;
            font-weight: 400;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-image: url('/assets/sidebar.png');
            background-repeat: no-repeat;
            background-size: cover;

            color: white;
            padding-top: 20px;
            z-index: 1000;
        }

        .sidebar h3 {
            text-shadow:
                1px 1px 2px rgba(0, 0, 0, .25);
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 14px 22px;
            margin: 8px 15px;

            color: #ffffff;
            font-size: 17px;
            font-weight: 600;
            letter-spacing: .5px;

            text-decoration: none;

            border-radius: 12px;

            transition: all .3s ease;

            text-shadow:
                1px 1px 2px rgba(0, 0, 0, .25);
        }

        .sidebar img {

            margin-left: 20px;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, .18);
            color: #fff;
            transform: translateX(8px);
        }

        /* ================= CONTENT ================= */

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .topbar {
            background-image: url('/assets/sidebar.png');
            background-repeat: no-repeat;
            background-size: cover;
            text-shadow:
                1px 1px 2px rgba(0, 0, 0, .25);

            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .topbar span {
            font-weight: 700;
            text-transform: capitalize;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
        }

        /* Tombol menu HP */
        .mobile-menu {
            color: white;
            display: none;
            background-image: url('/assets/sidebar.png');
            background-repeat: no-repeat;
            background-size: auto;
        }

        .mobile-menu:hover {
            color: white;

        }

        .sidebar .submenu-toggle,
        .offcanvas .submenu-toggle {
            cursor: pointer;
            justify-content: space-between;
        }

        .sidebar .submenu-toggle .chevron,
        .offcanvas .submenu-toggle .chevron {
            transition: transform .3s ease;
            margin-left: auto;
        }

        .sidebar .submenu-toggle[aria-expanded="true"] .chevron,
        .offcanvas .submenu-toggle[aria-expanded="true"] .chevron {
            transform: rotate(180deg);
        }

        .sidebar .submenu,
        .offcanvas .submenu {
            list-style: none;
            padding-left: 0;
            margin: 0 15px;
        }

        .sidebar .submenu .submenu-item,
        .offcanvas .submenu .submenu-item {
            display: block;
            padding: 12px 22px 12px 45px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 100;
            text-decoration: none;
            border-radius: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, .25);
            transition: all .3s ease;
        }

        .sidebar .submenu .submenu-item:hover,
        .offcanvas .submenu .submenu-item:hover {
            background: rgba(255, 255, 255, .18);
            color: #fff;
            transform: translateX(8px);
        }

        .warna-logout {
            background-image: url('/assets/sidebar.png');
            background-repeat: no-repeat;
            color: white;
            background-size: auto;
            border: 1px solid white;
        }

        .warna-logout:hover {

            border: 1px solid white;
        }



        /* ================= MOBILE ================= */

        @media(max-width:768px) {

            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
                padding: 15px;
            }

            .mobile-menu {
                display: block;

                margin-bottom: 15px;
            }

            .topbar {
                display: none;
            }

        }

        .close {
            margin-top: 20px;
            margin-left: 80px;
        }

        .offcanvas-header {

            padding: 0;
        }

        .offcanvas {
            --bs-offcanvas-width: 320px;
            background-image: url('/assets/sidebar.png');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;

        }

        .offcanvas .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 14px 22px;
            margin: 8px 15px;

            color: #ffffff;
            font-size: 17px;
            font-weight: 600;
            letter-spacing: .5px;

            text-decoration: none;

            border-radius: 12px;

            transition: all .3s ease;

            text-shadow:
                0 1px 2px rgba(0, 0, 0, .25);
        }



        .offcanvas img {
            padding: 0;
            margin-top: auto;

            position: relative;
            top: 20px;
            left: 40px;
        }

        .logout {
            color: white;
            text-decoration: none;
            display: block;
            border: 1px solid white;
            padding: 15px;
        }

        .logout:hover {

            border: 1px solid white;

        }

        .offcanvas .menu-link:hover {
            background: rgba(255, 255, 255, .18);
            color: #fff;
            transform: translateX(8px);
        }

        .offcanvas .submenu .submenu-item {


            font-weight: 400;


        }
    </style>

</head>

<body>

    <!-- ================= SIDEBAR DESKTOP ================= -->

    <div class="sidebar">


        <img src="/assets/logo.png" width="180px" alt="">


        <a href="<?= base_url('dashboard') ?>" class="fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
            </svg> Dashboard</a>

        <a href="<?= base_url('ticket') ?>" class="fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket-detailed-fill" viewBox="0 0 16 16">
                <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4 1a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5m0 5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5M4 8a1 1 0 0 0 1 1h6a1 1 0 1 0 0-2H5a1 1 0 0 0-1 1" />
            </svg> Ticket</a>

        <a href="<?= base_url('kategory') ?>" class="fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-fill" viewBox="0 0 16 16">
                <path d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2z" />
            </svg> Kategori</a>
        <a class="fw-bold submenu-toggle" data-bs-toggle="collapse" href="#userSubmenu" role="button" aria-expanded="false" aria-controls="userSubmenu">
            <span class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                </svg> Aktivitas
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chevron-down chevron" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
            </svg>
        </a>

        <ul class="submenu collapse" id="userSubmenu">
            <li><a class="submenu-item" href="<?= base_url('aktivitas') ?>">Admin</a></li>
            <li><a class="submenu-item" href="<?= base_url('aktivitask') ?>">Karyawan</a></li>
        </ul>

        <a class="fw-bold submenu-toggle" data-bs-toggle="collapse" href="#userSubmenu2" role="button" aria-expanded="false" aria-controls="userSubmenu">
            <span class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                </svg> User
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chevron-down chevron" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
            </svg>
        </a>

        <ul class="submenu collapse" id="userSubmenu2">
            <li><a class="submenu-item" href="<?= base_url('users') ?>">Admin</a></li>
            <li><a class="submenu-item" href="<?= base_url('usersK') ?>">Karyawan</a></li>
        </ul>
    </div>

    <!-- ================= CONTENT ================= -->

    <div class="content">

        <!-- Tombol Menu HP -->

        <button
            class="btn  mobile-menu"
            data-bs-toggle="offcanvas"
            data-bs-target="#menuMobile">

            ☰

        </button>

        <div class="topbar">

            <span>Selamat Datang, <?= session()->get('name') ?></span>

            <a href="<?= base_url('logout') ?>" class="btn warna-logout btn-sm">

                Logout

            </a>

        </div>

        <div class="card">

            <div class="card-body">

                <?= $this->renderSection('content') ?>

            </div>

        </div>

    </div>

    <!-- ================= OFFCANVAS MOBILE ================= -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="menuMobile">

        <div class="offcanvas-header">


            <img src="/assets/logo.png" width="180px" alt="">
            <div class="close">

                <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>

        </div>

        <div class="offcanvas-body d-flex flex-column ">

            <a class="menu-link" href="<?= base_url('dashboard') ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                </svg> Dashboard</a>

            <a class="menu-link" href="<?= base_url('ticket') ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket-detailed-fill" viewBox="0 0 16 16">
                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4 1a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5m0 5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5M4 8a1 1 0 0 0 1 1h6a1 1 0 1 0 0-2H5a1 1 0 0 0-1 1" />
                </svg> Ticket</a>



            <a class="menu-link" href="<?= base_url('kategory') ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-fill" viewBox="0 0 16 16">
                    <path d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2z" />
                </svg> Kategori</a>

            <a class="menu-link submenu-toggle" data-bs-toggle="collapse" href="#userSubmenuMobile2" role="button" aria-expanded="false" aria-controls="userSubmenuMobile">
                <span class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    </svg> Aktivitas
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chevron-down chevron" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                </svg>
            </a>

            <ul class="submenu collapse" id="userSubmenuMobile2">
                <li><a class="submenu-item" href="<?= base_url('aktivitas') ?>">Admin</a></li>
                <li><a class="submenu-item" href="<?= base_url('aktivitask') ?>">Karyawan</a></li>
            </ul>
            <a class="menu-link submenu-toggle" data-bs-toggle="collapse" href="#userSubmenuMobile" role="button" aria-expanded="false" aria-controls="userSubmenuMobile">
                <span class="d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    </svg> User
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chevron-down chevron" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                </svg>
            </a>

            <ul class="submenu collapse" id="userSubmenuMobile">
                <li><a class="submenu-item" href="<?= base_url('users') ?>">Admin</a></li>
                <li><a class="submenu-item" href="<?= base_url('usersK') ?>">Karyawan</a></li>
            </ul>
            <a href="<?= base_url('logout') ?>" class="btn logout btn-sm mt-auto w-100">

                Logout

            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>