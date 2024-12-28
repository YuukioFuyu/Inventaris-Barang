<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Pesan E-mail */

// Verifikasi akun
$lang['aauth_email_verification_subject'] = 'Verifikasi Akun';
$lang['aauth_email_verification_code'] = 'Kode verifikasi Anda adalah: ';
$lang['aauth_email_verification_text'] = " Anda juga dapat mengklik (atau menyalin dan menempelkan) tautan berikut\n\n";

// Reset kata sandi
$lang['aauth_email_reset_subject'] = 'Reset Kata Sandi';
$lang['aauth_email_reset_text'] = "Untuk mereset kata sandi Anda, klik (atau salin dan tempelkan ke bilah alamat browser Anda) tautan di bawah ini:\n\n";

// Sukses reset kata sandi
$lang['aauth_email_reset_success_subject'] = 'Reset Kata Sandi Berhasil';
$lang['aauth_email_reset_success_new_password'] = 'Kata sandi Anda telah berhasil direset. Kata sandi baru Anda adalah: ';

/* Pesan Error */

// Kesalahan pembuatan akun
$lang['aauth_error_email_exists'] = 'Alamat email sudah ada di sistem. Jika Anda lupa kata sandi, Anda dapat mengklik tautan di bawah ini.';
$lang['aauth_error_username_exists'] = "Akun sudah ada di sistem dengan nama pengguna tersebut. Silakan masukkan nama pengguna yang berbeda, atau jika Anda lupa kata sandi, silakan klik tautan di bawah ini.";
$lang['aauth_error_email_invalid'] = 'Alamat email tidak valid';
$lang['aauth_error_password_invalid'] = 'Kata sandi tidak valid';
$lang['aauth_error_username_invalid'] = 'Nama pengguna tidak valid';
$lang['aauth_error_username_required'] = 'Nama pengguna diperlukan';
$lang['aauth_error_totp_code_required'] = 'Kode autentikasi diperlukan';
$lang['aauth_error_totp_code_invalid'] = 'Kode autentikasi tidak valid';

// Kesalahan pembaruan akun
$lang['aauth_error_update_email_exists'] = 'Alamat email sudah ada di sistem. Silakan masukkan alamat email yang berbeda.';
$lang['aauth_error_update_username_exists'] = "Nama pengguna sudah ada di sistem. Silakan masukkan nama pengguna yang berbeda.";

// Kesalahan akses
$lang['aauth_error_no_access'] = 'Maaf, Anda tidak memiliki akses ke sumber daya yang Anda minta.';
$lang['aauth_error_login_failed_email'] = 'Alamat E-mail dan Kata Sandi tidak cocok.';
$lang['aauth_error_login_failed_name'] = 'Nama Pengguna dan Kata Sandi tidak cocok.';
$lang['aauth_error_login_failed_all'] = 'E-mail, Nama Pengguna, atau Kata Sandi tidak cocok.';
$lang['aauth_error_login_attempts_exceeded'] = 'Anda telah melebihi jumlah percobaan login, akun Anda sekarang telah terkunci.';
$lang['aauth_error_recaptcha_not_correct'] = 'Maaf, teks reCAPTCHA yang dimasukkan tidak benar.';

// Kesalahan lainnya
$lang['aauth_error_no_user'] = 'Pengguna tidak ada';
$lang['aauth_error_account_not_verified'] = 'Akun Anda belum terverifikasi. Harap periksa e-mail Anda dan verifikasi akun Anda.';
$lang['aauth_error_no_group'] = 'Grup tidak ada';
$lang['aauth_error_no_subgroup'] = 'Subgrup tidak ada';
$lang['aauth_error_self_pm'] = 'Tidak memungkinkan untuk mengirim pesan ke diri sendiri.';
$lang['aauth_error_no_pm'] = 'Pesan pribadi tidak ditemukan';

/* Pesan Informasi */
$lang['aauth_info_already_member'] = 'Pengguna sudah menjadi anggota grup';
$lang['aauth_info_already_subgroup'] = 'Subgrup sudah menjadi anggota grup';
$lang['aauth_info_group_exists'] = 'Nama grup sudah ada';
$lang['aauth_info_perm_exists'] = 'Nama izin sudah ada';
