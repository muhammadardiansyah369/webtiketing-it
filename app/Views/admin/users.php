<?= $this->extend('template/templateAdmin'); ?>
<?= $this->section('content'); ?>

<?php $status = ['Buka', 'Ditugaskan', 'Dikerja', 'Selesai', 'Tutup']; ?>

<style>
    .ticket-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        padding: 25px;
    }

    .table thead {
        background: #0d6efd;
        color: #fff;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
    }

    .table td {
        font-size: 14px;
    }

    .dropdown-menu {
        border: none;

        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
    }

    .dropdown-menu form {
        margin: 0;
    }

    .badge-category {
        font-size: 14px;
    }

    .ticket-img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        cursor: pointer;
        transition: .3s;
    }

    .ticket-img:hover {
        transform: scale(1.08);
    }

    #previewGambar {
        max-height: 80vh;
        object-fit: contain;
    }


    #cardDitugaskan {

        position: fixed;
        top: 90px;
        right: 20px;
        width: 350px;
        z-index: 9999;

    }



    @media (max-width:768px) {
        .subjudul {
            font-size: 14px;
        }

        .head {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .head h3 {
            font-size: 20px;
            margin-bottom: 0;
        }

        .head .btn {
            padding: 2px 6px;
        }

        .head .btn svg {
            width: 12px;
            height: 12px;
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

        .table {

            font-size: 14px;

        }

        .table th,
        .table td {

            white-space: nowrap;
            vertical-align: middle;

        }

        .badge-category {

            font-size: 12px;

        }

        .btn-sm {

            font-size: 12px;

        }



        .ticket-img {
            width: 45px;
            height: 45px;
        }

        #cardDitugaskan {

            right: 5px;
            left: 5px;
            width: auto;
            top: 70px;

        }

    }
</style>

<div class="container-fluid py-3 px-3 px-lg-4">



    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-2 mb-4">

        <div>
            <div class="head d-flex  align-items-center">

                <h3 class="fw-bold mb-0  ">

                    Manajemen Ticket
                </h3>
                <div class="dropdown">

                    <button class="btn"
                        data-bs-toggle="dropdown">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                        </svg>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li><a class="dropdown-item filter-status-link" href="#" data-keyword="">Tampilkan semua data</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item filter-status-link" href="#" data-keyword="Buka">Buka</a></li>
                        <li><a class="dropdown-item filter-status-link" href="#" data-keyword="Ditugaskan">Ditugaskan</a></li>
                        <li><a class="dropdown-item filter-status-link" href="#" data-keyword="Dikerja">Dikerja</a></li>
                        <li><a class="dropdown-item filter-status-link" href="#" data-keyword="Selesai">Selesai</a></li>
                        <li><a class="dropdown-item filter-status-link" href="#" data-keyword="Tutup">Tutup</a></li>



                    </ul>

                </div>
            </div>

            <small class="subjudul text-muted">
                Jumlah Ticket :
                <strong>

                    <?= $jumlah ?>
                </strong>
            </small>

        </div>
        <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center gap-2 ms-lg-auto">

            <form id="formCariTicket" action="<?= site_url('ticket') ?>" method="get" class="w-100">

                <div class="input-group search-box">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </span>

                    <input
                        id="inputCariTicket"
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari tiket..."
                        value="<?= $_GET['keyword'] ?? '' ?>"
                        autocomplete="off">

                    <button class="btn btn-primary" type="submit">
                        Cari
                    </button>
                </div>

            </form>

        </div>


    </div>
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
    <div>
        <div class="table-responsive">

            <table class="table table-hover align-middle text-center">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>nama</th>

                        <th>Subject</th>

                        <th>Lampiran</th>

                        <th>Kategori</th>

                        <th>Dibuat</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>



                    <?php foreach ($data as $ticket): ?>

                        <?php

                        switch ($ticket['status']) {

                            case 'Buka':
                                $btnClass = 'btn-primary';

                                break;

                            case 'Ditugaskan':
                                $btnClass = 'btn-warning';
                                break;

                            case 'Dikerja':
                                $btnClass = 'btn-success';
                                break;

                            case 'Selesai':
                                $btnClass = 'btn-secondary';
                                break;

                            case 'Tutup':
                                $btnClass = 'btn-danger';
                                break;

                            default:
                                $btnClass = 'btn-dark';
                        }

                        ?>

                        <tr id="ticket-<?= $ticket['id'] ?>">

                            <td><?= $nomor++ ?></td>
                            <td>

                                <div class="fw-semibold">

                                    <?= esc($ticket['name']) ?>


                                </div>
                            </td>
                            <td class="text-start">

                                <div class="fw-semibold">

                                    <?= esc($ticket['subjek']) ?>

                                </div>

                                <small class="text-muted">

                                    <?= esc($ticket['kode_tiket']) ?>

                                </small>

                            </td>

                            <td>

                                <img src="<?= base_url('img/' . $ticket['gambar']) ?>"
                                    class="ticket-img"
                                    style="cursor:pointer"
                                    onclick="lihatGambar('<?= base_url('img/' . $ticket['gambar']) ?>')">

                            </td>

                            <td>

                                <span class="badge bg-info badge-category">

                                    <?= $ticket['category'] ?>

                                </span>

                            </td>

                            <td>

                                <?= date('d M Y H:i', strtotime($ticket['Created_at'])) ?>

                            </td>

                            <td>

                                <div class="  <?= $ticket['status'] !== 'Tutup' ? 'dropdown' : '' ?>">

                                    <button
                                        id="status-btn-<?= $ticket['id'] ?>"
                                        class="btn <?= $btnClass ?> btn-sm  <?= $ticket['status'] == 'Tutup'  ? '' : 'dropdown-toggle' ?>"
                                        <?= $ticket['status'] != 'Tutup'  ? 'data-bs-toggle="dropdown"' : ''  ?>>

                                        <?= $ticket['status'] ?>

                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end p-0 py-0">

                                        <?php foreach ($status as $s): ?>

                                            <?php

                                            switch ($s) {

                                                case 'Buka':
                                                    $class = 'bg-primary';
                                                    break;

                                                case 'Ditugaskan':
                                                    $class = 'bg-warning';

                                                    break;

                                                case 'Dikerja':
                                                    $class = 'bg-success';
                                                    break;

                                                case 'Selesai':
                                                    $class = 'bg-secondary';
                                                    break;

                                                case 'Tutup':
                                                    $class = 'bg-danger';
                                                    break;

                                                default:
                                                    $class = 'btn-dark';
                                            }

                                            ?>

                                            <li>

                                                <form action="<?= site_url('ticket/updateStatus') ?>" method="post">

                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="teknisi" value="<?= $ticket['ditugaskan'] ?>">
                                                    <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                                    <input
                                                        type="hidden"
                                                        name="status"
                                                        value="<?= $s ?>">

                                                    <?php if (
                                                        $ticket['status'] !== $s
                                                    ) :
                                                        # code...
                                                    ?><button
                                                            type="button"
                                                            class="dropdown-item text-white <?= $class ?> rounded mb-1 py-2"
                                                            onclick="<?= $s == 'Ditugaskan'
                                                                            ? 'showCard(' . $ticket['id'] . ')'
                                                                            : 'confirmStatus(this)' ?>">

                                                            <?= $s ?>

                                                        </button>

                                                    <?php endif ?>

                                                </form>

                                            </li>

                                        <?php endforeach; ?>

                                    </ul>

                                </div>

                            </td>

                            <td>

                                <a
                                    href="<?= site_url('ticket/detail/' . $ticket['id']) ?>"
                                    class="btn btn-outline-primary btn-sm">

                                    <i class="bi bi-eye-fill"></i>

                                    Detail

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>
        <div class="d-flex justify-content-center mt-3" id="paginationTicket">
            <?= $pager->links('default', 'pager') ?>
        </div>
    </div>


</div>

<div id="cardDitugaskan" class="card shadow"
    style="display:none; ">


    <div class="card-header bg-warning d-flex align-items-center">

        <div>
            Ditugaskan
        </div>

        <button class="btn btn-sm btn-danger ms-auto btn-close"
            onclick="hideCard()">

        </button>

    </div>


    <div class="card-body">
        <form action="<?= site_url('ticket/updateStatus') ?>" method="post">

            <?= csrf_field() ?>
            <input type="hidden" name="id" id="ticketId">
            <input type="hidden" name="status" value="Ditugaskan">

            <div class="mb-3">
                <label>Nama Teknisi</label>
                <input type="text" name="teknisi" class="form-control">
            </div>
            <div class="d-flex justify-content-end gap-2">


                <button
                    type="button"
                    class="btn btn-secondary"
                    onclick="hideCard()">

                    Batal

                </button>
                <button type="button" class="btn btn-primary" onclick="confirmStatus(this)">Simpan</button>
            </div>
        </form>
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

<script>
    function showCard(id) {

        document.getElementById("ticketId").value = id;
        document.getElementById("cardDitugaskan").style.display = "block";

    }

    function hideCard() {

        document.getElementById("cardDitugaskan").style.display = "none";

    }
</script>
<script>
    (function() {
        const inputCari = document.getElementById('inputCariTicket');
        const formCari = document.getElementById('formCariTicket');
        const tbody = document.querySelector('table tbody');

        if (!inputCari || !formCari || !tbody) {
            console.error('[Search Ticket] Elemen tidak ditemukan');
            return;
        }

        let debounceTimer;
        let currentController = null;

        inputCari.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                doSearchTicket(inputCari.value, 1);
            }, 200);
        });

        formCari.addEventListener('submit', (e) => {
            e.preventDefault();
            clearTimeout(debounceTimer);
            doSearchTicket(inputCari.value, 1);
        });

        // Intercept klik dropdown filter status, biar ikut live juga
        document.querySelectorAll('.filter-status-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const keyword = link.getAttribute('data-keyword');
                inputCari.value = keyword;
                doSearchTicket(keyword, 1);
            });
        });

        async function doSearchTicket(keyword, page = 1) {
            if (currentController) {
                currentController.abort();
            }
            currentController = new AbortController();

            const params = new URLSearchParams({
                keyword: keyword,
                page: page,
            });

            try {
                const res = await fetch(`/ticket/search?${params.toString()}`, {
                    signal: currentController.signal
                });

                if (!res.ok) {
                    console.error('[Search Ticket] Response gagal, status:', res.status);
                    return;
                }

                const result = await res.json();

                renderTableTicket(result.data);
                renderPaginationTicket(keyword, result.currentPage, result.totalPages);
                updateJumlahTicketSearch(result.total);

            } catch (err) {
                if (err.name !== 'AbortError') {
                    console.error('[Search Ticket] Gagal mengambil data:', err);
                }
            }
        }

        // Warna badge status, sama seperti di WebSocket script
        const statusColorSearch = {
            'Buka': 'btn-primary',
            'Ditugaskan': 'btn-warning',
            'Dikerja': 'btn-success',
            'Selesai': 'btn-secondary',
            'Tutup': 'btn-danger',
        };
        const statusBgColorSearch = {
            'Buka': 'bg-primary',
            'Ditugaskan': 'bg-warning',
            'Dikerja': 'bg-success',
            'Selesai': 'bg-secondary',
            'Tutup': 'bg-danger',
        };

        function renderTableTicket(items) {
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
                <td>
                                <div class="fw-semibold">

                                  ${escapeHtmlSearch(t.name_user)}

                                </div>
                </td>
                
                <td class="text-start">
                    <div class="fw-semibold">${escapeHtmlSearch(t.subjek)}</div>
                    <small class="text-muted">${escapeHtmlSearch(t.kode_tiket)}</small>
                </td>
                <td>
                    <img src="/img/${t.gambar}"
                         class="ticket-img"
                         style="cursor:pointer"
                         onclick="lihatGambar('/img/${t.gambar}')">
                </td>
                <td><span class="badge bg-info badge-category">${escapeHtmlSearch(t.category)}</span></td>
                <td>${formatTanggalSearch(t.created_at)}</td>
                <td>${buildStatusDropdownSearch(t)}</td>
                <td>
                    <a href="/ticket/detail/${t.id}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-eye-fill"></i> Detail
                    </a>
                </td>
            </tr>
        `).join('');
        }

        function buildStatusDropdownSearch(t) {
            const allStatus = ['Buka', 'Ditugaskan', 'Dikerja', 'Selesai', 'Tutup'];

            const existingForm = document.querySelector('form[action*="updateStatus"]');
            const csrfInput = existingForm ? existingForm.querySelector('input[name^="csrf"]') : null;
            const csrfName = csrfInput ? csrfInput.name : 'csrf_test_name';
            const csrfValue = csrfInput ? csrfInput.value : '';

            if (t.status === 'Tutup') {
                return `<button class="btn ${statusColorSearch[t.status]} btn-sm">${t.status}</button>`;
            }

            let optionsHtml = '';
            allStatus.forEach(s => {
                if (s === t.status) return;

                const bgCls = statusBgColorSearch[s] || 'bg-dark';

                if (s === 'Ditugaskan') {
                    optionsHtml += `
                    <li>
                        <button type="button"
                            class="dropdown-item text-white ${bgCls} rounded mb-1 py-2"
                            onclick="showCard(${t.id})">
                            ${s}
                        </button>
                    </li>`;
                } else {
                    optionsHtml += `
                    <li>
                        <form action="/ticket/updateStatus" method="post">
                            <input type="hidden" name="${csrfName}" value="${csrfValue}">
                            <input type="hidden" name="teknisi" value="${escapeHtmlSearch(t.ditugaskan || '')}">
                            <input type="hidden" name="id" value="${t.id}">
                            <input type="hidden" name="status" value="${s}">
                            <button type="submit" class="dropdown-item text-white ${bgCls} rounded mb-1 py-2">
                                ${s}
                            </button>
                        </form>
                    </li>`;
                }
            });

            return `
            <div class="dropdown">
                <button id="status-btn-${t.id}" class="btn ${statusColorSearch[t.status]} btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                    ${t.status}
                </button>
                <ul class="dropdown-menu dropdown-menu-end p-0 py-0">
                    ${optionsHtml}
                </ul>
            </div>
        `;
        }

        function renderPaginationTicket(keyword, currentPage, totalPages) {
            const container = document.getElementById('paginationTicket');
            if (!container) return;

            if (totalPages <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = '<ul class="pagination">';

            html += `
                <li class="page-item ${currentPage <= 1 ? 'disabled' : ''}">
                    <a class="page-link page-link-ticket" href="#" data-page="${currentPage - 1}">&laquo;</a>
                </li>
            `;

            for (let i = 1; i <= totalPages; i++) {
                html += `
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link page-link-ticket" href="#" data-page="${i}">${i}</a>
                    </li>
                `;
            }

            html += `
                <li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}">
                    <a class="page-link page-link-ticket" href="#" data-page="${currentPage + 1}">&raquo;</a>
                </li>
            `;

            html += '</ul>';
            container.innerHTML = html;

            container.querySelectorAll('.page-link-ticket').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const page = parseInt(link.getAttribute('data-page'));
                    if (page < 1 || page > totalPages || page === currentPage) return;
                    doSearchTicket(keyword, page);
                });
            });
        }

        function updateJumlahTicketSearch(total) {
            const el = document.querySelector('small.text-muted');
            if (!el) return;
            el.textContent = el.textContent.replace(/\d+/, total);
        }

        function formatTanggalSearch(datetimeStr) {
            const d = new Date(datetimeStr);
            const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const pad = (n) => n.toString().padStart(2, '0');
            return `${pad(d.getDate())} ${bulan[d.getMonth()]} ${d.getFullYear()} ${pad(d.getHours())}:${pad(d.getMinutes())}`;
        }

        function escapeHtmlSearch(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }
    })();
</script>
<script>
    // ==========================================
    // WebSocket - Real-time update daftar tiket
    // ==========================================
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

            if (payload.type === 'new_ticket') {
                handleNewTicket(payload.data);
            }

            if (payload.type === 'status_update') {
                handleStatusUpdate(payload.data);
            }
            if (payload.type === 'delete_category') { // <-- TAMBAHKAN
                handleCategoryDeletedRemoveTickets(payload.data);
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

    // Warna badge status, sinkron dengan warna PHP di atas
    const statusColor = {
        'Buka': 'btn-primary',
        'Ditugaskan': 'btn-warning',
        'Dikerja': 'btn-success',
        'Selesai': 'btn-secondary',
        'Tutup': 'btn-danger',
    };
    const statusBgColor = {
        'Buka': 'bg-primary',
        'Ditugaskan': 'bg-warning',
        'Dikerja': 'bg-success',
        'Selesai': 'bg-secondary',
        'Tutup': 'bg-danger',
    };


    function handleNewTicket(t) {
        if (document.getElementById('ticket-' + t.id)) return;

        const tbody = document.querySelector('table tbody');
        const row = document.createElement('tr');
        row.id = 'ticket-' + t.id;
        row.style.backgroundColor = '#fff3cd';

        row.innerHTML = `
    <td><span class="badge bg-warning text-dark">Baru</span></td>
      <td>
                                <div class="fw-semibold">

                                  ${escapeHtmlSearch(t.name_user)}

                                </div>
                </td>
    <td class="text-start">
        <div class="fw-semibold">${escapeHtml(t.subjek)}</div>
        <small class="text-muted">${escapeHtml(t.kode_tiket)}</small>
    </td>
    <td>
        <img src="/img/${t.gambar}" 
             class="ticket-img" 
             style="cursor:pointer" 
             onclick="lihatGambar('/img/${t.gambar}')">
    </td>
    <td><span class="badge bg-info badge-category">${escapeHtml(t.kategori || '-')}</span></td>
    <td>${formatTanggal(t.created_at)}</td>
    <td>${buildStatusDropdown(t)}</td>
    <td>
        <a href="/ticket/detail/${t.id}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-eye-fill"></i> Detail
        </a>
    </td>
`;

        tbody.insertBefore(row, tbody.firstChild);
        updateJumlahTicket(1);

        setTimeout(() => row.style.backgroundColor = '', 3000);
    }

    // Bikin dropdown status yang beneran bisa diklik
    function buildStatusDropdown(t) {
        const allStatus = ['Buka', 'Ditugaskan', 'Dikerja', 'Selesai', 'Tutup'];

        const existingForm = document.querySelector('form[action*="updateStatus"]');
        if (!existingForm) return `<span class="badge ${statusColor[t.status]}">${t.status}</span>`;

        const csrfInput = existingForm.querySelector('input[name^="csrf"]');
        const csrfName = csrfInput ? csrfInput.name : 'csrf_test_name';
        const csrfValue = csrfInput ? csrfInput.value : '';

        if (t.status === 'Tutup') {
            return `<button class="btn ${statusColor[t.status]} btn-sm">${t.status}</button>`;
        }

        let optionsHtml = '';
        allStatus.forEach(s => {
            if (s === t.status) return;

            const bgCls = statusBgColor[s] || 'bg-dark'; // <-- GANTI dari statusColor jadi statusBgColor

            if (s === 'Ditugaskan') {
                optionsHtml += `
                <li>
                    <button type="button"
                        class="dropdown-item text-white ${bgCls} rounded mb-1 py-2"
                        onclick="showCard(${t.id})">
                        ${s}
                    </button>
                </li>`;
            } else {
                optionsHtml += `
                <li>
                    <form action="/ticket/updateStatus" method="post">
                        <input type="hidden" name="${csrfName}" value="${csrfValue}">
                        <input type="hidden" name="teknisi" value="">
                        <input type="hidden" name="id" value="${t.id}">
                        <input type="hidden" name="status" value="${s}">
                        <button type="submit" class="dropdown-item text-white ${bgCls} rounded mb-1 py-2">
                            ${s}
                        </button>
                    </form>
                </li>`;
            }
        });

        return `
        <div class="dropdown">
            <button class="btn ${statusColor[t.status]} btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                ${t.status}
            </button>
            <ul class="dropdown-menu dropdown-menu-end p-0 py-0">
                ${optionsHtml}
            </ul>
        </div>
    `;
    }

    function handleCategoryDeletedRemoveTickets(data) {
        const ticketIds = data.ticket_ids || [];
        if (ticketIds.length === 0) return;

        let jumlahTerhapus = 0;

        ticketIds.forEach(id => {
            const row = document.getElementById('ticket-' + id);
            if (!row) return; // tiket ini tidak ada di halaman/pagination yang sedang dilihat

            row.style.transition = 'background-color 0.5s ease, opacity 0.5s ease';
            row.style.backgroundColor = '#f8d7da';
            row.style.opacity = '0.5';

            setTimeout(() => row.remove(), 800);
            jumlahTerhapus++;
        });

        if (jumlahTerhapus > 0) {
            updateJumlahTicket(-jumlahTerhapus);
        }
    }

    function handleStatusUpdate(t) {
        const btn = document.getElementById('status-btn-' + t.id);
        if (!btn) return; // baris tidak ada di halaman ini (mungkin di halaman lain / sudah difilter)

        // Hapus semua class warna lama, pasang yang baru
        btn.className = 'btn btn-sm ' + (statusColor[t.status] || 'btn-dark');
        btn.textContent = t.status;

        const row = document.getElementById('ticket-' + t.id);
        if (row) {
            row.style.backgroundColor = '#d1ecf1'; // highlight biru sementara
            setTimeout(() => row.style.backgroundColor = '', 3000);
        }
    }

    function updateJumlahTicket(delta) {
        const el = document.querySelector('small.text-muted');
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
    function confirmStatus(button) {
        document.getElementById("cardDitugaskan").style.display = "none";

        Swal.fire({
            title: 'Ubah Status?',
            text: 'Apakah Anda yakin ingin mengubah status tiket ini?',
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