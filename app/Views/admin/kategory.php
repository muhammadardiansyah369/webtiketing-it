<?= $this->extend('template/templateAdmin') ?>
<?= $this->section('content') ?>

<style>
    .swal2-container {
        z-index: 99999 !important;
    }

    .category-card {
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

    .category-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #e9f2ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
    }

    .dropdown-item:hover {
        background: #f8f9fa;
    }

    .btn-action {
        min-width: 130px;
    }

    .input-group {
        width: 320px;
    }

    .input-group .form-control {
        box-shadow: none;
    }

    .input-group-text {
        background: #fff;
    }

    #cardKategori,
    #cardEditKategori {
        transition: all .25s ease;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        border: 1px solid white;
        position: fixed;
        top: 80px;
        right: 30px;
        width: 400px;
        z-index: 9999;

    }

    #cardKategori.hide,
    #cardEditKategori.hide {
        opacity: 0;
        transform: translateY(-15px);
        pointer-events: none;
    }



    .search-box .form-control,
    .search-box .input-group-text,
    .search-box .btn {
        font-size: 14px !important;
        font-weight: 200;
    }

    .card-header {
        border-radius: 10px 10px 0 0;
        background-image: url('/assets/sidebar.png');
        background-repeat: no-repeat;
        color: white;
    }

    .swal-top {
        z-index: 99999 !important;
    }

    @keyframes shimmer {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }

    /* ===========================
    Responsive Mobile
    ===========================*/
    @media (max-width:768px) {
        .head h3 {
            font-size: 20px;
            margin-bottom: 0;
        }

        .search-box .form-control,
        .search-box .input-group-text,
        .search-box .btn {
            height: 32px;
            font-weight: 200;
            font-size: 12px;

        }

        .search-box .input-group-text,
        .search-box .btn {
            display: flex;
            align-items: center;
        }

        .container-fluid {
            padding: 15px;
        }

        .page-title {
            font-size: 24px;
        }

        .page-subtitle {
            font-size: 14px;
        }

        .header-category {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .action-category {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .action-category form {
            width: 100%;
        }

        .input-group {
            width: 100%;
        }

        /* Hanya tombol Tambah */
        .btn-tambah {
            height: 32px;
            font-size: 14px;
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



        #cardKategori.hide,
        #cardEditKategori.hide {
            opacity: 0;
            transform: translateY(-15px);
            pointer-events: none;
        }

        #cardKategori,
        #cardEditKategori {
            box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
            transition: all .25s ease;
            z-index: 99999;
            border: 1px solid white;
            left: 15px;
            right: 15px;
            width: auto;
            top: 70px;
        }

    }
</style>

<div class="container-fluid py-4">


    <!-- Header -->
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4 header-category">

        <div class="head">

            <h3 class="page-title mb-1">

                Manajemen Kategori
            </h3>

            <div class="subjudul page-subtitle">
                Total Kategori :
                <strong id="total-kategori"><?= $jumlah ?></strong>
            </div>

        </div>

        <div class="d-flex align-items-center gap-2 action-category">

            <form id="formCariKategori" action="<?= current_url('kategory') ?>" method="get">

                <div class="input-group search-box">

                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </span>

                    <input
                        id="inputCariKategori"
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari kategori..."
                        value="<?= $_GET['keyword'] ?? '' ?>"
                        autocomplete="off">

                    <button class="btn btn-primary" type="submit">
                        Cari
                    </button>

                </div>

            </form>

            <button
                type="button"
                class="btn btn-primary btn-tambah"
                onclick="showCardKategori()">


                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                </svg> Tambah

            </button>
        </div>

    </div>

    <!-- Flash -->
    <?php if (session()->getFlashdata('pesan')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session()->getFlashdata('pesan') ?>',
                showConfirmButton: false,
                timer: 1000,
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('ubah')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'berhasil',
                text: '<?= session()->getFlashdata('ubah') ?>',
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    <?php endif; ?>
    <?php if (session()->getFlashdata('hapus')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'berhasil',
                text: '<?= session()->getFlashdata('hapus') ?>',
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

    <!-- Table -->
    <div class="table-responsive">

        <table class="table align-middle table-hover">

            <thead class="text-center">

                <tr>

                    <th width="70px">No</th>

                    <th>Nama Kategori</th>

                    <th width="170px">Aksi</th>

                </tr>

            </thead>

            <tbody>



                <?php foreach ($kategori as $k): ?>

                    <tr id="kategori-<?= $k['id'] ?>">

                        <td class="text-center">
                            <?= $nomor++ ?>
                        </td>
                        <td>
                            <div class="text-center " id="nama-kategori-<?= $k['id'] ?>">

                                <?= esc($k['category']) ?>

                            </div>

                        </td>
                        <td class="text-center">

                            <div class="d-flex justify-content-center gap-2">

                                <button
                                    id="btn-edit-<?= $k['id'] ?>"
                                    class="btn btn-warning btn-sm"

                                    onclick="editKategori(<?= $k['id'] ?>,'<?= esc($k['category']) ?>' )">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </button>
                                <form action="<?= site_url('kategori/hapus/' . $k['id']) ?>" method="post">
                                    <?= csrf_field() ?>

                                    <input type="hidden" name="_method" value="DELETE">

                                    <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                        </svg>
                                    </button>
                                </form>

                            </div>

                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>
        <div class="d-flex justify-content-center mt-3" id="paginationKategori">
            <?= $pager->links('default', 'pager') ?>
        </div>
    </div>

</div>



<!-- Modal Tambah -->
<div id="cardKategori" class="card shadow"
    style="display:none;">

    <form id="formTambahKategori" action="<?= site_url('kategori/simpan') ?>" method="post">

        <?= csrf_field() ?>

        <div class="card-header  d-flex justify-content-between align-items-center">

            <h5 class="mb-0">Tambah Kategori</h5>

            <button
                type="button"
                class="btn-close"
                onclick="hideCardKategori()">
            </button>

        </div>

        <div class="card-body">

            <div class="mb-3">

                <label class="form-label">
                    Nama Kategori
                </label>

                <input
                    id="inputNamaKategori"
                    type="text"
                    name="categories"
                    class="form-control"
                    placeholder="Masukkan nama kategori"
                    required>
                <div class="invalid-feedback" id="errorNamaKategori"></div>

            </div>

            <div class="d-flex justify-content-end gap-2">

                <button
                    type="button"
                    class="btn btn-font btn-secondary"
                    onclick="hideCardKategori()">

                    Batal

                </button>

                <button
                    type="button"
                    class="btn btn-font btn-primary" onclick="confirmTkategory(this)">

                    Simpan

                </button>

            </div>

        </div>

    </form>

</div>
<!-- Modal Tambah -->
<div id="cardEditKategori" class="card shadow"
    style="display:none;">

    <form id="formEditKategori" method="post">

        <?= csrf_field() ?>

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">Edit Kategori</h5>

            <button
                type="button"
                class="btn-close"
                onclick="hideEditCard()">
            </button>

        </div>

        <div class="card-body">

            <input
                type="hidden"
                id="idKategori"
                name="id">

            <div class="mb-3">

                <label class="form-label">
                    Nama Kategori
                </label>

                <input
                    type="text"

                    id="namaKategori"
                    name="categories"
                    class="form-control"
                    required>
                <div class="invalid-feedback" id="errorNamaKategoriEdit"></div>

            </div>
            <div class="d-flex justify-content-end gap-2">

                <button
                    type="button"
                    class="btn btn-font btn-secondary"
                    onclick="hideEditCard()">

                    Batal

                </button>

                <button
                    type="button"
                    class="btn btn-font btn-primary " onclick="confirmUkategory(this)">

                    Update

                </button>

            </div>

        </div>

    </form>

</div>
<script>
    // ==========================
    // Menutup semua card
    // ==========================
    function hideAllCard() {

        document.getElementById("cardKategori").style.display = "none";
        document.getElementById("cardEditKategori").style.display = "none";

    }

    // ==========================
    // Card Tambah
    // ==========================
    function showCardKategori() {

        hideAllCard();

        document.getElementById("cardKategori").style.display = "block";

    }

    function hideCardKategori() {
        document.getElementById("cardKategori").style.display = "none";
        clearKategoriErrors('formTambahKategori');
    }
    // ==========================
    // Card Edit
    // ==========================
    function editKategori(id, nama) {

        hideAllCard();

        document.getElementById("idKategori").value = id;
        document.getElementById("namaKategori").value = nama;

        document.getElementById("formEditKategori").action =
            "<?= site_url('kategori/update') ?>/" + id;

        document.getElementById("cardEditKategori").style.display = "block";

    }

    function hideEditCard() {
        document.getElementById("cardEditKategori").style.display = "none";
        clearKategoriErrors('formEditKategori');
    }
</script>
<script>
    function confirmDelete(button) {

        Swal.fire({
            title: 'Hapus Kategori Ini?',
            html: 'Semua <b>tiket</b> dan <b>riwayat aktivitas</b> yang memakai kategori ini akan ikut terhapus permanen.<br>Data yang dihapus tidak dapat dikembalikan.',
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
</script>

<script>
    // ==========================================
    // TAMBAH KATEGORI - Cek validasi dulu, baru SweetAlert
    // ==========================================
    async function confirmTkategory(button) {
        const form = document.getElementById('formTambahKategori');
        const formData = new FormData(form);

        button.disabled = true;
        clearKategoriErrors('formTambahKategori');

        try {
            const res = await fetch('/cek-kategori', {
                method: 'POST',
                body: formData,
            });

            const result = await res.json();
            updateCsrfTokenKategori(form, result.csrf_name, result.csrf_hash);

            if (!result.valid) {
                showKategoriErrors(result.errors || {}, {
                    categories: ['inputNamaKategori', 'errorNamaKategori'],
                });
                button.disabled = false;
                return;
            }

            Swal.fire({
                title: 'Simpan Kategori?',
                text: 'Kategori baru akan ditambahkan ke sistem.',
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
                    document.getElementById("cardKategori").style.display = "none";
                    form.submit();
                }
            });

        } catch (err) {
            console.error('[Tambah Kategori] Gagal:', err);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal memeriksa data, coba lagi.'
            });
            button.disabled = false;
        }
    }
</script>

<script>
    // ==========================================
    // EDIT KATEGORI - Cek validasi dulu, baru SweetAlert
    // ==========================================
    async function confirmUkategory(button) {
        const form = document.getElementById('formEditKategori');
        const id = document.getElementById('idKategori').value;
        const formData = new FormData(form);

        button.disabled = true;
        clearKategoriErrors('formEditKategori');

        try {
            const res = await fetch('/cek-kategori-update/' + id, {
                method: 'POST',
                body: formData,
            });

            const result = await res.json();
            updateCsrfTokenKategori(form, result.csrf_name, result.csrf_hash);

            if (!result.valid) {
                showKategoriErrors(result.errors || {}, {
                    categories: ['namaKategori', 'errorNamaKategoriEdit'],
                });
                button.disabled = false;
                return;
            }

            Swal.fire({
                title: 'Ubah Kategori?',
                text: 'Pastikan data kategori yang diubah sudah benar.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Ubah!',
                cancelButtonText: 'Batal',
                customClass: {
                    container: 'swal-top'
                }
            }).then((confirmResult) => {
                button.disabled = false;
                if (confirmResult.isConfirmed) {
                    document.getElementById("cardEditKategori").style.display = "none";
                    form.submit();
                } else {
                    document.getElementById("cardEditKategori").style.display = "block";
                }
            });

        } catch (err) {
            console.error('[Edit Kategori] Gagal:', err);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal memeriksa data, coba lagi.'
            });
            button.disabled = false;
        }
    }
</script>

<script>
    // ==========================================
    // Helper Bersama
    // ==========================================
    function updateCsrfTokenKategori(form, name, hash) {
        if (!name || !hash) return;

        document.querySelectorAll(`input[name="${name}"]`).forEach(el => {
            el.value = hash;
        });
    }

    function showKategoriErrors(errors, fieldMap) {
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

    function clearKategoriErrors(formId) {
        const form = document.getElementById(formId);
        if (!form) return;
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
    }
</script>
<script>
    (function() {
        const inputCari = document.getElementById('inputCariKategori');
        const formCari = document.getElementById('formCariKategori');
        const tbody = document.querySelector('table tbody');

        if (!inputCari || !formCari || !tbody) {
            console.error('[Search Kategori] Elemen tidak ditemukan, cek id inputCariKategori/formCariKategori');
            return;
        }

        let debounceTimer;
        let currentController = null;

        inputCari.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                doSearchKategori(inputCari.value, 1);
            }, 200);
        });

        formCari.addEventListener('submit', (e) => {
            e.preventDefault();
            clearTimeout(debounceTimer);
            doSearchKategori(inputCari.value, 1);
        });

        async function doSearchKategori(keyword, page = 1) {
            if (currentController) {
                currentController.abort();
            }
            currentController = new AbortController();

            const params = new URLSearchParams({
                keyword: keyword,
                page: page,
            });

            try {
                const res = await fetch(`/kategori/search?${params.toString()}`, {
                    signal: currentController.signal
                });

                if (!res.ok) {
                    console.error('[Search Kategori] Response gagal, status:', res.status);
                    return;
                }

                const result = await res.json();
                console.log('[Search Kategori] Hasil:', result);

                renderTableKategori(result.data);
                renderPaginationKategori(keyword, result.currentPage, result.totalPages);
                updateTotalKategoriSearch(result.total);

            } catch (err) {
                if (err.name !== 'AbortError') {
                    console.error('[Search Kategori] Gagal mengambil data:', err);
                }
            }
        }

        function renderTableKategori(items) {
            if (!items || items.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="text-center text-muted py-4">
                        Tidak ada kategori ditemukan
                    </td>
                </tr>
            `;
                return;
            }

            tbody.innerHTML = items.map(k => `
            <tr id="kategori-${k.id}">
                <td class="text-center">${k.no}</td>
                <td>
                            <div class="text-center " id="nama-kategori-${k.id}">

                                
                                   ${escapeJsSearch(k.category)}
                            </div>

                        </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        <button
                            id="btn-edit-${k.id}"
                            class="btn btn-warning btn-sm"
                            onclick="editKategori(${k.id}, '${escapeJsSearch(k.category)}')">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                        </button>
                        <form action="/kategori/hapus/${k.id}" method="post">
                            ${getCsrfInputSearch()}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">
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

        function renderPaginationKategori(keyword, currentPage, totalPages) {
            const container = document.getElementById('paginationKategori');
            if (!container) return;

            if (totalPages <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = '<ul class="pagination">';

            html += `
                <li class="page-item ${currentPage <= 1 ? 'disabled' : ''}">
                    <a class="page-link page-link-kategori" href="#" data-page="${currentPage - 1}">&laquo;</a>
                </li>
            `;

            for (let i = 1; i <= totalPages; i++) {
                html += `
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link page-link-kategori" href="#" data-page="${i}">${i}</a>
                    </li>
                `;
            }

            html += `
                <li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}">
                    <a class="page-link page-link-kategori" href="#" data-page="${currentPage + 1}">&raquo;</a>
                </li>
            `;

            html += '</ul>';
            container.innerHTML = html;

            container.querySelectorAll('.page-link-kategori').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const page = parseInt(link.getAttribute('data-page'));
                    if (page < 1 || page > totalPages || page === currentPage) return;
                    doSearchKategori(keyword, page);
                });
            });
        }

        function updateTotalKategoriSearch(total) {
            const el = document.getElementById('total-kategori');
            if (el) el.textContent = total;
        }

        function getCsrfInputSearch() {
            const existingForm = document.querySelector('form[action*="kategori/hapus"]');
            if (!existingForm) return '';
            const csrfInput = existingForm.querySelector('input[name^="csrf"]');
            if (!csrfInput) return '';
            return `<input type="hidden" name="${csrfInput.name}" value="${csrfInput.value}">`;
        }

        function escapeHtmlSearch(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        function escapeJsSearch(str) {
            return (str ?? '').replace(/\\/g, '\\\\').replace(/'/g, "\\'");
        }
    })();
</script>
<script>
    (function() {
        // GUARD: cegah koneksi ganda kalau script ter-load lebih dari sekali
        if (window.__wsKategoriActive) {
            console.warn('[WS] Koneksi kategori sudah aktif, skip inisialisasi ulang');
            return;
        }
        window.__wsKategoriActive = true;

        const wsUrl = window.WS_URL;
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
                console.log('[WS] Event diterima:', payload.type, payload.data);
                switch (payload.type) {
                    case 'new_category':
                        handleNewCategory(payload.data);
                        break;
                    case 'update_category':
                        handleUpdateCategory(payload.data);
                        break;
                    case 'delete_category':
                        handleDeleteCategory(payload.data);
                        break;
                }
            };

            socket.onclose = () => {
                console.log('[WS] Terputus, mencoba reconnect dalam 3 detik...');
                setTimeout(connectWebSocket, 3000);
            };

            socket.onerror = (err) => {
                console.error('[WS] Error:', err);
            };
        }

        function handleNewCategory(k) {
            if (document.getElementById('kategori-' + k.id)) return;

            const tbody = document.querySelector('table tbody');
            if (!tbody) return;

            const row = document.createElement('tr');
            row.id = 'kategori-' + k.id;
            row.style.backgroundColor = '#fff3cd';
            row.style.transition = 'background-color 1s ease';

            row.innerHTML = `
            <td class="text-center">
                <span class="badge bg-warning text-dark">Baru</span>
            </td>
             <td>
                            <div class="text-center " id="nama-kategori-${k.id}">

                                
                                    ${escapeJs(k.category)}
                            </div>

                        </td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                    <button
                        id="btn-edit-${k.id}"
                        class="btn btn-warning btn-sm"
                        onclick="editKategori(${k.id}, '${escapeJs(k.category)}')">
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                    </button>
                    <form action="/kategori/hapus/${k.id}" method="post">
                        ${getCsrfInput()}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                        </svg>
                        </button>
                    </form>
                </div>
            </td>
        `;

            tbody.insertBefore(row, tbody.firstChild);
            updateTotalKategori(1);

            setTimeout(() => {
                row.style.backgroundColor = '';
            }, 3000);
        }

        function handleUpdateCategory(k) {
            console.log('[WS] Update diterima untuk ID:', k.id, '-> nama baru:', k.category);

            const namaEl = document.getElementById('nama-kategori-' + k.id);
            const btnEditEl = document.getElementById('btn-edit-' + k.id);
            const row = document.getElementById('kategori-' + k.id);

            if (!namaEl) {
                console.warn('[WS] Baris kategori-' + k.id + ' tidak ditemukan, fallback ke handleNewCategory');
                handleNewCategory(k);
                return;
            }

            namaEl.textContent = k.category;

            if (btnEditEl) {
                btnEditEl.setAttribute(
                    'onclick',
                    `editKategori(${k.id}, '${escapeJs(k.category)}')`
                );
            }

            if (row) {
                row.style.transition = 'background-color 1s ease';
                row.style.backgroundColor = '#d1ecf1';
                setTimeout(() => {
                    row.style.backgroundColor = '';
                }, 3000);
            }
        }

        function handleDeleteCategory(k) {
            const row = document.getElementById('kategori-' + k.id);
            if (!row) return;

            row.style.transition = 'background-color 0.5s ease, opacity 0.5s ease';
            row.style.backgroundColor = '#f8d7da';
            row.style.opacity = '0.5';

            setTimeout(() => {
                row.remove();
                updateTotalKategori(-1);
            }, 800);
        }

        function updateTotalKategori(delta) {
            const el = document.getElementById('total-kategori');
            if (!el) return;
            const current = parseInt(el.textContent) || 0;
            el.textContent = current + delta;
        }

        function getCsrfInput() {
            const existingForm = document.querySelector('form[action*="kategori/hapus"]');
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

        function escapeJs(str) {
            return (str ?? '')
                .replace(/\\/g, '\\\\')
                .replace(/'/g, "\\'");
        }

        connectWebSocket();
    })();
</script>
<?= $this->endSection() ?>