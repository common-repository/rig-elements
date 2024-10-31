<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php echo esc_html(get_option('rig-header-scripts'));?>
	<?php wp_head(); ?>
</head>
<?php the_content(); ?>
<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
