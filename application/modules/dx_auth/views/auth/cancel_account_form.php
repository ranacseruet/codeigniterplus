<?php
$password = array(
	'name'	=> 'password',
	'id'		=> 'password',
	'size' 	=> 30
);

?>

<fieldset>
<legend>Cancel Account</legend>
<?php echo form_open($this->uri->uri_string()); ?>

<?php echo $this->dx_auth->get_auth_error(); ?>

<dl>
	<dt><?php echo form_label('Password', $password['id']); ?></dt>
	<dd>
		<?php echo form_password($password); ?>
		<?php echo form_error($password['name']); ?>
	</dd>
	<dt></dt>
	<dd><?php echo form_submit('cancel', 'Cancel Account'); ?></dd>
</dl>

<?php echo form_close(); ?>
</fieldset>