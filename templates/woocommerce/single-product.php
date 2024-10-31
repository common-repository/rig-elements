<?php

defined( 'ABSPATH' ) || exit;

get_header();

	$loop = new WP_Query(array
	('post_type' => 'rig-template'
	));

	while ( $loop->have_posts() ) : $loop->the_post();
	$template_type = get_post_meta(get_the_ID(), 'rig_template_type', true);

		
			if ($template_type == 'woo_single_product') {
				// the_content($loop->post->ID);
				the_content($loop->post->ID);
				}
	endwhile;

get_footer();
