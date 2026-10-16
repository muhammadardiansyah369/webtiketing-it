<?= $this->extend('template/templateLogin'); ?>
<?= $this->section('content') ?>



<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card p-5  col-11 col-sm-9 col-md-7 col-lg-5 login-card border-0 shadow-lg rounded-4">

        <h3 class="text-center mb-4 login-title">register</h3>



        <form action="/register/proses_r" method="post">
            <?= csrf_field() ?>

            <!-- Username -->
            <div class="mb-3">
                <label class="form-label">name</label>
                <div class="input-group">
                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg></span>
                    <input type="text"
                        name="name"

                        class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>"

                        placeholder="Masukkan name">

                    <div class="invalid-feedback">
                        <?= $validation->getError('name') ?>
                    </div>

                </div>
                <?php if (session()->getFlashdata('name')): ?>
                    <div class="alert alert-danger p-2 mt-2">
                        <?= session()->getFlashdata('name') ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Username -->
            <div class="mb-3">
                <label class="form-label">email</label>
                <div class="input-group">
                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                        </svg></span>
                    <input type="text"
                        name="email"
                        class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"

                        placeholder="Masukkan email">

                    <div class="invalid-feedback">
                        <?= $validation->getError('email') ?>
                    </div>
                </div>
                <?php if (session()->getFlashdata('email')): ?>
                    <div class="alert alert-danger p-2 mt-2">
                        <?= session()->getFlashdata('email') ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Username -->
            <div class="mb-3">
                <label class="form-label">departemen</label>
                <div class="input-group">
                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                            <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5" />
                        </svg></span>
                    <input type="text"
                        name="department"
                        class="form-control <?= ($validation->hasError('department')) ? 'is-invalid' : '' ?>"

                        placeholder="Masukkan departemen">

                    <div class="invalid-feedback">
                        <?= $validation->getError('department') ?>
                    </div>
                </div>
                <?php if (session()->getFlashdata('deprtment')): ?>
                    <div class="alert alert-danger p-2 mt-2">
                        <?= session()->getFlashdata('department') ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4m0 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3" />
                        </svg></span>
                    <input type="password"
                        name="password"
                        id="password"
                        class="form-control <?= ($validation->hasError('password')) ? 'is-invalid ' : '' ?>"
                        placeholder="Masukkan password">
                    <button class="btn btn-outline-secondary"
                        type="button"
                        id="togglePassword">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                        </svg>
                    </button>
                    <div class="invalid-feedback">
                        <?= $validation->getError('password') ?>
                    </div>
                </div>
                <?php if (session()->getFlashdata('password')): ?>
                    <div class="alert alert-danger p-2 mt-2">
                        <?= session()->getFlashdata('password') ?>
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">
                register
            </button>

            <div class="text-center auth-link">
                <p class="mb-0">
                    <a href="/login">sudah punya akun?</a>
                </p>
            </div>

        </form>
    </div>
</div>
<script>
    const password = document.getElementById('password');
    const toggle = document.getElementById('togglePassword');


    toggle.addEventListener('click', function() {

        if (password.type === 'password') {
            password.type = 'text';

        } else {
            password.type = 'password';

        }

    });
</script>
<?= $this->endSection(); ?>