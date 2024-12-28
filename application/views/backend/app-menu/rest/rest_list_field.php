<?php foreach ($this->db->list_fields($table) as $field): ?>
 <option value="<?= $field; ?>"><?= ucwords($field); ?></option>
<?php endforeach; ?>