<?php $i =0;  foreach ($this->db->list_fields($table) as $field): $i++?>
 <option <?= $i == 2 ? 'selected' : ''; ?> value="<?= $field; ?>"><?= ucwords($field); ?></option>
<?php endforeach; ?>