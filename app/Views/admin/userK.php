<?= $this->extend('template/templateAdmin') ?>
<?= $this->section('content') ?>

<style>
    .user-card {
        background: #fff;
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
    }

    .page-title {
        font-weight: 700;
    }

    .page-subtitle {
        color: #6c757d;
    }

    .table thead {
        background: #0d6efd;
        color: #fff;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
    }

    .avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #0d6efd;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
    }

    .role-admin {
        background: #dc3545;
        color: #fff;
    }

    .role-user {
        background: #198754;
        color: #fff;
    }

    .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
    }

    .dropdown-item:hover {
        background: #f8f9fa;
    }

    .btn-role {
        min-width: 150px;
    }

    .input-group {
        width: 320px;
    }

    .input-group .form-control {
        box-shadow: none;
    }

    .test {
        width: 100%;

        text-align: left;
    }

    .btn-tambah-user {
        text-wrap: nowrap;
    }

    .input-group-text {
        background: #fff;
    }

    #cardUser {

        position: fixed;

        inset: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: slideIn .3s ease;
        overflow-y: hidden;
        padding: 20px;

        z-index: 9999;

    }

    #cardUser .card {
        width: 100%;

        max-width: 700px;
        border: none;
        overflow: hidden;

        border-radius: 10px;

    }

    #cardUser .card-body {

        max-height: calc(90vh - 70px);
        overflow-y: auto;
        padding: 25px;
    }

    #cardUser .card-body::-webkit-scrollbar {
        width: 2px;
    }

    #cardUser .card-body::-webkit-scrollbar-thumb {
        background: #bdbdbd;
        border-radius: 10px;
    }

    #cardUser .card-body::-webkit-scrollbar-thumb:hover {
        background: #8d8d8d;
    }

    #cardUser .input-group {
        width: 100%;
    }

    #cardUser .form-control,
    #cardUser .form-select {
        height: 48px;
    }

    #cardEditUser .card-header,
    #cardUser .card-header {
        position: sticky;
        top: 0;

        z-index: 10;
        border-radius: 18px 18px 0 0;
        background-image: url('/assets/sidebar.png');
        background-repeat: no-repeat;
        background-size: cover;
        color: white;

        padding: 18px 24px;
        border-bottom: none;
    }


    #cardEditUser {

        position: fixed;
        inset: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: slideIn .3s ease;
        overflow-y: hidden;
        padding: 20px;

        z-index: 9999;

    }

    #cardEditUser .card {
        width: 100%;

        max-width: 700px;
        border: none;
        overflow: hidden;
        border-radius: 10px;

    }

    #cardEditUser .card-body {
        max-height: calc(85vh - 70px);
        overflow-y: auto;
        padding: 25px;
    }

    #cardEditUser .card-body::-webkit-scrollbar {
        width: 2px;
    }

    #cardEditUser .card-body::-webkit-scrollbar-thumb {
        background: #bdbdbd;
        border-radius: 10px;
    }

    #cardEditUser .card-body::-webkit-scrollbar-thumb:hover {
        background: #8d8d8d;
    }

    #cardEditUser .input-group {
        width: 100%;
    }

    #cardEditUser .form-control,
    #cardEditUser .form-select {
        height: 48px;
    }



    .close {
        margin-left: auto;
        padding: 10px;
        color: white;
    }


    .swal-top {
        z-index: 99999 !important;
    }


    @media (max-width:768px) {
        .test h3 {
            font-size: 20px;
        }

        .btn-tambah-user {
            height: 32px;
            font-size: 14px;
        }

        .search-box .form-control,
        .search-box .input-group-text,
        .search-box .btn {
            height: 32px;
            font-size: 14px;

        }

        .search-box .input-group-text,
        .search-box .btn {
            display: flex;
            align-items: center;
        }

        .container-fluid {
            padding: 15px;
        }

        .dropdown-item {
            font-size: 13px;
        }

        .page-title {
            font-size: 24px;
        }

        .page-subtitle {
            font-size: 14px;
        }

        .header-user {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .action-user {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .action-user form {
            width: 100%;
        }

        .input-group {
            width: 100%;
        }

        /* Hanya tombol Tambah User */
        .btn-tambah-user {
            width: 100%;
        }

        .table {
            font-size: 14px;
        }

        .table th,
        .table td {
            white-space: nowrap;
            vertical-align: middle;
        }

        .btn-role {
            font-size: 13px;
            min-width: 120px;
        }

        .tombol_bawah {
            padding: 0.35rem 0.6rem;
            font-size: 16px;
            line-height: 1.5;
            border-radius: 0.25rem;
        }

        #cardUser {
            top: 0;
            right: 5px;
            left: 5px;
            width: 90%;
            height: 95%;

            border-radius: 20px;

        }


        #cardUser .card {
            height: 90%;
            font-size: 13px;
            border-radius: 0;
        }

        #cardUser .card-header {

            border-radius: 18px 18px 0 0;
        }

        #cardUser h4,
        #cardEditUser h4 {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            font-size: 19px;



        }

        #cardUser h4 svg,
        #cardEditUser h4 svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        #cardEditUser {
            top: 0;
            right: 10px;
            left: 10px;
            width: 90%;
            height: 95%;

            border-radius: 20px;
        }

        #cardEditUser .form-control,
        #cardEditUser .form-select,

        #cardUser .form-control,
        #cardUser .form-select {
            height: 40px;
            font-size: 13px;
        }



        #cardEditUser .card {
            height: 90%;
            font-size: 13px;
            border-radius: 0;
        }

        #cardEditUser .card-header {

            border-radius: 18px 18px 0 0;
        }
    }




    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(40px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

<div class="container-fluid py-4">



    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4 header-user">

        <div class="test">

            <h3 class="page-title mb-1">



                Manajemen User

            </h3>

            <div class="subjudul page-subtitle">

                Total User :
                <strong id="total-user"><?= $jumlah ?></strong>

            </div>

        </div>

        <div class="d-flex align-items-center gap-2 action-user">

            <form id="formCariUser" method="get">

                <div class="input-group search-box">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </span>

                    <input
                        id="inputCariUser"
                        type="text"
                        class="form-control"
                        name="keyword"
                        placeholder="Cari user..."
                        value="<?= $_GET['keyword'] ?? '' ?>"
                        autocomplete="off">

                    <button class="btn btn-primary" type="submit">
                        Cari
                    </button>
                </div>

            </form>

            <button type="button" onclick="ShowCard()" class="btn btn-primary btn-tambah-user">



                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                </svg> Tambah User

            </button>

        </div>

    </div>

    <!-- FLASH -->
    <?php if (session()->getFlashdata('pesan')) : ?>

        <script>
            Swal.fire({
                icon: 'success',
                title: 'berhasil',
                text: '<?= session()->getFlashdata('pesan') ?>',
                showConfirmButton: false,
                timer: 1000
            });
        </script>


    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'gagal',
                text: '<?= session()->getFlashdata('error') ?>',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    <?php endif; ?>
    <!-- TABLE -->

    <div class="table-responsive">

        <table class="table align-middle text-center table-hover">

            <thead>

                <tr>

                    <th>No</th>

                    <th>User</th>

                    <th>Role</th>

                    <th width="200">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>



                <?php foreach ($data as $user): ?>
                    <?php if ($user['name'] !== session()->get('name')) :
                        # code...
                    ?>
                        <tr id="user-<?= $user['id'] ?>">

                            <td><?= $nomor++ ?></td>

                            <td>

                                <div class="d-flex align-items-center">


                                    <div class="ms-3 text-start">

                                        <div class="fw-semibold">

                                            <?= $user['name'] ?>

                                        </div>

                                        <small class="text-muted">

                                            <?= $user['email'] ?>

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td id="role-badge-<?= $user['id'] ?>">

                                <?php if ($user['role'] == "admin"): ?>

                                    <span class="badge role-admin px-3 py-2">

                                        Admin

                                    </span>

                                <?php else: ?>

                                    <span class="badge role-user px-3 py-2">

                                        User

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    <button
                                        id="btn-edit-<?= $user['id'] ?>"
                                        class="btn btn-warning btn-sm"
                                        data-id="<?= $user['id'] ?>"
                                        data-name="<?= esc($user['name'], 'attr') ?>"
                                        data-email="<?= esc($user['email'], 'attr') ?>"
                                        data-role="<?= esc($user['role'], 'attr') ?>"
                                        data-department="<?= esc($user['department'] ?? '', 'attr') ?>"
                                        onclick="editUser(this)">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </button>
                                    <form id="form-hapus-user-<?= $user['id'] ?>" action="<?= site_url('user/hapus/' . $user['id']) ?>" method="post">
                                        <?= csrf_field() ?>

                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="button" class="btn btn-danger" onclick="confirmDeleteUser(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>
                    <?php endif ?>
                <?php endforeach; ?>

            </tbody>

        </table>
        <div class="d-flex justify-content-center mt-3" id="paginationUser">
            <?= $pager->links('default', 'pager') ?>
        </div>
    </div>



</div>

<div id="cardUser" style="display: none;" class="container py-3 mt-0">

    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header d-flex justify-content-between text-white py-3">
                    <h4 class="mb-0 fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                        </svg> Tambah User
                    </h4>
                    <button type="button"
                        class="btn  btn-sm  btn-close bg-transparent"
                        onclick="CloseCard()">

                    </button>
                </div>

                <div class="card-body p-4">

                    <form id="formTambahUser" action="<?= site_url('admin/proses_C') ?>" method="post">
                        <?= csrf_field(); ?>
                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                    </svg></span>
                                <input id="inputNamaUser" type="text"
                                    name="name"
                                    class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>"
                                    value="<?= $old_name ?? '' ?>"
                                    placeholder="Masukkan name">
                                <div class="invalid-feedback" id="errorNamaUser">
                                    <?= $validation->getError('name') ?>
                                </div>

                            </div>


                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                    </svg></span>
                                <input id="inputEmailUser" type="text"
                                    name="email"
                                    class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                                    value="<?= $old_email ?? '' ?>"
                                    placeholder="Masukkan email">
                                <div class="invalid-feedback" id="errorEmailUser">
                                    <?= $validation->getError('email') ?>
                                </div>
                            </div>

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
                                <button class="btn btn-outline-secondary "
                                    type="button"
                                    id="togglePassword">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                                <div class="invalid-feedback" id="errorPasswordUser">
                                    <?= $validation->getError('password') ?>
                                </div>
                            </div>

                        </div>

                        <!-- Role -->
                        <div class="mb-3">

                            <label class="form-label ">Role</label>
                            <div class="input-group">

                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-fill-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793z" />
                                    </svg></span>
                                <select id="inputRoleUser" class="form-select  <?= ($validation->hasError('role')) ? 'is-invalid' : '' ?>" name="role">
                                    <option selected disabled>Pilih Role</option>
                                    <option value="admin" <?= $old_role   == 'admin' ? 'selected' : '' ?>>
                                        Admin
                                    </option>
                                    <option value="karyawan" <?= $old_role == 'karyawan' ? 'selected' : '' ?>>
                                        User
                                    </option>
                                </select>

                                <div class="invalid-feedback" id="errorRoleUser">
                                    <?= $validation->getError('role') ?>
                                </div>
                            </div>

                        </div>

                        <!-- Department -->
                        <div class="mb-4">
                            <label class="form-label">Department</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                                        <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5" />
                                    </svg></span>
                                <input id="inputDepartmentUser" type="text"
                                    name="department"
                                    class="form-control <?= ($validation->hasError('department')) ? 'is-invalid' : '' ?>"
                                    value="<?= $old_department ?? '' ?>"
                                    placeholder="Masukkan departemen">
                                <div class="invalid-feedback" id="errorDepartmentUser">
                                    <?= $validation->getError('department') ?>
                                </div>
                            </div>

                        </div>


                        <!-- Button -->
                        <div class="d-flex justify-content-end gap-2">

                            <button type="button" onclick="reset(this)" class="btn tombol_bawah btn-secondary">

                                reset
                            </button>

                            <button type="button" class="btn  tombol_bawah btn-primary" onclick="confirmUser(this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                </svg>
                                Simpan User
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
<div id="cardEditUser" style="display: none;" class="container py-3 mt-0">

    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card shadow border-0 rounded-4">

                <div class="card-header d-flex justify-content-between text-white py-3">
                    <h4 class="mb-0 fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg> Edit User
                    </h4>
                    <button type="button"
                        class="btn  btn-sm  btn-close bg-transparent"
                        onclick="CloseEditCard()">

                    </button>
                </div>
                <div class="card-body p-4">

                    <form id="formEditUser" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" id="editUserId" name="id">

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                    </svg></span>
                                <input type="text" id="inputNamaUserEdit" name="name" class="form-control" placeholder="Masukkan name">
                                <div class="invalid-feedback" id="errorNamaUserEdit"></div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                    </svg></span>
                                <input type="text" id="inputEmailUserEdit" name="email" class="form-control" placeholder="Masukkan email">
                                <div class="invalid-feedback" id="errorEmailUserEdit"></div>
                            </div>
                        </div>

                        <!-- Password (opsional) -->
                        <div class="mb-3">
                            <label class="form-label">Password Baru <small class="text-muted">(kosongkan jika tidak ingin mengubah)</small></label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4m0 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3" />
                                    </svg></span>
                                <input type="password" id="inputPasswordUserEdit" name="password" class="form-control" placeholder="Isi jika ingin ganti password">
                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordEdit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                                <div class="invalid-feedback" id="errorPasswordUserEdit"></div>
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-fill-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793z" />
                                    </svg></span>
                                <select class="form-select" id="inputRoleUserEdit" name="role">

                                    <option value="admin">Admin</option>
                                    <option value="karyawan">User</option>
                                </select>
                                <div class="invalid-feedback" id="errorRoleUserEdit"></div>
                            </div>
                        </div>

                        <!-- Department -->
                        <div class="mb-4">
                            <label class="form-label">Department</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                                        <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5" />
                                    </svg></span>
                                <input type="text" id="inputDepartmentUserEdit" name="department" class="form-control" placeholder="Masukkan departemen">
                                <div class="invalid-feedback" id="errorDepartmentUserEdit"></div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" onclick="CloseEditCard()" class="btn tombol_bawah btn-secondary">
                                Batal
                            </button>
                            <button type="button" class="btn tombol-bawah btn-primary" onclick="confirmEditUser(this)">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($validation) && $validation->getErrors()) : ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("cardUser").style.display = "block";
        });
    </script>
<?php endif; ?>
<script>
    const password = document.getElementById('password');
    const toggle = document.getElementById('togglePassword');
    toggle.addEventListener('click', function() {
        password.type = password.type === 'password' ? 'text' : 'password';
    });

    const passwordEdit = document.getElementById('inputPasswordUserEdit');
    const toggleEdit = document.getElementById('togglePasswordEdit');
    toggleEdit.addEventListener('click', function() {
        passwordEdit.type = passwordEdit.type === 'password' ? 'text' : 'password';
    });
</script>

<script>
    // ==========================================
    // TAMBAH USER - Cek validasi dulu, baru SweetAlert
    // ==========================================
    async function confirmUser(button) {
        const form = document.getElementById('formTambahUser');
        const formData = new FormData(form);

        button.disabled = true;
        clearUserErrors('formTambahUser');

        try {
            const res = await fetch('/cek-user', {
                method: 'POST',
                body: formData,
            });

            const result = await res.json();
            updateCsrfTokenUser(form, result.csrf_name, result.csrf_hash);

            if (!result.valid) {
                showUserErrors(result.errors || {}, {
                    name: ['inputNamaUser', 'errorNamaUser'],
                    email: ['inputEmailUser', 'errorEmailUser'],
                    password: ['password', 'errorPasswordUser'],
                    role: ['inputRoleUser', 'errorRoleUser'],
                    department: ['inputDepartmentUser', 'errorDepartmentUser'],
                });
                button.disabled = false;
                return;
            }

            Swal.fire({
                title: 'Tambah User?',
                text: 'Apakah Anda yakin ingin menambahkan user ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tambah!',
                cancelButtonText: 'Batal',
                customClass: {
                    container: 'swal-top'
                }
            }).then((confirmResult) => {
                button.disabled = false;
                if (confirmResult.isConfirmed) {
                    document.getElementById("cardUser").style.display = "none";
                    form.submit();
                }
            });

        } catch (err) {
            console.error('[Tambah User] Gagal:', err);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal memeriksa data, coba lagi.'
            });
            button.disabled = false;
        }
    }

    // ==========================================
    // EDIT USER - Buka modal, isi data, lalu cek validasi
    // ==========================================
    function editUser(button) {
        const id = button.dataset.id;
        const name = button.dataset.name;
        const email = button.dataset.email;
        const role = button.dataset.role;
        const department = button.dataset.department;

        document.getElementById('editUserId').value = id;
        document.getElementById('inputNamaUserEdit').value = name;
        document.getElementById('inputEmailUserEdit').value = email;
        document.getElementById('inputRoleUserEdit').value = role;
        document.getElementById('inputDepartmentUserEdit').value = department;
        document.getElementById('inputPasswordUserEdit').value = '';

        document.getElementById('formEditUser').action = '/user/update/' + id;

        clearUserErrors('formEditUser');
        document.getElementById("cardUser").style.display = "none";
        document.getElementById("cardEditUser").style.display = "block";
    }

    function CloseEditCard() {
        document.getElementById("cardEditUser").style.display = "none";
    }

    async function confirmEditUser(button) {
        const form = document.getElementById('formEditUser');
        const id = document.getElementById('editUserId').value;
        const formData = new FormData(form);

        button.disabled = true;
        clearUserErrors('formEditUser');

        try {
            const res = await fetch('/cek-user-update/' + id, {
                method: 'POST',
                body: formData,
            });

            const result = await res.json();
            updateCsrfTokenUser(form, result.csrf_name, result.csrf_hash);

            if (!result.valid) {
                showUserErrors(result.errors || {}, {
                    name: ['inputNamaUserEdit', 'errorNamaUserEdit'],
                    email: ['inputEmailUserEdit', 'errorEmailUserEdit'],
                    password: ['inputPasswordUserEdit', 'errorPasswordUserEdit'],
                    role: ['inputRoleUserEdit', 'errorRoleUserEdit'],
                    department: ['inputDepartmentUserEdit', 'errorDepartmentUserEdit'],
                });
                button.disabled = false;
                return;
            }

            Swal.fire({
                title: 'Simpan Perubahan?',
                text: 'Data user akan diperbarui.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal',
                customClass: {
                    container: 'swal-top'
                }
            }).then((confirmResult) => {
                button.disabled = false;
                if (confirmResult.isConfirmed) {
                    document.getElementById("cardEditUser").style.display = "none";
                    form.submit();
                }
            });

        } catch (err) {
            console.error('[Edit User] Gagal:', err);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal memeriksa data, coba lagi.'
            });
            button.disabled = false;
        }
    }

    // ==========================================
    // HAPUS USER - Konfirmasi dengan peringatan cascade
    // ==========================================
    function confirmDeleteUser(button) {
        Swal.fire({
            title: 'Hapus User Ini?',
            html: 'Semua <b>tiket</b> dan <b>riwayat aktivitas</b> milik user ini akan ikut terhapus permanen.<br>Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus Semua!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc3545',
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit();
            }
        });
    }

    // ==========================================
    // Helper Bersama
    // ==========================================
    function updateCsrfTokenUser(form, name, hash) {
        if (!name || !hash) return;

        document.querySelectorAll(`input[name="${name}"]`).forEach(el => {
            el.value = hash;
        });
    }

    function showUserErrors(errors, fieldMap) {
        Object.keys(errors).forEach(field => {
            const map = fieldMap[field];
            if (!map) return;
            const [inputId, errorId] = map;
            const inputEl = document.getElementById(inputId);
            const errorEl = document.getElementById(errorId);
            if (inputEl) inputEl.classList.add('is-invalid');
            if (errorEl) errorEl.textContent = errors[field];
        });
    }

    function clearUserErrors(formId) {
        const form = document.getElementById(formId);
        if (!form) return;
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
    }
</script>

<script>
    function ShowCard() {
        document.getElementById("cardUser").style.display = "block";
    }

    function CloseCard() {
        document.getElementById("cardUser").style.display = "none";
    }
</script>

<script>
    function reset(button) {
        const form = button.closest('form');
        form.reset();
        clearUserErrors('formTambahUser');
    }
</script>

<script>
    (function() {
        const inputCari = document.getElementById('inputCariUser');
        const formCari = document.getElementById('formCariUser');
        const tbody = document.querySelector('table tbody');

        if (!inputCari || !formCari || !tbody) {
            console.error('[Search User] Elemen tidak ditemukan');
            return;
        }

        let debounceTimer;
        let currentController = null;

        inputCari.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => doSearchUser(1), 200);
        });

        formCari.addEventListener('submit', (e) => {
            e.preventDefault();
            clearTimeout(debounceTimer);
            doSearchUser(1);
        });

        async function doSearchUser(page = 1) {
            if (currentController) currentController.abort();
            currentController = new AbortController();

            const params = new URLSearchParams({
                keyword: inputCari.value,
                page: page
            });

            try {
                const res = await fetch(`/users/searchk?${params.toString()}`, {
                    signal: currentController.signal
                });
                if (!res.ok) {
                    console.error('[Search User] Response gagal, status:', res.status);
                    return;
                }
                const result = await res.json();
                renderTableUser(result.data);
                renderPaginationUser(result.currentPage, result.totalPages);
                updateTotalUserSearch(result.total);
            } catch (err) {
                if (err.name !== 'AbortError') console.error('[Search User] Gagal:', err);
            }
        }

        function renderTableUser(items) {
            if (!items || items.length === 0) {
                tbody.innerHTML = `<tr><td colspan="4" class="text-center text-muted py-4">Tidak ada user ditemukan</td></tr>`;
                return;
            }

            tbody.innerHTML = items.map(u => `
                <tr id="user-${u.id}">
                    <td>${u.no}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="ms-3 text-start">
                                <div class="fw-semibold">${escapeHtmlUser(u.name)}</div>
                                <small class="text-muted">${escapeHtmlUser(u.email)}</small>
                            </div>
                        </div>
                    </td>
                    <td id="role-badge-${u.id}">${buildRoleBadgeUser(u.role)}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <button
                                id="btn-edit-${u.id}"
                                class="btn btn-warning btn-sm"
                                data-id="${u.id}"
                                data-name="${escapeAttrUser(u.name)}"
                                data-email="${escapeAttrUser(u.email)}"
                                data-role="${escapeAttrUser(u.role)}"
                                data-department="${escapeAttrUser(u.department || '')}"
                                onclick="editUser(this)">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                            </button>
                            <form id="form-hapus-user-${u.id}" action="/user/hapus/${u.id}" method="post">
                                ${getCsrfInputUser()}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="btn btn-danger" onclick="confirmDeleteUser(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function renderPaginationUser(currentPage, totalPages) {
            const container = document.getElementById('paginationUser');
            if (!container) return;

            if (totalPages <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = '<ul class="pagination">';
            html += `<li class="page-item ${currentPage <= 1 ? 'disabled' : ''}"><a class="page-link page-link-user" href="#" data-page="${currentPage - 1}">&laquo;</a></li>`;
            for (let i = 1; i <= totalPages; i++) {
                html += `<li class="page-item ${i === currentPage ? 'active' : ''}"><a class="page-link page-link-user" href="#" data-page="${i}">${i}</a></li>`;
            }
            html += `<li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}"><a class="page-link page-link-user" href="#" data-page="${currentPage + 1}">&raquo;</a></li>`;
            html += '</ul>';
            container.innerHTML = html;

            container.querySelectorAll('.page-link-user').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const page = parseInt(link.getAttribute('data-page'));
                    if (page < 1 || page > totalPages || page === currentPage) return;
                    doSearchUser(page);
                });
            });
        }

        function updateTotalUserSearch(total) {
            const el = document.getElementById('total-user');
            if (el) el.textContent = total;
        }

        window.getCsrfInputUser = function() {
            const existingForm = document.getElementById('formTambahUser');
            if (!existingForm) return '';
            const csrfInput = existingForm.querySelector('input[name^="csrf"]');
            if (!csrfInput) return '';
            return `<input type="hidden" name="${csrfInput.name}" value="${csrfInput.value}">`;
        };

        window.buildRoleBadgeUser = function(role) {
            const badgeClass = role === 'admin' ? 'role-admin' : 'role-user';
            const badgeText = role === 'admin' ? 'Admin' : 'User';
            return `<span class="badge ${badgeClass} px-3 py-2">${badgeText}</span>`;
        };

        function escapeHtmlUser(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        window.escapeAttrUser = function(str) {
            return (str ?? '').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
        };
    })();
</script>

<script>
    // ==========================================
    // WebSocket - Real-time Manajemen User
    // ==========================================
    const wsUrl = window.WS_URL;
    const currentUserName = "<?= esc(session()->get('name')) ?>";

    let socket;

    function connectWebSocket() {
        socket = new WebSocket(wsUrl);

        socket.onopen = () => {
            console.log('[WS] Terhubung');
            clearInterval(window.__wsPing);
            window.__wsPing = setInterval(() => {
                if (socket.readyState === WebSocket.OPEN) {
                    socket.send('ping');
                }
            }, 25000);
        };

        socket.onmessage = (event) => {
            const payload = JSON.parse(event.data);

            if (payload.type === 'new_user') handleNewUser(payload.data);
            if (payload.type === 'user_updated') handleUserUpdated(payload.data);
            if (payload.type === 'delete_user') handleDeleteUser(payload.data);
        };

        socket.onclose = () => {
            console.log('[WS] Terputus, reconnect dalam 3 detik...');
            setTimeout(connectWebSocket, 3000);
        };
    }

    function handleNewUser(u) {
        if (u.name === currentUserName) return;
        if (document.getElementById('user-' + u.id)) return;

        const tbody = document.querySelector('table tbody');
        const row = document.createElement('tr');
        row.id = 'user-' + u.id;
        row.style.backgroundColor = '#fff3cd';

        row.innerHTML = `
            <td><span class="badge bg-warning text-dark">Baru</span></td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="ms-3 text-start">
                        <div class="fw-semibold">${escapeHtml(u.name)}</div>
                        <small class="text-muted">${escapeHtml(u.email)}</small>
                    </div>
                </div>
            </td>
            <td id="role-badge-${u.id}">${buildRoleBadgeUser(u.role)}</td>
            <td>
                <div class="d-flex justify-content-center gap-2">
                    <button
                        id="btn-edit-${u.id}"
                        class="btn btn-warning btn-sm"
                        data-id="${u.id}"
                        data-name="${escapeAttrUser(u.name)}"
                        data-email="${escapeAttrUser(u.email)}"
                        data-role="${escapeAttrUser(u.role)}"
                        data-department="${escapeAttrUser(u.department || '')}"
                        onclick="editUser(this)">
                        
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                    </button>
                    <form id="form-hapus-user-${u.id}" action="/user/hapus/${u.id}" method="post">
                        ${getCsrfInputUser()}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-danger" onclick="confirmDeleteUser(this)">
                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                        </button>
                    </form>
                </div>
            </td>
        `;

        tbody.insertBefore(row, tbody.firstChild);
        updateTotalUser(1);
        setTimeout(() => row.style.backgroundColor = '', 3000);
    }

    function handleUserUpdated(u) {
        const row = document.getElementById('user-' + u.id);
        const badgeEl = document.getElementById('role-badge-' + u.id);
        const btnEditEl = document.getElementById('btn-edit-' + u.id);

        if (!row) return;

        const nameEl = row.querySelector('.fw-semibold');
        const emailEl = row.querySelector('small.text-muted');
        if (nameEl) nameEl.textContent = u.name;
        if (emailEl) emailEl.textContent = u.email;

        if (badgeEl) badgeEl.innerHTML = buildRoleBadgeUser(u.role);

        if (btnEditEl) {
            btnEditEl.dataset.name = u.name;
            btnEditEl.dataset.email = u.email;
            btnEditEl.dataset.role = u.role;
            btnEditEl.dataset.department = u.department || '';
        }

        row.style.backgroundColor = '#d1ecf1';
        setTimeout(() => row.style.backgroundColor = '', 3000);
    }

    function handleDeleteUser(data) {
        const row = document.getElementById('user-' + data.id);
        if (!row) return;

        row.style.transition = 'background-color 0.5s ease, opacity 0.5s ease';
        row.style.backgroundColor = '#f8d7da';
        row.style.opacity = '0.5';

        setTimeout(() => {
            row.remove();
            updateTotalUser(-1);
        }, 800);
    }

    function updateTotalUser(delta) {
        const el = document.getElementById('total-user');
        if (!el) return;
        el.textContent = parseInt(el.textContent) + delta;
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str ?? '';
        return div.innerHTML;
    }

    connectWebSocket();
</script>
<?= $this->endSection() ?>