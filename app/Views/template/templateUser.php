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

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-image: url('/assets/sidebar.png');
            background-repeat: no-repeat;
            background-size: auto;
            color: white;
            padding-top: 20px;
            z-index: 1000;
        }

        .sidebar h3 {
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



            transition: all .3s ease;

            text-shadow:
                0 1px 2px rgba(0, 0, 0, .25);
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
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.62);
            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .1);
        }

        .topbar span {
            font-weight: 700;
            text-transform: capitalize;
        }

        /* Tombol menu HP */
        .mobile-menu {
            color: white;
            display: none;
            background-image: url('/assets/sidebar.png');
            background-repeat: no-repeat;
            background-size: auto;
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

        .mobile-menu:hover {
            color: white;

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



                display: flex;
                justify-content: space-between;
                align-items: center;
            }



        }




        .offcanvas {
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

        .logout {
            color: white;
            text-decoration: none;
            display: block;
            padding: 15px;
        }

        .offcanvas .menu-link:hover {
            background: rgba(255, 255, 255, .18);
            color: #fff;
            transform: translateX(8px);
        }
    </style>

</head>

<body>

    <!-- ================= SIDEBAR DESKTOP ================= -->

    <div class="sidebar">

        <img src="/assets/logo.png" width="180px" alt="">



        <a href="<?= base_url('/lihat') ?>" class="fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket-detailed-fill" viewBox="0 0 16 16">
                <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4 1a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5m0 5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5M4 8a1 1 0 0 0 1 1h6a1 1 0 1 0 0-2H5a1 1 0 0 0-1 1" />
            </svg> Lihat Tiket</a>


    </div>

    <!-- ================= CONTENT ================= -->

    <div class="content">

        <!-- Tombol Menu HP -->


        <div class="topbar">

            <span>selamat datang, <?= session()->get('name') ?></span>

            <a href="<?= base_url('logout') ?>" class="btn  warna-logout btn-danger btn-sm ">

                Logout

            </a>

        </div>



        <?= $this->renderSection('content') ?>

    </div>

    <!-- ================= OFFCANVAS MOBILE ================= -->

    <div class="offcanvas offcanvas-start" tabindex="-1" id="menuMobile">

        <div class="offcanvas-header">

            <h5 class="offcanvas-title">

                User Panel

            </h5>

            <button class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>

        </div>

        <div class="offcanvas-body d-flex flex-column ">




            <a class="menu-link" href="<?= base_url('/lihat') ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket-detailed-fill" viewBox="0 0 16 16">
                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4 1a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5m0 5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5M4 8a1 1 0 0 0 1 1h6a1 1 0 1 0 0-2H5a1 1 0 0 0-1 1" />
                </svg> Ticket</a>



            <a href="<?= base_url('logout') ?>" class="btn logout btn-danger btn-sm mt-auto w-100">

                Logout

            </a>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>