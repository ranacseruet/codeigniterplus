<html>
	<head><title>Manage roles</title></head>
	<body>
	<?php  				
		// Show error
		echo validation_errors();
		
		// Build drop down menu
		$options[0] = 'None';
		foreach ($roles as $role)
		{
			$options[$role->id] = $role->name;
		}
	
		// Build table
		$this->table->set_heading('', 'ID', 'Name', 'Parent ID');
		
		foreach ($roles as $role)
		{			
			$this->table->add_row(form_checkbox('checkbox_'.$role->id, $role->id), $role->id, $role->name, $role->parent_id);
		}
		
		// Build form
		echo form_open($this->uri->uri_string());
		
		echo form_label('Role parent', 'role_parent_label');
		echo form_dropdown('role_parent', $options); 
				
		echo form_label('Role name', 'role_name_label');
		echo form_input('role_name', ''); 
		
		echo form_submit('add', 'Add role'); 
		echo form_submit('delete', 'Delete selected role');
				
		echo '<hr/>';
		
		// Show table
		echo $this->table->generate(); 
		
		echo form_close();
			
	?>
	</body>
</html>