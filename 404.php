<?php
	/**
	 * The template for displaying 404 pages (Not Found)
	 *
	 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
	 *
	 * @package 	WordPress
	 * @subpackage 	Starkers
	 * @since 		Starkers 4.0
	 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<!-- Content Information -->
<div class="container-fluid" id="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<h1 class="has-title">You have reached a missing page!</h1>
            <p>Please return to the previous link by clicking <a href="javascript:history.back()">here</a>.</p>
        <!-- end .col-md-10 --></div>
    <!-- end .row --></div>
<!-- end #content --></div>


<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>