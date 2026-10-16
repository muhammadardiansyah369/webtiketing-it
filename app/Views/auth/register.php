<?= $this->extend('template/templateLogin'); ?>
<?= $this->section('content') ?>


<div class="login-wrapper">
    <div class="login-box">

        <div class="login-left">


            <img src="/assets/IT.jpg" alt="">



        </div>
        <div class="login-right">
            <img src="/assets/logo.png" width="200" alt="">
            <h3 class="logo">Register Website Tiketing IT</h3>

            <div class="avatar">
                <svg xmlns="http://www.w3.org/2000/svg" width="250" height="250" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
            </div>

            <form action="/register/proses_r" method="post">
                <?= csrf_field() ?>

                <div class="mb-4">

                    <div class="input-group <?= $validation->hasError('name') ? 'border-danger' : '' ?>">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                        </span>

                        <input
                            type="text"
                            name="name"
                            class="form-control <?= $validation->hasError('name') ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan nama"
                            value="<?= old('name') ?>">
                    </div>

                    <?php if ($validation->hasError('name')) : ?>
                        <div class="error-text">
                            <?= $validation->getError('name') ?>
                        </div>
                    <?php endif; ?>

                </div>



                <div class="mb-4">
                    <div class="input-group <?= $validation->hasError('email') ? 'border-danger' : '' ?>">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                            </svg>
                        </span>

                        <input
                            type="text"
                            name="email"
                            class="form-control <?= $validation->hasError('email') ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan email"
                            value="<?= old('email') ?>">
                    </div>

                    <?php if ($validation->hasError('email')) : ?>
                        <div class="error-text">
                            <?= $validation->getError('email') ?>
                        </div>
                    <?php endif; ?>
                </div>


                <div class="mb-4">

                    <div class="input-group <?= $validation->hasError('department') ? 'border-danger' : '' ?>">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                                <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5" />
                            </svg>
                        </span>

                        <input
                            type="text"
                            name="department"
                            class="form-control <?= $validation->hasError('department') ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan departemen"
                            value="<?= old('department') ?>">
                    </div>

                    <?php if ($validation->hasError('department')) : ?>
                        <div class="error-text">
                            <?= $validation->getError('department') ?>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="mb-4">

                    <div class="input-group <?= $validation->hasError('password') ? 'border-danger' : '' ?>">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4m0 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3" />
                            </svg>
                        </span>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan password"
                            value="<?= old('password') ?>">

                        <button type="button" class="btn" id="togglePassword"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                            </svg></button>
                    </div>

                    <?php if ($validation->hasError('password')) : ?>
                        <div class="error-text">
                            <?= $validation->getError('password') ?>
                        </div>
                    <?php endif; ?>

                </div>


                <button class="btn-login">Register</button>

            </form>
            <div class="text-bawah">
                <a href="/login"> Sudah punya akun?</a>


            </div>
        </div>


    </div>
</div>

<script>
    const p = document.getElementById('password');
    document.getElementById('togglePassword').onclick = () => {
        p.type = p.type === 'password' ? 'text' : 'password';
    }
</script>

<?= $this->endSection() ?>