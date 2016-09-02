<?php
/**
 * header.php.
 *
 * The Header for theme.
 * ============================================ *
 */
?>
<!DOCTYPE html>
<!--[if IE 8]><html <?php language_attributes(); ?> class="ie8"><![endif]-->
<!--[if !IE]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="description" content="<?php bloginfo( 'description' ) ?>">
	<!-- Mobile specific meta -->
	<meta name="viewport" content="width=device-width, initioal-scale=1, maximum-scale=1.5">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<!-- Site wrapper -->
	<div class="site-wrap">

		<?php
			pure_get_relevant_header();
			pure_get_breadcrumbs(); 
		?>

		<!-- ====| Main content area |==== -->
		<div class="site-content" id="content">

			<?php do_action( 'pure_site_content_top' ); ?>

			<div class="container">
