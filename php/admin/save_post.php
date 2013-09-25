<?php
// ======================== //
//	Save/Delete Post Hooks  //
// ======================== //

/*
 * Save post hook for saving and updating translation links
 */
add_action('save_post', 'nLingual_save_post', 999);
function nLingual_save_post($post_id){
	global $wpdb;

	// Abort if doing auto save or it's a revision
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	elseif(wp_is_post_revision($post_id)) return;

	$post_type = $_POST['post_type'];

	// Abort if they don't have permission to edit posts/pages
	if($post_type == 'page' && !current_user_can('edit_page', $post_id)) return;
	elseif($post_type == 'page' && !current_user_can('edit_page', $post_id)) return;

	// Set the language if nLingual_language nonce is verified
	if(isset($_POST['nLingual_language']) && wp_verify_nonce($_POST['nLingual_language'], __FILE__) && isset($_POST['language'])){
		nL_set_post_lang($post_id, $_POST['language']);
	}

	// Update translations if nLingual_translations nonce is verified
	if(isset($_POST['nLingual_translations']) && wp_verify_nonce($_POST['nLingual_translations'], __FILE__) && isset($_POST['translations'])){
		nL_associate_posts($post_id, $_POST['translations']);
	}

	// Loop through the sync options, and syncronize the fields with it's associated posts
	$associated = nL_associated_posts($post_id);

	if($data_fields = nL_sync_rules($post_type, 'data')){
		$ids = implode(',', $associated);
		$post = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE ID = %d", $post_id));

		$changes = array();
		foreach($data_fields as $field){
			$changes[] = $wpdb->prepare("$field = %s", $post->$field);
		}
		$changes = implode(',', $changes);

		// Run the update
		$wpdb->query("UPDATE $wpdb->posts SET $changes WHERE ID IN($ids)");
	}
	if($taxonomies = nL_sync_rules($post_type, 'tax')){
		foreach($taxonomies as $taxonomy){
			$terms = get_the_terms($post_id, $taxonomy);
			if(is_object($terms)) continue; // invalid taxonomy, abort

			if(is_array($terms)){
				$terms = array_map(function($term){
					return intval($term->term_id);
				}, $terms);
			}else{
				$terms = null;
			}

			foreach($associated as $id){
				wp_set_object_terms($id, $terms, $taxonomy);
			}
		}
	}
	if($meta_fields = nL_sync_rules($post_type, 'meta')){
		foreach($meta_fields as $field){
			$data = get_post_meta($post_id, $field, true);
			foreach($associated as $id){
				update_post_meta($id, $field, $data);
			}
		}
	}
}

/*
 * Delete post hook for updating translation links
 */
add_action('delete_post', 'nL_delete_translation', 999);