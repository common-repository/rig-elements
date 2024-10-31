<?php
        namespace RigElements\Widgets;

        use Timber\Timber;
        use Elementor\Widget_Base;
        use Elementor\Controls_Manager;

        if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


        class Rig_Price_Table extends Widget_Base {


            public function get_name() {
                return 'rig-price-table';
            }


            public function get_title() {
                return __( 'Price Table', 'rig-elements' );
            }


            public function get_icon() {
                return 'rig-price-table';
            }


            public function get_categories() {
                return [ 'rig_elements_widgets' ];
            }


            public function get_style_depends() {
                return [ 'rig-app'];
            }

            public function get_script_depends() {
                return [ 'rig-elements' ];
            }


            protected function _register_controls() {

                // Content Controls

                // Table Image

                $this->start_controls_section(
                    'rig_price_table_image',
                    [
                        'label' => __( 'Image', 'rig-elements' ),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'price_table_image_enable',
                    [
                        'label' => __( 'Show Image', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'enable_image' => __( 'Enable', 'rig-elements' ),
                        'disable_image' => __( 'Disable', 'rig-elements' ),
                        'return_value' => 'enable_image',
                        'default' => 'disable_image',
                    ]
                );

                $this->add_control(
                    'price_table_image',
                    [
                        'label' => esc_html__( 'Choose Image', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                        'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'price_table_image_enable',
                                    'operator' => '==',
                                    'value' => 'enable_image',
                                ],
                            ],
                        ],
                    ]
                );

                $this->end_controls_section();

                // Table Header
                
                $this->start_controls_section(
                    'rig_price_table_table_header',
                    [
                        'label' => __( 'Header', 'rig-elements' ),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'price_table_title',
                    [
                        'label' => __( 'Table Title', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __( 'Startup', 'rig-elements' ),
                        'placeholder' => __( 'Type your title here', 'rig-elements' ),
                    ]
                );

                $this->add_control(
                    'price_table_description_enable',
                    [
                        'label' => __( 'Show Description', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'enable' => __( 'Enable', 'rig-elements' ),
                        'disable' => __( 'Disable', 'rig-elements' ),
                        'return_value' => 'enable',
                        'default' => 'enable',
                    ]
                );

                $this->add_control(
                    'price_table_description_before',
                    [
                        'label' => __( 'Table Description (Before Price)', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __( 'A plan that scales with your rapidly growing business.', 'rig-elements' ),
                        'placeholder' => __( 'Type your title here', 'rig-elements' ),
                        'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'price_table_description_enable',
                                    'operator' => '==',
                                    'value' => 'enable',
                                ],
                            ],
                        ],
                    ]
                );


				$this->add_control(
                    'price_table_description_after',
                    [
                        'label' => __( 'Table Description (After Price)', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __( 'A plan that scales with your rapidly growing business.', 'rig-elements' ),
                        'placeholder' => __( 'Type your title here', 'rig-elements' ),
                        'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'price_table_description_enable',
                                    'operator' => '==',
                                    'value' => 'enable',
                                ],
                            ],
                        ],
                    ]
                );

                
                $this->end_controls_section();

                
                // Table Pricing

                $this->start_controls_section(
                    'rig_price_table_pricing',
                    [
                        'label' => __( 'Pricing', 'rig-elements' ),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'price_table_currency',
                    [
                        'label' => __( 'Currency', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __( '$', 'rig-elements' ),
                        'placeholder' => __( 'Type your currency here', 'rig-elements' ),
                    ]
                );

                $this->add_control(
                    'price_table_price',
                    [
                        'label' => __( 'Price', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __( '35', 'rig-elements' ),
                        'placeholder' => __( 'Type your price here', 'rig-elements' ),
                    ]
                );

                $this->add_control(
                    'price_table_period',
                    [
                        'label' => __( 'Period', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __( '/Per Month', 'rig-elements' ),
                        'placeholder' => __( 'Type your period here', 'rig-elements' ),
                    ]
                );
                
                $this->end_controls_section();


                // Table Features
                
                $this->start_controls_section(
                    'rig_price_table_features',
                    [
                        'label' => __( 'Feature', 'rig-elements' ),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );
        
                $feature_list = new \Elementor\Repeater();

                $feature_list->add_control(
                    'price_table_feature_text',
                    [
                        'label' => __( 'Feature Text', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'rows' => 3,
                        'default' => __( 'Default description', 'rig-elements' ),
                        'placeholder' => __( 'Type your description here', 'rig-elements' ),
                    ]
                );

                $feature_list->add_control(
                    'price_table_feature_icon',
                    [
                        'label' => esc_html__( 'Feature Icon', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'default' => [
                            'value' => 'fas fa-star',
                            'library' => 'solid',
                        ],
                    ]
                );

                $this->add_control(
                    'price_table_feature_list',
                    [
                        'label' => __( 'Features List', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => $feature_list->get_controls(),
                        'default' => [
                            [
                                'price_table_feature_icon' => __( 'fas fa-check', 'rig-elements' ),
                                'price_table_feature_text' => __( 'Awesome Feature', 'rig-elements' ),
                            ],
                            [
                                'price_table_feature_icon' => __( 'Title #2', 'rig-elements' ),
                                'price_table_feature_text' => __( 'Exciting Feature', 'rig-elements' ),
                            ],
                            [
                                'price_table_feature_icon' => __( 'Title #3', 'rig-elements' ),
                                'price_table_feature_text' => __( 'Exciting Feature', 'rig-elements' ),
                            ],
                        ],
                    ]
                );
        
                $this->end_controls_section();


                // Table Button

                $this->start_controls_section(
                    'price_table_button',
                    [
                        'label' => __( 'Button', 'rig-elements' ),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );

                $this->add_control(
                    'price_table_button_enable',
                    [
                        'label' => __( 'Show Button', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'enable_button' => __( 'Enable', 'rig-elements' ),
                        'disable_button' => __( 'Disable', 'rig-elements' ),
                        'return_value' => 'enable_button',
                        'default' => 'enable_button',
                    ]
                );

                $this->add_control(
                    'price_table_button_text',
                    [
                        'label' => __( 'Button Text', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __( 'Click Here', 'rig-elements' ),
                        'placeholder' => __( 'Type your text here', 'rig-elements' ),
                        'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'price_table_button_enable',
                                    'operator' => '==',
                                    'value' => 'enable_button',
                                ],
                            ],
                        ], 
                    ]
                );


                $this->add_control(
                    'price_table_button_link',
                    [
                        'label' => __( 'Button Link', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'placeholder' => __( 'https://your-link.com', 'rig-elements' ),
                        'show_external' => true,
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                            
                        ],
                        'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'price_table_button_enable',
                                    'operator' => '==',
                                    'value' => 'enable_button',
                                ],
                            ],
                        ], 
                        'dynamic' => [
                            'active' => true
                        ],
                    ]
                );

                $this->end_controls_section();


                // Style Controls

                //  Container

				$this->start_controls_section(
					'price_table_container_style',
					[
						'label' => __( 'Container', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_control(
					'price_table_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'price_table_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'card_border',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-price-table',
					]
				);


				$this->add_control(
					'price_table_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'card_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-price-table',
					]
				);

				$this->end_controls_section();


				//  Image

				$this->start_controls_section(
					'price_table_image_style',
					[
						'label' => __( 'Image', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);


				$this->add_responsive_control(
                    'price_table_image_width',
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
                        'selectors' => [
                            '{{WRAPPER}} .rig-price-table-image' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );


                $this->add_responsive_control(
                    'price_table_image_height',
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
                        'selectors' => [
                            '{{WRAPPER}} .rig-price-table-image' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );


				$this->add_responsive_control(
					'price_table_image_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'price_table_image_border',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-price-table-image',
					]
				);


				$this->add_control(
					'price_table_image_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'price_table_image_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-price-table-image',
					]
				);
		


				$this->end_controls_section();


				// Price Table Title

				$this->start_controls_section(
					'price_table_title_style',
					[
						'label' => __( 'Title', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'price_table_title_typography',
						'selector' => '{{WRAPPER}} .rig-price-table-title',
					]
				);

				$this->add_control(
					'price_table_title_color',
					[
						'label' => esc_html__( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-title' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'price_table_title_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-title' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->add_responsive_control(
					'price_table_title_align',
					[
						'label' => esc_html__( 'Alignment', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'options' => [
							'left' => [
								'title' => esc_html__( 'Left', 'rig-elements' ),
								'icon' => 'fa fa-align-left',
							],
							'center' => [
								'title' => esc_html__( 'Center', 'rig-elements' ),
								'icon' => 'fa fa-align-center',
							],
							'right' => [
								'title' => esc_html__( 'Right', 'rig-elements' ),
								'icon' => 'fa fa-align-right',
							],
						],
						'default' => 'left',
						'toggle' => true,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-title' => 'text-align: {{VALUE}}',
						],
					]
				);


				$this->add_responsive_control(
					'price_table_title_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->end_controls_section();



				// Price Table Description

				$this->start_controls_section(
					'price_table_description_style',
					[
						'label' => __( 'Description', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'price_table_description_typography',
						'selector' => '{{WRAPPER}} .rig-price-table-description',
					]
				);

				$this->add_control(
					'price_table_description_color',
					[
						'label' => esc_html__( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-description' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'price_table_description_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-description' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->add_responsive_control(
					'price_table_description_align',
					[
						'label' => esc_html__( 'Alignment', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'options' => [
							'left' => [
								'title' => esc_html__( 'Left', 'rig-elements' ),
								'icon' => 'fa fa-align-left',
							],
							'center' => [
								'title' => esc_html__( 'Center', 'rig-elements' ),
								'icon' => 'fa fa-align-center',
							],
							'right' => [
								'title' => esc_html__( 'Right', 'rig-elements' ),
								'icon' => 'fa fa-align-right',
							],
						],
						'default' => 'left',
						'toggle' => true,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-description' => 'text-align: {{VALUE}}',
						],
					]
				);


				$this->add_responsive_control(
					'price_table_description_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->end_controls_section();


                // Price Table Price

				$this->start_controls_section(
					'price_table_price_style',
					[
						'label' => __( 'Price', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'label' => __( 'Price Typography', 'rig-elements' ),
                        'name' => 'price_table_currency_typography',
						'selector' => '{{WRAPPER}} .rig-price-table-currency',
					]
				);

                $this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'label' => __( 'Period Typography', 'rig-elements' ),
                        'name' => 'price_table_price_typography',
						'selector' => '{{WRAPPER}} .rig-price-table-period',
					]
				);

				$this->add_control(
					'price_table_price_color',
					[
						'label' => esc_html__( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-price' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'price_table_price_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-price' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->add_responsive_control(
					'price_table_price_align',
					[
						'label' => esc_html__( 'Alignment', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'options' => [
							'flex-start' => [
								'title' => esc_html__( 'Left', 'rig-elements' ),
								'icon' => 'fa fa-align-left',
							],
							'center' => [
								'title' => esc_html__( 'Center', 'rig-elements' ),
								'icon' => 'fa fa-align-center',
							],
							'flex-end' => [
								'title' => esc_html__( 'Right', 'rig-elements' ),
								'icon' => 'fa fa-align-right',
							],
						],
						'default' => 'flex-start',
						'toggle' => true,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-price' => 'justify-content: {{VALUE}}',
						],
					]
				);


				$this->add_responsive_control(
					'price_table_price_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->end_controls_section();



				// Price Table Features Style

				$this->start_controls_section(
					'price_table_features_style',
					[
						'label' => __( 'Features', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'label' => __( 'Typography', 'rig-elements' ),
                        'name' => 'price_table_features_typography',
						'selector' => '{{WRAPPER}} .rig-price-table-feature p',
					]
				);

				$this->add_control(
					'price_table_features_text_color',
					[
						'label' => esc_html__( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-feature p' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'price_table_features_divider',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);


				$this->add_responsive_control(
					'price_table_features_icon_size',
					[
						'label' => esc_html__( 'Icon Size', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 1000,
								'step' => 1,
							],
							'%' => [
								'min' => 0,
								'max' => 1000,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 18,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-icon' => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'price_table_features_icon_spacing',
					[
						'label' => esc_html__( 'Icon Spacing', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
								'step' => 1,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 5,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'price_table_features_icon_rotate',
					[
						'label' => esc_html__( 'Icon Rotate', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'range' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-icon' => 'transform: rotate({{SIZE}}deg);',
						],
					]
				);


				$this->add_control(
					'price_table_features_icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-icon' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'price_table_features_divider_02',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);


				$this->add_responsive_control(
					'price_table_features_align',
					[
						'label' => esc_html__( 'Alignment', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'options' => [
							'flex-start' => [
								'title' => esc_html__( 'Left', 'rig-elements' ),
								'icon' => 'fa fa-align-left',
							],
							'center' => [
								'title' => esc_html__( 'Center', 'rig-elements' ),
								'icon' => 'fa fa-align-center',
							],
							'flex-end' => [
								'title' => esc_html__( 'Right', 'rig-elements' ),
								'icon' => 'fa fa-align-right',
							],
						],
						'default' => 'left',
						'toggle' => true,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-feature' => 'justify-content: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'price_table_features_spacing',
					[
						'label' => esc_html__( 'Spacing', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 100,
								'step' => 1,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'default' => [
							'unit' => '%',
							'size' => 5,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-feature' => 'margin-bottom: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'price_table_features_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->end_controls_section();


				// Price Table Button

				$this->start_controls_section(
					'price_table_button_style',
					[
						'label' => __( 'Button', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'price_table_button_typography',
						'selector' => '{{WRAPPER}} .rig-price-table-button a',
					]
				);

				$this->add_responsive_control(
					'price_table_button_align',
					[
						'label' => esc_html__( 'Alignment', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'options' => [
							'flex-start' => [
								'title' => esc_html__( 'Left', 'rig-elements' ),
								'icon' => 'fa fa-align-left',
							],
							'center' => [
								'title' => esc_html__( 'Center', 'rig-elements' ),
								'icon' => 'fa fa-align-center',
							],
							'flex-end' => [
								'title' => esc_html__( 'Right', 'rig-elements' ),
								'icon' => 'fa fa-align-right',
							],
						],
						'default' => 'center',
						'toggle' => true,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-button' => 'justify-content: {{VALUE}}',
						],
					]
				);

				$this->add_responsive_control(
					'price_table_button_margin',
					[
						'label' => esc_html__( 'Margin', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'price_table_button_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
		

				$this->start_controls_tabs(
					'price_table_button_tabs'
				);
				
				$this->start_controls_tab(
					'price_table_button_normal',
					[
						'label' => esc_html__( 'Normal', 'rig-elements' ),
					]
				);

				$this->add_control(
					'price_table_button_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-button a' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'price_table_button_text_color',
					[
						'label' => esc_html__( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-button a' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'price_table_button_border',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-price-table-button a',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'price_table_button_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-price-table-button a',
					]
				);
				
				$this->end_controls_tab();

				$this->start_controls_tab(
					'price_table_button_hover',
					[
						'label' => esc_html__( 'Hover', 'rig-elements' ),
					]
				);

				$this->add_control(
					'price_table_button_background_color_hover',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-button a:hover' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'price_table_button_text_color_hover',
					[
						'label' => esc_html__( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-price-table-button a:hover' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'price_table_button_border_hover',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-price-table-button a:hover',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'price_table_button_box_shadow_hover',
						'label' => esc_html__( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-price-table-button a:hover',
					]
				);
		
				
				$this->end_controls_tab();
				
				$this->end_controls_tabs();

				
				
				$this->end_controls_section();

            }
            
            protected function render() {
                $settings = $this->get_settings_for_display();

                Timber::render('view.twig', [
                    'price_table_title' => $settings['price_table_title'],
                    'price_table_description_before' => $settings['price_table_description_before'],
					'price_table_description_after' => $settings['price_table_description_after'],
                    'price_table_currency' => $settings['price_table_currency'],
                    'price_table_price' => $settings['price_table_price'],
                    'price_table_period' => $settings['price_table_period'],
                    'price_table_feature_list' => $settings['price_table_feature_list'],
                    'price_table_button_enable' => $settings['price_table_button_enable'],
                    'price_table_button_text' => $settings['price_table_button_text'],
                    'price_table_button_link' => $settings['price_table_button_link'],
                    'price_table_image_enable' => $settings['price_table_image_enable'],
                    'price_table_image' => $settings['price_table_image'],
				]);
            }            

        }
