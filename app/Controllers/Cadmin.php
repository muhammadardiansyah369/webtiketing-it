<?php

namespace App\Controllers;

use App\Models\usersModel;
use App\models\ticketModel;
use App\models\categoryModel;
use App\Models\aktivitasModel;
use App\Models\attachmentsModel;
use App\Traits\BroadcastTrait;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Cadmin extends BaseController
{
    use BroadcastTrait;
    protected $usermodel;
    protected $ticketModel;
    protected $category;
    protected $aktivitas;
    protected $attachments;
    public function __construct()
    {
        $this->attachments = new attachmentsModel();
        $this->usermodel = new usersModel();
        $this->ticketModel = new ticketModel();
        $this->category = new categoryModel();
        $this->aktivitas = new aktivitasModel();
    }
    private function aturanValidasiKategoriTambah(): array
    {
        return [
            'categories' => [
                'rules' => 'required|is_unique[categories.category]',
                'errors' => [
                    'required'  => 'Nama kategori harus diisi',
                    'is_unique' => 'Kategori ini sudah ada',
                ]
            ],
        ];
    }

    private function aturanValidasiKategoriUpdate(int $id): array
    {
        return [
            'categories' => [
                'rules' => "required|is_unique[categories.category,id,{$id}]",
                'errors' => [
                    'required'  => 'Nama kategori harus diisi',
                    'is_unique' => 'Kategori ini sudah ada',
                ]
            ],
        ];
    }
    public function cekKategori()
    {
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        \Config\Services::toolbar()->respond();

        if (!$this->validate($this->aturanValidasiKategoriTambah())) {
            return $this->response->setJSON([
                'valid'     => false,
                'errors'    => $this->validator->getErrors(),
                'csrf_name' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'valid'     => true,
            'csrf_name' => csrf_token(),
            'csrf_hash' => csrf_hash(),
        ]);
    }
    public function cekKategoriUpdate($id)
    {
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        \Config\Services::toolbar()->respond();

        if (!$this->validate($this->aturanValidasiKategoriUpdate((int) $id))) {
            return $this->response->setJSON([
                'valid'     => false,
                'errors'    => $this->validator->getErrors(),
                'csrf_name' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'valid'     => true,
            'csrf_name' => csrf_token(),
            'csrf_hash' => csrf_hash(),
        ]);
    }
    public function Ktambah()
    {
        if (!$this->validate($this->aturanValidasiKategoriTambah())) {
            return redirect()->to('/kategory')->with('error', 'Gagal menambah kategori, nama kategori kosong atau sudah ada.');
        }

        $this->category->save(['category' => $this->request->getVar('categories'),]);
        $newId = $this->category->getInsertID();

        $this->broadcastWs('new_category', [
            'id'       => $newId,
            'category' => $this->request->getVar('categories'),
        ]);

        return redirect()->back()->with('pesan', 'kategory berhasil ditambahkan');
    }
    public function Khapus($id)
    {
        $tickets = $this->ticketModel->where('category_id', $id)->findAll();

        $ticketIds = [];
        $deletedTickets = [];

        foreach ($tickets as $t) {
            $ticketIds[] = $t['id'];

            $deletedTickets[] = [
                'status' => $t['status'],
                'bulan'  => (int) date('n', strtotime($t['Created_at'])),
                'tahun'  => (int) date('Y', strtotime($t['Created_at'])),
            ];

            // Hapus file gambar fisik, kecuali default.jpg
            if (!empty($t['gambar']) && $t['gambar'] !== 'default.jpg') {
                $path = FCPATH . 'img/' . $t['gambar'];
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        // Hapus attachment yang terkait tiket-tiket ini (FIX: sebelumnya terlewat)
        if (!empty($ticketIds)) {
            $this->attachments->whereIn('ticket_id', $ticketIds)->delete();
        }

        // Hapus aktivitas yang terkait tiket-tiket ini (FIX: sebelumnya terlewat)
        if (!empty($ticketIds)) {
            $this->aktivitas->whereIn('tiket_id', $ticketIds)->delete();
        }

        // Hapus tiket manual (tidak ada cascade FK di database)
        if (!empty($ticketIds)) {
            $this->ticketModel->whereIn('id', $ticketIds)->delete();
        }

        // Baru hapus kategorinya
        $this->category->delete($id);

        $this->broadcastWs('delete_category', [
            'id'              => $id,
            'ticket_ids'      => $ticketIds,
            'deleted_tickets' => $deletedTickets,
        ]);

        return redirect()->to('/kategory')->with('pesan', 'Kategori berhasil hapus');
    }

    public function Kupdate($id)
    {
        $kategoriLama = $this->category->find($id);
        $kategoriBaru = $this->request->getPost('categories');

        // Jika tidak ada perubahan, skip (tidak perlu validasi/update/broadcast)
        if ($kategoriLama['category'] == $kategoriBaru) {
            return redirect()->to('/kategory');
        }

        if (!$this->validate($this->aturanValidasiKategoriUpdate((int) $id))) {
            return redirect()->to('/kategory')->with('error', 'Gagal mengubah kategori, nama kategori sudah dipakai kategori lain.');
        }

        $this->category->update($id, [
            'category' => $kategoriBaru
        ]);

        $this->broadcastWs('update_category', [
            'id'       => $id,
            'category' => $kategoriBaru,
        ]);
        session()->setFlashdata('ubah', 'Kategori berhasil diubah.');

        return redirect()->back();
    }

    private function aturanValidasiTicket(): array
    {
        return [
            'subject' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'permasalahan',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'isi deskripsi dengan jelas',
                ]
            ],
            'category_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'pilih kategori',
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/webp]|ext_in[gambar,jpg,jpeg,png,webp]|max_size[gambar,5120]',
                'errors' => [
                    'uploaded' => 'laporan harus beserta gambar',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in'  => 'Format gambar harus JPG, PNG, atau WEBP.',
                    'ext_in'   => 'Ekstensi file harus .jpg, .jpeg, .png, atau .webp.',
                    'max_size' => 'Ukuran gambar maksimal 5 MB.',
                ]
            ]
        ];
    }

    private function sudahMencapaiBatasHarian(int $userId): bool
    {
        $jumlahHariIni = $this->ticketModel
            ->where('user_id', $userId)
            ->where('created_at >=', date('Y-m-d 00:00:00'))
            ->where('created_at <=', date('Y-m-d 23:59:59'))
            ->countAllResults();

        return $jumlahHariIni >= 5;
    }


    private function pesanErrorUpload(): ?string
    {
        // post_max_size terlampaui: PHP mengosongkan $_POST dan $_FILES
        $contentLength = (int) ($_SERVER['CONTENT_LENGTH'] ?? 0);
        if ($contentLength > 0 && empty($_POST) && empty($_FILES)) {
            return 'Ukuran total data terlalu besar. Kecilkan ukuran gambar.';
        }

        $file = $this->request->getFile('gambar');
        if ($file !== null) {
            switch ($file->getError()) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    return 'Ukuran gambar terlalu besar (maksimal 5 MB).';
                case UPLOAD_ERR_PARTIAL:
                    return 'Gambar tidak terunggah sempurna, coba lagi.';
                case UPLOAD_ERR_NO_TMP_DIR:
                case UPLOAD_ERR_CANT_WRITE:
                    return 'Server gagal menyimpan gambar sementara. Hubungi admin.';
            }
        }

        return null;
    }

    public function cekTicket()
    {
        // Bersihkan output buffer, jaga-jaga ada teks nyempil sebelum JSON
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        \Config\Services::toolbar()->respond();

        $userId = session()->get('id_user');

        $valid  = $this->validate($this->aturanValidasiTicket());
        $errors = $valid ? [] : $this->validator->getErrors();

        // Kalau PHP sendiri yang menolak file, timpa pesan gambar dengan yang akurat
        $pesanUpload = $this->pesanErrorUpload();
        if ($pesanUpload !== null) {
            $errors['gambar'] = $pesanUpload;
            $valid = false;
        }

        if (!$valid) {
            return $this->response->setJSON([
                'valid'     => false,
                'errors'    => $errors,
                'csrf_name' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'valid'     => true,
            'csrf_name' => csrf_token(),
            'csrf_hash' => csrf_hash(),
        ]);
    }

    public function Cticket()
    {
        $ticket = $this->ticketModel

            ->select('tickets.*, categories.category')
            ->join('categories', 'categories.id = category_id')
            ->where('user_id', session()->get('id_user'))
            ->orderBy('Created_at', 'DESC')
            ->paginate(10);

        $jumlah = $this->ticketModel->where('user_id', session()->get('id_user'))->countAllResults();
        $email = \Config\Services::email();
        $userId = session()->get('id_user');
        session();
        if ($this->sudahMencapaiBatasHarian($userId)) {
            return redirect()->back()->with('error', 'batas pembuatan tiket sudah mencapai batas');
        }


        if (!$this->validate($this->aturanValidasiTicket())) {
            $data =  [

                'validation' => $this->validator,
                'title' => 'membuat tiket',
                'tickets' => $ticket,
                'jumlah' => $jumlah,
                'pager' => $this->ticketModel->pager,
                'data' => $this->category->findAll(),
                'old_subject' => $this->request->getpost('subject'),
                'old_deskripsi' => $this->request->getpost('deskripsi'),
                'old_category_id' => $this->request->getpost('category_id'),

            ];
            return view('user/ticket', $data);
        }

        $fileGambar = $this->request->getFile('gambar');
        if ($fileGambar->getError() == 4) {
            $namaGambar = 'default.jpg';
        } else {

            $namaGambar = $fileGambar->getRandomName();
            $fileGambar->move('img/', $namaGambar);
        };




        $data = [

            'user_id'   => session()->get('id_user'),
            'category_id' =>  $this->request->getPost('category_id'),
            'subjek' => $this->request->getPost('subject'),
            'deskripsi' => $this->request->getPost('deskripsi'),


            'gambar' => $namaGambar,



        ];
        $db = \Config\Database::connect();

        $db->transStart();

        $this->ticketModel->insert($data);
        $ticketId = $this->ticketModel->getInsertID();
        $ticketCode = 'TCK-' . str_pad($ticketId, 6, '0', STR_PAD_LEFT);

        $this->ticketModel->update($ticketId, ['kode_tiket' => $ticketCode]);
        $this->aktivitas->save([

            'tiket_id' => $ticketId,

            'user_id' => session()->get('id_user'),

            'aktivitas' => session()->get('name') . ' Membuat Tiket'

        ]);
        $aktivitasId = $this->aktivitas->getInsertID();
        $this->attachments->save([
            'ticket_id' => $ticketId,
            'file_name' => $namaGambar,
            'file_path' => 'img/' . $namaGambar
        ]);
        $db->transComplete();

        if (!$db->transStatus()) {

            return redirect()->back()->with('error', 'Gagal menyimpan data.');
        }
        $this->broadcastWs('new_ticket', [
            'id'          => $ticketId,
            'aktivitas_id'  => $aktivitasId,
            'aktivitas'     => 'Membuat Tiket',
            'kode_tiket'  => $ticketCode,

            'subjek'      => $data['subjek'],
            'deskripsi'   => $data['deskripsi'],
            'name_user'   => session()->get('name'),
            'user_id'     => session()->get('id_user'),
            'kategori'    => $this->category->find($data['category_id'])['category'] ?? '-',
            'category_id' => $data['category_id'],          // <-- TAMBAHKAN
            'gambar'      => $namaGambar,
            'status'      => 'Buka',
            'ditugaskan'  => null,
            'bulan'       => (int) date('n'),                 // <-- TAMBAHKAN (1-12)
            'tahun'       => (int) date('Y'),                  // <-- TAMBAHKAN
            'created_at'  => date('Y-m-d H:i:s'),
        ]);


        $email->setFrom('muh.ardiansyah3691@gmail.com', 'Helpdesk');
        $email->setTo('muh.ardiansyah3691@gmail.com');

        $email->setSubject('Ticket Baru - ' . $ticketCode);

        $email->setMessage("
<div style='font-family:Arial,sans-serif;background:#f4f4f4;padding:30px;'>

    <div style='max-width:650px;margin:auto;background:#ffffff;
                border-radius:10px;
                overflow:hidden;
                box-shadow:0 2px 10px rgba(0,0,0,.15);'>

        <div style='background:#0d6efd;color:#fff;padding:20px;text-align:center;'>
            <h2 style='margin:0;'> Ticket Baru</h2>
            <p style='margin:5px 0 0;'>Sistem Helpdesk</p>
        </div>

        <div style='padding:25px;'>

            <p>Halo Admin,</p>

            <p>Terdapat tiket baru yang dibuat oleh karyawan.</p>

            <table style='width:100%;border-collapse:collapse;'>

                <tr>
                    <td style='padding:8px;font-weight:bold;'>Kode Ticket</td>
                    <td style='padding:8px;'>: {$ticketCode}</td>
                </tr>

                <tr>
                    <td style='padding:8px;font-weight:bold;'>Nama Pelapor</td>
                    <td style='padding:8px;'>: " . session()->get('name') . "</td>
                </tr>

                <tr>
                    <td style='padding:8px;font-weight:bold;'>Email</td>
                    <td style='padding:8px;'>: " . session()->get('email') . "</td>
                </tr>

                <tr>
                    <td style='padding:8px;font-weight:bold;'>Kategori</td>
                    <td style='padding:8px;'>: " .
            ($this->category->find($data['category_id'])['category'] ?? '-') .
            "</td>
                </tr>

                <tr>
                    <td style='padding:8px;font-weight:bold;'>Subjek</td>
                    <td style='padding:8px;'>: {$data['subjek']}</td>
                </tr>

            </table>

            <br>

            <div style='background:#f8f9fa;
                        border-left:5px solid #0d6efd;
                        padding:15px;
                        border-radius:5px;'>

                <b>Deskripsi:</b><br><br>

                {$data['deskripsi']}

            </div>

            <br>

            <p>
                Silakan login ke sistem Helpdesk untuk memproses tiket ini.
            </p>

        </div>

        <div style='background:#f1f1f1;
                    text-align:center;
                    padding:15px;
                    font-size:13px;
                    color:#666;'>

            Email ini dikirim otomatis oleh Sistem Helpdesk.

        </div>

    </div>

</div>
");

        if (!$email->send()) {
            log_message('error', $email->printDebugger(['headers']));

            return redirect()->to('/karyawan')
                ->with('warning', 'Tiket berhasil dibuat, tetapi email notifikasi gagal dikirim.');
        }
        return redirect()->to('/lihat')->with('pesan', 'tiket berhasil dibuat');
    }
    public function ubahstatus()
    {
        $id = $this->request->getVar('id');
        $token = $this->ticketModel->find($id);
        $statusLama = $token['status'];

        $status = $this->request->getPost('status');

        switch ($status) {

            case 'Buka':
                $statusBaru = 'Buka';
                break;

            case 'Ditugaskan':
                $statusBaru = 'Ditugaskan';
                break;

            case 'Dikerja':
                $statusBaru = 'Dikerja';
                break;

            case 'Selesai':
                $statusBaru = 'Selesai';
                break;
            case 'Tutup':
                $statusBaru = 'Tutup';
                break;

            default:
                $statusBaru = $status;
                break;
        }


        $data = [
            'status' => $statusBaru,
            'ditugaskan' => $this->request->getPost('teknisi')
        ];

        if ($statusBaru == 'Tutup') {
            $data['Closed_at'] = date('Y-m-d H:i:s');
        }

        $this->ticketModel->update($id, $data);
        $aktivitasText =  'Tiket ' . $token['kode_tiket'] . ' telah ' . $statusBaru . ' dikerjakan';
        if ($statusBaru == 'Selesai') {

            $this->aktivitas->save([

                'tiket_id' => $id,

                'user_id' => session()->get('id_user'),

                'aktivitas' => $aktivitasText
            ]);
        }
        $aktivitasId = $this->aktivitas->getInsertID();
        $this->broadcastWs('status_update', [
            'id'           => $id,
            'aktivitas_id' => $aktivitasId,
            'aktivitas'    => $aktivitasText,
            'kode_tiket'   => $token['kode_tiket'],
            'subjek'       => $token['subjek'],
            'nama_user'    => session()->get('name'),
            'user_id'      => session()->get('id_user'),
            'status'       => $statusBaru,
            'old_status'   => $statusLama,
            'ditugaskan'   => $this->request->getPost('teknisi'),
            'bulan'        => (int) date('n', strtotime($token['Created_at'])),
            'tahun'        => (int) date('Y', strtotime($token['Created_at'])),
        ]);
        return redirect()->back()->with('pesan', 'status telah diperbarui');
    }



    private function aturanValidasiUserTambah(): array
    {
        return [
            'name' => [
                'rules' => 'required|is_unique[users.name]',
                'errors' => [
                    'required' => 'nama harus di isi',
                    'is_unique' => 'nama harus berbeda',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required'    => 'Email harus diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique'   => 'Email sudah digunakan.'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => ['required' => 'role wajib diisi']
            ],
            'department' => [
                'rules' => 'required',
                'errors' => ['required' => 'departemen harus di isi']
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} harus di isi',
                    'min_length' => '{field} minimal 8 karakter'
                ]
            ],
        ];
    }

    private function aturanValidasiUserUpdate(int $id): array
    {
        return [
            'name' => [
                'rules' => "required|is_unique[users.name,id,{$id}]",
                'errors' => [
                    'required' => 'nama harus di isi',
                    'is_unique' => 'nama harus berbeda',
                ]
            ],
            'email' => [
                'rules' => "required|valid_email|is_unique[users.email,id,{$id}]",
                'errors' => [
                    'required'    => 'Email harus diisi.',
                    'valid_email' => 'Format email tidak valid.',
                    'is_unique'   => 'Email sudah digunakan.'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => ['required' => 'role wajib diisi']
            ],
            'department' => [
                'rules' => 'required',
                'errors' => ['required' => 'departemen harus di isi']
            ],
        ];
    }

    public function cekUser()
    {
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        \Config\Services::toolbar()->respond();

        if (!$this->validate($this->aturanValidasiUserTambah())) {
            return $this->response->setJSON([
                'valid'     => false,
                'errors'    => $this->validator->getErrors(),
                'csrf_name' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'valid'     => true,
            'csrf_name' => csrf_token(),
            'csrf_hash' => csrf_hash(),
        ]);
    }
    public function cekUserUpdate($id)
    {
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        \Config\Services::toolbar()->respond();

        $rules = $this->aturanValidasiUserUpdate((int) $id);

        // Password OPSIONAL saat edit — cuma divalidasi kalau diisi
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $rules['password'] = [
                'rules' => 'min_length[8]',
                'errors' => ['min_length' => 'Password minimal 8 karakter']
            ];
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'valid'     => false,
                'errors'    => $this->validator->getErrors(),
                'csrf_name' => csrf_token(),
                'csrf_hash' => csrf_hash(),
            ]);
        }

        return $this->response->setJSON([
            'valid'     => true,
            'csrf_name' => csrf_token(),
            'csrf_hash' => csrf_hash(),
        ]);
    }
    public function updateUser($id)
    {
        $rules = $this->aturanValidasiUserUpdate((int) $id);

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $rules['password'] = [
                'rules' => 'min_length[8]',
                'errors' => ['min_length' => 'Password minimal 8 karakter']
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to('/users')->with('error', 'Gagal mengubah user, periksa kembali data yang diisi.');
        }

        $data = [
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'role'       => $this->request->getPost('role'),
            'department' => $this->request->getPost('department'),
        ];

        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->usermodel->update($id, $data);

        $this->broadcastWs('user_updated', [
            'id'         => $id,
            'name'       => $data['name'],
            'email'      => $data['email'],
            'role'       => $data['role'],
            'department' => $data['department'],
        ]);

        return redirect()->to('/usersK')->with('pesan', 'Data user berhasil diubah');
    }
    public function hapusUser($id)
    {
        $user = $this->usermodel->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User tidak ditemukan');
        }

        // ===============================
        // 1. Ambil semua tiket milik user ini SEBELUM dihapus
        // ===============================
        $tickets = $this->ticketModel->where('user_id', $id)->findAll();
        $ticketIds = array_column($tickets, 'id');

        // ===============================
        // 2. Hapus file gambar fisik tiket-tiket itu
        // ===============================
        foreach ($tickets as $t) {
            if (!empty($t['gambar']) && $t['gambar'] !== 'default.jpg') {
                $path = FCPATH . 'img/' . $t['gambar'];
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        // ===============================
        // 3. Hapus attachment yang terkait tiket-tiket ini
        // ===============================
        if (!empty($ticketIds)) {
            $this->attachments->whereIn('ticket_id', $ticketIds)->delete();
        }

        // ===============================
        // 4. Hapus SEMUA aktivitas terkait:
        //    - aktivitas yang terjadi DI tiket-tiket milik user ini (walau dilakukan admin lain)
        //    - aktivitas yang DILAKUKAN OLEH user ini sendiri
        // ===============================
        if (!empty($ticketIds)) {
            $this->aktivitas->whereIn('tiket_id', $ticketIds)->delete();
        }
        $this->aktivitas->where('user_id', $id)->delete();

        // ===============================
        // 5. Hapus semua tiket milik user ini
        // ===============================
        if (!empty($ticketIds)) {
            $this->ticketModel->whereIn('id', $ticketIds)->delete();
        }

        // ===============================
        // 6. Terakhir, hapus user-nya sendiri
        // ===============================
        $this->usermodel->delete($id);

        $this->broadcastWs('delete_user', [
            'id' => $id,
        ]);

        return redirect()->to('/usersK')->with('pesan', 'User beserta seluruh data terkait (tiket & aktivitas) berhasil dihapus');
    }
    public function proses_Cuser()
    {
        $perPage = 10;
        $page = $this->request->getVar('page') ?? 1;
        $keyword = $this->request->getVar('keyword');
        $jumlah = $this->usermodel->where('name !=', session()->get('name'))->countAllResults();
        if ($keyword) {
            $user = $this->usermodel->orderBy('created_at', 'DESC')->where('name !=', session()->get('name'))->like('name', $keyword)->Orlike('email', $keyword)->paginate(10);
        } else {
            $user = $this->usermodel->orderBy('created_at', 'DESC')->where('name !=', session()->get('name'))->paginate(10);
        }
        if (!$this->validate(
            [
                'name' =>
                [
                    'rules' => 'required|is_unique[users.name]',
                    'errors' =>
                    [
                        'required' => 'nama harus di isi',
                        'is_unique' => 'nama harus berbeda',

                    ]

                ],
                'email' =>
                [
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required'    => 'Email harus diisi.',
                        'valid_email' => 'Format email tidak valid.',
                        'is_unique'   => 'Email sudah digunakan.'
                    ]

                ],
                'role' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'role wajib diisi',


                    ]

                ],
                'department' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => 'departemen harus di isi',


                    ]

                ],
                'password' =>
                [
                    'rules' => 'required|min_length[8]',
                    'errors' =>
                    [
                        'required' => '{field} nama harus di isi',

                        'min_length' => '{field} minimal 8 karakter'
                    ]

                ],


            ]
        )) {
            $data =  [
                'validation' => $this->validator,
                'data' => $user,
                'jumlah' => $jumlah,
                'title' => 'Data user',
                'pager' => $this->usermodel->pager,
                'nomor'  => ($page - 1) * $perPage + 1,
                'old_name' => $this->request->getPost('name'),
                'old_email' => $this->request->getPost('email'),
                'old_role' => $this->request->getPost('role'),
                'old_department' => $this->request->getPost('department'),
            ];
            return view('admin/userk', $data);
        }
        $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $this->usermodel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $passwordHash,

            'role' => $this->request->getPost('role'),
            'department' => $this->request->getPost('department'),

        ]);
        $newUserId = $this->usermodel->getInsertID();
        $this->broadcastWs('new_user', [
            'id'         => $newUserId,
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'role'       => $this->request->getPost('role'),
            'department' => $this->request->getPost('department'),
        ]);
        return redirect()->to('/usersK')->with('pesan', 'user telah ditambahkan');
    }
    public function ubahrole()
    {
        $id = $this->request->getPost('id');


        $user = $this->usermodel->find($id);
        $roleBaru = ($user['role'] == 'admin') ? 'karyawan' : 'admin';

        $this->usermodel->update($id, [
            'role' => $roleBaru
        ]);
        $this->broadcastWs('role_update', [
            'id'   => $id,
            'name' => $user['name'],
            'role' => $roleBaru,
        ]);
        return redirect()->back()->with('pesan', 'role dengan nama ' . $user['name'] . ' telah diubah');
    }


    public function exportExcelk()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $keyword = $this->request->getGet('keyword');

        $builder = $this->aktivitas
            ->select('aktivitas.*, users.name, tickets.kode_tiket, tickets.subjek, tickets.ditugaskan, users.role')
            ->join('users', 'users.id = aktivitas.user_id')
            ->join('tickets', 'tickets.id = aktivitas.tiket_id')
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

        $data = $builder
            ->orderBy('aktivitas.created_at', 'DESC')
            ->get()
            ->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'LAPORAN AKTIVITAS TICKET');

        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        ]);

        $header = [
            'A3' => 'No',
            'B3' => 'Kode Ticket',
            'C3' => 'Subjek',
            'D3' => 'User',
            'E3' => 'Teknisi',
            'F3' => 'Aktivitas',
            'G3' => 'Tanggal/Jam'
        ];

        foreach ($header as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        $sheet->getStyle('A3:G3')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'rgb' => 'FFFFFF'
                ]
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '0D6EFD'
                ]
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        ]);

        $row = 4;
        $no = 1;

        foreach ($data as $d) {

            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $d['kode_tiket']);
            $sheet->setCellValue('C' . $row, $d['subjek']);
            $sheet->setCellValue('D' . $row, $d['name']);
            $sheet->setCellValue('E' . $row, $d['ditugaskan']);
            $sheet->setCellValue('F' . $row, $d['aktivitas']);
            $sheet->setCellValue('G' . $row, date('d-m-Y H:i', strtotime($d['created_at'])));

            $row++;
        }

        $sheet->getStyle('A3:G' . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ]);

        $sheet->getStyle('A3:A' . $row)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $sheet->freezePane('A4');
        $sheet->setAutoFilter('A3:G3');
        $sheet->setTitle('Aktivitas');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Aktivitas karyawan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function exportExcel()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $keyword = $this->request->getGet('keyword');

        $builder = $this->aktivitas
            ->select('aktivitas.*, users.name, tickets.kode_tiket, tickets.subjek, tickets.ditugaskan, users.role')
            ->join('users', 'users.id = aktivitas.user_id')
            ->join('tickets', 'tickets.id = aktivitas.tiket_id')
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

        $data = $builder
            ->orderBy('aktivitas.created_at', 'DESC')
            ->get()
            ->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'LAPORAN AKTIVITAS TICKET');

        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        ]);

        $header = [
            'A3' => 'No',
            'B3' => 'Kode Ticket',
            'C3' => 'Subjek',
            'D3' => 'User',
            'E3' => 'Teknisi',
            'F3' => 'Aktivitas',
            'G3' => 'Tanggal/Jam'
        ];

        foreach ($header as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        $sheet->getStyle('A3:G3')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'rgb' => 'FFFFFF'
                ]
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '0D6EFD'
                ]
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        ]);

        $row = 4;
        $no = 1;

        foreach ($data as $d) {

            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $d['kode_tiket']);
            $sheet->setCellValue('C' . $row, $d['subjek']);
            $sheet->setCellValue('D' . $row, $d['name']);
            $sheet->setCellValue('E' . $row, $d['ditugaskan']);
            $sheet->setCellValue('F' . $row, $d['aktivitas']);
            $sheet->setCellValue('G' . $row, date('d-m-Y H:i', strtotime($d['created_at'])));

            $row++;
        }

        $sheet->getStyle('A3:G' . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ]);

        $sheet->getStyle('A3:A' . $row)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        foreach (range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $sheet->freezePane('A4');
        $sheet->setAutoFilter('A3:G3');
        $sheet->setTitle('Aktivitas');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Aktivitas admin.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
