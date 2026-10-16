<?= $this->extend('template/templateUser'); ?>
<?= $this->section('content'); ?>

<?php $status = ['Buka', 'Ditugaskan', 'Dikerja', 'Selesai', 'Tutup']; ?>

<style>
    .ticket-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        padding: 25px;
    }

    .page-subtitle {
        color: #6c757d;
        font-size: 18px;
    }

    .page-title {
        font-weight: 700;
    }

    .test {
        width: 100%;

        text-align: left;
    }

    .card-header {
        background-image: url('/assets/sidebar.png');
        background-repeat: no-repeat;
        background-size: cover;
    }

    .table thead {
        background: #0d6efd;
        color: #fff;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
    }

    .dropdown-menu {
        border: none;

        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
    }

    .dropdown-menu form {
        margin: 0;
    }

    .ticket-img {
        width: 55px;
        height: 55px;
        object-fit: contain;
        cursor: pointer;
        transition: .3s;
    }

    .badge-category {
        font-size: 14px;
    }


    .table-responsive {
        border-radius: 15px;
    }

    #cardTiket {
        position: fixed;
        top: 5px;
        bottom: 5px;
        right: 22%;
        width: 55%;
        height: calc(90vh - 40px);
        background-color: white;

        border-radius: 20px;
        border: 1px solid #e9ecef;

        box-shadow:
            0 25px 60px rgba(0, 0, 0, .18),
            0 8px 20px rgba(0, 0, 0, .08);

        overflow: hidden;
        z-index: 9999;

        animation: slideIn .3s ease;
    }

    #cardTiket .card {
        border: none;
        border-radius: 20px;
        height: 100%;

    }

    #cardTiket .card-header {
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


    #cardTiket .card-body {
        height: calc(100% - 75px);
        overflow-y: auto;
        padding: 25px;
    }

    #cardTiket .card-body::-webkit-scrollbar {
        width: 2px;
    }

    #cardTiket .card-body::-webkit-scrollbar-thumb {
        background: #bdbdbd;
        border-radius: 10px;
    }

    #cardTiket .card-body::-webkit-scrollbar-thumb:hover {
        background: #8d8d8d;
    }

    .btn-tambah-ticket {

        white-space: nowrap;
    }


    .swal-top {
        z-index: 99999 !important;
    }

    @media (max-width:768px) {
        .page-subtitle {
            font-size: 14px;

        }

        .test h3 {
            font-size: 20px;
        }

        .btn-tambah-ticket {
            height: 32px;
            width: 100%;
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

        .ticket-card {
            padding: 15px;
        }

        .header-user {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .btn-font {
            font-size: 14px;
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

        .table {
            font-size: 14px;
        }



        .ticket-img {
            width: 45px;
            height: 45px;
        }

        #cardTiket h4 {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            font-size: 19px;



        }

        #cardTiket h4 svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        #cardTiket .form-control,
        #cardTiket .form-select {
            height: 40px;
            font-size: 13px;
        }


        #cardTiket {
            top: 0;
            right: 10px;
            left: 10px;
            width: 90%;
            height: 75vh;

            border-radius: 20px;
        }

        #cardTiket .card,
        #cardTiket .card-header {
            border-radius: 0;
        }

        #cardTiket .card-header {
            border-radius: 18px 18px 0 0;
        }
    }

    .badge-category {
        font-size: 12px;
    }

    .btn-sm {
        font-size: 12px;
        padding: 4px 8px;
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
<div class="card">

    <div class="card-body">

        <div class="container py-4">


            <div class="d-flex justify-content-between align-items-center mb-4 header-user">

                <div class="test">

                    <h3 class="page-title mb-1">



                        Manajemen Tiket

                    </h3>

                    <div class="page-subtitle">

                        Total tiket :
                        <strong>

                            <?= $jumlah ?>
                        </strong>


                    </div>

                </div>

                <div class="d-flex align-items-center gap-2 action-user w-100">

                    <form id="formCariTicketKaryawan" action="<?= site_url('lihat') ?>" method="get" class="flex-grow-1">

                        <div class="input-group search-box">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </span>

                            <input
                                id="inputCariTicketKaryawan"
                                type="text"
                                class="form-control"
                                name="keyword"
                                placeholder="Cari tiket..."
                                value="<?= $_GET['keyword'] ?? '' ?>"
                                autocomplete="off">

                            <button class="btn btn-primary" type="submit">
                                Cari
                            </button>
                        </div>

                    </form>

                    <button type="button" class="btn btn-primary btn-tambah-ticket" onclick="ShowCard()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                        </svg> tambah tiket</button>
                </div>

            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle text-center">

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Subjek</th>

                            <th>Lampiran</th>

                            <th>Kategori</th>

                            <th>Dibuat</th>

                            <th>Teknisi</th>

                            <th>Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php $i = 1; ?>

                        <?php foreach ($tickets as $ticket): ?>
                            <?php if ($ticket['user_id'] == session()->get('id_user')) : ?>

                                <tr id="ticket-<?= $ticket['id'] ?>">

                                    <td><?= $i++ ?></td>

                                    <td class="text-start">
                                        <div class="fw-semibold">
                                            <?= esc($ticket['subjek']) ?>
                                        </div>
                                        <small class="text-muted">
                                            <?= esc($ticket['kode_tiket']) ?>
                                        </small>
                                    </td>

                                    <td>
                                        <img src="/img/<?= $ticket['gambar'] ?>" class="ticket-img" onclick="lihatGambar('<?= base_url('img/' . $ticket['gambar']) ?>')">
                                    </td>

                                    <td>
                                        <span class="badge bg-info badge-category">
                                            <?= $ticket['category'] ?>
                                        </span>
                                    </td>

                                    <td>
                                        <?= date('d M Y H:i', strtotime($ticket['Created_at'])) ?>
                                    </td>

                                    <td id="teknisi-<?= $ticket['id'] ?>">
                                        <?= esc($ticket['ditugaskan']) ?>
                                    </td>

                                    <td>
                                        <a href="/user/detail/<?= $ticket['id'] ?>"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye-fill"></i>
                                            Detail
                                        </a>
                                    </td>

                                </tr>

                            <?php endif ?>
                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>
            <div class="d-flex justify-content-center mt-3" id="paginationTicketKaryawan">

                <?= $pager->links('default', 'pager') ?>
            </div>

        </div>
    </div>


</div>



<div class="modal fade" id="modalGambar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Lampiran</h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body text-center">
                <img id="previewGambar"
                    src=""
                    class="img-fluid rounded">
            </div>

        </div>
    </div>
</div>


<div id="cardTiket" style="display:none;" class="container-fluid mt-4 p-0">

    <div class="card shadow border-0 rounded-4">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between text-white py-3">
            <h4 class="mb-0" class="fw-bold">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket-detailed-fill" viewBox="0 0 16 16">
                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4 1a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5m0 5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5M4 8a1 1 0 0 0 1 1h6a1 1 0 1 0 0-2H5a1 1 0 0 0-1 1" />
                </svg> Buat Ticket
            </h4>
            <button type="button"
                class="btn  btn-sm  btn-close bg-transparent"
                onclick="CloseCard()">

            </button>
        </div>
        <?php if (session()->getFlashdata('pesan')) : ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'berhasil',
                    text: '<?= session()->getFlashdata('pesan') ?>',
                    showConfirmButton: false,
                    timer: 1500
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
        <?php if (session()->getFlashdata('warning')) : ?>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'gagal',
                    text: '<?= session()->getFlashdata('warning') ?>',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>

        <?php endif; ?>
        <!-- Body -->
        <div class="card-body">
            <form id="formTambahTiket" action="/Cticket" method="post" enctype="multipart/form-data">

                <?= csrf_field() ?>

                <!-- Subject -->
                <div class="mb-3">
                    <label class="form-label ">
                        Subject
                    </label>

                    <input
                        id="inputSubject"
                        type="text"
                        class="form-control  <?= ($validation->hasError('subject')) ? 'is-invalid ' : '' ?>"
                        name="subject"
                        value="<?= $old_subject ?? '' ?>"
                        placeholder="Masukkan subject ticket">
                    <div class="invalid-feedback" id="errorSubject">
                        <?= $validation->getError('subject') ?>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="mb-3">

                    <label class="form-label ">
                        Kategori
                    </label>

                    <select id="inputCategory" class="form-select <?= ($validation->hasError('category_id')) ? 'is-invalid ' : '' ?>" name="category_id">
                        <option value="" disabled <?= empty($old_category_id) ? 'selected' : '' ?>>
                            Pilih Kategori
                        </option>

                        <?php foreach ($data as $kategori) : ?>
                            <option
                                value="<?= $kategori['id'] ?>"
                                <?= ($old_category_id ?? '') == $kategori['id'] ? 'selected' : '' ?>>
                                <?= esc($kategori['category']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback" id="errorCategory">
                        <?= $validation->getError('category_id') ?>
                    </div>
                </div>

                <!-- Lampiran -->
                <div class="mb-3">

                    <label class="form-label ">
                        Lampiran
                    </label>
                    <input
                        id="inputGambar"
                        type="file"
                        class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid ' : '' ?>"
                        name="gambar"
                        accept="image/jpeg,image/png,image/webp"
                        onchange="prosesGambar(this)">
                    <div class="invalid-feedback" id="errorGambar">
                        <?= $validation->getError('gambar') ?>
                    </div>
                </div>




                <!-- Deskripsi -->
                <div class="mb-4">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        id="inputDeskripsi"
                        class="form-control  <?= ($validation->hasError('deskripsi')) ? 'is-invalid ' : '' ?>"
                        rows="3"
                        name="deskripsi"

                        placeholder="Jelaskan masalah secara detail..."><?= $old_deskripsi ?? '' ?></textarea>
                    <div class="invalid-feedback" id="errorDeskripsi">
                        <?= $validation->getError('deskripsi') ?>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="text-end">

                    <button
                        type="reset"
                        class="btn btn-font btn-secondary"
                        onclick="resetForm(this)">

                        Reset

                    </button>

                    <button
                        type="button"
                        class="btn btn-font btn-primary"
                        onclick="confirmTicket(this)">

                        Kirim Ticket

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    function resetForm(button) {
        const form = button.closest('form');

        form.reset();

        // Hapus tanda error dan pesan error
        form.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
        form.querySelectorAll('.invalid-feedback').forEach(el => {
            el.textContent = '';
        });
    }
</script>
<script>
    // ==========================================
    // Helper error & CSRF
    // ==========================================
    function clearTicketErrors() {
        const form = document.getElementById('formTambahTiket');
        if (!form) return;

        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
    }

    function showTicketErrors(errors) {
        const fieldMap = {
            subject: ['inputSubject', 'errorSubject'],
            category_id: ['inputCategory', 'errorCategory'],
            gambar: ['inputGambar', 'errorGambar'],
            deskripsi: ['inputDeskripsi', 'errorDeskripsi'],
        };

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

    function updateCsrfToken(name, hash) {
        if (!name || !hash) return;
        // Perbarui semua input token di halaman, bukan hanya satu form
        document.querySelectorAll(`input[name="${name}"]`).forEach(el => {
            el.value = hash;
        });
    }

    // ==========================================
    // Kecilkan gambar otomatis (screenshot besar / format tak umum -> JPG)
    // ==========================================
    let gambarPromise = Promise.resolve();

    function prosesGambar(input) {
        gambarPromise = kompresGambar(input);
        return gambarPromise;
    }

    async function kompresGambar(input) {
        const file = input.files[0];
        const errorEl = document.getElementById('errorGambar');

        input.classList.remove('is-invalid');
        errorEl.textContent = '';

        if (!file) return;

        // Sudah kecil dan formatnya aman -> biarkan apa adanya
        const formatAman = ['image/jpeg', 'image/png', 'image/webp'].includes(file.type);
        if (formatAman && file.size <= 1.5 * 1024 * 1024) return;

        try {
            const bmp = await createImageBitmap(file);
            const skala = Math.min(1, 1600 / Math.max(bmp.width, bmp.height));
            const w = Math.round(bmp.width * skala);
            const h = Math.round(bmp.height * skala);

            const canvas = document.createElement('canvas');
            canvas.width = w;
            canvas.height = h;

            const ctx = canvas.getContext('2d');
            ctx.fillStyle = '#ffffff'; // PNG transparan -> latar putih
            ctx.fillRect(0, 0, w, h);
            ctx.drawImage(bmp, 0, 0, w, h);
            bmp.close();

            const blob = await new Promise(resolve => canvas.toBlob(resolve, 'image/jpeg', 0.85));
            if (!blob) throw new Error('toBlob gagal');

            const hasil = new File([blob], file.name.replace(/\.[^.]+$/, '') + '.jpg', {
                type: 'image/jpeg'
            });

            const dt = new DataTransfer();
            dt.items.add(hasil);
            input.files = dt.files;

        } catch (e) {
            console.error('[Gambar] Gagal diproses:', e);
            input.value = '';
            input.classList.add('is-invalid');
            errorEl.textContent = 'Gambar tidak bisa diproses. Gunakan file JPG, PNG, atau WEBP.';
        }
    }

    // ==========================================
    // Cek validasi dulu, baru SweetAlert
    // ==========================================
    async function confirmTicket(button) {
        const form = document.getElementById('formTambahTiket');

        button.disabled = true;
        clearTicketErrors();

        // Tunggu kompresi gambar (kalau masih berjalan) sebelum data dikirim
        await gambarPromise;

        const formData = new FormData(form);

        try {
            const res = await fetch('/cek-ticket', {
                method: 'POST',
                body: formData,
            });

            // Sesi habis -> filter Login mengalihkan ke halaman login
            if (res.redirected && res.url.includes('/login')) {
                window.location.href = res.url;
                return;
            }

            const teks = await res.text();
            let result;

            try {
                result = JSON.parse(teks);
            } catch (e) {
                console.error('[Cek Tiket] Respons bukan JSON. Status:', res.status, teks.slice(0, 300));
                Swal.fire({
                    icon: 'error',
                    title: 'Server Menolak Data',
                    text: 'Kode ' + res.status + '. Biasanya karena ukuran gambar terlalu besar atau sesi sudah habis. Muat ulang halaman lalu coba lagi.',
                    customClass: {
                        container: 'swal-top'
                    }
                });
                button.disabled = false;
                return;
            }

            updateCsrfToken(result.csrf_name, result.csrf_hash);

            if (!result.valid) {
                if (result.errors && Object.keys(result.errors).length > 0) {
                    showTicketErrors(result.errors);
                } else if (result.message) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak Bisa Menambah Tiket',
                        text: result.message,
                        customClass: {
                            container: 'swal-top'
                        }
                    });
                }
                button.disabled = false;
                return;
            }


            Swal.fire({
                title: 'Tambah Ticket?',
                text: 'Apakah Anda yakin ingin menambahkan ticket?',
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
                    document.getElementById("cardTiket").style.display = "none";
                    form.submit();
                }
            });

        } catch (err) {
            console.error('[Cek Tiket] Gagal:', err);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal memeriksa data, coba lagi.',
                customClass: {
                    container: 'swal-top'
                }
            });
            button.disabled = false;
        }
    }
</script>

<script>
    function ShowCard() {


        document.getElementById("cardTiket").style.display = "block";

    }

    function CloseCard() {


        document.getElementById("cardTiket").style.display = "none";

    }
</script>

<script>
    (function() {
        const inputCari = document.getElementById('inputCariTicketKaryawan');
        const formCari = document.getElementById('formCariTicketKaryawan');
        const tbody = document.querySelector('table tbody');

        if (!inputCari || !formCari || !tbody) {
            console.error('[Search Ticket Karyawan] Elemen tidak ditemukan');
            return;
        }

        let debounceTimer;
        let currentController = null;

        inputCari.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                doSearchTicketKaryawan(inputCari.value, 1);
            }, 200);
        });

        formCari.addEventListener('submit', (e) => {
            e.preventDefault();
            clearTimeout(debounceTimer);
            doSearchTicketKaryawan(inputCari.value, 1);
        });

        async function doSearchTicketKaryawan(keyword, page = 1) {
            if (currentController) {
                currentController.abort();
            }
            currentController = new AbortController();

            const params = new URLSearchParams({
                keyword: keyword,
                page: page,
            });

            try {
                const res = await fetch(`/lihat/search?${params.toString()}`, {
                    signal: currentController.signal
                });

                if (!res.ok) {
                    console.error('[Search Ticket Karyawan] Response gagal, status:', res.status);
                    return;
                }

                const result = await res.json();

                renderTableTicketKaryawan(result.data);
                renderPaginationTicketKaryawan(keyword, result.currentPage, result.totalPages);
                updateJumlahTicketKaryawan(result.total);

            } catch (err) {
                if (err.name !== 'AbortError') {
                    console.error('[Search Ticket Karyawan] Gagal mengambil data:', err);
                }
            }
        }

        function renderTableTicketKaryawan(items) {
            if (!items || items.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Tidak ada tiket ditemukan
                    </td>
                </tr>
            `;
                return;
            }

            tbody.innerHTML = items.map(t => `
            <tr id="ticket-${t.id}">
                <td>${t.no}</td>
                <td class="text-start">
                    <div class="fw-semibold">${escapeHtmlKaryawan(t.subjek)}</div>
                    <small class="text-muted">${escapeHtmlKaryawan(t.kode_tiket)}</small>
                </td>
                <td>
                    <img src="/img/${t.gambar}" class="ticket-img" onclick="lihatGambar('/img/${t.gambar}')">
                </td>
                <td>
                    <span class="badge bg-info badge-category">${escapeHtmlKaryawan(t.category)}</span>
                </td>
                <td>${formatTanggalKaryawan(t.created_at)}</td>
                <td id="teknisi-${t.id}">${escapeHtmlKaryawan(t.ditugaskan || '-')}</td>
                <td>
                    <a href="/user/detail/${t.id}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-eye-fill"></i> Detail
                    </a>
                </td>
            </tr>
        `).join('');
        }

        function renderPaginationTicketKaryawan(keyword, currentPage, totalPages) {
            const container = document.getElementById('paginationTicketKaryawan');
            if (!container) return;

            if (totalPages <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = '<ul class="pagination">';

            html += `
            <li class="page-item ${currentPage <= 1 ? 'disabled' : ''}">
                <a class="page-link page-link-ticket-karyawan" href="#" data-page="${currentPage - 1}">&laquo;</a>
            </li>
        `;

            for (let i = 1; i <= totalPages; i++) {
                html += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link page-link-ticket-karyawan" href="#" data-page="${i}">${i}</a>
                </li>
            `;
            }

            html += `
            <li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}">
                <a class="page-link page-link-ticket-karyawan" href="#" data-page="${currentPage + 1}">&raquo;</a>
            </li>
        `;

            html += '</ul>';
            container.innerHTML = html;

            container.querySelectorAll('.page-link-ticket-karyawan').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const page = parseInt(link.getAttribute('data-page'));
                    if (page < 1 || page > totalPages || page === currentPage) return;
                    doSearchTicketKaryawan(keyword, page);
                });
            });
        }

        function updateJumlahTicketKaryawan(total) {
            const el = document.querySelector('.page-subtitle');
            if (!el) return;
            el.textContent = el.textContent.replace(/\d+/, total);
        }

        function formatTanggalKaryawan(datetimeStr) {
            const d = new Date(datetimeStr);
            const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const pad = (n) => n.toString().padStart(2, '0');
            return `${pad(d.getDate())} ${bulan[d.getMonth()]} ${d.getFullYear()} ${pad(d.getHours())}:${pad(d.getMinutes())}`;
        }

        function escapeHtmlKaryawan(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }
    })();
</script>

<script>
    // ==========================================
    // WebSocket - Real-time untuk halaman karyawan
    // ==========================================
    const wsUrl = window.WS_URL;
    const currentUserId = <?= (int) session()->get('id_user') ?>; // ID karyawan yang sedang login
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



            if (payload.type === 'new_ticket') {
                handleNewTicket(payload.data);
            }

            if (payload.type === 'status_update') {
                handleStatusUpdate(payload.data);
            }
        };

        socket.onclose = () => {
            console.log('[WS] Terputus, reconnect dalam 3 detik...');
            setTimeout(connectWebSocket, 3000);
        };
    }

    function handleNewTicket(t) {
        // FILTER PENTING: hanya tampilkan kalau tiket ini milik user yang sedang login
        if (t.user_id != currentUserId) return;

        // Cegah duplikat
        if (document.getElementById('ticket-' + t.id)) return;

        const tbody = document.querySelector('table tbody');

        const row = document.createElement('tr');
        row.id = 'ticket-' + t.id;
        row.style.backgroundColor = '#fff3cd';

        row.innerHTML = `
            <td><span class="badge bg-warning text-dark">Baru</span></td>
            <td class="text-start">
                <div class="fw-semibold">${escapeHtml(t.subjek)}</div>
                <small class="text-muted">${escapeHtml(t.kode_tiket)}</small>
            </td>
            <td>
                <img src="/img/${t.gambar}" class="ticket-img">
            </td>
            <td><span class="badge bg-info badge-category">${escapeHtml(t.kategori || '-')}</span></td>
            <td>${formatTanggal(t.created_at)}</td>
            <td id="teknisi-${t.id}">${escapeHtml(t.ditugaskan || '-')}</td>
            <td>
                <a href="/user/detail/${t.id}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-eye-fill"></i> Detail
                </a>
            </td>
        `;

        tbody.insertBefore(row, tbody.firstChild);
        updateJumlahTicket(1);

        setTimeout(() => row.style.backgroundColor = '', 3000);
    }

    function handleStatusUpdate(t) {
        const row = document.getElementById('ticket-' + t.id);

        // Kalau tiket ini nggak ada di tabel karyawan ini, berarti bukan tiketnya -> abaikan
        if (!row) return;

        // Update kolom teknisi (halaman karyawan tidak punya kolom status terpisah, cuma teknisi)
        const teknisiEl = document.getElementById('teknisi-' + t.id);
        if (teknisiEl) {
            teknisiEl.textContent = t.ditugaskan || '-';
        }

        row.style.backgroundColor = '#d1ecf1';
        setTimeout(() => row.style.backgroundColor = '', 3000);
    }

    function updateJumlahTicket(delta) {
        const el = document.querySelector('page-subtitle');
        if (!el) return;
        const match = el.textContent.match(/\d+/);
        if (match) {
            const newCount = parseInt(match[0]) + delta;
            el.textContent = el.textContent.replace(/\d+/, newCount);
        }
    }

    function formatTanggal(datetimeStr) {
        const d = new Date(datetimeStr);
        const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const pad = (n) => n.toString().padStart(2, '0');
        return `${pad(d.getDate())} ${bulan[d.getMonth()]} ${d.getFullYear()} ${pad(d.getHours())}:${pad(d.getMinutes())}`;
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str ?? '';
        return div.innerHTML;
    }

    connectWebSocket();
</script>
<script>
    function lihatGambar(url) {

        document.getElementById("previewGambar").src = url;

        const modal = new bootstrap.Modal(
            document.getElementById("modalGambar")
        );

        modal.show();
    }
</script>
<?= $this->endSection(); ?>