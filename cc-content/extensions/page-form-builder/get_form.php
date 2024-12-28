<?php

$result = $cc_core->db->get('form');

foreach ($result as $row) {
	?>
	<select value="<?= $row->id; ?>"><?= ucwords($row->subject); ?></select>
	<?php
}