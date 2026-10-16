<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Traits\BroadcastTrait;



class Clogin extends BaseController
{
    use BroadcastTrait;
    protected $usermodel;
    public function __construct()
    {
        $this->usermodel = new UsersModel();
    }
    public function index()
    {
        if (session()->has('id_user')) {

            if (session()->get('role') == 'admin') {
                return redirect()->to('/dashboard');
            }

            return redirect()->to('/lihat');
        }
        session();
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }
    public function register()
    {
        session();
        if (session()->has('id_user')) {

            if (session()->get('role') == 'admin') {
                return redirect()->to('/dashboard');
            }

            return redirect()->to('/lihat');
        }
        $data = [
            'title' => 'Registrasi',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/register', $data);
    }
    public function reset()
    {
        if (session()->has('id_user')) {

            if (session()->get('role') == 'admin') {
                return redirect()->to('/dashboard');
            }

            return redirect()->to('/lihat');
        }
        $data = [
            'title' => 'Reset password',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/reset', $data);
    }

    public function prosesForgotPassword()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Format email tidak valid.',
                ]
            ],
        ])) {
            $data = [
                'title' => 'Reset password',
                'validation' => $this->validator
            ];
            return view('auth/reset', $data);
        }

        $email = $this->request->getPost('email');
        $user = $this->usermodel->where('email', $email)->first();

        // Selalu tampilkan pesan sukses meski email tidak ditemukan,
        // supaya tidak bocorkan info "email ini terdaftar atau tidak" (keamanan)
        if (!$user) {
            return redirect()->to('/login')->with('pesan', 'Kalau email terdaftar, link reset password sudah dikirim.');
        }

        // Generate token unik
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $this->usermodel->update($user['id'], [
            'reset_token' => $token,
            'reset_token_expires' => $expires,
        ]);

        // Kirim email
        $resetLink = base_url('reset-password/' . $token);

        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password - Helpdesk');
        $emailService->setMessage("
<div style='margin:0;padding:30px;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;'>

    <div style='max-width:600px;margin:auto;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,.08);'>

        <div style='background:#0d6efd;padding:25px;text-align:center;'>
            <h1 style='margin:0;color:#ffffff;font-size:28px;'>
                🔐 Reset Password
            </h1>
        </div>

        <div style='padding:35px;'>

            <h2 style='margin-top:0;color:#333;'>
                Halo {$user['name']} 👋
            </h2>

            <p style='font-size:16px;color:#555;line-height:1.8;'>
                Kami menerima permintaan untuk mengatur ulang password akun Anda.
                Klik tombol di bawah ini untuk membuat password baru.
            </p>

            <div style='text-align:center;margin:35px 0;'>

                <a href='{$resetLink}'
                   style='background:#0d6efd;
                          color:#ffffff;
                          padding:14px 35px;
                          text-decoration:none;
                          border-radius:8px;
                          font-size:16px;
                          font-weight:bold;
                          display:inline-block;'>
                    Reset Password
                </a>

            </div>

            <p style='color:#555;font-size:15px;'>
                Jika tombol tidak dapat diklik, salin dan buka tautan berikut:
            </p>

            <p style='word-break:break-all;'>
                <a href='{$resetLink}' style='color:#0d6efd;text-decoration:none;'>
                    {$resetLink}
                </a>
            </p>

            <hr style='border:none;border-top:1px solid #e5e5e5;margin:30px 0;'>

            <p style='color:#dc3545;font-size:15px;'>
                ⏰ Link ini hanya berlaku selama <strong>1 jam</strong>.
            </p>

            <p style='font-size:15px;color:#555;line-height:1.8;'>
                Jika Anda tidak meminta reset password, abaikan email ini.
                Password Anda tidak akan berubah tanpa tindakan dari Anda.
            </p>

        </div>

        <div style='background:#f8f9fa;padding:20px;text-align:center;'>

            <p style='margin:0;color:#888;font-size:13px;'>
                Email ini dikirim secara otomatis oleh sistem.
            </p>

            <p style='margin-top:8px;font-weight:bold;color:#555;'>
                Kochi Ticketing System
            </p>

        </div>

    </div>

</div>
");

        if ($emailService->send()) {
            return redirect()->to('/login')->with('pesan', 'Kalau email terdaftar, link reset password sudah dikirim.');
        } else {
            log_message('error', 'Gagal kirim email reset password: ' . $emailService->printDebugger(['headers']));
            return redirect()->to('/reset')->with('error', 'Gagal mengirim email. Coba lagi nanti.');
        }
    }
    public function resetPassword($token)
    {
        $user = $this->usermodel
            ->where('reset_token', $token)
            ->where('reset_token_expires >=', date('Y-m-d H:i:s'))
            ->first();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Link reset password tidak valid atau sudah kedaluwarsa.');
        }

        $data = [
            'title' => 'Reset Password',
            'token' => $token,
            'validation' => \Config\Services::validation()
        ];

        return view('auth/Preset', $data);
    }

    public function prosesResetPassword()
    {
        $token = $this->request->getPost('token');

        $user = $this->usermodel
            ->where('reset_token', $token)
            ->where('reset_token_expires >=', date('Y-m-d H:i:s'))
            ->first();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Link reset password tidak valid atau sudah kedaluwarsa.');
        }

        if (!$this->validate([
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'min_length' => 'Password minimal 8 karakter.',
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi.',
                    'matches' => 'Konfirmasi password tidak sama.',
                ]
            ],
        ])) {
            $data = [
                'title' => 'proses reset',
                'validation' => $this->validator,
                'token' => $token,
            ];
            return view('auth/Preset', $data);
        }

        $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

        $this->usermodel->update($user['id'], [
            'password' => $passwordHash,
            'reset_token' => null,
            'reset_token_expires' => null,
        ]);

        return redirect()->to('/login')->with('pesan', 'Password berhasil diubah. Silakan login dengan password baru.');
    }
    public function proses_registrasi()
    {

        if (!$this->validate(
            [
                'name' =>
                [
                    'rules' => 'required|is_unique[users.name]|regex_match[/^\S+$/]',
                    'errors' =>
                    [
                        'required' => ' nama harus di isi',
                        'is_unique' => 'nama harus berbeda',
                        'regex_match' => 'Username tidak boleh mengandung spasi.'
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
                'department' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => '{field} nama harus di isi',


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
                'title' => 'Registrasi',
                'validation' => $this->validator
            ];
            return view('auth/register', $data);
        }
        $passwordHash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $this->usermodel->save([
            'name' => $this->request->getPost('name'),
            'email' => strtolower($this->request->getPost('email')),
            'password' => $passwordHash,

            'role' => 'karyawan',
            'department' => $this->request->getPost('department'),






        ]);
        $newUserId = $this->usermodel->getInsertID();
        $this->broadcastWs('new_user', [
            'id'    => $newUserId,
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role'  => $this->request->getPost('role'),
        ]);
        return redirect()->to('/login');
    }
    public function proses_login()
    {
        if (!$this->validate(
            [
                'name' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => '{field} belum di isi',


                    ]

                ],
                'password' =>
                [
                    'rules' => 'required',
                    'errors' =>
                    [
                        'required' => '{field}  harus di isi',

                        'min_length' => '{field} minimal 8 karakter'
                    ]

                ],


            ]
        )) {
            $data =  [

                'title' => "Login",
                'validation' => $this->validator
            ];
            return view('auth/login', $data);
        }


        $username = $this->request->getPost('name');

        $password = $this->request->getPost('password');


        $db = \Config\Database::connect();
        $sql = "SELECT * FROM users WHERE email = ? OR BINARY name = ? LIMIT 1";
        $query = $db->query($sql, [$username, $username]);
        $user = $query->getRowArray();
        if (!$user) {

            return redirect()->to('/login')->with('name', 'username atau email mu salah kamu salah');
        }
        if (!password_verify($password, $user['password'])) {

            return redirect()->to('/login')->with('password', 'password kamu salah');
        }
        session()->set([
            'id_user' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'department' => $user['department'],
            'role' => $user['role'],
            'logged_in' => true
        ]);
        session()->regenerate();
        if ($user['role'] == 'admin') {
            return redirect()->to('/dashboard');
        } elseif ($user['role'] == 'teknisi') {
            return redirect()->to('/teknisi');
        } else {
            return redirect()->to('/lihat');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function landing_page()
    {
        if (session()->has('id_user')) {

            if (session()->get('role') == 'admin') {
                return redirect()->to('/dashboard');
            }

            return redirect()->to('/lihat');
        }
        $data = ['title' => 'landing page'];
        return view('auth/landing_page', $data);
    }
}
