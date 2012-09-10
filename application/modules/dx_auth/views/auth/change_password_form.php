<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'		=> 'old_password',
	'size' 	=> 30,
	'value' => set_value('old_password')
);

$new_password = array(
	'name'	=> 'new_password',
	'id'		=> 'new_password',
	'size'	=> 30
);

$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'		=> 'confirm_new_password',
	'size' 	=> 30
);

?>

<fieldset>
<legend>Change Password</legend>
<?php echo form_open($this->uri->uri_string()); ?>

<?php echo $this->dx_auth->get_auth_error(); ?>

<dl>
	<dt><?php echo form_label('Old Password', $old_password['id']); ?></dt>
	<dd>
		<?php echo form_password($old_password); ?>
		<?php echo form_error($old_password['name']); ?>
	</dd>

	<dt><?php echo form_label('New Password', $new_password['id']); ?></dt>
	<dd>
		<?php echo form_password($new_password); ?>
		<?php echo form_error($new_password['name']); ?>
	</dd>

	<dt><?php echo form_label('Confirm New Password', $confirm_new_password['id']); ?></dt>
	<dd>
		<?php echo form_password($confirm_new_password); ?>
		<?php echo form_error($confirm_new_password['name']); ?>
	</dd>

	<dt></dt>
	<dd><?php echo form_submit('change', 'Change Password'); ?></dd>
</dl>

<?php echo form_close(); ?>
</fieldset>