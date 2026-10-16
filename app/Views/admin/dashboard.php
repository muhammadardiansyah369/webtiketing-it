<?= $this->extend('template/templateAdmin') ?>
<?= $this->section('content') ?>


<style>
    #selectBulanDashboard,
    #selectTahunDashboard {
        height: 40px;

        width: 30%;

        font-size: 16px;
    }

    #selectTahunDashboard {
        margin-left: 10px;
    }

    .chart-scroll-wrapper {
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
    }

    .chart-inner {
        height: 450px;
        min-width: 100%;
    }

    @media (max-width:768px) {
        .chart-scroll-wrapper {
            /* biar keliatan jelas ada konten yg bisa discroll */
            border-radius: 8px;
        }

        .card-header h5 {
            font-size: 16px;
        }

        .header-admin {
            font-size: 20px;
        }

        #selectBulanDashboard,
        #selectTahunDashboard {
            height: 32px;

            width: 47%;

            font-size: 14px;
        }

        #selectTahunDashboard {
            margin-left: auto;
        }
    }
</style>
<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4 header-admin">

    <h3 class="fw-bold mb-0">
        Dashboard Admin
    </h3>


</div>

<!-- Card Statistik -->
<div class="row mb-4">

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Jumlah Tiket</h6>
                <h2 id="badge-total" class="fw-bold " style="color:#4F46E5;"><?= $jumlah ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Status Buka</h6>
                <h2 id="badge-buka" class="fw-bold " style="color: 
                    #10B981 "><?= $buka ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Status Dikerja</h6>
                <h2 id="badge-proses" class="fw-bold " style="color:#F59E0B;"><?= $proses ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <h6 class="text-muted">Status Tutup</h6>
                <h2 id="badge-tutup" class="fw-bold " style="color: #EF4444;"><?= $tutup ?></h2>
            </div>
        </div>
    </div>

</div>


<div class="card-body">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Statistik Tiket</h5>

    </div>

    <form id="formFilterDashboard" action="<?= base_url('dashboard') ?>" method="get">
        <div class="d-flex g-3 align-items-end">

            <select id="selectBulanDashboard" name="bulan" class="form-select">
                <option value="">Semua Bulan</option>

                <?php
                $namaBulan = [
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember'
                ];

                foreach ($namaBulan as $key => $value):
                ?>

                    <option value="<?= $key ?>"
                        <?= ($bulan == $key) ? 'selected' : '' ?>>
                        <?= $value ?>
                    </option>

                <?php endforeach; ?>

            </select>



            <select id="selectTahunDashboard" name="tahun" class="form-select">




                <?php for ($i = $tahunMin; $i <= $tahunMax; $i++): ?>

                    <option value="<?= $i ?>" <?= ($tahun == $i) ? 'selected' : '' ?>>
                        <?= $i ?>
                    </option>

                <?php endfor; ?>

            </select>







        </div>

    </form>

</div>

<div class="card shadow-sm mt-3">

    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h5 class="fw-bold mb-0">
                    Statistik Tiket
                </h5>
                <small class="text-muted" id="subtitle-dashboard">
                    <?php if (empty($bulan)): ?>
                        Tahun <?= $tahun ?>
                    <?php else: ?>
                        <?= $namaBulan[$bulan] ?> <?= $tahun ?>
                    <?php endif; ?>
                </small>
            </div>

        </div>
    </div>

    <div class="card-body">

        <div class="chart-scroll-wrapper">
            <div class="chart-inner" id="chartInner">
                <canvas id="ticketChart"></canvas>
            </div>
        </div>

    </div>
</div>

<div class="card shadow-sm mt-3">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold">

            Persentase Tiket Berdasarkan Kategori
        </h5>
    </div>

    <div class="card-body">

        <div class="row align-items-center">

            <!-- Pie Chart -->
            <div class="col-lg-5 text-center">

                <div style="width:250px;height:250px;margin:auto;">
                    <canvas id="categoryChart"></canvas>
                </div>

                <div class="mt-3">
                    <h4 id="total-di-pie" class="fw-bold text-primary mb-0">
                        <?= $totalTicket ?>
                    </h4>

                    <small class="text-muted">
                        Total Ticket
                    </small>
                </div>


            </div>

            <!-- Detail -->
            <div class="col-lg-7">
                <h6 class="fw-bold mb-3">
                    Detail Kategori
                </h6>
                <div id="kategoriDetailContainer">



                    <?php $i = 0; ?>
                    <?php foreach ($kategori as $row): ?>

                        <?php
                        $persen = $totalTicket > 0
                            ? round(($row['total'] / $totalTicket) * 100, 1)
                            : 0;
                        ?>

                        <div class="mb-4" id="cat-row-<?= $row['category_id'] ?>" data-category-id="<?= $row['category_id'] ?>">
                            <div class="d-flex justify-content-between">

                                <div>
                                    <span class="fw-semibold">
                                        <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:<?= $colors[$i] ?>; margin-right:8px;"></span>
                                        <?= $row['category'] ?>
                                    </span>
                                </div>

                                <div>
                                    <strong id="cat-total-<?= $i ?>"><?= $row['total'] ?></strong>
                                    <small id="cat-persen-<?= $i ?>" class="text-muted">(<?= $persen ?>%)</small>
                                </div>

                            </div>

                            <div class="progress mt-2" style="height:8px">
                                <div id="cat-progress-<?= $i ?>" class="progress-bar" style="width:<?= $persen ?>%; background:<?= $colors[$i] ?>;"></div>
                            </div>

                        </div>

                        <?php $i++; ?>

                    <?php endforeach ?>

                </div>
            </div>

        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    const label = <?= json_encode($label); ?>;
    const total = <?= json_encode($TotalData); ?>;
    const buka = <?= json_encode($TotalBuka); ?>;
    const tutup = <?= json_encode($TotalTutup); ?>;
    const totaltiket = <?= json_encode($totalTicket); ?>;
    const jumlah = <?= json_encode($jumlah); ?>;

    function setChartMinWidth() {
        const inner = document.getElementById('chartInner');
        const perBarWidth = 70;
        const minWidth = label.length * perBarWidth;
        const wrapperWidth = inner.parentElement.clientWidth;

        inner.style.width = Math.max(minWidth, wrapperWidth) + 'px';
    }

    setChartMinWidth();
    window.addEventListener('resize', setChartMinWidth);

    const ticketChartInstance = new Chart(document.getElementById("ticketChart"), {
        type: "bar",

        data: {

            labels: label,

            datasets: [

                {
                    label: "Jumlah Tiket",
                    data: total,
                    backgroundColor: "#4F46E5",

                    borderSkipped: false,
                    maxBarThickness: 45
                },

                {
                    label: "Belum Selesai",
                    data: buka,
                    backgroundColor: "#F59E0B",

                    borderSkipped: false,
                    maxBarThickness: 45
                },

                {
                    label: "Sudah Selesai",
                    data: tutup,
                    backgroundColor: "#10B981",

                    borderSkipped: false,
                    maxBarThickness: 45
                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            animation: {

                duration: 1800,
                easing: "easeOutQuart"

            },

            interaction: {

                mode: "index",
                intersect: false

            },

            plugins: {

                legend: {

                    position: "top",

                    labels: {

                        usePointStyle: true,
                        pointStyle: "rect",
                        padding: 25,
                        font: {

                            size: 13,
                            weight: "600"

                        }

                    }

                },

                tooltip: {

                    backgroundColor: "#1f2937",

                    padding: 14,

                    cornerRadius: 10,

                    displayColors: true

                }

            },

            scales: {

                x: {

                    grid: {

                        display: false

                    },

                    ticks: {

                        color: "#6b7280",

                        font: {

                            weight: "600"

                        }

                    }

                },

                y: {

                    beginAtZero: true,

                    ticks: {

                        precision: 0,

                        color: "#6b7280"

                    },

                    grid: {

                        color: "#eef2f7"

                    },

                    title: {

                        display: true,

                        text: "Jumlah Tiket " + jumlah,

                        font: {

                            weight: "bold"

                        }

                    }

                }

            }

        }

    });
</script>

<script>
    const categoryLabel = <?= json_encode($labelKategori); ?>;
    const categoryTotal = <?= json_encode($totalKategori); ?>;
    const categoryColors = <?= json_encode($colors); ?>;
    const categoryIds = <?= json_encode(array_column($kategori, 'category_id')); ?>;

    const categoryChartInstance = new Chart(document.getElementById("categoryChart"), {

        type: "pie",

        data: {

            labels: categoryLabel,

            datasets: [{

                data: categoryTotal,

                backgroundColor: categoryColors,

                borderColor: "#fff",

                borderWidth: 3,

                hoverOffset: 10

            }]

        },

        options: {

            responsive: true,



            plugins: {

                legend: {
                    display: false
                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            const total = context.dataset.data.reduce((a, b) => a + b, 0);

                            const value = context.raw;

                            const persen = ((value / total) * 100).toFixed(1);

                            return `${context.label}: ${value} Ticket (${persen}%)`;

                        }

                    }

                }

            }

        }

    });
</script>
<script>
    (function() {
        const formFilter = document.getElementById('formFilterDashboard');
        const selectBulan = document.getElementById('selectBulanDashboard');
        const selectTahun = document.getElementById('selectTahunDashboard');

        if (!formFilter || !selectBulan || !selectTahun) return;

        let currentController = null;

        selectBulan.addEventListener('change', () => doFilterDashboard());
        selectTahun.addEventListener('change', () => doFilterDashboard());

        formFilter.addEventListener('submit', (e) => {
            e.preventDefault();
            doFilterDashboard();
        });

        async function doFilterDashboard() {
            // Update filter WebSocket supaya realtime tetap sinkron dengan filter yang aktif
            window.__dashboardFilterBulan = selectBulan.value ? parseInt(selectBulan.value) : null;
            window.__dashboardFilterTahun = selectTahun.value ? parseInt(selectTahun.value) : null;
            if (currentController) currentController.abort();
            currentController = new AbortController();

            const params = new URLSearchParams({
                bulan: selectBulan.value,
                tahun: selectTahun.value,
            });

            try {
                const res = await fetch(`/dashboard/search?${params.toString()}`, {
                    signal: currentController.signal
                });

                if (!res.ok) {
                    console.error('[Dashboard Filter] Response gagal:', res.status);
                    return;
                }

                const result = await res.json();
                applyDashboardResult(result);

            } catch (err) {
                if (err.name !== 'AbortError') {
                    console.error('[Dashboard Filter] Gagal:', err);
                }
            }
        }

        function applyDashboardResult(result) {
            // Update badge atas
            setBadge('badge-total', result.jumlah);
            setBadge('badge-buka', result.buka);
            setBadge('badge-proses', result.proses);
            setBadge('badge-tutup', result.tutup);
            setBadge('total-di-pie', result.totalTicket);

            // Update subtitle
            const subtitleEl = document.getElementById('subtitle-dashboard');
            if (subtitleEl) subtitleEl.textContent = result.subtitle;

            // Update bar chart
            label.length = 0;
            label.push(...result.label);
            total.length = 0;
            total.push(...result.total);
            buka.length = 0;
            buka.push(...result.buka_bulanan);
            tutup.length = 0;
            tutup.push(...result.tutup_bulanan);

            ticketChartInstance.data.labels = label;
            ticketChartInstance.data.datasets[0].data = total;
            ticketChartInstance.data.datasets[1].data = buka;
            ticketChartInstance.data.datasets[2].data = tutup;
            ticketChartInstance.options.scales.y.title.text = 'Jumlah Tiket ' + result.jumlah;
            ticketChartInstance.update();

            // Update pie chart
            categoryLabel.length = 0;
            categoryLabel.push(...result.labelKategori);
            categoryTotal.length = 0;
            categoryTotal.push(...result.totalKategori);
            categoryColors.length = 0;
            categoryColors.push(...result.colors);
            categoryIds.length = 0;
            categoryIds.push(...result.categoryIds);

            categoryChartInstance.data.labels = categoryLabel;
            categoryChartInstance.data.datasets[0].data = categoryTotal;
            categoryChartInstance.data.datasets[0].backgroundColor = categoryColors;
            categoryChartInstance.update();



            setChartMinWidth(); // <-- tambahkan ini
            ticketChartInstance.resize();
            // Bangun ulang seluruh "Detail Kategori"
            rebuildKategoriDetail(result.kategoriDetail);
        }

        function rebuildKategoriDetail(items) {
            const container = document.getElementById('kategoriDetailContainer');
            if (!container) return;

            if (!items || items.length === 0) {
                container.innerHTML = '<p class="text-muted">Tidak ada data kategori.</p>';
                return;
            }

            container.innerHTML = items.map((item, idx) => `
            <div class="mb-4" id="cat-row-${item.category_id}" data-category-id="${item.category_id}">
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="fw-semibold">
                            <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:${item.color}; margin-right:8px;"></span>
                            ${escapeHtmlDashFilter(item.category)}
                        </span>
                    </div>
                    <div>
                        <strong id="cat-total-${idx}">${item.total}</strong>
                        <small id="cat-persen-${idx}" class="text-muted">(${item.persen}%)</small>
                    </div>
                </div>
                <div class="progress mt-2" style="height:8px">
                    <div id="cat-progress-${idx}" class="progress-bar" style="width:${item.persen}%; background:${item.color};"></div>
                </div>
            </div>
        `).join('');
        }

        function setBadge(id, value) {
            const el = document.getElementById(id);
            if (el) el.textContent = value;
        }

        function escapeHtmlDashFilter(str) {
            const div = document.createElement('div');
            div.textContent = str ?? '';
            return div.innerHTML;
        }
    })();
</script>
<script>
    // ==========================================
    // WebSocket - Real-time Dashboard
    // ==========================================
    const wsUrl = window.WS_URL;

    // Filter yang sedang aktif di halaman (dari PHP)
    let filterBulan = <?= !empty($bulan) ? (int) $bulan : 'null' ?>;
    let filterTahun = <?= !empty($tahun) ? (int) $tahun : 'null' ?>;

    // Sinkronkan dengan filter live search kalau berubah
    function matchFilter(bulan, tahun) {
        const fb = window.__dashboardFilterBulan !== undefined ? window.__dashboardFilterBulan : filterBulan;
        const ft = window.__dashboardFilterTahun !== undefined ? window.__dashboardFilterTahun : filterTahun;
        if (fb !== null && fb !== bulan) return false;
        if (ft !== null && ft !== tahun) return false;
        return true;
    }

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
                handleNewTicketDashboard(payload.data);
            }

            if (payload.type === 'status_update') {
                handleStatusUpdateDashboard(payload.data);
            }
            if (payload.type === 'delete_category') { // <-- TAMBAHKAN
                handleDeleteCategoryDashboard(payload.data);
            }
        };

        socket.onclose = () => {
            console.log('[WS] Dashboard terputus, reconnect...');
            setTimeout(connectWebSocket, 3000);
        };
    }

    // Cek apakah event ini relevan dengan filter yang sedang aktif di halaman
    function matchFilter(bulan, tahun) {
        if (filterBulan !== null && filterBulan !== bulan) return false;
        if (filterTahun !== null && filterTahun !== tahun) return false;
        return true;
    }

    function badgeVal(id) {
        const el = document.getElementById(id);
        return el ? parseInt(el.textContent) || 0 : 0;
    }

    function setBadge(id, value) {
        const el = document.getElementById(id);
        if (el) el.textContent = value;
    }

    // Status mana yang termasuk ke masing-masing badge
    function isDalamBuka(status) {
        return ['Buka', 'Ditugaskan', 'Dikerja'].includes(status);
    }

    function isDalamProses(status) {
        return status === 'Dikerja';
    }

    function isDalamTutup(status) {
        return ['Tutup', 'Selesai'].includes(status);
    }

    function recalculateCategoryPercentages() {
        const total = categoryTotal.reduce((a, b) => a + b, 0);

        categoryTotal.forEach((val, i) => {
            const persen = total > 0 ? ((val / total) * 100).toFixed(1) : 0;

            const totalEl = document.getElementById('cat-total-' + i);
            const persenEl = document.getElementById('cat-persen-' + i);
            const progressEl = document.getElementById('cat-progress-' + i);

            if (totalEl) totalEl.textContent = val;
            if (persenEl) persenEl.textContent = `(${persen}%)`;
            if (progressEl) progressEl.style.width = persen + '%';
        });
    }

    function handleNewTicketDashboard(t) {
        if (!matchFilter(t.bulan, t.tahun)) return;

        setBadge('badge-total', badgeVal('badge-total') + 1);
        setBadge('badge-buka', badgeVal('badge-buka') + 1);
        setBadge('total-di-pie', badgeVal('total-di-pie') + 1);

        const monthIndex = label.indexOf(monthShortName(t.bulan));
        if (monthIndex !== -1) {
            total[monthIndex] += 1;
            buka[monthIndex] += 1;
            ticketChartInstance.data.datasets[0].data = total;
            ticketChartInstance.data.datasets[1].data = buka;
            ticketChartInstance.update();
        }

        // Cari kategori berdasarkan ID (bukan nama teks, biar akurat)
        const catIndex = categoryIds.indexOf(t.category_id);

        if (catIndex !== -1) {
            // Kategori sudah ada di chart -> tinggal tambah angkanya
            categoryTotal[catIndex] += 1;
            categoryChartInstance.data.datasets[0].data = categoryTotal;
            categoryChartInstance.update();
            recalculateCategoryPercentages();
        } else {
            // Kategori BARU (sebelumnya 0 tiket, belum ada di chart) -> tambahkan slot baru
            addNewCategoryToChart(t.category_id, t.kategori);
        }
    }

    function addNewCategoryToChart(categoryId, categoryName) {
        const palette = [
            '#4F46E5', '#3B82F6', '#06B6D4', '#10B981', '#22C55E',
            '#84CC16', '#EAB308', '#F59E0B', '#F97316', '#EF4444',
            '#EC4899', '#8B5CF6', '#14B8A6', '#6366F1', '#0EA5E9',
        ];
        const warnaBaru = palette[categoryIds.length % palette.length];

        categoryIds.push(categoryId);
        categoryTotal.push(1);
        categoryColors.push(warnaBaru);
        categoryLabel.push(categoryName + ' (0%)');

        categoryChartInstance.data.labels = categoryLabel;
        categoryChartInstance.data.datasets[0].data = categoryTotal;
        categoryChartInstance.data.datasets[0].backgroundColor = categoryColors;
        categoryChartInstance.update();

        // Tambahkan baris baru di "Detail Kategori"
        const container = document.querySelector('.col-lg-7');
        if (container) {
            const idx = categoryIds.length - 1;
            const div = document.createElement('div');
            div.className = 'mb-4';
            div.id = 'cat-row-' + categoryId;
            div.setAttribute('data-category-id', categoryId);

            div.innerHTML = `
            <div class="d-flex justify-content-between">
                <div>
                    <span class="fw-semibold">
                        <span style="display:inline-block;width:12px;height:12px;border-radius:50%;background:${warnaBaru};margin-right:8px;"></span>
                        ${escapeHtmlDash(categoryName)}
                    </span>
                </div>
                <div>
                    <strong id="cat-total-${idx}">1</strong>
                    <small id="cat-persen-${idx}" class="text-muted">(0%)</small>
                </div>
            </div>
            <div class="progress mt-2" style="height:8px">
                <div id="cat-progress-${idx}" class="progress-bar" style="width:0%;background:${warnaBaru};"></div>
            </div>
        `;

            container.appendChild(div);
        }

        recalculateCategoryPercentages();
    }

    function escapeHtmlDash(str) {
        const div = document.createElement('div');
        div.textContent = str ?? '';
        return div.innerHTML;
    }

    function handleDeleteCategoryDashboard(data) {
        const deletedTickets = data.deleted_tickets || [];
        const deletedCategoryId = data.id;

        let totalDikurangi = 0;

        deletedTickets.forEach(t => {
            if (!matchFilter(t.bulan, t.tahun)) return;

            totalDikurangi++;

            if (isDalamBuka(t.status)) {
                setBadge('badge-buka', Math.max(0, badgeVal('badge-buka') - 1));
            }
            if (isDalamProses(t.status)) {
                setBadge('badge-proses', Math.max(0, badgeVal('badge-proses') - 1));
            }
            if (isDalamTutup(t.status)) {
                setBadge('badge-tutup', Math.max(0, badgeVal('badge-tutup') - 1));
            }

            const monthIndex = label.indexOf(monthShortName(t.bulan));
            if (monthIndex !== -1) {
                total[monthIndex] = Math.max(0, total[monthIndex] - 1);
                if (isDalamBuka(t.status)) buka[monthIndex] = Math.max(0, buka[monthIndex] - 1);
                if (isDalamTutup(t.status)) tutup[monthIndex] = Math.max(0, tutup[monthIndex] - 1);
            }
        });

        if (totalDikurangi > 0) {
            setBadge('badge-total', Math.max(0, badgeVal('badge-total') - totalDikurangi));
            setBadge('total-di-pie', Math.max(0, badgeVal('total-di-pie') - totalDikurangi));

            ticketChartInstance.data.datasets[0].data = total;
            ticketChartInstance.data.datasets[1].data = buka;
            ticketChartInstance.data.datasets[2].data = tutup;
            ticketChartInstance.update();
        }

        // ===============================
        // Hapus kategori dari pie chart + detail kategori
        // ===============================
        removeCategoryFromChart(deletedCategoryId);
    }

    function removeCategoryFromChart(categoryId) {
        const idx = categoryIds.indexOf(categoryId);
        if (idx === -1) return; // kategori tidak ditemukan di chart (mungkin memang 0 tiket dari awal)

        // Hapus dari semua array acuan pie chart
        categoryIds.splice(idx, 1);
        categoryTotal.splice(idx, 1);
        categoryColors.splice(idx, 1);
        categoryLabel.splice(idx, 1);

        // Update pie chart
        categoryChartInstance.data.labels = categoryLabel;
        categoryChartInstance.data.datasets[0].data = categoryTotal;
        categoryChartInstance.data.datasets[0].backgroundColor = categoryColors;
        categoryChartInstance.update();

        // Hapus baris "Detail Kategori" yang sesuai
        const row = document.getElementById('cat-row-' + categoryId);
        if (row) row.remove();

        // Karena index semua kategori setelahnya bergeser (idx berkurang 1),
        // kita perlu susun ulang ID elemen (cat-total-X, cat-persen-X, cat-progress-X)
        // supaya tetap sinkron dengan index array yang baru
        reindexCategoryRows();

        recalculateCategoryPercentages();
    }

    function reindexCategoryRows() {
        const container = document.querySelector('.col-lg-7');
        if (!container) return;

        const rows = container.querySelectorAll('[id^="cat-row-"]');

        rows.forEach((row, newIndex) => {
            const totalEl = row.querySelector('strong[id^="cat-total-"]');
            const persenEl = row.querySelector('small[id^="cat-persen-"]');
            const progressEl = row.querySelector('[id^="cat-progress-"]');

            if (totalEl) totalEl.id = 'cat-total-' + newIndex;
            if (persenEl) persenEl.id = 'cat-persen-' + newIndex;
            if (progressEl) progressEl.id = 'cat-progress-' + newIndex;
        });
    }

    function handleStatusUpdateDashboard(t) {
        if (!matchFilter(t.bulan, t.tahun)) return;

        const oldStatus = t.old_status;
        const newStatus = t.status;

        if (oldStatus === newStatus) return; // tidak ada perubahan kategori badge

        // Badge "Buka" (Buka/Ditugaskan/Dikerja)
        if (isDalamBuka(oldStatus) && !isDalamBuka(newStatus)) {
            setBadge('badge-buka', Math.max(0, badgeVal('badge-buka') - 1));
        } else if (!isDalamBuka(oldStatus) && isDalamBuka(newStatus)) {
            setBadge('badge-buka', badgeVal('badge-buka') + 1);
        }

        // Badge "Dikerja"
        if (isDalamProses(oldStatus) && !isDalamProses(newStatus)) {
            setBadge('badge-proses', Math.max(0, badgeVal('badge-proses') - 1));
        } else if (!isDalamProses(oldStatus) && isDalamProses(newStatus)) {
            setBadge('badge-proses', badgeVal('badge-proses') + 1);
        }

        // Badge "Tutup" (Tutup/Selesai)
        if (isDalamTutup(oldStatus) && !isDalamTutup(newStatus)) {
            setBadge('badge-tutup', Math.max(0, badgeVal('badge-tutup') - 1));
        } else if (!isDalamTutup(oldStatus) && isDalamTutup(newStatus)) {
            setBadge('badge-tutup', badgeVal('badge-tutup') + 1);
        }

        // Update bar chart "Belum Selesai" vs "Sudah Selesai"
        const monthIndex = label.indexOf(monthShortName(t.bulan));
        if (monthIndex !== -1) {
            if (isDalamBuka(oldStatus) && !isDalamBuka(newStatus)) buka[monthIndex] = Math.max(0, buka[monthIndex] - 1);
            if (!isDalamBuka(oldStatus) && isDalamBuka(newStatus)) buka[monthIndex] += 1;

            if (isDalamTutup(oldStatus) && !isDalamTutup(newStatus)) tutup[monthIndex] = Math.max(0, tutup[monthIndex] - 1);
            if (!isDalamTutup(oldStatus) && isDalamTutup(newStatus)) tutup[monthIndex] += 1;

            ticketChartInstance.data.datasets[1].data = buka;
            ticketChartInstance.data.datasets[2].data = tutup;
            ticketChartInstance.update();
        }
    }

    // Bantu cocokkan angka bulan (1-12) ke label singkat chart ("Jan", "Feb", dst)
    function monthShortName(bulanNumber) {
        const bulanArr = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        return bulanArr[bulanNumber];
    }

    connectWebSocket();
</script>
<?= $this->endSection() ?>