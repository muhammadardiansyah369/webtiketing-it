<?= $this->extend('template/templateLogin') ?>
<?= $this->section('content') ?>

<style>
    body {
        font-family: 'poppins', sans-serif;
        background-image: url('/assets/IT.jpg');
        background-repeat: no-repeat;
        background-size: cover;

    }

    .card {
        background: rgba(146, 146, 146, 0.18);
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);

        border: 1px solid rgba(255, 255, 255, .35);
        border-radius: 20px;

        box-shadow: 0 15px 35px rgba(0, 0, 0, .20);
    }

    .card h3,
    .card h5 {
        color: #fff;
        font-weight: 700;
        text-shadow:
            0 2px 4px rgba(0, 0, 0, .8),
            0 4px 12px rgba(0, 0, 0, .7),
            0 0 20px rgba(0, 0, 0, .3);
    }

    .card p {
        color: #fff;

        line-height: 1.7;
        text-shadow:
            0 2px 4px rgba(0, 0, 0, .8),
            0 4px 10px rgba(0, 0, 0, .6);
    }

    hr {
        border-color: rgba(255, 255, 255, .3);
    }

    .btn-register {
        font-weight: 700;
        background: transparent;
        color: #fff;
        border: 1px solid rgba(255, 255, 255, .5);
    }

    .btn-register:hover {
        color: white;
        background: rgba(255, 255, 255, .12);
        border-color: #fff;
    }

    .btn-login {
        background: #E53935;
        color: #fff;
        border-radius: 5px;
        border: none;
        font-weight: 700;
    }

    .btn-login:hover {
        color: white;
        background: #C62828;
    }

    @media (max-width:768px) {
        body {
            font-family: 'Manrope', sans-serif;
            background-image: url('/assets/sidebar.png');
            background-repeat: no-repeat;
            background-size: cover;

        }

        .card {
            background: #fff;
            color: black;

            border: 1px solid rgba(255, 255, 255, .35);
            border-radius: 20px;

            box-shadow: 0 15px 35px rgba(0, 0, 0, .20);
        }

        .card h3,
        .card h5 {
            color: #090909;
            font-weight: 750;
            text-shadow:
                0 0px 0px #fff;
        }

        .card p {
            color: #000000;

            line-height: 1.7;
            text-shadow:
                0 0px 0px #fff;

        }

        .btn-register {
            font-weight: 700;
            background: transparent;
            color: #000000;
            border: 1px solid rgba(1, 1, 1, 0.5);
        }

        .btn-register:hover {
            color: black;
            background: rgba(255, 255, 255, .12);
            border-color: #010101;
        }

    }
</style>

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-md-8 col-lg-6">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-5 text-center">

                    <!-- Logo -->
                    <img src="<?= base_url('/assets/logo.png') ?>"
                        width="200"
                        class="mb-3">

                    <!-- Judul -->
                    <h3 class="">
                        Selamat Datang
                    </h3>

                    <h5 class="mb-3">
                        Web Ticketing
                    </h5>

                    <!-- Deskripsi -->
                    <p class="">
                        Laporkan permasalahan perangkat, jaringan,
                        maupun aplikasi kepada tim IT secara cepat,
                        mudah, dan terorganisir.
                    </p>

                    <hr>

                    <!-- Tombol -->
                    <div class="d-grid gap-2">

                        <a href="<?= base_url('login') ?>"
                            class="btn btn-login">
                            Login
                        </a>

                        <a href="<?= base_url('register') ?>"
                            class="btn btn-register">
                            Register
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>