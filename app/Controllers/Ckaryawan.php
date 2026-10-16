<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\models\categoryModel;
use App\Models\ticketModel;

class Ckaryawan extends BaseController
{
    protected $category;
    protected $ticketModel;
    protected $usermodel;
    public function __construct()
    {
        $this->usermodel = new UsersModel();
        $this->category = new categoryModel();
        $this->ticketModel = new ticketModel();
    }

    public function ticket()
    {
        session();
        $keyword = $this->request->getVar('keyword');
        $jumlah = $this->ticketModel->where('user_id', session()->get('id_user'))->countAllResults();

        if ($keyword) {
            $ticket = $this->ticketModel->select('tickets.*, categories.category')
                ->join('categories', 'categories.id = category_id')
                ->where('user_id', session()->get('id_user'))
                ->groupStart()
                ->like('tickets.kode_tiket', $keyword)
                ->orLike('tickets.subjek', $keyword)
                ->groupEnd()
                ->orderBy('Created_at', 'DESC')
                ->paginate(10);
        } else {
            $ticket = $this->ticketModel->select('tickets.*, categories.category')
                ->join('categories', 'categories.id = category_id')
                ->where('user_id', session()->get('id_user'))
                ->orderBy('Created_at', 'DESC')
                ->paginate(10);
        }


        $data = [
            'data' => $this->category->findAll(),
            'validation' => \Config\Services::validation(),
            'old_subject' => '',
            'old_deskripsi' => '',
            'old_category_id' => '',
            'title' => 'Lihat tiket',

            'tickets' => $ticket,
            'jumlah' => $jumlah,
            'pager' => $this->ticketModel->pager,


        ];

        return view('user/ticket', $data);
    }
    public function ticketSearch()
    {
        \Config\Services::toolbar()->respond();

        $keyword = $this->request->getGet('keyword');
        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        $userId = session()->get('id_user');

        $builder = $this->ticketModel
            ->select('tickets.*, categories.category')
            ->join('categories', 'categories.id = category_id')
            ->where('user_id', $userId);

        if ($keyword) {
            $builder->groupStart()
                ->like('subjek', $keyword)
                ->orLike('kode_tiket', $keyword)
                ->orLike('category', $keyword)
                ->orLike('ditugaskan', $keyword)
                ->groupEnd();
        }

        $countBuilder = clone $builder;
        $totalRows = $countBuilder->countAllResults(false);

        $ticket = $builder
            ->orderBy('Created_at', 'DESC')
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        $data = [];
        $no = ($page - 1) * $perPage + 1;
        foreach ($ticket as $t) {
            $data[] = [
                'no'          => $no++,
                'id'          => $t['id'],
                'subjek'      => $t['subjek'],
                'kode_tiket'  => $t['kode_tiket'],
                'gambar'      => $t['gambar'],
                'category'    => $t['category'],
                'created_at'  => $t['Created_at'],
                'ditugaskan'  => $t['ditugaskan'],
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

    public function detail($id)
    {

        $ticket = $this->ticketModel
            ->select('tickets.*, categories.category, users.name')
            ->join('categories', 'categories.id = tickets.category_id')
            ->join('users', 'users.id = tickets.user_id')
            ->where('tickets.id', $id)
            ->first();


        $data = [
            'title' => 'Detail tiket',
            'ticket' => $ticket
        ];


        return view('user/detailUser', $data);
    }
    public function teknisi()
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
                ->where('ditugaskan', session()->get('id_user'))
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
                ->where('ditugaskan', session()->get('id_user'))
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
            'datateknisi'        => $userteknisi,
            'jumlah' => $jumlah,
            'data' => $ticket,
            'pager' => $this->ticketModel->pager,
            'nomor'  => ($page - 1) * $perPage + 1,
        ];


        return view('user/teknisi', $data);
    }
}
