<?php

/* 
Template Name: Rig Single
*/

get_header();
// $content = apply_filters( 'the_content', get_the_content() );
// echo $content;
// $builder_content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( 1119);
// echo $builder_content;
// remove_all_actions('the_content');
        $loop = new WP_Query(array
        ('post_type' => 'rig-template'
         ));

       while ( $loop->have_posts() ) : $loop->the_post();
       $template_type = get_post_meta(get_the_ID(), 'rig_template_type', true);

        if ($template_type == 'page') {
          // the_content($loop->post->ID);
          the_content($loop->post->ID);
        }
   endwhile;
get_footer();