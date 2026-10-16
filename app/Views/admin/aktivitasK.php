<?= $this->extend('template/templateAdmin'); ?>

<?= $this->section('content'); ?>

<style>
    .activity-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .08);
        padding: 25px;
    }

    .search-box {
        width: 400px;
    }

    .table thead {
        background: #0d6efd;
        color: white;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
        transition: .2s;
    }



    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #0d6efd;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }

    .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
    }

    .dropdown-item:hover {
        background: #f1f5ff;
    }

    .activity-text {
        font-weight: 500;
    }

    .badge-ticket {
        background: #0d6efd;
    }

    #selectBulanAktivitas {
        width: 18%;

    }

    #selectTahunAktivitas {
        width: 20%;

    }

    @media(max-width:768px) {
        .subjudul {
            font-size: 14px;

        }

        #linkExportAktivitas,
        #selectBulanAktivitas,
        #selectTahunAktivitas {
            height: 32px;
            font-size: 14px;
        }

        #selectBulanAktivitas,
        #selectTahunAktivitas {
            width: 45%;

        }

        .search-box {
            width: 80%;
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

        .head h3 {
            font-size: 20px;
            margin-bottom: 0;
        }

        .header-action {
            flex-direction: column;
            gap: 10px;
        }

        .table th {
            font-size: 15px;
        }

        .table td {
            font-weight: 400;
            font-size: 13px;
        }

        .table th,
        .table td {
            white-space: nowrap;
            vertical-align: middle;
        }

        .header-action form {
            width: 100%;
        }

        .header-action input {
            width: 100%;
        }

    }
</style>

<div class="container py-4">



    <div class="d-flex justify-content-between align-items-center mb-2 header-action">

        <div class="head">

            <h3 class="fw-bold mb-1">

                Riwayat Aktivitas Karyawan
            </h3>

            <p class="subjudul text-muted mb-0">
                Semua aktivitas pengguna pada sistem ticket.
            </p>

        </div>

    </div>
    <div class="d-flex gap-2 align-items-center flex-wrap mb-4">

        <form id="formCariAktivitas" action="" method="get" class="d-flex gap-2 flex-wrap">

            <div class="input-group search-box">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </span>

                <input
                    id="inputCariAktivitas"
                    type="text"
                    class="form-control"
                    name="keyword"
                    placeholder="Cari Aktivitas.."
                    value="<?= $_GET['keyword'] ?? '' ?>"
                    autocomplete="off">

                <button class="btn btn-primary" type="submit">
                    Cari
                </button>
            </div>
            <a id="linkExportAktivitas" href="/aktivitas/exportk?<?= http_build_query($_GET) ?>" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                    <path d="M6 12v-2h3v2z" />
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z" />
                </svg>

            </a>
            <select id="selectBulanAktivitas" name="bulan" class="form-select">
                <option value="">Semua Bulan</option>
                <?php
                $namaBulanList = [
                    1 => "Januari",
                    2 => "Februari",
                    3 => "Maret",
                    4 => "April",
                    5 => "Mei",
                    6 => "Juni",
                    7 => "Juli",
                    8 => "Agustus",
                    9 => "September",
                    10 => "Oktober",
                    11 => "November",
                    12 => "Desember"
                ];
                foreach ($namaBulanList as $key => $value):
                ?>
                    <option value="<?= $key ?>" <?= service('request')->getGet('bulan') == $key ? 'selected' : '' ?>>
                        <?= $value ?>
                    </option>
                <?php endforeach ?>
            </select>

            <select id="selectTahunAktivitas" name="tahun" class="form-select">
                <option value="">Semua Tahun</option>
                <?php for ($i = $tahunMin; $i <= $tahunMax; $i++): ?>
                    <option value="<?= $i ?>" <?= ($tahun == $i) ? 'selected' : '' ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>



        </form>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle text-center">

            <thead>

                <tr>

                    <th width="60">No</th>

                    <th>User</th>

                    <th>Kode Ticket</th>

                    <th>Subjek</th>

                    <th>Aktivitas</th>
                    <th>teknisi</th>

                    <th>Tanggal/jam</th>

                </tr>

            </thead>

            <tbody>


                <?php foreach ($log as $row): ?>

                    <tr id="log-<?= $row['id'] ?>">

                        <td><?= $nomor++ ?></td>

                        <td>

                            <div class="d-flex align-items-center gap-2">



                                <div class="text-center">

                                    <div class="fw-semibold ">

                                        <?= esc($row['name']) ?>

                                    </div>

                                    <small class="text-muted">

                                        ID :
                                        <?= $row['user_id'] ?>

                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            <span class="badge badge-ticket">

                                <?= esc($row['kode_tiket']) ?>

                            </span>

                        </td>

                        <td>

                            <?= esc($row['subjek']) ?>

                        </td>

                        <td class="activity-text text-wrap">

                            <?= esc($row['aktivitas']) ?>

                        </td>

                        <td>

                            <?= esc($row['ditugaskan']) ?>


                        </td>
                        <td>

                            <?= date('d M Y, H:i', strtotime($row['created_at'])) ?>

                        </td>

                    </tr>

                <?php endforeach ?>

            </tbody>

        </table>
    </div>

    <div class="d-flex justify-content-center mt-3" id="paginationAktivitas">
        <?= $pager->links('default', 'pager') ?>
    </div>

</div>

<script>
    (function() {
        const inputCari = document.getElementById('inputCariAktivitas');
        const formCari = document.getElementById('formCariAktivitas');
        const selectBulan = document.getElementById('selectBulanAktivitas');
        const selectTahun = document.getElementById('selectTahunAktivitas');
        const tbody = document.querySelector('table tbody');

        if (!inputCari || !formCari || !tbody) {
            console.error('[Search Aktivitas] Elemen tidak ditemukan');
            return;
        }

        let debounceTimer;
        let currentController = null;

        inputCari.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                doSearchAktivitas(1);
            }, 200);
        });

        selectBulan.addEventListener('change', () => doSearchAktivitas());
        selectTahun.addEventListener('change', () => doSearchAktivitas());

        formCari.addEventListener('submit', (e) => {
            e.preventDefault();
            clearTimeout(debounceTimer);
            doSearchAktivitas(1);
        });

        async function doSearchAktivitas(page = 1) {
            if (currentController) {
                currentController.abort();
            }
            currentController = new AbortController();

            const params = new URLSearchParams({
                keyword: inputCari.value,
                bulan: selectBulan.value,
                tahun: selectTahun.value,
                page: page,
            });

            const linkExport = document.getElementById('linkExportAktivitas');
            if (linkExport) {
                const exportParams = new URLSearchParams({
                    keyword: inputCari.value,
                    bulan: selectBulan.value,
                    tahun: selectTahun.value,
                });
                linkExport.href = `/aktivitas/exportk?${exportParams.toString()}`;
            }

            try {
                const res = await fetch(`/aktivitas/searchk?${params.toString()}`, {
                    signal: currentController.signal
                });

                if (!res.ok) {
                    console.error('[Search Aktivitas] Response gagal, status:', res.status);
                    return;
                }

                const result = await res.json();
                renderTableAktivitas(result.data);
                renderPaginationAktivitas(result.currentPage, result.totalPages);

            } catch (err) {
                if (err.name !== 'AbortError') {
                    console.error('[Search Aktivitas] Gagal mengambil data:', err);
                }
            }
        }

        function renderPaginationAktivitas(currentPage, totalPages) {
            const container = document.getElementById('paginationAktivitas');
            if (!container) return;

            if (totalPages <= 1) {
                container.innerHTML = '';
                return;
            }

            let html = '<ul class="pagination">';

            // Tombol Previous
            html += `
        <li class="page-item ${currentPage <= 1 ? 'disabled' : ''}">
            <a class="page-link page-link-aktivitas" href="#" data-page="${currentPage - 1}">&laquo;</a>
        </li>
    `;

            // Nomor halaman
            for (let i = 1; i <= totalPages; i++) {
                html += `
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link page-link-aktivitas" href="#" data-page="${i}">${i}</a>
            </li>
        `;
            }

            // Tombol Next
            html += `
        <li class="page-item ${currentPage >= totalPages ? 'disabled' : ''}">
            <a class="page-link page-link-aktivitas" href="#" data-page="${currentPage + 1}">&raquo;</a>
        </li>
    `;

            html += '</ul>';
            container.innerHTML = html;

            // Pasang event listener ke link halaman yang baru dibuat
            container.querySelectorAll('.page-link-aktivitas').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const page = parseInt(link.getAttribute('data-page'));
                    if (page < 1 || page > totalPages || page === currentPage) return;
                    doSearchAktivitas(page);
                });
            });
        }

        function renderTableAktivitas(items) {
            if (!items || items.length === 0) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Tidak ada aktivitas ditemukan
                    </td>
                </tr>
            `;
                return;
            }

            tbody.innerHTML = items.map(row => `
            <tr id="log-${row.id}">
                <td>${row.no}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div class="text-center">
                            <div class="fw-semibold">${escapeHtmlAktivitas(row.name)}</div>
                            <small class="text-muted">ID : ${row.user_id}</small>
                        </div>
                    </div>
                </td>
                <td><span class="badge badge-ticket">${escapeHtmlAktivitas(row.kode_tiket)}</span></td>
                <td>${escapeHtmlAktivitas(row.subjek)}</td>
                <td class="activity-text text-wrap">${escapeHtmlAktivitas(row.aktivitas)}</td>
                <td>${escapeHtmlAktivitas(row.ditugaskan || '-')}</td>
                <td>${formatTanggalAktivitas(row.created_at)}</td>
            </tr>
        `).join('');
        }

        function formatTanggalAktivitas(datetimeStr) {
            const d = new Date(datetimeStr);
            const bulanArr = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const pad = (n) => n.toString().padStart(2, '0');
            return `${pad(d.getDate())} ${bulanArr[d.getMonth()]} ${d.getFullYear()}, ${pad(d.getHours())}:${pad(d.getMinutes())}`;
        }

        function escapeHtmlAktivitas(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }
    })();
</script>

<script>
    (function() {
        // ==========================================
        // WEBSOCKET - REAL-TIME RIWAYAT AKTIVITAS
        // ==========================================
        if (window.__wsAktivitasActive) {
            console.warn('[WS] Koneksi aktivitas sudah aktif, skip inisialisasi ulang');
            return;
        }
        window.__wsAktivitasActive = true;

        const wsUrl = window.WS_URL;

        // Filter yang sedang aktif di halaman (dari query string PHP)
        const filterBulan = <?= service('request')->getGet('bulan') ? (int) service('request')->getGet('bulan') : 'null' ?>;
        const filterTahun = <?= !empty($tahun) ? (int) $tahun : 'null' ?>;
        const filterKeyword = <?= json_encode(strtolower($_GET['keyword'] ?? '')) ?>;

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

                if (payload.type === 'new_ticket' || payload.type === 'status_update') {
                    handleNewActivity(payload.data);
                }
            };

            socket.onclose = () => {
                console.log('[WS] Terputus, reconnect dalam 3 detik...');
                setTimeout(connectWebSocket, 3000);
            };

            socket.onerror = (err) => {
                console.error('[WS] Error:', err);
            };
        }

        // Cek apakah event ini cocok dengan filter bulan/tahun/keyword yang sedang aktif
        function matchFilter(t) {
            if (filterBulan !== null && filterBulan !== t.bulan) return false;
            if (filterTahun !== null && filterTahun !== t.tahun) return false;

            if (filterKeyword) {
                const teks = (
                    (t.subjek || '') + ' ' +
                    (t.ditugaskan || '') + ' ' +
                    (t.kode_tiket || '')
                ).toLowerCase();

                if (!teks.includes(filterKeyword)) return false;
            }

            return true;
        }

        function handleNewActivity(t) {
            // Kalau payload ini tidak punya info aktivitas (misal event lama tanpa update), abaikan
            if (!t.aktivitas_id || !t.aktivitas) return;

            // Cegah duplikat
            if (document.getElementById('log-' + t.aktivitas_id)) return;

            // Cocokkan dengan filter yang sedang aktif di halaman
            if (!matchFilter(t)) return;

            const tbody = document.querySelector('table tbody');
            if (!tbody) return;

            const row = document.createElement('tr');
            row.id = 'log-' + t.aktivitas_id;
            row.style.backgroundColor = '#fff3cd';
            row.style.transition = 'background-color 1.5s ease';

            row.innerHTML = `
            <td><span class="badge bg-warning text-dark">Baru</span></td>
            <td>
                <div class="d-flex align-items-center gap-2">
                    <div class="text-center">
                        <div class="fw-semibold">${escapeHtml(t.nama_user)}</div>
                        <small class="text-muted">ID : ${t.user_id}</small>
                    </div>
                </div>
            </td>
            <td><span class="badge badge-ticket">${escapeHtml(t.kode_tiket)}</span></td>
            <td>${escapeHtml(t.subjek)}</td>
            <td class="activity-text text-wrap">${escapeHtml(t.aktivitas)}</td>
            <td>${escapeHtml(t.ditugaskan || '-')}</td>
            <td>${formatTanggal(t.created_at || new Date().toISOString())}</td>
        `;

            tbody.insertBefore(row, tbody.firstChild);

            setTimeout(() => {
                row.style.backgroundColor = '';
            }, 3000);
        }

        function formatTanggal(datetimeStr) {
            const d = new Date(datetimeStr);
            const bulanArr = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const pad = (n) => n.toString().padStart(2, '0');
            return `${pad(d.getDate())} ${bulanArr[d.getMonth()]} ${d.getFullYear()}, ${pad(d.getHours())}:${pad(d.getMinutes())}`;
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }

        connectWebSocket();
    })();
</script>
<?= $this->endSection(); ?>