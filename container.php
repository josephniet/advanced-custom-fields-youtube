<?php

add_action('add_meta_boxes', 'add_youtube_metabox');
function add_youtube_metabox(){
	

	function add_it($post_type){
			 add_meta_box( 'youtube-module', 
		 'youtube video', 
		 'youtube_metabox_markup',
		 $post_type, 
		 'normal',
		 'high',
		 array()//callback args
		  );		
	}
	
	global $post;
	$slug = basename( get_permalink( $post->ID ) );
	if ( 'lost-labs' == $slug ) {
	    // Page has ID of 123, add meta box
    	add_it('page');
	}
	
	add_it('talk');
	add_it('partner');
	add_it('project');
}


function youtube_metabox_markup($post, $args){
load_js_module('jquery-migrate');
load_js_module('cms_video');

?>
<script>
	console.log('inline: ', jQuery.fn.jquery);
</script>
<?php	
$items = get_post_meta($post->ID,'youtube_videos');
if (!empty($items) && is_array($items) ){ ?>
<div id="youtube-module">
	<div class="data">
		<?php

		 foreach ($items as $item){
		 	if (is_array($item) && !empty($item)){	
			 	$value =	 htmlentities($item[0]);
			} else {
				$value = '';
			}
			echo '<input type="hidden" style="width:100%;" value="' . $value . '" />';
		}?>
	</div>
	<?php
} //end if items is populated.	
  wp_nonce_field('youtube_metabox', 'youtube_metabox_nonce'); ?>
</div>
<?php
}



function youtube_metabox_save($post_id){

  // Check if our nonce is set.
  if ( ! isset( $_POST['youtube_metabox_nonce'] ) )
    return $post_id;

  $nonce = $_POST['youtube_metabox_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'youtube_metabox' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */



  // Sanitize user input.
  if (isset($_POST['youtube'])){
	  $data = ( $_POST['youtube'] );
	  foreach($_POST['youtube'] as &$JSON){
	  	$JSON = str_replace( '\\', '\\\\', $JSON );
	  }
	} else {
		$data = array();
	}
	  // Update the meta field in the database.
	  $response = update_post_meta( $post_id, 'youtube_videos', $data );
	  // var_dump($_POST['youtube']);
	 // wp_die();

}
//add_action('save_post', 'youtube_metabox_save');
//add_action('edit_post', 'youtube_metabox_save');
add_action( 'pre_post_update', 'youtube_metabox_save' );
//add_action('edit_page_form', 'youtube_metabox_save');




