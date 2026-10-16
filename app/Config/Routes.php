<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/dashboard', 'CTadmin::index', ['filter' => ['Login', 'Admin']]);
$routes->get('/lihat', 'Ckaryawan::ticket', ['filter' => ['Login', 'User']]);
$routes->get('/teknisi', 'Ckaryawan::teknisi');

$routes->get('/ticket', 'CTadmin::ticket', ['filter' => ['Login', 'Admin']]);
$routes->post('/ticket/validate', 'Cadmin::validateTicket');
$routes->get('/users', 'CTadmin::user', ['filter' => ['Login', 'Admin']]);
$routes->get('/usersK', 'CTadmin::userK', ['filter' => ['Login', 'Admin']]);
$routes->get('/Cuser', 'Cadmin::Cuser', ['filter' => ['Admin', 'Login']]);
$routes->get('/kategory', 'CTadmin::kategory', ['filter' => ['Admin', 'Login']]);
$routes->post('cek-ticket', 'Cadmin::cekTicket', ['filter' => 'Login']);
$routes->get('kategori/search', 'CTadmin::kategorySearch');
$routes->get('ticket/search', 'CTadmin::ticketSearch');
$routes->post('cek-kategori', 'Cadmin::cekKategori', ['filter' => ['Login', 'Admin']]);
$routes->post('cek-kategori-update/(:num)', 'Cadmin::cekKategoriUpdate/$1', ['filter' => ['Login', 'Admin']]);
$routes->post('cek-user', 'Cadmin::cekUser', ['filter' => ['Login', 'Admin']]);
$routes->post('cek-user-update/(:num)', 'Cadmin::cekUserUpdate/$1', ['filter' => ['Login', 'Admin']]);
$routes->post('user/update/(:num)', 'Cadmin::updateUser/$1', ['filter' => ['Login', 'Admin']]);
$routes->DELETE('user/hapus/(:num)', 'Cadmin::hapusUser/$1', ['filter' => ['Login', 'Admin']]);
$routes->get('lihat/search', 'Ckaryawan::ticketSearch', ['filter' => ['Login', 'User']]);
$routes->get('dashboard/search', 'CTadmin::dashboardSearch', ['filter' => ['Login', 'Admin']]);
$routes->get('users/search', 'CTadmin::userSearch', ['filter' => ['Login', 'Admin']]);
$routes->get('users/searchk', 'CTadmin::userSearchk', ['filter' => ['Login', 'Admin']]);
$routes->post('/kategori/simpan', 'Cadmin::Ktambah', ['filter' => ['Login', 'Admin']]);
$routes->get('/aktivitas', 'CTadmin::aktivitas', ['filter' => ['Login', 'Admin']]);
$routes->get('/aktivitask', 'CTadmin::aktivitasK', ['filter' => ['Login', 'Admin']]);
$routes->get('aktivitas/search', 'CTadmin::aktivitasSearch');
$routes->get('aktivitas/searchk', 'CTadmin::aktivitasSearchk');
$routes->post('/ubahrole', 'Cadmin::ubahrole', ['filter' => ['Login', 'Admin']]);
$routes->post('Cticket', 'Cadmin::Cticket', ['filter' => 'Login']);
$routes->post('/ticket/updateStatus', 'Cadmin::ubahstatus', ['filter' => ['Login', 'Admin']]);
$routes->get('aktivitas/export', 'Cadmin::exportExcel', ['filter' => ['Login', 'Admin']]);
$routes->get('aktivitas/exportk', 'Cadmin::exportExcelk', ['filter' => ['Login', 'Admin']]);
$routes->DELETE('kategori/hapus/(:num)', 'Cadmin::Khapus/$1', ['filter' => ['Login', 'Admin']]);
$routes->DELETE('user/hapus/(:num)', 'Cadmin::Uhapus/$1', ['filter' => ['Login', 'Admin']]);
$routes->get('ticket/detail/(:num)', 'CTadmin::detail/$1', ['filter' => ['Login', 'Admin']]);
$routes->get('user/detail/(:num)', 'Ckaryawan::detail/$1', ['filter' => ['Login', 'User']]);
$routes->post('/kategori/update/(:num)', 'Cadmin::Kupdate/$1', ['filter' => ['Login', 'Admin']]);
$routes->get('/', 'Clogin::landing_page');

/** login */

$routes->post('/forgot-password/proses', 'Clogin::prosesForgotPassword');
$routes->get('/reset-password/(:any)', 'Clogin::resetPassword/$1');
$routes->post('/reset-password/proses', 'Clogin::prosesResetPassword');
$routes->get('/login', 'Clogin::index'); // TANPA FILTER
$routes->get('/reset', 'Clogin::reset'); // TANPA FILTER
$routes->post('/login/proses_l', 'Clogin::proses_login');
$routes->get('/register', 'Clogin::register');
$routes->post('/register/proses_r', 'Clogin::proses_registrasi');
$routes->post('/admin/proses_C', 'Cadmin::proses_Cuser', ['filter' => ['Login', 'Admin']]);
$routes->get('/logout', 'Clogin::logout', ['filter' => 'Login']);
