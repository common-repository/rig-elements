<?php
		namespace RigElements\Widgets;

		use Timber\Timber;
		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Card extends Widget_Base {


			public function get_name() {
				return 'Card';
			}


			public function get_title() {
				return __( 'Card', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-advance-card';
			}


			public function get_categories() {
				return [ 'rig_elements_widgets' ];
			}


			public function get_style_depends() {
				return [ 'rig-app'];
			}

			public function get_script_depends() {
				return [ 'rig-main' ];
			}


			protected function _register_controls() {

				// Content Controls
				
				$this->start_controls_section(
					'rig_card_image_control',
					[
						'label' => __( 'Card Image', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				$this->add_control(
					'rig_cards_enable_image',
					[
						'label' => __( 'Show Image', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'enable' => __( 'Enable', 'rig-elements' ),
						'disable' => __( 'Disable', 'rig-elements' ),
						'return_value' => 'enable_image',
						'default' => 'enable_image',
					]
				);

				$this->add_control(
					'rig_cards_image_link',
					[
						'label' => __( 'Choose Image', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						
						'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'rig_cards_enable_image',
                                    'operator' => '==',
                                    'value' => 'enable_image',
                                ],
                            ],
						],
						
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
						'dynamic' => [
							'active' => true,
						],
					]
				);

				$this->add_control(
					'card_image_url',
					[
						'label' => __( 'Image Link', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::URL,
						'placeholder' => __( 'https://example.com', 'rig-elements' ),
						'show_external' => true,
						'default' => [
							'url' => '',
							'is_external' => true,
							'nofollow' => true,
						],
					]
				);
		

				$this->end_controls_section();

				$this->start_controls_section(
					'rig_card_title_control',
					[
						'label' => __( 'Card Title', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);


				$this->add_control(
					'rig_card_enable_title',
					[
						'label' => __( 'Show Title', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'enable_title' => __( 'Enable', 'rig-elements' ),
						'disable_title' => __( 'Disable', 'rig-elements' ),
						'return_value' => 'enable_title',
						'default' => 'enable_title',
					]
				);

				$this->add_control(
					'rig_card_title',
					[
						'label' => __( 'Card Title', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => __( 'Rig Elements', 'rig-elements' ),
						'placeholder' => __( 'Type your title here', 'rig-elements' ),
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'rig_card_enable_title',
									'operator' => '==',
									'value' => 'enable_title',
								],
							],
						],
						'dynamic' => [
							'active' => true,
						],
					]
				);

				$this->end_controls_section();

				$this->start_controls_section(
					'rig_card_description_control',
					[
						'label' => __( 'Card Content', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				$this->add_control(
					'rig_card_enable_descriprion',
					[
						'label' => __( 'Show Content', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'enable_description' => __( 'Enable', 'rig-elements' ),
						'disable_description' => __( 'Disable', 'rig-elements' ),
						'return_value' => 'enable_description',
						'default' => 'enable_description',
					]
				);

				$this->add_control(
					'rig_card_description',
					[
						'label' => __( 'Content', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::WYSIWYG,

						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'rig_card_enable_descriprion',
									'operator' => '==',
									'value' => 'enable_description',
								],
							],
						],

						'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'rig-elements' ),
						'placeholder' => __( 'Type your description here', 'rig-elements' ),
					]
				);
		

				$this->end_controls_section();


				// Style Controls

				// Card Container

				$this->start_controls_section(
					'card_container_style',
					[
						'label' => __( 'Card Container', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_control(
					'card_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-card' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'card_background_color_horizontal',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-card-content' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'card_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'card_border',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-card',
					]
				);


				$this->add_control(
					'card_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'card_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-card',
					]
				);

				$this->end_controls_section();


				// Card Image

				$this->start_controls_section(
					'card_image_style',
					[
						'label' => __( 'Card Image', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_responsive_control(
                    'card_image_fit',
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
							'{{WRAPPER}} .rig-card-image' => 'object-fit: {{options}}',
						],
                    ]
                );


				$this->add_responsive_control(
                    'card_image_width',
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
                            '{{WRAPPER}} .rig-card-image' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );


                $this->add_responsive_control(
                    'card_image_height',
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
                            '{{WRAPPER}} .rig-card-image' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

				$this->add_responsive_control(
					'card_image_margin',
					[
						'label' => esc_html__( 'Margin', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-card-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'card_image_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-card-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'card_image_border',
						'label' => esc_html__( 'Border', 'plugin-name' ),
						'selector' => '{{WRAPPER}} .rig-card-image',
					]
				);


				$this->add_control(
					'card_image_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-card-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'card_image_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'plugin-name' ),
						'selector' => '{{WRAPPER}} .rig-card-image',
					]
				);
		


				$this->end_controls_section();


				// Card Title

				$this->start_controls_section(
					'card_title_style',
					[
						'label' => __( 'Card Title', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'card_title_typography',
						'selector' => '{{WRAPPER}} .rig-card-title',
					]
				);

				$this->add_control(
					'card_title_color',
					[
						'label' => esc_html__( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-card-title' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'card_title_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-card-title' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->add_responsive_control(
					'card_title_align',
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
							'{{WRAPPER}} .rig-card-title' => 'text-align: {{VALUE}}',
						],
					]
				);


				$this->add_responsive_control(
					'card_title_margin',
					[
						'label' => esc_html__( 'Margin', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'card_title_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-card-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->end_controls_section();



				// Card Description

				$this->start_controls_section(
					'card_description_style',
					[
						'label' => __( 'Card Content', 'rig-elements' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'card_description_typography',
						'selector' => '{{WRAPPER}} .rig-card-description',
					]
				);

				$this->add_control(
					'card_description_color',
					[
						'label' => esc_html__( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-card-description' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'card_description_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-card-description' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->add_responsive_control(
					'card_description_align',
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
							'{{WRAPPER}} .rig-card-description' => 'text-align: {{VALUE}}',
						],
					]
				);


				$this->add_responsive_control(
					'card_description_margin',
					[
						'label' => esc_html__( 'Margin', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-card-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'card_description_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-card-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->end_controls_section();


			}


			protected function render() {
				$settings = $this->get_settings_for_display();
				$enable_title = $settings['rig_card_enable_title'];
				$enable_description = $settings['rig_card_enable_descriprion'];
				$enable_image = $settings['rig_cards_enable_image'];
				
				Timber::render('gridview.twig', [
					'enable_title' => $enable_title,
                    'card_title' => $settings['rig_card_title'],
					'enable_description' => $enable_description,
					'card_description' => $settings['rig_card_description'],
                    'enable_image' => $enable_image,
					'card_image' => $settings['rig_cards_image_link'],
					'card_image_url' => $settings['card_image_url'],
				]);

			}

		}
