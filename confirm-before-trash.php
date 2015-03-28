<?php

/*
Plugin Name: Confirm Before Trash
Plugin URI: http://example.com
Description: A brief description of the Plugin.
Version: 1.0
Author: Panagiotis Vagenas <pan.vagenas@gmail.com>
Author URI: http://example.com
License: A "Slug" license name e.g. GPL2
*/

add_action('admin_footer-edit.php', 'cbd_wp_loaded');
add_action('admin_footer-post.php', 'cbd_wp_loaded');

function cbd_wp_loaded(){
	$screen = get_current_screen();

	if(in_array($screen->id, array('edit-post', 'edit-page', 'post', 'page'))){
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('a.submitdelete').click(function(e){
					e.preventDefault();
					var href = $(this).attr('href');
					var r = confirm('Are you sure you want to delete this <?php echo $screen->post_type; ?>');
					if(r){
						window.location = href;
					}
				});

				$('#doaction').click(function(e){
					if($('#bulk-action-selector-top').val() == 'trash'){
						if($('input[name="post[]"]:checked').length > 0){
							var r = confirm('Are you sure you want to delete these <?php echo $screen->post_type; ?>s');
							if(!r){
								e.preventDefault();
							}
						}
					}
				});
			});
		</script>
		<?php
	}
	return true;
}