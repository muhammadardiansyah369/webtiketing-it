<!DOCTYPE html>


<html lang="id">


<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" sizes="128x128" href="/assets/icon.png">
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Stack+Sans+Text:wght@200..700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('/assets/sidebar.png');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .login-box {
            width: 55%;
            max-width: 99%;
            min-height: 80%;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .25);
        }

        .login-right {
            flex: 0 0 320px;
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .login-right h3 {
            font-size: 20px;
        }

        .logo {
            text-align: center;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background-image: url('/assets/sidebar.png');
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 35px;
            font-size: 42px;
        }

        .input-group {
            border: 1px solid #222;
            border-radius: 50px;
            overflow: hidden;
            margin-bottom: 0px;
        }

        .input-group-text,
        .input-group .btn {
            background: #fff;
            border: none;
        }

        .form-control {
            border: none;
            box-shadow: none;
            height: 40px;
        }

        .btn-login {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 50px;
            background-image: url('/assets/sidebar.png');
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
            font-weight: 600;
        }

        .login-left {
            flex: 1;
            background: #eef3ff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .login-left img {
            width: 100%;
            height: 100%;
            object-fit: auto;
        }

        .text-bawah {

            display: flex;
            text-align: center;

            text-transform: capitalize;
            flex-direction: column;
            margin-top: 10px;
            font-size: 12px;
        }

        .text-bawah a {
            color: rgb(255, 132, 0);
            text-decoration: underline;
        }

        .error-text {
            position: absolute;
            color: #dc3545;
            font-size: 13px;
            margin-top: 0px;
            margin-left: 15px;
        }

        @media(max-width:768px) {
            .login-box {
                width: 90%;
                flex-direction: column;
            }

            .login-right {
                width: 100%;
            }

            .login-left {

                height: 260px;

            }

            .login-left {
                display: none;
                min-height: 260px;
            }
        }
    </style>

</head>

<body>



    <?= $this->renderSection('content'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>