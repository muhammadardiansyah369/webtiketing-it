<?= $this->extend('template/templateLogin'); ?>
<?= $this->section('content') ?>


<style>
    .text-bawah {

        display: flex;
        text-align: left;

        text-transform: capitalize;
        flex-direction: column;
        margin-top: 10px;
        font-size: 12px;
    }
</style>
<div class="login-wrapper">
    <div class="login-box">


        <div class="login-left">


            <img src="/assets/IT.jpg" alt="">



        </div>
        <div class="login-right">
            <img src="/assets/logo.png" width="200" alt="">
            <h3 class="logo">Reset password</h3>

            <div class="avatar">
                <svg xmlns="http://www.w3.org/2000/svg" width="250" height="250" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
            </div>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= site_url('forgot-password/proses') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">

                    <div class="input-group ">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                            </svg>
                        </span>

                        <input
                            type="email"
                            name="email"
                            class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan nama"
                            value="<?= old('email') ?>">
                    </div>
                    <?php if ($validation->hasError('email')) : ?>
                        <div class="error-text">
                            <?= $validation->getError('email') ?>
                        </div>
                    <?php endif; ?>



                </div>

                <button type="submit" class="btn-login">kirim reset password</button>

            </form>
            <div class="text-bawah">
                <a href="/login"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg> Kembali?</a>


            </div>
        </div>



    </div>
</div>

<?= $this->endSection() ?>