<?= $this->extend('template/templateUser'); ?>

<?= $this->section('content'); ?>

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

    .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .15);
    }

    @media (max-width:768px) {
        .ticket-header h3 {
            font-size: 20px;
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

<div class="container-fluid mt-4 px-0">

    <div class="card shadow">

        <div class="card-body">


            <div class="container p-0 border-opacity-50 border border-dark">



                <div class="ticket-header">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <div class="d-flex align-items-center gap-2 mb-2">

                                <a href="<?= base_url('lihat') ?>"
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
                                    <?= esc($ticket['kode_tiket']) ?>
                                </span>

                            </div>

                            <h3 class="fw-bold mb-0">
                                Kode Tiket
                            </h3>
                        </div>
                        <div id="status-badge-detail" class="btn <?= $btnClass ?> "><?= $ticket['status'] ?></div>




                    </div>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4">

                            <img src="/img/<?= $ticket['gambar'] ?>"
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
                                        <?= esc($ticket['name']) ?>
                                    </div>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <div class="info-title">
                                        teknisi
                                    </div>

                                    <div class="info-value" id="teknisi-detail">
                                        <?= esc($ticket['ditugaskan'] ?: '-') ?>
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

                                <?= $ticket['deskripsi'] ?>
                            </div>

                        </div>

                    </div>

                </div>


            </div>
        </div>

    </div>


</div>
<script>
    (function() {
        // ==========================================
        // WEBSOCKET - REAL-TIME DETAIL TIKET (KARYAWAN)
        // ==========================================
        if (window.__wsDetailActive) {
            console.warn('[WS] Koneksi detail tiket sudah aktif, skip inisialisasi ulang');
            return;
        }
        window.__wsDetailActive = true;

        const wsUrl = window.WS_URL;
        const currentTicketId = <?= (int) $ticket['id'] ?>;

        // Class warna badge status, sama seperti switch-case PHP di atas
        const btnStatusColor = {
            'Buka': 'btn-primary',
            'Ditugaskan': 'btn-warning',
            'Dikerja': 'btn-success',
            'Selesai': 'btn-secondary',
            'Tutup': 'btn-danger',
        };

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

            // Update teknisi
            const teknisiEl = document.getElementById('teknisi-detail');
            if (teknisiEl) {
                teknisiEl.textContent = t.ditugaskan || '-';
                highlightElement(teknisiEl);
            }

            // Update badge status
            const statusEl = document.getElementById('status-badge-detail');
            if (statusEl) {
                const newClass = btnStatusColor[t.status] || 'btn-dark';
                statusEl.className = `btn ${newClass}`;
                statusEl.textContent = t.status;
                highlightElement(statusEl);
            }
        }

        function highlightElement(el) {
            if (!el) return;
            el.style.transition = 'background-color 1s ease, box-shadow 1s ease';
            el.style.boxShadow = '0 0 0 3px #d1ecf1';
            setTimeout(() => {
                el.style.boxShadow = '';
            }, 2000);
        }

        connectWebSocket();
    })();
</script>
<?= $this->endSection(); ?>