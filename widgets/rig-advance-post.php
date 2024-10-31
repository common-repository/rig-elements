<?php
		namespace RigElements\Widgets;

		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Advance_Post extends Widget_Base {


			public function get_name() {
				return 'rig-advance-post';
			}


			public function get_title() {
				return __( 'Blog Post', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-advance-post';
			}


			public function get_categories() {
				return [ 'rig_elements_widgets' ];
			}


			public function get_style_depends() {
				return ['rig-app'];
			}

			public function get_script_depends() {
				return [ 'rig-main' ];
			}


			protected function _register_controls() {

				// Get All Post Category
				

				$post_cat = array();

				$args = array(
					'orderby' => 'name',
					'order' => 'ASC',
					'hide_empty' => false
			   );
			   foreach( get_categories( $args ) as $category ) :
					$post_cat[$category->slug] = $category->name;
			   endforeach;


			//    Controls Start


			// Product Query Controls

				$this->start_controls_section(
					'rig_advance_posts_query_controls',
					[
						'label' => __( 'Post Query', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);


				$this->add_control(
					'rig_advance_posts_query_type',
					[
						'label' => __( 'Post Query', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'all_posts',
						'options' => [
							'all_posts'  => __( 'All Posts', 'rig-elements' ),
							'category_posts'  => __( 'Categorized Posts / Post Archive', 'rig-elements' ),
						],
					]
				);

				$this->add_control(
					'rig_advance_posts_short_by',
					[
						'label' => __( 'Short By', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => '',
						'options' => [
							'DESC'  => __( 'Latest Posts', 'rig-elements' ),
                            'ASC'  => __( 'Oldest Posts', 'rig-elements' ),
                            'date'  => __( 'Date', 'rig-elements' ),
                            'comment_count'  => __( 'Comment Count', 'rig-elements' ),
                            'author'  => __( 'Author', 'rig-elements' ),
						],
					]
				);


				$this->add_control(
					'rig_advance_posts_category',
					[
						'label' => __( 'Post Category', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => '',
						'options' => $post_cat,
						'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'rig_advance_posts_query_type',
                                    'operator' => '!=',
                                    'value' => 'category_products',
                                ],
                            ],
						],
					]
				);


				$this->add_control(
					'rig_advance_posts_show_products',
					[
						'label' => __( 'Show Posts', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'min' => 1,
						'max' => 500,
						'step' => 1,
						'default' => 12,
					]
				);


				$this->end_controls_section();


				// Post Layout Controls


				$this->start_controls_section(
					'rig_advance_posts_layout_controls',
					[
						'label' => __( 'Layout', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);


				$this->add_responsive_control(
                    'rig_advance_posts_grid_columns',
                    [
                        'label' => __( 'Columns', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
						'devices' => [ 'desktop', 'tablet', 'mobile' ],
						'desktop_default' => 'auto auto auto auto',
						'tablet_default'  => 'auto auto auto',
						'mobile_default'  => 'auto auto',
                        'options' => [
                            'auto' => __( '1 Columns', 'rig-elements' ),
							'auto auto' => __( '2 Columns', 'rig-elements' ),
                            'auto auto auto' => __( '3 Columns', 'rig-elements' ),
                            'auto auto auto auto' => __( '4 Columns', 'rig-elements' ),
                            'auto auto auto auto auto' => __( '5 Columns', 'rig-elements' ),
                            'auto auto auto auto auto auto'  => __( '6 Columns', 'rig-elements' ),
                        ],

						'selectors' => [
							'{{WRAPPER}} .rig-container' => 'grid-template-columns: {{options}};',
						],
                    ]
                );

				$this->end_controls_section();


				// Post Excerpt Control


				$this->start_controls_section(
					'rig_advance_posts_excerpt_controls',
					[
						'label' => __( 'Post Excerpt', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);


				$this->add_control(
					'rig_advance_posts_excerpt_length',
					[
						'label' => __( 'Excerpt Length', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'min' => 1,
						'max' => 500,
						'step' => 1,
						'default' => 20,
					]
				);


				$this->end_controls_section();


				// Product Image Controls

				$this->start_controls_section(
					'rig_advance_posts_image_controls',
					[
						'label' => __( 'Image', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				$this->add_responsive_control(
                    'rig_advance_posts_image_fit',
                    [
                        'label' => __( 'Image Fit', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
						'devices' => [ 'desktop', 'tablet', 'mobile' ],
						'desktop_default' => 'contain',
						'tablet_default'  => 'contain',
						'mobile_default'  => 'contain',
                        'options' => [
                            'contain'  => __( 'Contain', 'rig-elements' ),
                            'cover' => __( 'Cover', 'rig-elements' ),
                            'auto' => __( 'Auto', 'rig-elements' ),
                            'fill' => __( 'Fill', 'rig-elements' ),
                            'none' => __( 'None', 'rig-elements' ),
                        ],

						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-img' => 'object-fit: {{options}}',
						],
                    ]
                );


				$this->add_responsive_control(
                    'rig_advance_posts_image_width',
                    [
                        'label' => __( 'Image Width', 'rig-elements' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 500,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'desktop_default' => [
                            'unit' => '%',
                            'size' => 100,
                        ],
						'tablet_default' => [
                            'unit' => '%',
                            'size' => 100,
                        ],
						'mobile_default' => [
                            'unit' => '%',
                            'size' => 100,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rig-advance-post-img' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );


                $this->add_responsive_control(
                    'rig_advance_posts_image_height',
                    [
                        'label' => __( 'Image Height', 'rig-elements' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px'],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 500,
                                'step' => 1,
                            ],
                        ],
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => 250,
                        ],
						'tablet_default' => [
                            'unit' => 'px',
                            'size' => 200,
                        ],
						'mobile_default' => [
                            'unit' => 'px',
                            'size' => 150,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rig-advance-post-img' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

				$this->end_controls_section();


				/* Style Controls */


				// Product Container Styles

				$this->start_controls_section(
					'rig_advance_posts_container_style',
					[
						'label' => __( 'Post Container', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);


				$this->add_responsive_control(
					'rig_advance_posts_column_gap',
					[
						'label' => __( 'Post Column Gap', 'rig-elements' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px'],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
								'step' => 1,
							],
						],
						'desktop_default' => [
							'unit' => 'px',
							'size' => 15,
						],
						'tablet_default' => [
							'unit' => 'px',
							'size' => 10,
						],
						'mobile_default' => [
							'unit' => 'px',
							'size' => 5,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-container' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'rig_advance_posts_row_gap',
					[
						'label' => __( 'Post Row Gap', 'rig-elements' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px'],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
								'step' => 1,
							],
						],
						'desktop_default' => [
							'unit' => 'px',
							'size' => 15,
						],
						'tablet_default' => [
							'unit' => 'px',
							'size' => 10,
						],
						'mobile_default' => [
							'unit' => 'px',
							'size' => 5,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-container' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_control(
					'rig_advance_posts_background_color',
					[
						'label' => __( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-bg' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->start_controls_tabs(
						'rig_advance_posts_border_controls'
		);

				$this->start_controls_tab(
						'products_border_controls_normal_tab',
						[
							'label' => __( 'Normal', 'rig-elements' ),
						]
		);

				$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'rig_advance_posts_border_normal',
							'label' => __( 'Border', 'rig-elements' ),
							'selector' => '{{WRAPPER}} .rig-advance-post',
						]
					);

					$this->add_control(
						'products_border_radius_normal',
						[
							'label' => __( 'Border Radius', 'rig-elements' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} .rig-advance-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);


					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'products_box_shadow_normal',
							'label' => __( 'Box Shadow', 'rig-elements' ),
							'selector' => '{{WRAPPER}} .rig-advance-post',
						]
					);

				$this->end_controls_tab();


				$this->start_controls_tab(
						'products_border_controls_hover_tab',
						[
							'label' => __( 'Hover', 'rig-elements' ),
						]
		);

				$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'rig_advance_posts_border_hover',
							'label' => __( 'Border', 'rig-elements' ),
							'selector' => '{{WRAPPER}} .rig-advance-post:hover',
						]
					);


					$this->add_control(
						'products_border_radius_hover',
						[
							'label' => __( 'Border Radius', 'rig-elements' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} .rig-advance-post:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);


					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'products_box_shadow_hover',
							'label' => __( 'Box Shadow', 'rig-elements' ),
							'selector' => '{{WRAPPER}} .rig-advance-post:hover',
						]
					);


				$this->end_controls_tab();

				$this->end_controls_tabs();


				$this->end_controls_section();


				// Product Name Styles

				$this->start_controls_section(
					'rig_advance_posts_name_style',
					[
						'label' => __( 'Post Name', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_advance_posts_name_typography',
						'label' => __( 'Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-advance-post-name',
					]
				);


				$this->add_responsive_control(
					'rig_advance_posts_name_alignment',
					[
						'label' => __( 'Alignment', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'options' => [
							'left' => [
								'title' => __( 'Left', 'rig-elements' ),
								'icon' => 'fa fa-align-left',
							],
							'center' => [
								'title' => __( 'Center', 'rig-elements' ),
								'icon' => 'fa fa-align-center',
							],
							'right' => [
								'title' => __( 'Right', 'rig-elements' ),
								'icon' => 'fa fa-align-right',
							],
						],
						'default' => 'center',
						'devices' => [ 'desktop', 'tablet' ],
						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-name' => 'text-align: {{VALUE}};',
						],
					]
				);


	                $this->add_control(
						'rig_advance_posts_name_color',
						[
							'label' => __( 'Color', 'rig-elements' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .rig-advance-post-name' => 'color: {{VALUE}}',
							],
						]
					);


				$this->add_responsive_control(
			'rig_advance_posts_name_margin',
			[
				'label' => __( 'Margin', 'rig-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rig-advance-post-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

				$this->add_responsive_control(
			'rig_advance_posts_name_padding',
			[
				'label' => __( 'Padding', 'rig-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rig-advance-post-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

                $this->end_controls_section();


                // Product Price Styles

                $this->start_controls_section(
					'rig_advance_posts_description_style',
					[
						'label' => __( 'Post Description', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_advance_posts_description_typography',
						'label' => __( 'Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-advance-post-description',
					]
				);


				$this->add_responsive_control(
					'rig_advance_posts_description_alignment',
					[
						'label' => __( 'Alignment', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'options' => [
							'left' => [
								'title' => __( 'Left', 'rig-elements' ),
								'icon' => 'fa fa-align-left',
							],
							'center' => [
								'title' => __( 'Center', 'rig-elements' ),
								'icon' => 'fa fa-align-center',
							],
							'right' => [
								'title' => __( 'Right', 'rig-elements' ),
								'icon' => 'fa fa-align-right',
							],
						],
						'default' => 'center',
						'devices' => [ 'desktop', 'tablet' ],
						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-description' => 'text-align: {{VALUE}};',
						],
					]
				);

          $this->add_control(
					'rig_advance_posts_description_color',
					[
						'label' => __( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-description' => 'color: {{VALUE}}',
						],
					]
				);


							$this->add_responsive_control(
						'rig_advance_posts_description_margin',
						[
							'label' => __( 'Margin', 'rig-elements' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} .rig-advance-post-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_responsive_control(
				'rig_advance_posts_description_padding',
				[
					'label' => __( 'Padding', 'rig-elements' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .rig-advance-post-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


				$this->end_controls_section();


				// Product Image Styles

				$this->start_controls_section(
					'rig_advance_posts_image_style',
					[
						'label' => __( 'Post Image', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_responsive_control(
					'rig_advance_posts_image_margin',
					[
						'label' => __( 'Image Margin', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'rig_advance_posts_image_padding',
					[
						'label' => __( 'Image Padding', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'rig_advance_posts_image_background_color',
					[
						'label' => __( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-img' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->start_controls_tabs(
					'rig_advance_posts_image_border_controls'
				);

				$this->start_controls_tab(
					'image_border_normal',
					[
						'label' => __( 'Normal', 'rig-elements' ),
					]
				);

				$this->add_responsive_control(
					'image_border_style',
					[
						'label' => __( 'Border Style', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'none',
						'options' => [
							'solid'  => __( 'Solid', 'plugin-domain' ),
							'dashed' => __( 'Dashed', 'plugin-domain' ),
							'dotted' => __( 'Dotted', 'plugin-domain' ),
							'double' => __( 'Double', 'plugin-domain' ),
							'none' => __( 'None', 'plugin-domain' ),
						],
						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-img' => 'border-style: {{options}};',
						],
					]
				);

				$this->add_responsive_control(
					'image_border_width',
					[
						'label' => __( 'Width', 'rig-elements' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 500,
								'step' => 1,
							],
							'em' => [
								'min' => 0,
								'max' => 500,
								'step' => 1,
							],
						],
						'desktop_default' => [
							'unit' => 'px',
							'size' => 1,
						],
						'tablet_default' => [
							'unit' => 'px',
							'size' => 1,
						],
						'mobile_default' => [
							'unit' => 'px',
							'size' => 1,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-img' => 'border-width: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'image_border_color',
					[
						'label' => __( 'Border Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'desktop_default' => '#F66E49',
						'tablet_default' => '#F66E49',
						'mobile_default' => '#F66E49',
						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-img' => 'border-color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'rig_advance_posts_image_border_radius_normal',
					[
						'label' => __( 'Border Radius', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-advance-post-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'rig_advance_posts_image_box_shadow_normal',
					'label' => __( 'Box Shadow', 'rig-elements' ),
					'selector' => '{{WRAPPER}} .rig-advance-post-img',
				]
		);


				$this->end_controls_tab();

				$this->end_controls_tabs();


				$this->end_controls_section();
			}


			protected function render() {
				$settings = $this->get_settings_for_display();
				$query_type = $settings['rig_advance_posts_query_type'];
				$post_excerpt_length = $settings['rig_advance_posts_excerpt_length']; 

				if ($query_type == 'all_posts') {

					global $wp_query;

					$args = array(
						'post_type'        => 'post',
						'meta_key' => $settings['rig_advance_posts_short_by'],
						'orderby' => 'meta_value_num',
						'category_name' => $settings['rig_advance_posts_category'],
						'posts_per_page'   => $settings['rig_advance_posts_show_products'],
					);
				}

				elseif ($query_type == 'category_products') {
					global $wp;
					$current_category = $wp->query_vars['product_cat'];
					
					if (isset($current_category)){
						$args = array(
							'post_type'        => 'post',
							'meta_key' => $settings['rig_advance_posts_short_by'],
							'orderby' => 'meta_value_num',
							'product_cat' => $current_category,
							'posts_per_page'   => $settings['rig_advance_posts_show_products'],
						);
					}

					else {
						return 0;
					}

				}

				else {
					return 0;
				}

                // $products = get_posts( $args );
                $loop = new \WP_Query( $args );
                ?>

		  	<section>
            <div class="relative">
            <div class="relative mx-auto max-w-7xl">
            <div class="grid max-w-lg gap-5 mx-auto lg:grid-cols-3 lg:max-w-none rig-container">
				
                <?php
                while ( $loop->have_posts() ) : $loop->the_post();
			echo'

			<div class="flex flex-col overflow-hidden rounded-lg shadow-lg rig-advance-post">
			
			<div class="flex-shrink-0">
			<img class="rig-advance-post-img object-cover w-full h-48" src="'.get_the_post_thumbnail_url($loop->ID).'" alt="">
			</div>
			<div class="flex flex-col justify-between flex-1 p-6 bg-white rig-advance-post-bg">
          		<div class="flex-1">
                <a href="'.get_permalink($loop->ID).'" class="block mt-2">
                <p class="rig-advance-post-name text-xl font-semibold text-neutral-600">'.get_the_title($loop->ID).'</p>
                <p class="rig-advance-post-description mt-3 text-base text-gray-500">'.wp_trim_words(get_the_excerpt($loop->ID),$num_words = $post_excerpt_length,$more = '' ).'</p>
                </a>
                </div>
            </div>
            </div>';
            endwhile;
			wp_reset_postdata();

			echo "</div>
            </div>
        	</div>
          	</section>";

		}


		}
