<?php
		namespace RigElements\Widgets;

		use Timber\Timber;
		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;
		use RigElements\Rig_Query_Control;


		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Search extends Widget_Base {


			public function get_name() {
				return 'rig-search';
			}


			public function get_title() {
				return __( 'Search', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-search';
			}


			public function get_categories() {
				return [ 'rig_elements_header_footer_widgets' ];
			}


			public function get_style_depends() {
				return [ 'rig-app'];
			}

			public function get_script_depends() {
				return [ 'rig-elements' ];
			}


			protected function register_controls() {

				// Content Controls
				
				$this->start_controls_section(
					'rig_search_content_section',
					[
						'label' => __( 'Content', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);
				$this->add_control(
					'rig_search_layout',
					[
						'label' => __( 'Layout', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'button',
						'options' => [
							'default'  => __( 'Input Box', 'rig-elements' ),
							'button' => __( 'Input box with Button', 'rig-elements' ),
							'icon' => __( 'Input Box With Icon (End)', 'rig-elements' ),
							'icon02' => __( 'Input Box With Icon (Start)', 'rig-elements' ),
						],
					]
				);
				$this->add_control(
					'rig_search_input_placeholder',
					[
						'label' => __( 'Placeholder', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => __( 'Search...', 'rig-elements' ),
						'placeholder' => __( 'Type your title here', 'rig-elements' ),
					]
				);


				$this->add_control(
					'rig_search_button_text',
					[
						'label' => __( 'Button Text', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => __( 'Search', 'rig-elements' ),
						'placeholder' => __( 'Type your title here', 'rig-elements' ),
						'conditions' => [
                            'relation' => 'and',
                            'terms' => [
								[
                                    'name' => 'rig_search_layout',
                                    'operator' => '==',
                                    'value' => 'button',
                                ],
                            ],
                        ],
					]
				);

				$this->add_control(
					'rig_search_button_icon',
					[
						'label' => esc_html__( 'Icon', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::ICONS,
						'default' => [
							'value' => 'fas fa-search',
							'library' => 'solid',
						],
						'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'rig_search_layout',
                                    'operator' => '==',
                                    'value' => 'icon',
                                ],
								[
                                    'name' => 'rig_search_layout',
                                    'operator' => '==',
                                    'value' => 'icon02',
                                ],
                            ],
                        ],
					]
				);

				$this->end_controls_section();


				// Search Container Style

				$this->start_controls_section(
					'rig_search_container_style',
					[
						'label' => __( 'Container', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);


				$this->add_responsive_control(
					'rig_search_box_height',
					[
						'label' => __( 'Height', 'rig-elements' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range' => [
							'px' => [
								'min' => 35,
								'max' => 500,
								'step' => 1,
							],
						],

						'selectors' => [
							'{{WRAPPER}} .rig-search input' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->end_controls_section();


				// Search Input Style

				$this->start_controls_section(
					'rig_search_input_style',
					[
						'label' => __( 'Input Box', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_responsive_control(
					'input_box_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'label' => esc_html__( 'Typography', 'rig-elements' ),
						'name' => 'input_box_typography',
						'selector' => '{{WRAPPER}} .rig-search-input',
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'label' => esc_html__( 'Placeholder Typography', 'rig-elements' ),
						'name' => 'input_box_placeholder_typography',
						'selector' => '{{WRAPPER}} .rig-search-input::placeholder',
					]
				);


				$this->add_control(
					'input_box_text_color',
					[
						'label' => esc_html__( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-search-input' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'input_box_placeholder_color',
					[
						'label' => esc_html__( 'Placeholder Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-search-input::placeholder' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'input_box_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-search-input' => 'background-color: {{VALUE}}',
						],
					]
				);
		

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'input_box_border',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-search-input',
					]
				);


				$this->add_control(
					'input_box_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->end_controls_section();

				// Search Button Style

				$this->start_controls_section(
					'rig_search_button_style',
					[
						'label' => __( 'Button', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
						'conditions' => [
                            'relation' => 'and',
                            'terms' => [
								[
                                    'name' => 'rig_search_layout',
                                    'operator' => '==',
                                    'value' => 'button',
                                ],
                            ],
                        ],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'label' => esc_html__( 'Typography', 'rig-elements' ),
						'name' => 'button_typography',
						'selector' => '{{WRAPPER}} .rig-search-button',
					]
				);



				$this->start_controls_tabs(
					'button_style_tab'
				);
				
				$this->start_controls_tab(
					'button_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'rig-elements' ),
					]
				);

				$this->add_responsive_control(
					'button_margin',
					[
						'label' => esc_html__( 'Margin', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'button_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_control(
					'button_text_color',
					[
						'label' => esc_html__( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-search-button' => 'color: {{VALUE}}',
						],
					]
				);

				
				
				$this->add_control(
					'button_background_color',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-search-button' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'button_border',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-search-button',
					]
				);


				$this->add_control(
					'button_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'button_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-search-button',
					]
				);
				
				$this->end_controls_tab();


				$this->start_controls_tab(
					'button_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'rig-elements' ),
					]
				);

				$this->add_responsive_control(
					'button_margin_hover',
					[
						'label' => esc_html__( 'Margin', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'button_padding_hover',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_control(
					'button_text_color_hover',
					[
						'label' => esc_html__( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-search-button:hover' => 'color: {{VALUE}}',
						],
					]
				);

				
				
				$this->add_control(
					'button_background_color_hover',
					[
						'label' => esc_html__( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-search-button:hover' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'button_border_hover',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-search-button:hover',
					]
				);


				$this->add_control(
					'button_border_radius_hover',
					[
						'label' => esc_html__( 'Border Radius', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'button_box_shadow_hover',
						'label' => esc_html__( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-search-button:hover',
					]
				);

				
				$this->end_controls_tab();
				
				$this->end_controls_tabs();

				$this->end_controls_section();


				// Search Icon Style

				$this->start_controls_section(
					'rig_search_icon_style',
					[
						'label' => __( 'Icon', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
						'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'rig_search_layout',
                                    'operator' => '==',
                                    'value' => 'icon',
                                ],
								[
                                    'name' => 'rig_search_layout',
                                    'operator' => '==',
                                    'value' => 'icon02',
                                ],
                            ],
                        ],
					]
				);


				$this->start_controls_tabs(
					'icon_style_tab'
				);
				
				$this->start_controls_tab(
					'icon_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'rig-elements' ),
					]
				);


				$this->add_responsive_control(
					'search_icon_margin',
					[
						'label' => esc_html__( 'Margin', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'search_icon_padding',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'search_icon_size',
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
							'{{WRAPPER}} .rig-search-icon' => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'search_icon_rotate',
					[
						'label' => esc_html__( 'Icon Rotate', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'range' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon' => 'transform: rotate({{SIZE}}deg);',
						],
					]
				);


				$this->add_control(
					'search_icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'search_icon_background_color',
					[
						'label' => esc_html__( 'Icon Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon-button' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'search_icon_border',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-search-icon-button',
					]
				);


				$this->add_control(
					'search_icon_border_radius',
					[
						'label' => esc_html__( 'Border Radius', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'search_icon_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-search-icon-button',
					]
				);


				$this->end_controls_tab();


				$this->start_controls_tab(
					'icon_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'rig-elements' ),
					]
				);


				$this->add_responsive_control(
					'search_icon_margin_hover',
					[
						'label' => esc_html__( 'Margin', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon-button:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'search_icon_padding_hover',
					[
						'label' => esc_html__( 'Padding', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon-button:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'search_icon_size_hover',
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
							'{{WRAPPER}} .rig-search-icon:hover' => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'search_icon_rotate_hover',
					[
						'label' => esc_html__( 'Icon Rotate', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'range' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon:hover' => 'transform: rotate({{SIZE}}deg);',
						],
					]
				);


				$this->add_control(
					'search_icon_color_hover',
					[
						'label' => esc_html__( 'Icon Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon:hover' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'search_icon_background_color_hover',
					[
						'label' => esc_html__( 'Icon Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon-button:hover' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'search_icon_border_hover',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-search-icon-button:hover',
					]
				);


				$this->add_control(
					'search_icon_border_radius_hover',
					[
						'label' => esc_html__( 'Border Radius', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-search-icon-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'search_icon_box_shadow_hover',
						'label' => esc_html__( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-search-icon-button:hover',
					]
				);
				
				$this->end_controls_tab();
				
				$this->end_controls_tabs();

				$this->end_controls_section();


			}


			protected function render() {
				$settings = $this->get_settings_for_display();

				Timber::render($settings['rig_search_layout'].'.twig', [
						'search_placeholder' => $settings['rig_search_input_placeholder'],
						'search_icon' => $settings['rig_search_button_icon'],
				]);
			}
			
		}






		