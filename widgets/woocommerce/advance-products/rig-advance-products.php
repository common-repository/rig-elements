<?php
		namespace RigElements\Widgets;

		use Timber\Timber;
		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;
		use RigElements\Rig_Ajax_Control;

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Advance_Products extends Widget_Base {


			public function get_name() {
				return 'rig-advance-products';
			}


			public function get_title() {
				return __( 'WooCommerce Products', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-advance-product';
			}


			public function get_categories() {
				return [ 'rig_elements_widgets' ];
			}


			public function get_style_depends() {
				return [ 'core_css','rig-app'];
			}

			public function get_script_depends() {
				return [ 'rig-main','rig-elements' ];
			}


			protected function _register_controls() {

				// Get All WooCommerce Product Category

				$product_cats = array();

				$args = array(
					'taxonomy' => 'product_cat',
					'orderby' => 'name',
					'order' => 'ASC',
					'hide_empty' => false
			   );
			   foreach( get_categories( $args ) as $category ) :

					$product_cats[$category->slug] = $category->name;
					// var_dump($category);
			   endforeach;


			//    Controls Start


			// Product Query Controls

				$this->start_controls_section(
					'rig_advance_products_query_controls',
					[
						'label' => __( 'Product Query', 'plugin-name' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);


				$this->add_control(
					'rig_advance_products_query_type',
					[
						'label' => __( 'Product Query', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'all_products',
						'options' => [
							'all_products'  => __( 'All Products', 'rig-elements' ),
							'category_products'  => __( 'Categorized Products / Product Archive', 'rig-elements' ),
						],
					]
				);

				$this->add_control(
					'rig_advance_products_short_by',
					[
						'label' => __( 'Short By', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => '',
						'options' => [
							''  => __( 'Latest Products', 'rig-elements' ),
							'total_sales'  => __( 'Bestseller / Top Seller Products', 'rig-elements' ),
							'_sale_price'  => __( 'Sale Products', 'rig-elements' ),
							'_wc_rating_count'  => __( 'Highest / Top Rated Products', 'rig-elements' ),
							'_wc_review_count'  => __( 'Highest / Top Reviewd Products', 'rig-elements' ),
							// 'product_category'  => __( 'Categorized Products', 'rig-elements' ),
							// 'solid'  => __( 'Low Stock Products', 'rig-elements' ),
							// 'solid'  => __( 'Virtual & Downloadable Products', 'rig-elements' ),
							// 'solid'  => __( 'Featured Products', 'rig-elements' ),

						],
					]
				);


				$this->add_control(
					'rig_advance_products_category',
					[
						'label' => __( 'Product Category', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => '',
						'options' => $product_cats,
						'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'rig_advance_products_query_type',
                                    'operator' => '!=',
                                    'value' => 'category_products',
                                ],
                            ],
						],
					]
				);


				$this->add_control(
					'rig_advance_products_show_products',
					[
						'label' => __( 'Show Products', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::NUMBER,
						'min' => 1,
						'max' => 500,
						'step' => 1,
						'default' => 12,
					]
				);


				$this->end_controls_section();


				// Product Layout Controls


				$this->start_controls_section(
					'rig_advance_products_layout_controls',
					[
						'label' => __( 'Layout', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				// $this->add_responsive_control(
                //     'rig_advance_products_grid_columns',
                //     [
                //         'label' => __( 'Columns', 'rig-elements' ),
                //         'type' => \Elementor\Controls_Manager::SELECT,
				// 		'devices' => [ 'desktop', 'tablet', 'mobile' ],
				// 		'desktop_default' => '25%',
				// 		'tablet_default'  => '33%',
				// 		'mobile_default'  => '50%',
                //         'options' => [
                //             '100%' => __( '1 Columns', 'rig-elements' ),
				// 			'50%' => __( '2 Columns', 'rig-elements' ),
                //             '33%' => __( '3 Columns', 'rig-elements' ),
                //             '25%' => __( '4 Columns', 'rig-elements' ),
                //             '20%' => __( '5 Columns', 'rig-elements' ),
                //             '16%'  => __( '6 Columns', 'rig-elements' ),
                //         ],

				// 		'selectors' => [
				// 			'{{WRAPPER}} .rig-woo-products' => 'max-width: {{options}};',
				// 		],
                //     ]
                // );


				$this->add_responsive_control(
                    'rig_advance_products_grid_columns',
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


				// Product Image Controls

				$this->start_controls_section(
					'rig_advance_products_image_controls',
					[
						'label' => __( 'Image', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				$this->add_responsive_control(
                    'rig_advance_products_image_fit',
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
							'{{WRAPPER}} .rig-woo-products-img' => 'object-fit: {{options}}',
						],
                    ]
                );


				$this->add_responsive_control(
                    'rig_advance_products_image_width',
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
                            '{{WRAPPER}} .rig-woo-products-img' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );


                $this->add_responsive_control(
                    'rig_advance_products_image_height',
                    [
                        'label' => __( 'Image Height', 'rig-elements' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px'],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 3000,
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
                            '{{WRAPPER}} .rig-woo-products-img' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

				$this->end_controls_section();


				// Product Price Controls

				$this->start_controls_section(
					'rig_advance_products_price_controls',
					[
						'label' => __( 'Price', 'plugin-name' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);


				$this->add_control(
					'rig_advance_products_price_show',
					[
						'label' => __( 'Show Price', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'price_show' => __( 'Show', 'your-plugin' ),
						'price_hide' => __( 'Hide', 'your-plugin' ),
						'return_value' => 'price_show',
						'default' => 'price_show',
					]
				);

				$this->end_controls_section();


				// Product Add To Cart Controls


				$this->start_controls_section(
					'rig_advance_products_cart_button',
					[
						'label' => __( 'Add To Cart Button', 'plugin-name' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);


				$this->add_control(
					'rig_advance_products_cart_button_show',
					[
						'label' => __( 'Show Add To Cart Button', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'button_show' => __( 'Show', 'your-plugin' ),
						'button_hide' => __( 'Hide', 'your-plugin' ),
						'return_value' => 'button_show',
						'default' => 'button_show',
					]
				);


				$this->add_control(
					'rig_advance_products_cart_button_action',
					[
						'label' => __( 'Button Action', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'add_to_cart',
						'options' => [
							'add_to_cart'  => __( 'Add Product To Cart', 'rig-elements' ),
							'product_details'  => __( 'Go To Product Details', 'rig-elements' ),
						],
						'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'rig_advance_products_cart_button_show',
                                    'operator' => '==',
                                    'value' => 'button_show',
                                ],
                            ],
                        ],
					]
				);


				$this->add_control(
					'rig_advance_products_cart_button_text',
					[
						'label' => __( 'Cart Button Text', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => __( 'Add To Cart', 'rig-elements' ),
						'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'rig_advance_products_cart_button_show',
                                    'operator' => '==',
                                    'value' => 'button_show',
                                ],
                            ],
                        ],
						// 'placeholder' => __( 'Type your title here', 'rig-elements' ),
					]
				);


                $this->end_controls_section();


				/* Style Controls */


				// Product Container Styles

				$this->start_controls_section(
					'rig_advance_products_container_style',
					[
						'label' => __( 'Product Container', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);


				$this->add_responsive_control(
					'rig_advance_products_column_gap',
					[
						'label' => __( 'Product Column Gap', 'rig-elements' ),
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
					'rig_advance_products_row_gap',
					[
						'label' => __( 'Product Row Gap', 'rig-elements' ),
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
					'rig_advance_products_background_color',
					[
						'label' => __( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->start_controls_tabs(
						'rig_advance_products_border_controls'
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
							'name' => 'rig_advance_products_border_normal',
							'label' => __( 'Border', 'rig-elements' ),
							'selector' => '{{WRAPPER}} .rig-woo-products',
						]
					);

					$this->add_control(
						'products_border_radius_normal',
						[
							'label' => __( 'Border Radius', 'rig-elements' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} .rig-woo-products' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);


					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'products_box_shadow_normal',
							'label' => __( 'Box Shadow', 'rig-elements' ),
							'selector' => '{{WRAPPER}} .rig-woo-products',
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
							'name' => 'rig_advance_products_border_hover',
							'label' => __( 'Border', 'rig-elements' ),
							'selector' => '{{WRAPPER}} .rig-woo-products:hover',
						]
					);


					$this->add_control(
						'products_border_radius_hover',
						[
							'label' => __( 'Border Radius', 'rig-elements' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} .rig-woo-products:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);


					$this->add_group_control(
						\Elementor\Group_Control_Box_Shadow::get_type(),
						[
							'name' => 'products_box_shadow_hover',
							'label' => __( 'Box Shadow', 'rig-elements' ),
							'selector' => '{{WRAPPER}} .rig-woo-products:hover',
						]
					);


				$this->end_controls_tab();

				$this->end_controls_tabs();


				$this->end_controls_section();


				// Product Name Styles

				$this->start_controls_section(
					'rig_advance_products_product_name_style',
					[
						'label' => __( 'Product Name', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_advance_products_product_name_typography',
						'label' => __( 'Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-woo-products-name',
					]
				);


				$this->add_responsive_control(
					'rig_advance_products_product_name_alignment',
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
							'{{WRAPPER}} .rig-woo-products-name' => 'float: {{VALUE}};',
						],
					]
				);


	                $this->add_control(
						'rig_advance_products_product_name_color',
						[
							'label' => __( 'Color', 'rig-elements' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .rig-woo-products-name' => 'color: {{VALUE}}',
							],
						]
					);


				$this->add_responsive_control(
			'rig_advance_products_product_name_margin',
			[
				'label' => __( 'Margin', 'rig-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rig-woo-products-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

				$this->add_responsive_control(
			'rig_advance_products_product_name_padding',
			[
				'label' => __( 'Padding', 'rig-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rig-woo-products-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

                $this->end_controls_section();


                // Product Price Styles

                $this->start_controls_section(
					'rig_advance_products_product_price_style',
					[
						'label' => __( 'Product Price', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_advance_products_product_price_typography',
						'label' => __( 'Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-woo-products-price',
					]
				);


				$this->add_responsive_control(
					'rig_advance_products_product_price_alignment',
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
							'{{WRAPPER}} .rig-woo-products-price' => 'float: {{VALUE}};',
						],
					]
				);

          $this->add_control(
					'rig_advance_products_product_price_color',
					[
						'label' => __( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-price' => 'color: {{VALUE}}',
						],
					]
				);


							$this->add_responsive_control(
						'rig_advance_products_product_price_margin',
						[
							'label' => __( 'Margin', 'rig-elements' ),
							'type' => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors' => [
								'{{WRAPPER}} .rig-woo-products-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_responsive_control(
				'rig_advance_products_product_price_padding',
				[
					'label' => __( 'Margin', 'rig-elements' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .rig-woo-products-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


				$this->end_controls_section();


				// Product Image Styles

				$this->start_controls_section(
					'rig_advance_products_image_style',
					[
						'label' => __( 'Product Image', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_responsive_control(
					'rig_advance_products_image_margin',
					[
						'label' => __( 'Image Margin', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'rig_advance_products_image_padding',
					[
						'label' => __( 'Image Padding', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'rig_advance_products_image_background_color',
					[
						'label' => __( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-img' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->start_controls_tabs(
					'rig_advance_products_image_border_controls'
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
							'{{WRAPPER}} .rig-woo-products-img' => 'border-style: {{options}};',
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
							'{{WRAPPER}} .rig-woo-products-img' => 'border-width: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .rig-woo-products-img' => 'border-color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'rig_advance_products_image_border_radius_normal',
					[
						'label' => __( 'Border Radius', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'rig_advance_products_image_box_shadow_normal',
					'label' => __( 'Box Shadow', 'rig-elements' ),
					'selector' => '{{WRAPPER}} .rig-woo-products-img',
				]
		);


				$this->end_controls_tab();

				$this->end_controls_tabs();


				$this->end_controls_section();


                // Add To Cart Button


				$this->start_controls_section(
					'rig_advance_products_cart_button_styles',
					[
						'label' => __( 'Add To Cart Button', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
                );


                $this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'add_to_cart_button_typography',
						'label' => __( 'Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-woo-products-button',
					]
				);

				$this->add_responsive_control(
					'add_to_cart_button_width',
					[
						'label' => __( 'Button Width', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_control(
					'add_to_cart_button_color_controls_seperator',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);

				// Add To Cart Button Color Controls

				$this->start_controls_tabs(
					'add_to_cart_button_color_controls'
				);


				// Normal Color

				$this->start_controls_tab(
					'add_to_cart_button_color_normal_controls',
					[
						'label' => __( 'Normal', 'rig-elements' ),
					]
				);

				$this->add_control(
					'add_to_cart_button_text_color',
					[
						'label' => __( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-button' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'add_to_cart_button_background_color',
					[
						'label' => __( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-button' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->end_controls_tab();



				// Hover Color

				$this->start_controls_tab(
					'add_to_cart_button_color_hover_controls',
					[
						'label' => __( 'Hover', 'rig-elements' ),
					]
				);


				$this->add_control(
					'add_to_cart_button_text_hover_color',
					[
						'label' => __( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-button:hover' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'add_to_cart_button_background_hover_color',
					[
						'label' => __( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-button:hover' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->end_controls_tab();


				$this->end_controls_tabs();


				// Add To Cart Button Border Controls


				$this->add_control(
					'add_to_cart_button_border_controls_seperator',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);

				$this->start_controls_tabs(
					'add_to_cart_button_border_controls'
				);


				// Normal Controls

				$this->start_controls_tab(
					'add_to_cart_button_border_normal_controls',
					[
						'label' => __( 'Normal', 'rig-elements' ),
					]
				);

				$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'add_to_cart_button_border',
						'label' => __( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-woo-products-button',
					]
				);


				$this->add_control(
					'add_to_cart_button_border_radius',
					[
						'label' => __( 'Border Radius', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'add_to_cart_button_box_shadow',
					'label' => __( 'Box Shadow', 'rig-elements' ),
					'selector' => '{{WRAPPER}} .rig-woo-products-button',
				]
		);

				$this->end_controls_tab();


				$this->start_controls_tab(
					'add_to_cart_button_border_hover_controls',
					[
						'label' => __( 'Hover', 'rig-elements' ),
					]
				);


				$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'add_to_cart_button_border_hover',
						'label' => __( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-woo-products-button:hover',
					]
				);

				$this->add_control(
					'add_to_cart_button_border_hover_radius',
					[
						'label' => __( 'Border Radius', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-woo-products-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'add_to_cart_button_box_shadow_hover',
					'label' => __( 'Box Shadow', 'rig-elements' ),
					'selector' => '{{WRAPPER}} .rig-woo-products-button:hover',
				]
		);

				$this->end_controls_tab();

				$this->end_controls_tabs();

				$this->end_controls_section();

			}


			protected function render() {
				$settings = $this->get_settings_for_display();
				$query_type = $settings['rig_advance_products_query_type'];
				
				if ($query_type == 'all_products') {
					global $wp_query;

					$args = array(
						'post_type'        => 'product',
						'meta_key' => $settings['rig_advance_products_short_by'],
						'orderby' => 'meta_value_num',
						'product_cat' => $settings['rig_advance_products_category'],
						'posts_per_page'   => $settings['rig_advance_products_show_products'],
					);
				}

				elseif ($query_type == 'category_products') {
					global $wp;
					$current_category = $wp->query_vars['product_cat'];
					
					if (isset($current_category)){
						$args = array(
							'post_type'        => 'product',
							'meta_key' => $settings['rig_advance_products_short_by'],
							'orderby' => 'meta_value_num',
							'product_cat' => $current_category,
							'posts_per_page'   => $settings['rig_advance_products_show_products'],
						);
					}

					else {
						return 0;
					}

				}

				else {
					return 0;
				}

                $loop = new \WP_Query( $args );
				global $product;

                ?>
               <div id="rig-adpr" class="rig-container grid mobile:grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-1" data-js-filter="target">

                <?php

                while ( $loop->have_posts() ) : $loop->the_post();
				global $product;


				$add_to_cart_button = $this->rig_advanced_products_add_to_cart();
				$product_price = $this->rig_advanced_products_price();

				echo '
                    <div class="rig-woo-products">
					<a href='.get_post_permalink($loop->ID).'>
                    <img class="rig-woo-products-img" src='.get_the_post_thumbnail_url($loop->ID).' alt="Avatar">
					</a>
                    <p class="rig-woo-products-name">'.esc_html($product->get_name()).'</p>'
					.$product_price.$add_to_cart_button.'</div>';


            endwhile;
			wp_reset_postdata();
			
			echo "</div>";

		}


			protected function rig_advanced_products_price() {
				global $product;
				$store_currency = get_woocommerce_currency_symbol();
				$settings = $this->get_settings_for_display();

				$price_condition = $settings['rig_advance_products_price_show'];

				if ($price_condition == 'price_show') {
					$product_price = '<p lang="bn" class="rig-woo-products-price">'.$store_currency.$product->get_price().'</p>';
				}

				else {
					$product_price = '';
				}

				return $product_price;

			}


			protected function rig_advanced_products_add_to_cart() {
				global $product;

				$settings = $this->get_settings_for_display();
				$button_condition = $settings['rig_advance_products_cart_button_show'];
				$button_action = $settings['rig_advance_products_cart_button_action'];
				$button_text = $settings['rig_advance_products_cart_button_text'];

				if ($button_condition == 'button_show' && $button_action == 'add_to_cart') {
					$add_to_cart_button = '<form action="'.esc_url( $product->add_to_cart_url() ).'" method="post" enctype="multipart/form-data">
					<button type="submit" name="rig_advance_products_cart_button" class="rig-woo-products-button">'.$settings['rig_advance_products_cart_button_text'].'</button></form>';
				}

				elseif ($button_condition == 'button_show' && $button_action == 'product_details') {
					$add_to_cart_button = '<form action="'.get_post_permalink($loop->ID).'" method="post" enctype="multipart/form-data">
					<button type="submit" name="rig_advance_products_cart_button" class="rig-woo-products-button">'.$settings['rig_advance_products_cart_button_text'].'</button></form>';
				}

				else {
					$add_to_cart_button = '';
				}

				return $add_to_cart_button;
			}


		}
