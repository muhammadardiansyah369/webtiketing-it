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
        max-height: calc(80vh - 70px);
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

    #cardUser .card-header {
        border: white 1px solid;
        background-image: url('/assets/sidebar.png');
        background-repeat: no-repeat;
        background-size: cover;
        border-radius: 18px 18px 0 0;
    }


    .close {
        margin-left: auto;
        padding: 10px;
        color: white;
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


        #cardTiket {
            top: 0;
            right: 10px;
            left: 10px;
            width: 90%;
            height: 95vh;

            border-radius: 20px;
        }


        #cardUser .card {
            border-radius: 0;
        }

        #cardUser .card-header {
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



                Manajemen Admin

            </h3>

            <div class="subjudul page-subtitle">

                Total User :
                <strong id="total-user"><?= $jumlah ?></strong>

            </div>

        </div>

        <div class="d-flex align-items-center gap-2 action-user">

            <form id="formCariUser" action="<?= site_url('users') ?>" method="get">

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

                            <div class="dropdown" id="dropdown-role-<?= $user['id'] ?>">

                                <button
                                    class="btn btn-outline-primary btn-role dropdown-toggle"
                                    data-bs-toggle="dropdown">



                                    Ubah Role

                                </button>

                                <ul class="dropdown-menu dropdown-menu-end" id="dropdown-menu-<?= $user['id'] ?>">

                                    <?php if ($user['role'] == "admin"): ?>

                                        <li>

                                            <form action="<?= site_url('ubahrole') ?>" method="post">

                                                <?= csrf_field() ?>

                                                <input
                                                    type="hidden"
                                                    name="id"
                                                    value="<?= $user['id'] ?>">

                                                <input
                                                    type="hidden"
                                                    name="role"
                                                    value="user">

                                                <button type="button" class="dropdown-item" onclick="confirmRole(this)">

                                                    Jadikan User

                                                </button>

                                            </form>

                                        </li>

                                    <?php else: ?>

                                        <li>

                                            <form action="<?= site_url('ubahrole') ?>" method="post">

                                                <?= csrf_field() ?>

                                                <input
                                                    type="hidden"
                                                    name="id"
                                                    value="<?= $user['id'] ?>">

                                                <input
                                                    type="hidden"
                                                    name="role"
                                                    value="admin">

                                                <button type="button" class="dropdown-item" onclick="confirmRole(this)">

                                                    Jadikan Admin

                                                </button>

                                            </form>

                                        </li>

                                    <?php endif; ?>

                                </ul>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>
        <div class="d-flex justify-content-center mt-3" id="paginationUser">
            <?= $pager->links('default', 'pager') ?>
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

        if (password.type === 'password') {
            password.type = 'text';

        } else {
            password.type = 'password';

        }

    });
</script>
<script>
    function confirmUser(button) {
        const form = button.closest('form');

        document.getElementById("cardUser").style.display = "none";

        Swal.fire({
            title: 'Tambah Ticket?',
            text: 'Apakah Anda yakin ingin menambahkan ticket?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tambah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // langsung kirim, validasi ditangani server
            } else {
                document.getElementById("cardUser").style.display = "block";
            }
        });
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

        // 1. Reset semua input teks, select, textarea ke kondisi awal
        form.reset();


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
            debounceTimer = setTimeout(() => {
                doSearchUser(1);
            }, 200);
        });

        formCari.addEventListener('submit', (e) => {
            e.preventDefault();
            clearTimeout(debounceTimer);
            doSearchUser(1);
        });

        async function doSearchUser(page = 1) {
            if (currentController) {
                currentController.abort();
            }
            currentController = new AbortController();

            const params = new URLSearchParams({
                keyword: inputCari.value,
                page: page,
            });

            try {
                const res = await fetch(`/users/search?${params.toString()}`, {
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
                if (err.name !== 'AbortError') {
                    console.error('[Search User] Gagal mengambil data:', err);
                }
            }
        }

        function renderTableUser(items) {
            if (!items || items.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        Tidak ada user ditemukan
                    </td>
                </tr>
            `;
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
                <td id="role-badge-${u.id}">
                    ${buildRoleBadge(u.role)}
                </td>
                <td>
                    <div class="dropdown" id="dropdown-role-${u.id}">
                        <button class="btn btn-outline-primary btn-role dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-gear"></i> Ubah Role
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" id="dropdown-menu-${u.id}">
                            ${buildRoleMenu(u)}
                        </ul>
                    </div>
                </td>
            </tr>
        `).join('');
        }

        function buildRoleBadge(role) {
            const badgeClass = role === 'admin' ? 'role-admin' : 'role-user';
            const badgeText = role === 'admin' ? 'Admin' : 'User';
            return `<span class="badge ${badgeClass} px-3 py-2">${badgeText}</span>`;
        }

        function buildRoleMenu(u) {
            const toggleRoleValue = u.role === 'admin' ? 'user' : 'admin';
            const toggleRoleLabel = u.role === 'admin' ? 'Jadikan User' : 'Jadikan Admin';
            const csrfInput = getCsrfInputUser();

            return `
            <li>
                <form action="/ubahrole" method="post">
                    ${csrfInput}
                    <input type="hidden" name="id" value="${u.id}">
                    <input type="hidden" name="role" value="${toggleRoleValue}">
                    <button type="button" class="dropdown-item" onclick="confirmRole(this)">${toggleRoleLabel}</button>
                </form>
            </li>
        `;
        }

        function renderPaginationUser(currentPage, totalPages) {
            const container = document.getElementById('paginationUser');
            if (!container) return;

            if (totalPages <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = '<ul class="pagination">';

            html += `
            <li class="page-item ${currentPage <= 1 ? 'disabled' : ''}">
                <a class="page-link page-link-user" href="#" data-page="${currentPage - 1}">&laquo;</a>
            </li>
        `;

            for (let i = 1; i <= totalPages; i++) {
                html += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link page-link-user" href="#" data-page="${i}">${i}</a>
                </li>
            `;
            }

            html += `
            <li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}">
                <a class="page-link page-link-user" href="#" data-page="${currentPage + 1}">&raquo;</a>
            </li>
        `;

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

        function getCsrfInputUser() {
            const existingForm = document.querySelector('form[action*="ubahrole"]');
            if (!existingForm) return '';
            const csrfInput = existingForm.querySelector('input[name^="csrf"]');
            if (!csrfInput) return '';
            return `<input type="hidden" name="${csrfInput.name}" value="${csrfInput.value}">`;
        }

        function escapeHtmlUser(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }
    })();
</script>

<script>
    // ==========================================
    // WebSocket - Real-time Manajemen User
    // ==========================================
    const wsUrl = window.WS_URL;
    const currentUserName = "<?= esc(session()->get('name')) ?>"; // untuk skip baris diri sendiri

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

            // if (payload.type === 'new_user') {
            //     handleNewUser(payload.data);
            // }

            if (payload.type === 'role_update') {
                handleRoleUpdate(payload.data);
            }
        };

        socket.onclose = () => {
            console.log('[WS] Terputus, reconnect dalam 3 detik...');
            setTimeout(connectWebSocket, 3000);
        };
    }

    function handleNewUser(u) {
        // Jangan tampilkan diri sendiri (mengikuti logic PHP: $user['name'] !== session nama sendiri)
        if (u.name === currentUserName) return;

        // Cegah duplikat
        if (document.getElementById('user-' + u.id)) return;

        const tbody = document.querySelector('table tbody');

        const badgeClass = u.role === 'admin' ? 'role-admin' : 'role-user';
        const badgeText = u.role === 'admin' ? 'Admin' : 'User';
        const toggleRoleValue = u.role === 'admin' ? 'karyawan' : 'admin';
        const toggleRoleLabel = u.role === 'admin' ? 'Jadikan User' : 'Jadikan Admin';

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
            <td id="role-badge-${u.id}">
                <span class="badge ${badgeClass} px-3 py-2">${badgeText}</span>
            </td>
            <td>
                <div class="dropdown" id="dropdown-role-${u.id}">
                    <button class="btn btn-outline-primary btn-role dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-person-gear"></i> Ubah Role
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" id="dropdown-menu-${u.id}">
                        <li>
                            <form action="/ubahrole" method="post">
                                ${getCsrfInput()}
                                <input type="hidden" name="id" value="${u.id}">
                                <input type="hidden" name="role" value="${toggleRoleValue}">
                                <button class="dropdown-item">${toggleRoleLabel}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
        `;

        tbody.insertBefore(row, tbody.firstChild);
        updateTotalUser(1);
        setTimeout(() => row.style.backgroundColor = '', 3000);
    }

    function handleRoleUpdate(u) {
        const badgeEl = document.getElementById('role-badge-' + u.id);
        const menuEl = document.getElementById('dropdown-menu-' + u.id);
        const row = document.getElementById('user-' + u.id);

        if (!badgeEl) return; // user ini tidak ada di halaman (mungkin sedang di halaman pagination lain)

        const badgeClass = u.role === 'admin' ? 'role-admin' : 'role-user';
        const badgeText = u.role === 'admin' ? 'Admin' : 'User';
        const toggleRoleValue = u.role === 'admin' ? 'karyawan' : 'admin';
        const toggleRoleLabel = u.role === 'admin' ? 'Jadikan User' : 'Jadikan Admin';

        badgeEl.innerHTML = `<span class="badge ${badgeClass} px-3 py-2">${badgeText}</span>`;

        if (menuEl) {
            menuEl.innerHTML = `
                <li>
                    <form action="/ubahrole" method="post">
                        ${getCsrfInput()}
                        <input type="hidden" name="id" value="${u.id}">
                        <input type="hidden" name="role" value="${toggleRoleValue}">
                        <button class="dropdown-item">${toggleRoleLabel}</button>
                    </form>
                </li>
            `;
        }

        if (row) {
            row.style.backgroundColor = '#d1ecf1';
            setTimeout(() => row.style.backgroundColor = '', 3000);
        }
    }

    function updateTotalUser(delta) {
        const el = document.getElementById('total-user');
        if (!el) return;
        el.textContent = parseInt(el.textContent) + delta;
    }

    // Ambil token CSRF dari form yang sudah ada di halaman, biar form baru tetap valid
    function getCsrfInput() {
        const existingForm = document.querySelector('form[action*="ubahrole"]');
        if (!existingForm) return '';

        const csrfInput = existingForm.querySelector('input[name^="csrf"]');
        if (!csrfInput) return '';

        return `<input type="hidden" name="${csrfInput.name}" value="${csrfInput.value}">`;
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str ?? '';
        return div.innerHTML;
    }

    connectWebSocket();
</script>
<script>
    function confirmRole(button) {

        Swal.fire({
            title: 'Ubah Role?',
            text: 'Apakah Anda yakin ingin mengubah role pengguna ini? Hak akses pengguna akan diperbarui.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {
                button.closest('form').submit();

            }

        });

    }
</script>
<?= $this->endSection() ?>