<style type="text/css">
   .widget-user-header {
      padding-left: 20px !important;
   }
</style>

<link rel="stylesheet" href="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.css">

<section class="content-header">
    <h1>
        Dashboard
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
            Dashboard
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $jumlah_departemen; ?></h3>

              <p>Departemen</p>
            </div>
            <div class="icon">
              <i class="ion ion-briefcase"></i>
            </div>
            <a href="<?= BASE_URL . 'departemen'; ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $jumlah_supplier; ?></h3>

              <p>Supplier</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= BASE_URL . 'supplier'; ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $jumlah_jenis_pengadaan; ?></h3>

              <p>Jenis Pengadaan</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?= BASE_URL . 'jenis_pengadaan'; ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $jumlah_kategori_barang; ?></h3>

              <p>Kategori</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= BASE_URL . 'kategori'; ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- DONUT CHART -->
        <div class="col-lg-6 col-xs-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Rekapitulasi Barang</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" onclick="window.location.href='<?= BASE_URL . 'barang'; ?>'">Selengkapnya <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="chart-jumlah-barang" style="height: 300px; position: relative;"></div>
                </div>
            </div>
        </div>

        <!-- BAR CHART -->
        <div class="col-lg-6 col-xs-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Rekapitulasi Pengadaan Barang</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" onclick="window.location.href='<?= BASE_URL . 'pengadaan'; ?>'">Selengkapnya <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="bar-chart" style="height: 300px;"></div>
                </div>
            </div>
        </div>

        <!-- LINE CHART -->
        <div class="col-lg-6 col-xs-6">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Rekapitulasi Peminjaman</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" onclick="window.location.href='<?= BASE_URL . 'pengajuan'; ?>'">Selengkapnya <i class="fa fa-arrow-circle-right"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="line-chart-peminjaman" style="height: 300px;"></div>
            </div>
          </div>
        </div>

        <!-- LINE CHART -->
        <div class="col-lg-6 col-xs-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Rekapitulasi Pengembalian</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" onclick="window.location.href='<?= BASE_URL . 'pengembalian'; ?>'">Selengkapnya <i class="fa fa-arrow-circle-right"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="line-chart-pengembalian" style="height: 300px;"></div>
            </div>
          </div>
        </div>

    </div>
</section>
<!-- /.content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.min.js"></script>
<script>
    // RANDOM COLOR
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // DONUT CHART BARANG
    const DonutChartData = <?php echo $donut_chart_data; ?>;
    var BarangColors = DonutChartData.map(() => getRandomColor());

    new Morris.Donut({
        element: 'chart-jumlah-barang',
        resize: true,
        colors: BarangColors,
        data: DonutChartData,
        hideHover: 'auto'
    });

    // BAR CHART PENGAJUAN
    const barChartData = JSON.parse('<?php echo $bar_chart_data; ?>');
    const BarChartData = [];
    const GroupedBarDataPengajuan = {};

    barChartData.forEach(item => {
        const month = item.bulan;
        const type = item.jenis_pengadaan;
        const total = parseInt(item.total, 10);

        if (!GroupedBarDataPengajuan[month]) {
            GroupedBarDataPengajuan[month] = { m: month };
        }
        GroupedBarDataPengajuan[month][type] = total;
    });

    for (const month in GroupedBarDataPengajuan) {
        BarChartData.push(GroupedBarDataPengajuan[month]);
    }

    const ykeys = [...new Set(barChartData.map(item => item.jenis_pengadaan))];
    const labels = ykeys;
    var PengajuanColors = BarChartData.map(() => getRandomColor());

    new Morris.Bar({
        element: 'bar-chart',
        resize: true,
        data: BarChartData,
        barColors: PengajuanColors,
        xkey: 'm',
        ykeys: ykeys,
        labels: labels,
        hideHover: 'auto'
    });

    // LINE CHART PEMINJAMAN
    const lineChartDataPeminjaman = JSON.parse('<?php echo $line_chart_data_peminjaman; ?>');
    const LineChartDataPeminjaman = [];
    const GroupedLineDataPeminjaman = {};

    lineChartDataPeminjaman.forEach(item => {
        const month = item.bulan;
        const department = item.departemen;
        const total = parseInt(item.total, 10);

        if (!GroupedLineDataPeminjaman[month]) {
            GroupedLineDataPeminjaman[month] = { y: month };
        }
        GroupedLineDataPeminjaman[month][department] = total;
    });

    for (const month in GroupedLineDataPeminjaman) {
        LineChartDataPeminjaman.push(GroupedLineDataPeminjaman[month]);
    }

    const lineYKeysPeminjaman = [...new Set(lineChartDataPeminjaman.map(item => item.departemen))];
    const lineLabelsPeminjaman = lineYKeysPeminjaman;
    var PeminjamanColors = LineChartDataPeminjaman.map(() => getRandomColor());

    new Morris.Line({
        element: 'line-chart-peminjaman',
        resize: true,
        data: LineChartDataPeminjaman,
        xkey: 'y',
        ykeys: lineYKeysPeminjaman,
        labels: lineLabelsPeminjaman,
        lineColors: PeminjamanColors,
        hideHover: 'auto'
    });

    // LINE CHART PENGEMBALIAN
    const lineChartDataPengembalian = JSON.parse('<?php echo $line_chart_data_pengembalian; ?>');
    const LineChartDataPengembalian = [];
    const GroupedLineDataPengembalian = {};

    lineChartDataPengembalian.forEach(item => {
        const month = item.bulan;
        const departemen_peminjam = item.departemen_peminjam;
        const total = parseInt(item.total, 10);

        if (!GroupedLineDataPengembalian[month]) {
            GroupedLineDataPengembalian[month] = { y: month };
        }
        GroupedLineDataPengembalian[month][departemen_peminjam] = total;
    });

    for (const month in GroupedLineDataPengembalian) {
        LineChartDataPengembalian.push(GroupedLineDataPengembalian[month]);
    }

    const lineYKeysPengembalian = [...new Set(lineChartDataPengembalian.map(item => item.departemen_peminjam))];
    const lineLabelsPengembalian = lineYKeysPengembalian;
    var PengembalianColors = LineChartDataPengembalian.map(() => getRandomColor());

    new Morris.Line({
        element: 'line-chart-pengembalian',
        resize: true,
        data: LineChartDataPengembalian,
        xkey: 'y',
        ykeys: lineYKeysPengembalian,
        labels: lineLabelsPengembalian,
        lineColors: PengembalianColors,
        hideHover: 'auto'
    });
</script>