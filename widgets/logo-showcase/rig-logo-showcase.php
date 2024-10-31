<?php
		namespace RigElements\Widgets;

		use Timber\Timber;
		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;
		use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
		use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Logo_Showcase extends Widget_Base {


			public function get_name() {
				return 'rig-logo-showcase';
			}


			public function get_title() {
				return __( 'Logo Showcase', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-logo-showcase';
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

                $this->start_controls_section(
					'rig_logo_showcase',
					[
						'label' => __( 'Logo Showcase', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

                $logo_showcase = new \Elementor\Repeater();

                $logo_showcase->add_control(
                    'logo_title', [
                        'label' => esc_html__( 'Logo Title', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'List Title' , 'plugin-name' ),
                        'label_block' => true,
                    ]
                );

                $logo_showcase->add_control(
                    'logo_tagline', [
                        'label' => esc_html__( 'Logo Tagline', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'List Title' , 'plugin-name' ),
                        'label_block' => true,
                    ]
                );

                $logo_showcase->add_control(
                    'logo_image',
                    [
                        'label' => esc_html__( 'Choose Image', 'plugin-name' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                );

                $this->add_control(
                    'logo_list',
                    [
                        'label' => esc_html__( 'Repeater List', 'plugin-name' ),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => $logo_showcase->get_controls(),
                        'default' => [
                            [
                                'logo_title' => esc_html__( 'Title #1', 'plugin-name' ),
                                'logo_tagline' => esc_html__( 'Item content. Click the edit button to change this text.', 'plugin-name' ),
                                'logo_image' => esc_html__( 'Item content. Click the edit button to change this text.', 'plugin-name' ),
                            ],
                        ],
                        // 'title_field' => '{{{ list_title }}}',
                    ]
                );

                $this->end_controls_section();


				$this->start_controls_section(
					'rig_logo_showcase_layout_controls',
					[
						'label' => __( 'Layout', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);


				$this->add_responsive_control(
                    'logo_column',
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
							'{{WRAPPER}} .rig-logo-showcase' => 'grid-template-columns: {{options}};',
						],
                    ]
                );

				$this->end_controls_section();
			


				// Style Controls

				// Logo Container

				$this->start_controls_section(
					'logo_container_style',
					[
						'label' => __( 'Logo Container', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_responsive_control(
					'logo_container_column_gap',
					[
						'label' => __( 'Logo Column Gap', 'rig-elements' ),
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
							'{{WRAPPER}} .rig-logo-showcase' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'logo_container_row_gap',
					[
						'label' => __( 'Logo Row Gap', 'rig-elements' ),
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
							'{{WRAPPER}} .rig-logo-showcase' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_control(
					'logo_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-content' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'logo_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'logo_border',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-logo-showcase-content',
					]
				);


				$this->add_control(
					'logo_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'logo_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-logo-showcase-content',
					]
				);

				$this->end_controls_section();


				// Logo Image

				$this->start_controls_section(
					'logo_image_style',
					[
						'label' => __( 'Logo Image', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_responsive_control(
                    'logo_image_fit',
                    [
                        'label' => __( 'Image Fit', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
						'devices' => [ 'desktop', 'tablet', 'mobile' ],
						'desktop_default' => 'cover',
						'tablet_default'  => 'cover',
						'mobile_default'  => 'cover',
                        'options' => [
                            'contain'  => __( 'Contain', 'rig-elements' ),
                            'cover' => __( 'Cover', 'rig-elements' ),
                            'auto' => __( 'Auto', 'rig-elements' ),
                            'fill' => __( 'Fill', 'rig-elements' ),
                            'none' => __( 'None', 'rig-elements' ),
                        ],

						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-image' => 'object-fit: {{options}}',
						],
                    ]
                );


				$this->add_responsive_control(
                    'logo_image_width',
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
                            '{{WRAPPER}} .rig-logo-showcase-image' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );


                $this->add_responsive_control(
                    'logo_image_height',
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
                            '{{WRAPPER}} .rig-logo-showcase-image' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

				$this->add_responsive_control(
					'logo_image_margin',
					[
						'label' => esc_html__( 'Margin', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'logo_image_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'logo_image_border',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-logo-showcase-image',
					]
				);


				$this->add_control(
					'logo_image_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'logo_image_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'plugin-name' ),
						'selector' => '{{WRAPPER}} .rig-logo-showcase-image',
					]
				);
		


				$this->end_controls_section();


				// Logo Title

				$this->start_controls_section(
					'logo_title_style',
					[
						'label' => __( 'Logo Title', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'logo_title_typography',
						'selector' => '{{WRAPPER}} .rig-logo-showcase-title',
					]
				);

				$this->add_control(
					'logo_title_color',
					[
						'label' => esc_html__( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-title' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'logo_title_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-title' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->add_responsive_control(
					'logo_title_align',
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
							'{{WRAPPER}} .rig-logo-showcase-title' => 'text-align: {{VALUE}}',
						],
					]
				);


				$this->add_responsive_control(
					'logo_title_margin',
					[
						'label' => esc_html__( 'Margin', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'logo_title_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->end_controls_section();



				// Logo Description

				$this->start_controls_section(
					'logo_description_style',
					[
						'label' => __( 'Logo Description', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'logo_description_typography',
						'selector' => '{{WRAPPER}} .rig-logo-showcase-description',
					]
				);

				$this->add_control(
					'logo_description_color',
					[
						'label' => esc_html__( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-description' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'logo_description_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-description' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->add_responsive_control(
					'logo_description_align',
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
							'{{WRAPPER}} .rig-logo-showcase-description' => 'text-align: {{VALUE}}',
						],
					]
				);


				$this->add_responsive_control(
					'logo_description_margin',
					[
						'label' => esc_html__( 'Margin', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'logo_description_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-logo-showcase-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->end_controls_section();


			}


			protected function render() {
				$settings = $this->get_settings_for_display();
				
				Timber::render('view.twig', [
                    'logo_list'  => $settings['logo_list'],
				]);

			}

		}
