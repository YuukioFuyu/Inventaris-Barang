<style type="text/css">
   .widget-user-header {
      padding-left: 20px !important;
   }

  .donate-button {
      background: linear-gradient(135deg, #ff7eb3, #ff758c); /* Gradien warna */
      color: #fff;
      font-size: 1.5rem;
      font-weight: bold;
      padding: 15px 30px;
      border: none;
      border-radius: 50px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease-in-out;
  }

  .donate-button:hover {
      background: linear-gradient(135deg, #ff758c, #ff7eb3); /* Gradien warna terbalik */
      transform: scale(1.1); /* Efek membesar */
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
  }

  .donate-button:active {
      transform: scale(1); /* Kembali ke ukuran asli saat ditekan */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  }

  #donasiModal .modal-dialog {
      margin: 0;
      padding: 0;
      height: 100vh; /* Modal dialog mengikuti tinggi viewport */
      width: 100vw; /* Opsional: Gunakan lebar penuh jika diperlukan */
  }

  #donasiModal .modal-content {
      height: 100%; /* Modal konten mengikuti tinggi dialog */
  }

  #donasiModal .modal-body {
      height: calc(100% - 60px); /* Kurangi tinggi header untuk modal body */
      padding: 0; /* Hapus padding */
      overflow: hidden;
  }

  #donasiIframe {
      width: 100%;
      height: 100%;
      border: 0; /* Hapus border pada iframe */
  }

  h5 a {
    color: #6eeaff; /* Warna biru cerah untuk kontras yang kuat */
    text-decoration: none;
    font-weight: bold; /* Membuat link lebih menonjol */
  }

  h5 a:hover {
    color: #fff900; /* Mengubah warna saat hover agar lebih interaktif */
  }

  @media (max-width: 768px) {
      #donasiModal .modal-dialog {
          height: 100%;
          width: 100vw; /* Lebar penuh untuk perangkat kecil */
          margin: 0;
      }
  }
</style>

<link rel="stylesheet" href="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<section class="content-header">
    <h1>
        Informasi
        <small>
            <?= get_option('site_name'); ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-dashboard">
                </i>
                Home
            </a>
        </li>
        <li class="active">
            Informasi
        </li>
    </ol>
</section>

  <section class="content">
    <!-- /.box -->
    <div class="row">
      <!-- /.col (LEFT) -->
      <div class="col-md-6">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Sistem</h3>
            <table class="table">
            <h5 scope="col"><?= get_option('site_name'); ?></h5>
              <tbody>
                <tr>
                  <td>Host</td>
                  <td><?= $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]"; ?></td>
                </tr>
                <tr>
                  <td>IP</td>
                  <td><?= $_SERVER['SERVER_ADDR']; ?></td>
                </tr>
                <tr>
                  <td>Port</td>
                  <td><?= $_SERVER['SERVER_PORT']; ?></td>
                </tr>
                <tr>
                  <td>Framework</td>
                  <td><?= print CI_VERSION;?></td>
                </tr>
                <tr>
                  <td>PHP</td>
                  <td><?= print phpversion();?></td>
                </tr>
                <tr>
                  <td>SQL</td>
                  <td><?= print mysqli_get_client_info();?></td>
                </tr>
                <tr>
                  <td>Database</td>
                  <td><?=get_database_config('database');?></td>
                </tr>
                <tr>
                <td>PHP Extension</td>
                <td>
                  <?php
                    $extensions = get_loaded_extensions();
                    echo implode(", ", $extensions);
                  ?>
                </td>
              </tr>
              </tbody>
            </table>
            <div class="box-tools pull-right">
              <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
            </div>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col (RIGHT) -->
      <div class="col-md-6">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Lisensi</h3>
            <div class="widget-user-image">
              <img class="img-responsive center-block" src="<?= BASE_ASSET; ?>admin-lte/dist/img/credit/MIT-logo.png" alt="MIT Lisence" style="width: 26%" >
            </div>
            <h2 class="text-center">
              <b>MIT License</b>
            </h2>
            <h5 class="text-center">
              Copyright &copy; <?= date('Y'); ?> <a href="https://yuuki0.net" target="_blank">Yuukio Fuyu</a>
            </h5>
            <h5>
              Dengan ini diberikan izin, secara gratis, kepada siapa saja yang memperoleh salinan perangkat lunak ini dan berkas dokumentasi terkait (selanjutnya disebut "Perangkat Lunak"), untuk menggunakan, menyalin, memodifikasi, menggabungkan, menerbitkan, mendistribusikan, memberi lisensi, dan/atau menjual salinan Perangkat Lunak, serta mengizinkan pihak lain yang menerima Perangkat Lunak untuk melakukannya, dengan ketentuan-ketentuan berikut:</h5><h5>Pemberitahuan hak cipta di atas dan pemberitahuan izin ini harus disertakan dalam semua salinan atau bagian substansial dari Perangkat Lunak.</h5><h5>PERANGKAT LUNAK DIBERIKAN "SEBAGAIMANA ADANYA", TANPA JAMINAN APAPUN, BAIK YANG TERSURAT MAUPUN TERSIRAT, TERMASUK NAMUN TIDAK TERBATAS PADA JAMINAN KELAYAKAN PERDAGANGAN, KECOCOKAN UNTUK TUJUAN TERTENTU, DAN TIDAK MELANGGAR HAK. DALAM HAL APAPUN, PENULIS ATAU PEMEGANG HAK CIPTA TIDAK BERTANGGUNG JAWAB ATAS SETIAP KLAIM, KERUSAKAN, ATAU TANGGUNG JAWAB LAINNYA, BAIK DALAM TINDAKAN KONTRAK, TORT, ATAU SEBALIKNYA, YANG TIMBUL DARI, TERKAIT DENGAN, ATAU BERHUBUNGAN DENGAN PERANGKAT LUNAK ATAU PENGGUNAAN ATAU TINDAKAN LAINNYA DALAM PERANGKAT LUNAK.
            </h5>
            <div class="box-tools pull-right">
              <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
            </div>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <div class="col-md-12">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-blue">
                <div class="widget-user-image">
                    <img alt="Support to Yuukio Fuyu" src="<?=BASE_ASSET;?>/img/support.png">
                    </img>
                </div>
                <h1 class="widget-user-username">
                    Hai, <?= _ent(ucwords(clean_snake_case($this->aauth->get_user()->full_name))); ?>!
                </h1>
                <h5 class="widget-user-desc">
                  Dukungan Anda sangat berarti bagi <a href="https://github.com/yuukiofuyu" target="_blank">Yuukio Fuyu</a> untuk terus mengembangkan proyek aplikasi maupun program sumber terbuka di masa mendatang.
                </h5>
            </div>
            <div class="widget-user-header bg-white">
              <div class="text-center">
                  <button type="button" class="btn btn-primary btn-lg donate-button" id="donasiBtn">💝 Dukung Yuukio Fuyu</button>
              </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.content -->
  </section>
  <div class="modal fade" id="donasiModal" tabindex="-1" role="dialog" aria-labelledby="donasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
              <h4 class="modal-title" id="donasiModalLabel">Form Dukungan untuk Yuukio Fuyu</h4>
            </div>
            <div class="modal-body">
              <iframe id="donasiIframe" src=""></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    document.getElementById('donasiBtn').addEventListener('click', function () {
        const iframe = document.getElementById('donasiIframe');
        iframe.src = 'https://support.yuuki0.net';
        $('#donasiModal').modal('show');
    });
</script>
<script>
  // $(function () {
   // "use strict";

    // AREA CHART
    //var area = new Morris.Area({
   //   element: 'revenue-chart',
   //   resize: true,
    //  data: [
   //     {y: '2015 Q1', item1: 2666, item2: 2666},
   //     {y: '2015 Q2', item1: 2778, item2: 2294},
   //     {y: '2015 Q3', item1: 4912, item2: 1969},
   //     {y: '2015 Q4', item1: 3767, item2: 3597},
    //    {y: '2016 Q1', item1: 6810, item2: 1914},
   //     {y: '2016 Q2', item1: 5670, item2: 4293},
    //    {y: '2016 Q3', item1: 4820, item2: 3795},
    //    {y: '2016 Q4', item1: 15073, item2: 5967},
    //    {y: '2017 Q1', item1: 10687, item2: 4460},
    //    {y: '2017 Q2', item1: 8432, item2: 5713}
    //  ],
    //  xkey: 'y',
    //  ykeys: ['item1', 'item2'],
    //  labels: ['Item 1', 'Item 2'],
    //  lineColors: ['#a0d0e0', '#3c8dbc'],
    //  hideHover: 'auto'
   // });

    // LINE CHART
  //  var line = new Morris.Line({
   //   element: 'line-chart',
   //   resize: true,
   //   data: [
    //    {y: '2015 Q1', item1: 2666},
   //     {y: '2015 Q2', item1: 2778},
     //   {y: '2015 Q3', item1: 4912},
    //    {y: '2015 Q4', item1: 3767},
    //    {y: '2016 Q1', item1: 6810},
   //     {y: '2016 Q2', item1: 5670},
   //     {y: '2016 Q3', item1: 4820},
   //     {y: '2016 Q4', item1: 15073},
   //     {y: '2017 Q1', item1: 10687},
   //     {y: '2017 Q2', item1: 8432}
   //   ],
   //   xkey: 'y',
   //   ykeys: ['item1'],
   //   labels: ['Item 1'],
   //   lineColors: ['#3c8dbc'],
   //   hideHover: 'auto'
  //  });

    //DONUT CHART
  //  var donut = new Morris.Donut({
   //   element: 'sales-chart',
  //    resize: true,
 //     colors: ["#3c8dbc", "#f56954", "#00a65a"],
 //     data: [
 //       {label: "Download Sales", value: 12},
  //      {label: "In-Store Sales", value: 30},
  //      {label: "Mail-Order Sales", value: 20}
  //    ],
 //     hideHover: 'auto'
 //   });

    //BAR CHART
 //   var bar = new Morris.Bar({
 //     element: 'bar-chart',
  //    resize: true,
 //     data: [
 //       {y: '2013', a: 100, b: 90},
 //       {y: '2014', a: 75, b: 65},
 //       {y: '2015', a: 50, b: 40},
 ////       {y: '2017', a: 75, b: 65},
  //      {y: '2018', a: 50, b: 40},
  //      {y: '2019', a: 75, b: 65},
  //      {y: '2020', a: 100, b: 90}
 //     ],
  //    barColors: ['#00a65a', '#f56954'],
  //    xkey: 'y',
  ///    ykeys: ['a', 'b'],
  //    labels: ['CPU', 'DISK'],
   //   hideHover: 'auto'
  //  });
  //});
</script>