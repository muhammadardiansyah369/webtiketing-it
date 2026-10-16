<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\models\ticketModel;
use App\models\categoryModel;
use App\Models\aktivitasModel;

class CTadmin extends BaseController
{
    protected $usermodel;
    protected $ticketModel;
    protected $category;
    protected $aktivitas;
    public function __construct()
    {
        $this->usermodel = new UsersModel();
        $this->ticketModel = new ticketModel();
        $this->category = new categoryModel();
        $this->aktivitas = new aktivitasModel();
    }
    public function index()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        $label = [];
        $TotalData = [];
        $TotalBuka = [];
        $TotalTutup = [];

        for ($i = 1; $i <= 12; $i++) {

            if (!empty($bulan) && $i != $bulan) {
                continue;
            }

            $label[] = date('M', mktime(0, 0, 0, $i, 1));

            // Total Ticket
            $builder = $this->ticketModel->builder();

            if (!empty($tahun)) {
                $builder->where('YEAR(created_at)', $tahun);
            }

            $TotalData[] = $builder
                ->where('MONTH(created_at)', $i)
                ->countAllResults();

            // Ticket Belum Selesai
            $builder = $this->ticketModel->builder();

            if (!empty($tahun)) {
                $builder->where('YEAR(created_at)', $tahun);
            }

            $TotalBuka[] = $builder
                ->where('MONTH(created_at)', $i)
                ->whereIn('status', [
                    'Buka',
                    'Ditugaskan',
                    'Dikerja'
                ])
                ->countAllResults();

            // Ticket Selesai
            $builder = $this->ticketModel->builder();

            if (!empty($tahun)) {
                $builder->where('YEAR(created_at)', $tahun);
            }

            $TotalTutup[] = $builder
                ->where('MONTH(created_at)', $i)
                ->whereIn('status', [
                    'Tutup',
                    'Selesai'
                ])
                ->countAllResults();
        }

        $builder = $this->ticketModel
            ->select('categories.id as category_id, categories.category, COUNT(tickets.id) as total')
            ->join('categories', 'categories.id = tickets.category_id');

        if (!empty($bulan)) {
            $builder->where('MONTH(tickets.created_at)', $bulan);
        }

        if (!empty($tahun)) {
            $builder->where('YEAR(tickets.created_at)', $tahun);
        }

        $kategori = $builder
            ->groupBy('categories.id')
            ->findAll();


        $totalTicket = array_sum(array_column($kategori, 'total'));


        $palette = [
            '#4F46E5',
            '#3B82F6',
            '#06B6D4',
            '#10B981',
            '#22C55E',
            '#84CC16',
            '#EAB308',
            '#F59E0B',
            '#F97316',
            '#EF4444',
            '#EC4899',
            '#8B5CF6',
            '#14B8A6',
            '#6366F1',
            '#0EA5E9',
        ];

        $colors = array_map(
            fn($index) => $palette[$index % count($palette)],
            array_keys($kategori)
        );

        $labelKategori = [];
        $totalKategori = [];

        foreach ($kategori as $row) {

            $persen = $totalTicket > 0
                ? round(($row['total'] / $totalTicket) * 100, 1)
                : 0;

            $labelKategori[] = $row['category'] . " ({$persen}%)";
            $totalKategori[] = (int) $row['total'];
        }

        $tahunMin = $this->ticketModel
            ->select('MIN(YEAR(created_at)) AS min_tahun')
            ->first();

        $tahunMax = $this->ticketModel
            ->select('MAX(YEAR(created_at)) AS max_tahun')
            ->first();

        $statistik = $this->ticketModel->builder();

        if (!empty($bulan)) {
            $statistik->where('MONTH(created_at)', $bulan);
        }

        if (!empty($tahun)) {
            $statistik->where('YEAR(created_at)', $tahun);
        }

        $db = \Config\Database::connect();

        $jumlah = (clone $statistik)->countAllResults();
        $buka = (clone $statistik)
            ->whereIn('status', [
                'Buka',
                'Ditugaskan',
                'Dikerja'
            ])
            ->countAllResults();

        $proses = (clone $statistik)
            ->where('status', 'Dikerja')
            ->countAllResults();

        $tutup = (clone $statistik)
            ->whereIn('status', [
                'Tutup',
                'Selesai'
            ])
            ->countAllResults();

        $data = [

            'title' => 'Dashboard Admin',

            'label' => $label,
            'TotalData' => $TotalData,
            'TotalBuka' => $TotalBuka,
            'TotalTutup' => $TotalTutup,

            'kategori' => $kategori,
            'labelKategori' => $labelKategori,
            'totalKategori' => $totalKategori,
            'totalTicket' => $totalTicket,
            'colors' => $colors,

            'jumlah' => $jumlah,
            'buka' => $buka,
            'proses' => $proses,
            'tutup' => $tutup,

            'bulan' => $bulan,
            'tahun' => $tahun,

            'tahunMin' => (int) $tahunMin['min_tahun'],
            'tahunMax' => (int) $tahunMax['max_tahun']
        ];

        return view('admin/dashboard', $data);
    }

    public function dashboardSearch()
    {
        \Config\Services::toolbar()->respond();

        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        $label = [];
        $TotalData = [];
        $TotalBuka = [];
        $TotalTutup = [];

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($bulan) && $i != $bulan) {
                continue;
            }

            $label[] = date('M', mktime(0, 0, 0, $i, 1));

            $builder = $this->ticketModel->builder();
            if (!empty($tahun)) {
                $builder->where('YEAR(created_at)', $tahun);
            }
            $TotalData[] = $builder->where('MONTH(created_at)', $i)->countAllResults();

            $builder = $this->ticketModel->builder();
            if (!empty($tahun)) {
                $builder->where('YEAR(created_at)', $tahun);
            }
            $TotalBuka[] = $builder
                ->where('MONTH(created_at)', $i)
                ->whereIn('status', ['Buka', 'Ditugaskan', 'Dikerja'])
                ->countAllResults();

            $builder = $this->ticketModel->builder();
            if (!empty($tahun)) {
                $builder->where('YEAR(created_at)', $tahun);
            }
            $TotalTutup[] = $builder
                ->where('MONTH(created_at)', $i)
                ->whereIn('status', ['Tutup', 'Selesai'])
                ->countAllResults();
        }

        $builder = $this->ticketModel
            ->select('categories.id as category_id, categories.category, COUNT(tickets.id) as total')
            ->join('categories', 'categories.id = tickets.category_id');

        if (!empty($bulan)) {
            $builder->where('MONTH(tickets.created_at)', $bulan);
        }
        if (!empty($tahun)) {
            $builder->where('YEAR(tickets.created_at)', $tahun);
        }

        $kategori = $builder->groupBy('categories.id')->findAll();

        $totalTicket = array_sum(array_column($kategori, 'total'));

        // ===============================
        // Hitung $colors DI SINI (sebelumnya cuma ada di view, sekarang perlu di controller juga)
        // ===============================
        $palette = [
            '#4F46E5',
            '#3B82F6',
            '#06B6D4',
            '#10B981',
            '#22C55E',
            '#84CC16',
            '#EAB308',
            '#F59E0B',
            '#F97316',
            '#EF4444',
            '#EC4899',
            '#8B5CF6',
            '#14B8A6',
            '#6366F1',
            '#0EA5E9',
        ];

        $colors = array_map(
            fn($index) => $palette[$index % count($palette)],
            array_keys($kategori)
        );

        $labelKategori = [];
        $totalKategori = [];
        $categoryIds = [];

        foreach ($kategori as $row) {
            $persen = $totalTicket > 0 ? round(($row['total'] / $totalTicket) * 100, 1) : 0;

            $labelKategori[] = $row['category'] . " ({$persen}%)";
            $totalKategori[] = (int) $row['total'];
            $categoryIds[] = $row['category_id'];
        }

        $statistik = $this->ticketModel->builder();
        if (!empty($bulan)) {
            $statistik->where('MONTH(created_at)', $bulan);
        }
        if (!empty($tahun)) {
            $statistik->where('YEAR(created_at)', $tahun);
        }

        $db = \Config\Database::connect();
        $jumlah = (clone $statistik)->countAllResults();

        $buka = (clone $statistik)
            ->whereIn('status', ['Buka', 'Ditugaskan', 'Dikerja'])
            ->countAllResults();

        $proses = (clone $statistik)
            ->where('status', 'Dikerja')
            ->countAllResults();

        $tutup = (clone $statistik)
            ->whereIn('status', ['Tutup', 'Selesai'])
            ->countAllResults();

        $namaBulanMap = [
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

        $subtitle = empty($bulan)
            ? "Tahun {$tahun}"
            : ($namaBulanMap[$bulan] ?? '') . " {$tahun}";

        $kategoriDetail = [];
        $idx = 0;
        foreach ($kategori as $row) {
            $persen = $totalTicket > 0 ? round(($row['total'] / $totalTicket) * 100, 1) : 0;
            $kategoriDetail[] = [
                'category_id' => $row['category_id'],
                'category'    => $row['category'],
                'total'       => (int) $row['total'],
                'persen'      => $persen,
                'color'       => $colors[$idx],
            ];
            $idx++;
        }

        return $this->response->setJSON([
            'label'          => $label,
            'total'          => $TotalData,
            'buka_bulanan'   => $TotalBuka,
            'tutup_bulanan'  => $TotalTutup,
            'jumlah'         => $jumlah,
            'buka'           => $buka,
            'proses'         => $proses,
            'tutup'          => $tutup,
            'totalTicket'    => $totalTicket,
            'labelKategori'  => $labelKategori,
            'totalKategori'  => $totalKategori,
            'categoryIds'    => $categoryIds,
            'colors'         => $colors,
            'kategoriDetail' => $kategoriDetail,
            'subtitle'       => $subtitle,
        ]);
    }

    public function detail($id)
    {

        $ticket = $this->ticketModel
            ->select('
        tickets.*,
        categories.category,
        user_pembuat.name AS nama_user,
        user_teknisi.name AS nama_teknisi
    ')
            ->join(
                'categories',
                'categories.id = tickets.category_id'
            )
            ->join(
                'users AS user_pembuat',
                'user_pembuat.id = tickets.user_id'
            )
            ->join(
                'users AS user_teknisi',
                'user_teknisi.id = tickets.ditugaskan',
                'left'
            )
            ->where('tickets.id', $id)
            ->first();


        $data = [
            'title' => 'detail tiket',
            'ticket' => $ticket
        ];


        return view('admin/detail', $data);
    }
    public function kategory()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $kategory = $this->category->orderBy('created_at', 'DESC')->like('category', $keyword)->paginate(10);
        } else {
            $kategory = $this->category->orderBy('created_at', 'DESC')->paginate(10);
        }

        $jumlah = $this->category->countAllResults();


        $perPage = 10;

        $page = $this->request->getVar('page') ?? 1;

        $data = [
            'title' => 'Kategory',
            'kategori' => $kategory,
            'pager' => $this->category->pager,
            'jumlah' => $jumlah,
            'nomor'  => ($page - 1) * $perPage + 1,
        ];
        return view('admin/kategory', $data);
    }
    public function kategorySearch()
    {
        \Config\Services::toolbar()->respond();

        $keyword = $this->request->getGet('keyword');
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;

        $builder = $keyword ? $this->category->orderBy('created_at', 'DESC')->like('category', $keyword) : $this->category->orderBy('created_at', 'DESC');

        $totalRows = $builder->countAllResults(false);

        $kategory = $builder
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        $data = [];
        $no = ($page - 1) * $perPage + 1;
        foreach ($kategory as $k) {
            $data[] = [
                'no'       => $no++,
                'id'       => $k['id'],
                'category' => $k['category'],
            ];
        }

        return $this->response->setJSON([
            'data'        => $data,
            'total'       => $totalRows,
            'perPage'     => $perPage,
            'currentPage' => $page,
            'totalPages'  => (int) ceil($totalRows / $perPage),
        ]);
    }
    public function aktivitas()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $keyword = $this->request->getVar('keyword');


        $builder = $this->aktivitas
            ->select('aktivitas.*, users.name, tickets.kode_tiket, tickets.subjek, tickets.ditugaskan, tickets.category_id, tickets.status, users.role')
            ->join('users', 'users.id = aktivitas.user_id')
            ->join('tickets', 'tickets.id = aktivitas.tiket_id')
            ->join('categories', 'categories.id = tickets.category_id')
            ->where('role', 'admin');

        if (!empty($bulan)) {
            $builder->where('MONTH(aktivitas.created_at)', $bulan);
        }
        if ($keyword) {
            $builder->groupStart()
                ->like('tickets.subjek', $keyword)
                ->orLike('tickets.ditugaskan', $keyword)
                ->orLike('tickets.kode_tiket', $keyword)
                ->orLike('aktivitas.aktivitas', $keyword)
                ->orLike('users.name', $keyword)
                ->groupEnd();
        }
        if (!empty($tahun)) {
            $builder->where('YEAR(aktivitas.created_at)', $tahun);
        }


        $log = $builder
            ->orderBy('aktivitas.created_at', 'DESC')
            ->paginate(10);



        $tahunMin = $this->ticketModel
            ->select('MIN(YEAR(created_at)) AS min_tahun')
            ->first();

        $tahunMax = $this->ticketModel
            ->select('MAX(YEAR(created_at)) AS max_tahun')
            ->first();

        $perPage = 10;

        $page = $this->request->getVar('page') ?? 1;

        $data = [
            'tahunMin' => (int) $tahunMin['min_tahun'],
            'tahunMax' => (int) $tahunMax['max_tahun'],
            'tahun'    => $tahun,
            'log' => $log,
            'title' => 'Aktivitas',
            'pager' => $this->aktivitas->pager,
            'nomor'  => ($page - 1) * $perPage + 1,
        ];

        return view('admin/aktivitas', $data);
    }
    public function aktivitasK()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $keyword = $this->request->getVar('keyword');


        $builder = $this->aktivitas
            ->select('aktivitas.*, users.name, tickets.kode_tiket, tickets.subjek, tickets.ditugaskan, tickets.category_id, tickets.status, users.role')
            ->join('users', 'users.id = aktivitas.user_id')
            ->join('tickets', 'tickets.id = aktivitas.tiket_id')
            ->join('categories', 'categories.id = tickets.category_id')
            ->where('role', 'karyawan');

        if (!empty($bulan)) {
            $builder->where('MONTH(aktivitas.created_at)', $bulan);
        }
        if ($keyword) {
            $builder->groupStart()
                ->like('tickets.subjek', $keyword)
                ->orLike('tickets.ditugaskan', $keyword)
                ->orLike('tickets.kode_tiket', $keyword)
                ->orLike('aktivitas.aktivitas', $keyword)
                ->orLike('users.name', $keyword)
                ->groupEnd();
        }
        if (!empty($tahun)) {
            $builder->where('YEAR(aktivitas.created_at)', $tahun);
        }


        $log = $builder
            ->orderBy('aktivitas.created_at', 'DESC')
            ->paginate(10);



        $tahunMin = $this->ticketModel
            ->select('MIN(YEAR(created_at)) AS min_tahun')
            ->first();

        $tahunMax = $this->ticketModel
            ->select('MAX(YEAR(created_at)) AS max_tahun')
            ->first();

        $perPage = 10;

        $page = $this->request->getVar('page') ?? 1;

        $data = [
            'tahunMin' => (int) $tahunMin['min_tahun'],
            'tahunMax' => (int) $tahunMax['max_tahun'],
            'tahun'    => $tahun,
            'log' => $log,
            'title' => 'Aktivitas',
            'pager' => $this->aktivitas->pager,
            'nomor'  => ($page - 1) * $perPage + 1,
        ];

        return view('admin/aktivitasK', $data);
    }

    public function aktivitasSearch()
    {
        \Config\Services::toolbar()->respond();

        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $keyword = $this->request->getGet('keyword');
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;

        $builder = $this->aktivitas
            ->select('aktivitas.*, users.name, tickets.kode_tiket, tickets.subjek, tickets.ditugaskan, tickets.category_id, tickets.status')
            ->join('users', 'users.id = aktivitas.user_id')
            ->join('tickets', 'tickets.id = aktivitas.tiket_id')
            ->join('categories', 'categories.id = tickets.category_id')
            ->where('role', 'admin');

        if (!empty($bulan)) {
            $builder->where('MONTH(aktivitas.created_at)', $bulan);
        }

        if ($keyword) {
            $builder->groupStart()
                ->like('tickets.subjek', $keyword)
                ->orLike('tickets.ditugaskan', $keyword)
                ->orLike('tickets.kode_tiket', $keyword)
                ->orLike('aktivitas.aktivitas', $keyword)
                ->orLike('users.name', $keyword)
                ->groupEnd();
        }

        if (!empty($tahun)) {
            $builder->where('YEAR(aktivitas.created_at)', $tahun);
        }

        // Hitung total SEBELUM limit/offset diterapkan
        $totalRows = $builder->countAllResults(false);

        $log = $builder
            ->orderBy('aktivitas.created_at', 'DESC')
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        $data = [];
        $no = ($page - 1) * $perPage + 1;
        foreach ($log as $row) {
            $data[] = [
                'no'         => $no++,
                'id'         => $row['id'],
                'name'       => $row['name'],
                'user_id'    => $row['user_id'],
                'kode_tiket' => $row['kode_tiket'],
                'subjek'     => $row['subjek'],
                'aktivitas'  => $row['aktivitas'],
                'ditugaskan' => $row['ditugaskan'],
                'created_at' => $row['created_at'],
            ];
        }

        return $this->response->setJSON([
            'data'        => $data,
            'total'       => $totalRows,
            'perPage'     => $perPage,
            'currentPage' => $page,
            'totalPages'  => (int) ceil($totalRows / $perPage),
        ]);
    }
    public function aktivitasSearchk()
    {
        \Config\Services::toolbar()->respond();

        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $keyword = $this->request->getGet('keyword');
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;

        $builder = $this->aktivitas
            ->select('aktivitas.*, users.name, tickets.kode_tiket, tickets.subjek, tickets.ditugaskan, tickets.category_id, tickets.status')
            ->join('users', 'users.id = aktivitas.user_id')
            ->join('tickets', 'tickets.id = aktivitas.tiket_id')
            ->join('categories', 'categories.id = tickets.category_id')
            ->where('role', 'karyawan');

        if (!empty($bulan)) {
            $builder->where('MONTH(aktivitas.created_at)', $bulan);
        }

        if ($keyword) {
            $builder->groupStart()
                ->like('tickets.subjek', $keyword)
                ->orLike('tickets.ditugaskan', $keyword)
                ->orLike('tickets.kode_tiket', $keyword)
                ->orLike('aktivitas.aktivitas', $keyword)
                ->orLike('users.name', $keyword)
                ->groupEnd();
        }

        if (!empty($tahun)) {
            $builder->where('YEAR(aktivitas.created_at)', $tahun);
        }

        // Hitung total SEBELUM limit/offset diterapkan
        $totalRows = $builder->countAllResults(false);

        $log = $builder
            ->orderBy('aktivitas.created_at', 'DESC')
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        $data = [];
        $no = ($page - 1) * $perPage + 1;
        foreach ($log as $row) {
            $data[] = [
                'no'         => $no++,
                'id'         => $row['id'],
                'name'       => $row['name'],
                'user_id'    => $row['user_id'],
                'kode_tiket' => $row['kode_tiket'],
                'subjek'     => $row['subjek'],
                'aktivitas'  => $row['aktivitas'],
                'ditugaskan' => $row['ditugaskan'],
                'created_at' => $row['created_at'],
            ];
        }

        return $this->response->setJSON([
            'data'        => $data,
            'total'       => $totalRows,
            'perPage'     => $perPage,
            'currentPage' => $page,
            'totalPages'  => (int) ceil($totalRows / $perPage),
        ]);
    }

    public function ticket()
    {
        $keyword = $this->request->getVar('keyword');
        $jumlah = $this->ticketModel->countAllResults();
        $userteknisi = $this->usermodel->where('role', 'teknisi')->findAll();
        if ($keyword) {

            $ticket = $this->ticketModel
                ->select('tickets.*, categories.category, users.name, users.role, users.id AS id_user')
                ->join('categories', 'categories.id = tickets.category_id')
                ->join('users', 'users.id = tickets.user_id')
                ->orderBy('created_at', 'DESC')
                ->groupStart()
                ->like('kode_tiket', $keyword)
                ->orLike('subjek', $keyword)
                ->orLike('category', $keyword)
                ->orLike('status', $keyword)
                ->orLike('name', $keyword)
                ->groupEnd()
                ->paginate(10);
        } else {

            $ticket = $this->ticketModel
                ->select('tickets.*, categories.category, users.name, users.role, users.id AS id_user')
                ->join('categories', 'categories.id = tickets.category_id')
                ->join('users', 'users.id = tickets.user_id')
                ->orderBy('created_at', 'DESC')
                ->groupStart()
                ->where('status !=', 'Tutup')
                ->groupEnd()
                ->orGroupStart()
                ->where('status', 'Tutup')
                ->where('Closed_at >=', date('Y-m-d H:i:s', strtotime('-1 week')))
                ->groupEnd()
                ->paginate(10);
        }


        $perPage = 10;

        $page = $this->request->getVar('page') ?? 1;
        $data = [
            'title' => 'Tiket admin',
            'datateknisi' => $userteknisi,
            'jumlah' => $jumlah,
            'data' => $ticket,
            'pager' => $this->ticketModel->pager,
            'nomor'  => ($page - 1) * $perPage + 1,
        ];

        return view('admin/users', $data);
    }
    public function ticketSearch()
    {
        \Config\Services::toolbar()->respond();

        $keyword = $this->request->getGet('keyword');
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        $userteknisi = $this->usermodel->where('role', 'teknisi')->findAll();
        if ($keyword) {
            $builder = $this->ticketModel
                ->select('tickets.*, categories.category, users.name, users.role, users.id AS id_user ')
                ->join('categories', 'categories.id = tickets.category_id')
                ->join('users', 'users.id = tickets.user_id')
                ->orderBy('Created_at', 'DESC')
                ->groupStart()
                ->like('kode_tiket', $keyword)
                ->orLike('subjek', $keyword)
                ->orLike('category', $keyword)
                ->orLike('status', $keyword)
                ->orLike('name', $keyword)
                ->groupEnd();
        } else {
            $builder = $this->ticketModel
                ->select('tickets.*, categories.category, users.name, users.role, users.id AS id_user')
                ->join('categories', 'categories.id = tickets.category_id')
                ->join('users', 'users.id = tickets.user_id')
                ->orderBy('Created_at', 'DESC')
                ->groupStart()
                ->where('status !=', 'Tutup')
                ->groupEnd()
                ->orGroupStart()
                ->where('status', 'Tutup')
                ->where('Closed_at >=', date('Y-m-d H:i:s', strtotime('-1 week')))
                ->groupEnd();
        }

        $totalRows = $builder->countAllResults(false);

        $ticket = $builder
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        $data = [];
        $no = ($page - 1) * $perPage + 1;
        foreach ($ticket as $t) {
            $data[] = [
                'no'          => $no++,
                'id'          => $t['id'],
                'name_user'   => $t['name'],
                'subjek'      => $t['subjek'],
                'kode_tiket'  => $t['kode_tiket'],
                'gambar'      => $t['gambar'],
                'category'    => $t['category'],
                'created_at'  => $t['Created_at'],
                'status'      => $t['status'],
                'ditugaskan'  => $t['ditugaskan'],
            ];
        }

        return $this->response->setJSON([
            'data'        => $data,
            'datateknisi'        => $userteknisi,
            'total'       => $totalRows,
            'perPage'     => $perPage,
            'currentPage' => $page,
            'totalPages'  => (int) ceil($totalRows / $perPage),
        ]);
    }
    public function user()
    {
        session();
        $keyword = $this->request->getVar('keyword');
        $jumlah = $this->usermodel->where('role', 'admin')->countAllResults();
        if ($keyword) {
            $user = $this->usermodel->orderBy('created_at', 'DESC')->where('role', 'admin')->like('name', $keyword)->Orlike('email', $keyword)->paginate(10);
        } else {
            $user = $this->usermodel->orderBy('created_at', 'DESC')->where('role', 'admin')->paginate(10);
        }

        $perPage = 10;

        $page = $this->request->getVar('page') ?? 1;
        $data = [
            'title' => 'Data user',
            'validation' => \Config\Services::validation(),

            'old_name' => '',
            'old_email' => '',
            'old_role' => '',
            'old_department' => '',
            'data' => $user,
            'jumlah' => $jumlah,

            'pager' => $this->usermodel->pager,
            'nomor'  => ($page - 1) * $perPage + 1,
        ];
        return view('admin/user', $data);
    }
    public function userK()
    {
        session();
        $keyword = $this->request->getVar('keyword');
        $jumlah = $this->usermodel->where('role', 'karyawan')->countAllResults();
        if ($keyword) {
            $user = $this->usermodel->orderBy('created_at', 'DESC')->where('role', 'karyawan')->like('name', $keyword)->Orlike('email', $keyword)->paginate(10);
        } else {
            $user = $this->usermodel->orderBy('created_at', 'DESC')->where('role', 'karyawan')->paginate(10);
        }

        $perPage = 10;

        $page = $this->request->getVar('page') ?? 1;
        $data = [
            'title' => 'Data user',
            'validation' => \Config\Services::validation(),

            'old_name' => '',
            'old_email' => '',
            'old_role' => '',
            'old_department' => '',
            'data' => $user,
            'jumlah' => $jumlah,

            'pager' => $this->usermodel->pager,
            'nomor'  => ($page - 1) * $perPage + 1,
        ];
        return view('admin/userK', $data);
    }
    public function userSearch()
    {
        \Config\Services::toolbar()->respond();

        $keyword = $this->request->getGet('keyword');
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;

        $builder = $this->usermodel
            ->orderBy('created_at', 'DESC')
            ->where('role', 'admin');

        if ($keyword) {
            $builder->groupStart()
                ->like('name', $keyword)
                ->orLike('email', $keyword)
                ->groupEnd();
        }

        $totalRows = $builder->countAllResults(false);

        $user = $builder
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        $data = [];
        $no = ($page - 1) * $perPage + 1;
        foreach ($user as $u) {
            $data[] = [
                'no'    => $no++,
                'id'    => $u['id'],
                'name'  => $u['name'],
                'email' => $u['email'],
                'role'  => $u['role'],
                'department' => $u['department'],
            ];
        }

        return $this->response->setJSON([
            'data'        => $data,
            'total'       => $totalRows,
            'perPage'     => $perPage,
            'currentPage' => $page,
            'totalPages'  => (int) ceil($totalRows / $perPage),
        ]);
    }
    public function userSearchk()
    {
        \Config\Services::toolbar()->respond();

        $keyword = $this->request->getGet('keyword');
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;

        $builder = $this->usermodel
            ->orderBy('created_at', 'DESC')

            ->where('role', 'karyawan');

        if ($keyword) {
            $builder->groupStart()
                ->like('name', $keyword)
                ->orLike('email', $keyword)
                ->groupEnd();
        }

        $totalRows = $builder->countAllResults(false);

        $user = $builder
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        $data = [];
        $no = ($page - 1) * $perPage + 1;
        foreach ($user as $u) {
            $data[] = [
                'no'    => $no++,
                'id'    => $u['id'],
                'name'  => $u['name'],
                'email' => $u['email'],
                'role'  => $u['role'],
                'department' => $u['department'],
            ];
        }

        return $this->response->setJSON([
            'data'        => $data,
            'total'       => $totalRows,
            'perPage'     => $perPage,
            'currentPage' => $page,
            'totalPages'  => (int) ceil($totalRows / $perPage),
        ]);
    }
}
