<style type="text/css">
	* {
		font-size: 90%;
		line-height: 1;
	}
</style>

<?php
function format_hari_tanggal($waktu)
{
    $hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    $hr = date('w', strtotime($waktu));
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($waktu));
    $bulan_array = array(
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
        12 => 'Desember',
    );
    $bl = date('n', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date( 'H:i:s', strtotime($waktu));
    
    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    return "$hari, $tanggal $bulan $tahun";
}
?>

<page backtop="0mm" backleft="0mm" backright="0mm" backbottom="0mm">
	<table border="1" style="margin: auto; border-collapse: collapse;">
		<thead>
			<tr>
			<?php foreach ($fields as $field): ?>
				<th style="text-align:center;"><?= ucwords(str_replace(['_', '-'], ' ', $field)); ?></th>
			<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach($results as $row): ?>
			<tr>
				<?php foreach ($fields as $field){ ?>
					<td style="text-align:center;"><?= $row->{$field}; ?></td>
				<?php } ?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

<page_footer>
</page_footer>
</page>
