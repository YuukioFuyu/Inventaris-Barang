<h1 align="center">Sistem Inventaris Barang</h1>
<p align="center" valign="top">
  <img src="https://github.com/user-attachments/assets/55363328-6601-4aa2-a7ca-ff5a8389f746" width="60%" alt="CodeIgniter 3"/>
</p>
<h3 align="center">Sistem Inventarisasi Barang Berbasis Web dengan CodeIgniter dan Bootstrap.</h3>
<h5 align='center'>
  <a href="https://support.yuuki0.net"><img alt="Donasi" src="https://img.shields.io/badge/Donasi-30363D?style=for-the-badge&logo=GitHub-Sponsors&logoColor=#white" /></a>
  &nbsp;
  <a href="#"><img alt="GitHub Repo stars" src="https://img.shields.io/github/stars/YuukioFuyu/Inventaris-Barang?style=for-the-badge" /></a>
</h5>

---

## ⚠️ Informasi Penting

Sistem Inventaris Barang ini tersedia untuk digunakan secara bebas dengan ketentuan. Apabila Anda mendistribusikan ulang atau mengunggah ulang repositori ini pada website pribadi atau komunitas, Anda diwajibkan untuk mencantumkan tautan balik (backlink) ke repositori GitHub asli: [YuukioFuyu/Inventaris-Barang](https://github.com/YuukioFuyu/Inventaris-Barang).

### Informasi tambahan tentang cara instalasi, update dan FAQ dapat diakses melalui: [https://ask.yuuki0.net](https://ask.yuuki0.net/knowledge-bases/github/1-inventaris-barang)

---

## 🚀 Fitur Utama

- **Data Management:**
  - ChartJS
  - Departemen/Unit
  - Supplier
  - Lokasi
  - Jenis Pengadaan
  - Kategori Barang
  - Barang
  - Pengadaan, Penempatan, Mutasi, Peminjaman, Pengembalian, Retur, Disposal
- **Akun dan Hak Akses:**
  - Multi Akun dengan Profil Kustom
  - Group Permission dan Custom Permission
- **Fitur Lanjutan:**
  - Upload Gambar
  - Rich Text Editor
  - Konfigurasi Dinamis
  - Pencarian & Filter Data
  - Aksi Cepat (Bulk)
  - Ekspor Excel & PDF

## 🛠️ Teknologi yang Didukung

![PHP](https://img.shields.io/badge/PHP-5.6%20to%208.2-darkblue)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.1.13-red)
![Bootstrap](https://img.shields.io/badge/Bootstrap-4.6.2-purple)
![jQuery](https://img.shields.io/badge/jQuery-3.6.0-blue)

- **Server:**
  - ![XAMPP](https://img.shields.io/badge/XAMPP-5.6.3--8.2-orange)
  - ![Apache2](https://img.shields.io/badge/Apache2-%3E%3D2.4.54-red)
  - ![NGINX](https://img.shields.io/badge/NGINX-%3E%3D1.23.3-brightgreen)
- **Database:**
  - ![MySQL](https://img.shields.io/badge/MySQL-%3E%3D5.7-lightblue)
  - ![PostgreSQL](https://img.shields.io/badge/PostgreSQL-%3E%3D6.5-blue)

## 🖼️ Preview

### 🎨 Dashboard Interaktif
Menghadirkan grafik dinamis untuk laporan dengan integrasi ChartJS, memungkinkan pengguna memahami data dengan lebih visual.
![Dashboard](https://github.com/user-attachments/assets/791b11ea-0ae4-417a-ad78-dd7760ef122a)

### 📂 Pengelolaan Data
Fitur unggulan untuk inventarisasi barang dengan kemampuan aksi cepat dan laporan otomatis dalam format PDF/Excel.
![Barang](https://github.com/user-attachments/assets/3daa7e51-a74c-42db-b805-92b2e0c3a538)

### 👤 Multi Akun
Fasilitas akun multi pengguna dengan kemampuan personalisasi profil untuk organisasi besar.
![User](https://github.com/user-attachments/assets/34a0f68a-377c-49da-a582-4f26154d56d7)

### 👥 Manajemen Grup
Atur akses pengguna dengan cepat melalui fitur manajemen grup yang fleksibel.
![Group](https://github.com/user-attachments/assets/709d7a8f-dc8f-4bd6-bc62-c5f11a5c5ada)

### 🎖️ Kustomisasi Hak Akses
Tambahkan atau batasi akses untuk setiap role dengan tingkat fleksibilitas tinggi.
![Akses](https://github.com/user-attachments/assets/208d8c25-6a52-4300-be03-e93a40b6340a)

### ⚙️ Kustomisasi Aplikasi
Aplikasi modular yang mudah disesuaikan untuk berbagai kebutuhan organisasi.
![Setting](https://github.com/user-attachments/assets/89ac833f-ed45-4534-b200-1fa81a3559a6)

---

## 🔐 Login Default

| **Grup**        | **Username** | **Password** |
|-----------------|-------------|-------------|
| Administrator   | admin       | admin       |
| Staff           | staff       | staff       |
| Guest           | guest       | guest       |

---

## 📝 ChangeLog
### Versi 3.0 (Terbaru)

- **Additions:**
  - ChartJS Integration on Dashboard
  - Organisation Name and Logo in Website Settings
  - PostgreSQL Database Support
  - Support for PHP 8.2 up to the latest version
- **Improvements:**
  - Validate the minimum password length in the add user form and fix missing password input field
  - [Bulk] data delete feature changed to [Aksi Cepat]
  - Improvement on user profile regarding lost roles after saving
  - Table export (PDF/Excel) now supports images
  - Group information in user profiles no longer always shows the currently logged in user
  - Page redirection after login
  - Language fixed and improved
  - Security vulnerability fixes thanks to reports from **[Jafar Akhoundali](https://github.com/JafarAkhondali)** and **[Hamidreza Hamidi](https://github.com/parrot409)**
- **Increases:**
  - Excel export library change from PHPExcel to PHPOffice
  - PDF export library change from HTML2PDF to TCPDF
  - Landing page redesign

#### Versi 2.4
- Bug Fixes on Security Issues
- Minor Bug Fix in Menu Akun
- Deleting Role Selector on User Account Profile Menu
- Changes Sub-Menu from [Role] to [Group]
- Minor Changes to the Database

#### Versi 2.3
- Added Feature **Disposal (Penghapusan Asset)**
- Reconfigure MySQL Database 
- Bug Fixed on MySQL Database Trigger Function

#### Versi 2.2
- Added Responsive Icons and Links
- Improve UI Appearance

#### Versi 2.1
- Added Informasi
- Minor Bug Fixed
- Fixed Typo

#### Versi 2.0
- Upgrade Framework
- Major Bug Fixed
- Add PostgreSQL Support

#### Versi 1.0
- First Release
