<?php

class acf_field_youtube extends acf_field
{
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options
		
		
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct()
	{
		
		// vars
		$this->name = 'youtube';
		$this->label = __('Youtube');
		$this->category = __('Content', 'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
			'allow_null' => 0
		);
		
		
		// do not delete!
    	parent::__construct();
    	
    	// settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.1.2'
		);

	}
	
	
	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	function create_options( $field )
	{
		// defaults?
		$field = array_merge($this->defaults, $field);
		
		// key is needed in the field names to correctly save the data
		$key = $field['name'];
		
		
		// Create Field Options HTML
		?>

		<?php
		
	}
	
	
	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function create_field( $field )
	{

		$field = array_merge($this->defaults, $field);
		
		// create Field HTML
		$dir = apply_filters('acf/helpers/get_dir', __FILE__);
		echo "<div class='yt-wrapper'>";
		echo sprintf( '<iframe class="acf-youtube" onload="acfYoutubeInit(this)"  src="%1$s"></iframe>', $dir . '/angular/index.html');			
		//echo sprintf( '<input type="hidden" value="%s">',  $field['value'] );			
		echo sprintf( '<input type="hidden" class="%s" name="%s" value="%s">', $field['class'], $field['name'], $field['value']  );
		echo "</div>";
	}

	function format_value_for_api( $value, $post_id, $field )
	{
		$field = array_merge($this->defaults, $field);
		if( !$value ) {
			return false;
		}
		
		return $value;
	}

	
}


// create field
new acf_field_youtube();

?>