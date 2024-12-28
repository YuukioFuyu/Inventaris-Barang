<?= get_header(); ?>
<body id="page-top">
   <?= get_navigation(); ?>
   <header>
      <div class="header-content">
         <div class="header-content-inner">
            <div class="text-content">
               <?php
                  $site_logo = get_option('site_logo');
                  $site_logo_path = BASE_URL . 'uploads/logo/' . $site_logo;
                  if (!empty($site_logo) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/uploads/logo/' . $site_logo)) :
               ?>
                  <img src="<?= $site_logo_path; ?>" alt="Organization Logo">
               <?php endif; ?>
               <h1 id="homeHeading"><?= get_option('site_name'); ?></h1>
               <h2><?= get_option('site_organization'); ?></h2>
               <a href="<?= site_url('dashboard'); ?>" class="btn btn-primary btn-xl page-scroll">Masuk ke Dashboard</a>
            </div>
            <div class="image-content">
               <img src="<?= BASE_ASSET; ?>home/hero.webp" alt="Image Description" class="header-image">
               <div class="generator__shape"></div>
            </div>
         </div>
      </div>
   </header>

   <div class="footer">
      <?php if (get_option('site_organization') == ''): ?>
         <span>Copyright &copy; 2022 - <?= date('Y'); ?> <a href="https://yuuki0.net" target="_blank">Yuukio Fuyu</a>. All Rights Reserved</span>
      <?php else: ?>
         <span>Copyright &copy; 2022 - <?= date('Y'); ?> <a href="https://yuuki0.net" target="_blank">Yuukio Fuyu</a> &amp; <b><?= get_option('site_organization'); ?></b>. All Rights Reserved</span>
      <?php endif; ?>
   </div>

   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 150" class="gradient-shape" preserveaspectratio="none">
      <defs>
         <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color: #0182c9; stop-opacity: 1" />
            <stop offset="50%" style="stop-color: #009ddc; stop-opacity: 1" />
            <stop offset="100%" style="stop-color: #006fAA; stop-opacity: 1" />
         </linearGradient>
      </defs>
      <path d="M0,150 C50,100 100,100 150,150 L150,0 L0,0 Z" fill="url(#grad1)"></path>
   </svg>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
   <script src="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.min.js"></script>
   <?= get_footer(); ?>
</body>
<script>
   window.addEventListener('resize', function() {
   if (window.innerWidth <= 768) { // Pastikan hanya diterapkan pada layar kecil
      document.querySelector('header').style.height = `${window.innerHeight}px`; // Sesuaikan tinggi header dengan tinggi layar
   }
   });

   // Memastikan tinggi header saat pertama kali dimuat
   window.addEventListener('load', function() {
   if (window.innerWidth <= 768) {
      document.querySelector('header').style.height = `${window.innerHeight}px`; // Sesuaikan tinggi header dengan tinggi layar
   }
   });
</script>
