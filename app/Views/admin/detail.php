<?= $this->extend('template/templateAdmin'); ?>

<?= $this->section('content'); ?>
<?php $status = ['Buka', 'Ditugaskan', 'Dikerja', 'Selesai', 'Tutup']; ?>

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

<style>
    .ticket-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
    }


    .ticket-header {
        background-image: url('/assets/sidebar.png');
        background-repeat: no-repeat;
        background-size: cover;
        color: white;
        padding: 20px;
    }

    .ticket-header h3 {

        text-transform: capitalize;
        font-weight: 700;
    }



    .ticket-img {
        width: 100%;
        height: 250px;
        object-fit: contain;
        border-radius: 12px;
    }

    .info-title {
        font-size: .9rem;
        color: #6c757d;
        margin-bottom: 3px;
    }

    .info-value {
        font-weight: 600;
        font-size: 16px;
    }

    .description-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px;
        line-height: 1.7;
    }

    #cardDitugaskan {
        width: 380px;
    }

    .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .15);
    }


    @media (max-width:768px) {
        .ticket-header h3 {
            font-size: 20px;

        }

        #cardDitugaskan {
            width: 99%;
        }

        #status-badge-detail {
            #status-badge-detail {
                min-width: 110px;
                height: 40px;
                line-height: 28px;
                padding: 6px 12px;
                font-size: 14px;
                border-radius: 8px;
                text-align: center;
            }
        }
    }
</style>

<div class="container p-0 border-opacity-50 border border-dark">



    <div class="ticket-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <div class="d-flex align-items-center gap-2 mb-2">

                    <a href="<?= base_url('ticket') ?>"
                        class=" text-black">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            fill="currentColor"
                            class="bi bi-arrow-left"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                    </a>

                    <span class="badge bg-light text-dark px-3 py-2">
                        <?= $ticket['kode_tiket'] ?>
                    </span>

                </div>


                <h3 class="mb-0">
                    kode tiket
                </h3>

            </div>

            <div>
                <div id="status-wrapper-detail" class="  <?= $ticket['status'] !== 'Tutup' ? 'dropdown' : '' ?>">

                    <button
                        id="status-btn-detail"
                        class="btn <?= $btnClass ?> btn-sm  <?= $ticket['status'] == 'Tutup' ? '' : 'dropdown-toggle' ?>"
                        <?= $ticket['status'] !== 'Tutup' ? 'data-bs-toggle="dropdown"' : ''  ?>>

                        <?= $ticket['status'] ?>

                    </button>

                    <ul id="status-menu-detail" class="dropdown-menu dropdown-menu-end p-0">
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

                                    <?php if ($ticket['status'] !== $s) :
                                        # code...
                                    ?>
                                        <button
                                            type="<?= $s == 'Ditugaskan' ? 'button' : 'submit' ?>"
                                            class="dropdown-item text-white <?= $class ?> rounded mb-1 py-2 " <?php if ($s == 'Ditugaskan'): ?>
                                            onclick="showCard(<?= $ticket['id'] ?>)"
                                            <?php endif; ?>>

                                            <?= $s ?>

                                        </button>

                                    <?php endif ?>

                                </form>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            </div>

        </div>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-4">

                <img src="<?= base_url('img/' . $ticket['gambar']) ?>"
                    class="ticket-img">

            </div>

            <div class="col-md-8">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <div class="info-title">
                            Subjek
                        </div>

                        <div class="info-value">
                            <?= esc($ticket['subjek']) ?>
                        </div>

                    </div>

                    <div class="col-md-4 mb-3">

                        <div class="info-title">
                            Kategori
                        </div>

                        <div class="info-value">
                            <?= esc($ticket['category']) ?>
                        </div>

                    </div>

                    <div class="col-md-4 mb-3">

                        <div class="info-title">
                            Dibuat Oleh
                        </div>

                        <div class="info-value">
                            <?= esc($ticket['nama_user']) ?>
                        </div>

                    </div>

                    <div class="col-md-4 mb-3">

                        <div class="info-title">
                            teknisi
                        </div>

                        <div class="info-value" id="teknisi-detail">
                            <?= esc($ticket['nama_teknisi']) ?>
                        </div>

                    </div>
                    <div class="col-md-4 mb-3">

                        <div class="info-title">
                            Dibuat Pada
                        </div>

                        <div class="info-value">
                            <?= date('d M Y, H:i', strtotime($ticket['Created_at'])) ?>

                        </div>

                    </div>

                </div>

                <hr>

                <h5 class="mb-3">
                    Deskripsi Masalah
                </h5>

                <div class="description-box">

                    <?= esc($ticket['deskripsi']) ?>
                </div>

            </div>

        </div>

    </div>


</div>
<div id="cardDitugaskan" class="card shadow"
    style="display:none; position:fixed; top:100px; right:1px;   z-index:9999;">


    <div class="card-header bg-warning d-flex align-items-center">

        <div>
            Ditugaskan
        </div>

        <button class="btn btn-close ms-auto"
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

            <button class="btn btn-success">Simpan</button>
        </form>
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
        // ==========================================
        // WEBSOCKET - REAL-TIME DETAIL TIKET
        // ==========================================
        if (window.__wsDetailActive) {
            console.warn('[WS] Koneksi detail tiket sudah aktif, skip inisialisasi ulang');
            return;
        }
        window.__wsDetailActive = true;

        const wsUrl = window.WS_URL;
        const currentTicketId = <?= (int) $ticket['id'] ?>;

        const btnStatusColor = {
            'Buka': 'btn-primary',
            'Ditugaskan': 'btn-warning',
            'Dikerja': 'btn-success',
            'Selesai': 'btn-secondary',
            'Tutup': 'btn-danger',
        };

        // Class warna item dropdown
        const bgStatusColor = {
            'Buka': 'bg-primary',
            'Ditugaskan': 'bg-warning',
            'Dikerja': 'bg-success',
            'Selesai': 'bg-secondary',
            'Tutup': 'bg-danger',
        };

        const allStatus = ['Buka', 'Ditugaskan', 'Dikerja', 'Selesai', 'Tutup'];

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

                if (payload.type === 'status_update') {
                    handleStatusUpdate(payload.data);
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

        function handleStatusUpdate(t) {
            // Hanya proses kalau ini tiket yang sedang dibuka di halaman ini
            if (parseInt(t.id) !== currentTicketId) return;

            // Update kolom teknisi
            const teknisiEl = document.getElementById('teknisi-detail');
            if (teknisiEl) {
                teknisiEl.textContent = t.ditugaskan || '-';
                highlightElement(teknisiEl.closest('.col-md-4') || teknisiEl);
            }

            // Update tombol status utama
            const statusBtn = document.getElementById('status-btn-detail');
            if (statusBtn) {
                const newClass = btnStatusColor[t.status] || 'btn-dark';
                const isTutup = t.status === 'Tutup';

                statusBtn.className = `btn ${newClass} btn-sm` + (isTutup ? '' : ' dropdown-toggle');
                statusBtn.textContent = t.status;

                if (isTutup) {
                    statusBtn.removeAttribute('data-bs-toggle');
                } else {
                    statusBtn.setAttribute('data-bs-toggle', 'dropdown');
                }

                highlightElement(statusBtn);
            }

            // Update wrapper dropdown (hilangkan class "dropdown" kalau sudah Tutup)
            const wrapperEl = document.getElementById('status-wrapper-detail');
            if (wrapperEl) {
                wrapperEl.className = t.status !== 'Tutup' ? 'dropdown' : '';
            }

            // Bangun ulang isi dropdown menu sesuai status terbaru
            rebuildStatusMenu(t);
        }

        function rebuildStatusMenu(t) {
            const menuEl = document.getElementById('status-menu-detail');
            if (!menuEl) return;

            if (t.status === 'Tutup') {
                menuEl.innerHTML = ''; // tiket sudah tutup, tidak ada opsi lagi
                return;
            }

            const csrfInput = getCsrfInput();
            let html = '';

            allStatus.forEach(s => {
                if (s === t.status) return; // skip status yang sedang aktif

                const cls = bgStatusColor[s] || 'bg-dark';

                if (s === 'Ditugaskan') {
                    html += `
                    <li>
                        <form action="/ticket/updateStatus" method="post">
                            <button type="button"
                                class="dropdown-item text-white ${cls} rounded mb-1 py-2"
                                onclick="showCard(${t.id})">
                                ${s}
                            </button>
                        </form>
                    </li>`;
                } else {
                    html += `
                    <li>
                        <form action="/ticket/updateStatus" method="post">
                            ${csrfInput}
                            <input type="hidden" name="teknisi" value="${escapeHtml(t.ditugaskan || '')}">
                            <input type="hidden" name="id" value="${t.id}">
                            <input type="hidden" name="status" value="${s}">
                            <button type="submit" class="dropdown-item text-white ${cls} rounded mb-1 py-2">
                                ${s}
                            </button>
                        </form>
                    </li>`;
                }
            });

            menuEl.innerHTML = html;
        }

        function getCsrfInput() {
            const existingForm = document.querySelector('form[action*="updateStatus"]');
            if (!existingForm) return '';

            const csrfInput = existingForm.querySelector('input[name^="csrf"]');
            if (!csrfInput) return '';

            return `<input type="hidden" name="${csrfInput.name}" value="${csrfInput.value}">`;
        }

        function highlightElement(el) {
            if (!el) return;
            const original = el.style.transition;
            el.style.transition = 'background-color 1s ease';
            el.style.backgroundColor = '#d1ecf1';
            setTimeout(() => {
                el.style.backgroundColor = '';
                el.style.transition = original;
            }, 2000);
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