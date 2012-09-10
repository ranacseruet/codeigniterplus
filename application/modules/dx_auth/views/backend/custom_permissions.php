<html>
	<head><title>Manage Custom Permissions</title></head>
	<body>
	<?php
		echo '<b>Here is an example how to use custom permissions</b><br/><br/>';
		
		// Build drop down menu
		foreach ($roles as $role)
		{
			$options[$role->id] = $role->name;
		}

		// Change allowed uri to string to be inserted in text area
		if ( ! empty($allowed_uri))
		{
			$allowed_uri = implode("\n", $allowed_uri);
		}
		
		if (empty($edit))
		{
			$edit = FALSE;
		}
			
		if (empty($delete))
		{
			$delete = FALSE;
		}
		
		// Build form
		echo form_open($this->uri->uri_string());
		
		echo form_label('Role', 'role_name_label');
		echo form_dropdown('role', $options); 
		echo form_submit('show', 'Show permissions'); 
		
		echo form_label('', 'uri_label');
				
		echo '<hr/>';
		
		echo form_checkbox('edit', '1', $edit);
		echo form_label('Allow edit', 'edit_label');
		echo '<br/>';
		
		echo form_checkbox('delete', '1', $delete);
		echo form_label('Allow delete', 'delete_label');
		echo '<br/>';
					
		echo '<br/>';
		echo form_submit('save', 'Save Permissions');
		
		echo '<br/>';
		
		echo 'Open '.anchor('auth/custom_permissions/').' to see the result, try to login using user that you have changed.<br/>';
		echo 'If you change your own role, you need to relogin to see the result changes.';
		
		echo form_close();
			
	?>
	</body>
</html>