<?php if (count($forms)){?>
<?php foreach ($forms as $form): ?>
	<option data-form-url="<?= base_url('form/preview_form/'.$form->id); ?>" value="<?= $form->id; ?>"><?= $form->subject; ?></option>
<?php endforeach; ?>
<?php } else { 
echo "empty";
} ?>