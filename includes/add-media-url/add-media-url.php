<?php
/**
 * Plugin Name: LH Add Media from URL
 * Plugin URI: https://lhero.org/plugins/lh-add-media-from-url/
 * Author: Peter Shaw
 * Author URI: https://shawfactor.com
 * Text Domain: lh_add_media_from_url
 * Domain Path: /languages
 * Version: 1.15
 * Description: This plugin allows you to fetch the remote file and save to your local WordPress, via wp-admin or bookmarklet.
 */

if (!class_exists('LH_add_media_from_url_plugin')) {


class LH_add_media_from_url_plugin {

var $namespace = 'lh_add_media_from_url';

private function reconstruct_url($url){    
    $url_parts = parse_url($url);
    $constructed_url = $url_parts['scheme'] . '://' . $url_parts['hostname'] . $url_parts['path'];

    return $constructed_url;
}


private function return_bookmarklet_string(){

$string = "javascript: (function() { var jsScript = document.createElement('script'); var jsScript = document.createElement('script'); jsScript.setAttribute('src', '".plugins_url( 'bookmarklet.php', __FILE__ )."'); document.getElementsByTagName('head')[0].appendChild(jsScript); })();";

$string = "javascript: (function() { window.location.href='".admin_url( 'upload.php?page=lh-add-media-from-url.php')."&lh_add_media_from_url-file_url=' + encodeURIComponent(location.href);})();";

return $string;

}


private function handle_upload_v2(){

if (current_user_can('upload_files')){

if (!wp_verify_nonce( $_POST['lh_add_media_from_url-nonce'], "lh_add_media_from_url-file_url")) {
		return new WP_Error('lh_add_media_from_url', 'Could not verify request nonce');
	}


$upload_url = esc_url(sanitize_text_field($_POST['lh_add_media_from_url-file_url']));
$upload_url = str_replace(' ', '%20', $upload_url);


if (!class_exists('LH_copy_from_url_class')) {

include_once("includes/lh-copy-from-url-class.php");

}


$id = LH_copy_from_url_class::save_external_file($upload_url,0);

return $id;

}

}



public function add_media_from_url() {

global $pagenow;

//Check to make sure we're on the right page and performing the right action

if( 'upload.php' != $pagenow ){
	
	return false;

} elseif ( empty( $_POST[ 'lh_add_media_from_url-file_url' ] ) ){

 return false;
		
} else {

	
$return = $this->handle_upload_v2();

if ( is_wp_error( $return ) ) {

//Upload has failed add to a global for display on the form page

$GLOBALS['lh_add_media_from_url-form-result'] = $return;

} else {

//Upload has succeeded, redirect to mediapage

wp_safe_redirect( admin_url( 'post.php?post='.$return.'&action=edit') );
exit();

}



}
	

}

public function plugin_menu() {

add_media_page(__('LH Add Media from URL', $this->namespace ), __('Add from URL', $this->namespace ), 'read', 'lh-add-media-from-url.php', array($this,"plugin_options"));


}

public function plugin_options() {

if (!current_user_can('upload_files')){

wp_die( __('You do not have sufficient permissions to access this page.', $this->namespace ) );

}

$lh_add_media_from_url_hidden_field_name = 'lh_add_media_from_url_submit_hidden';

echo "<h1>" . __( 'Add Media from URL', $this->namespace ) . "</h1>";


if (isset($GLOBALS['lh_add_media_from_url-form-result'])){


if ( is_wp_error( $GLOBALS['lh_add_media_from_url-form-result'] ) ) {

        foreach ( $GLOBALS['lh_add_media_from_url-form-result']->get_error_messages() as $error ) {

            echo '<strong>'.__( 'Error', $this->namespace ).'</strong>: ';
            echo $error . '<br/>';

}

} 

}

if (isset($_POST[ 'lh_add_media_from_url-file_url' ])){

$value = $_POST['lh_add_media_from_url-file_url'];

} elseif (isset($_GET['lh_add_media_from_url-file_url'])){

$value = $_GET['lh_add_media_from_url-file_url'];


}

?>

<form method="post">
<label for="lh_add_media_from_url-file_url"><?php echo __( 'URL', $this->namespace );  ?></label>
<input type="url" name="lh_add_media_from_url-file_url" id="lh_add_media_from_url-file_url" value="<?php  if (isset($value)){  echo $value; } ?>" size="50" />
<input type="hidden" value="<?php echo wp_create_nonce("lh_add_media_from_url-file_url"); ?>" name="lh_add_media_from_url-nonce" id="lh_add_media_from_url-nonce" />
<?php submit_button( 'Submit' ); ?>
</form>

<?php

  if (!isset($value)){  

echo '<h4>'.__( 'Bookmarklet', $this->namespace ).'</h4>';

echo '<p>'.__( 'Drag the bookmarklet below to your bookmarks bar. Then, when you find a file online you want to upload, simply "Upload" it', $this->namespace ).'</p>';

echo '<p><a title="'.__( 'Bookmark this link', $this->namespace ).'" href="'.$this->return_bookmarklet_string().'">'.__( 'Upload URL to ', $this->namespace ).get_bloginfo("name").'</a><br/>';

echo __( ' or edit your bookmarks and paste the below code', $this->namespace ).'<br/>';

echo $this->return_bookmarklet_string().'</p>';


}

}

public function plugins_loaded(){


load_plugin_textdomain( 'lh_add_media_from_url', false, basename( dirname( __FILE__ ) ) . '/languages' ); 

}


public function __construct() {

add_action('admin_menu', array($this,"plugin_menu"));
add_action( 'admin_init', array($this,"add_media_from_url"));

add_action( 'plugins_loaded', array($this,"plugins_loaded"));


}

}




$lh_add_media_from_url = new LH_add_media_from_url_plugin();


}


?>