<?php
		namespace RigElements\Widgets;

		use Timber\Timber;
		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;
		use RigElements\Rig_Query_Control;

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Site_Logo extends Widget_Base {


			public function get_name() {
				return 'rig-site-logo';
			}


			public function get_title() {
				return __( 'Site Logo', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-site-logo';
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

				$this->start_controls_section(
					'rig_site_logo_content_section',
					[
						'label' => __( 'Content', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);


				$this->add_control(
					'rig_site_logo_source',
					[
						'label' => esc_html__( 'Logo Source', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'wordpress',
						'options' => [
							'wordpress'  => esc_html__( 'WordPress Default', 'rig-elements' ),
							'custom' => esc_html__( 'Custom', 'rig-elements' ),
						],
					]
				);


				$this->add_control(
					'rig_site_logo_custom',
					[
						'label' => esc_html__( 'Choose Logo', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
						'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'rig_site_logo_source',
                                    'operator' => '==',
                                    'value' => 'custom',
                                ],
                            ],
						],
					]
				);

				

				$this->add_responsive_control(
					'rig_site_logo_align',
					[
						'label' => __( 'Alignment', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'devices' => [ 'desktop', 'tablet', 'mobile' ],
						'desktop_default' => 'flex-start',
						'tablet_default'  => 'flex-start',
						'mobile_default'  => 'flex-start',
						'options' => [
							'flex-start' => [
								'title' => __( 'Left', 'rig-elements' ),
								'icon' => 'eicon-text-align-left',
							],
							'center' => [
								'title' => __( 'Center', 'rig-elements' ),
								'icon' => 'eicon-text-align-center',
							],
							'flex-end' => [
								'title' => __( 'Right', 'rig-elements' ),
								'icon' => 'eicon-text-align-right',
							],
						],
						'default' => 'center',
						'toggle' => true,
						'selectors' => [
							'{{WRAPPER}} .rig-site-logo' => 'display: flex; justify-content: {{VALUE}};',
						],
					]
				);


				$this->add_control(
					'rig_site_logo_link',
					[
						'label' => __( 'Link', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::URL,
						'placeholder' => __( 'https://your-link.com', 'rig-elements' ),
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
					'rig_site_logo_style_section',
					[
						'label' => __( 'Image', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);
				$this->add_responsive_control(
					'rig_site_logo_width',
					[
						'label' => __( 'Width', 'rig-elements' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 1000,
								'step' => 5,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .rig-site-logo img' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'rig_site_logo_max_width',
					[
						'label' => __( 'Max Width', 'rig-elements' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 1000,
								'step' => 5,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .rig-site-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'rig_site_logo_height',
					[
						'label' => __( 'Height', 'rig-elements' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 1000,
								'step' => 5,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .rig-site-logo img' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'rig_site_logo_object_fit',
					[
						'label' => __( 'Object Fit', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'default',
						'options' => [
							'default' => 'Default',
							'fill'  => __( 'Fill', 'rig-elements' ),
							'cover' => __( 'Cover', 'rig-elements' ),
							'contain' => __( 'Contain', 'rig-elements' ),
							
						],
						'selectors' => [
							'{{WRAPPER}} .rig-site-logo img' => 'object-fit: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'rig_site_logo_first_divider',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);
				$this->start_controls_tabs('_rig_site_logo_opacity');
				$this->start_controls_tab(
					'rig_site_logo_normal_tab',
					[
						'label' => __( 'Normal', 'rig-elements' ),
					]
				);
				$this->add_control(
					'rig_site_logo_normal',
					[
						'label' => __( 'Opacity', 'rig-elements' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ ' ' ],
						'range' => [
							' ' => [
								'min' => 0,
								'max' => 1,
								'step' => 0.10,
							],
						],
						'default' => [
							'unit' => ' ',
							'size' => 1,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-site-logo' => 'opacity: {{SIZE}};',
						],
					]
				);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'rig_site_logo_hover_tab',
					[
						'label' => __( 'Hover', 'rig-elements' ),
					]
				);
				$this->add_control(
					'rig_site_logo_hover',
					[
						'label' => __( 'Opacity', 'rig-elements' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ ' ' ],
						'range' => [
							' ' => [
								'min' => 0,
								'max' => 1,
								'step' => 0.10,
							],
						],
						'default' => [
							'unit' => ' ',
							'size' => 1,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-site-logo:hover' => 'opacity: {{SIZE}};',
						],
					]
				);
				$this->add_control(
					'rig_site_logo_hover_animation',
					[
						'label' => __( 'Hover Animation', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
						'prefix_class' => 'elementor-animation-',
					]
				);
				$this->add_control(
					'rig_site_logo_hover_transition',
					[
						'label' => __( 'Opacity', 'rig-elements' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ ' ' ],
						'range' => [
							' ' => [
								'min' => 0,
								'max' => 2,
								'step' => 0.10,
							],
						],
						'default' => [
							'unit' => ' ',
							'size' => 1,
						],
						'selectors' => [
							'{{WRAPPER}} .rig-site-logo:hover ,elementor-animation' => 'transition-duration: {{SIZE}}s;',
						],
					]
				);
				$this->end_controls_tab();
				$this->end_controls_tabs();
				$this->add_control(
					'rig_site_logo_second_divider',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rig_site_logo_border',
						'label' => __( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-site-logo img',
					]
				);
				$this->add_control(
					'rig_site_logo_border_radius',
					[
						'label' => __( 'Border Radius', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .rig-site-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'rig_site_logo_box_shadow',
						'label' => __( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-site-logo img',
					]
				);
				$this->end_controls_section();
			}


			protected function render() {
				$settings = $this->get_settings_for_display();
                $logo_id = get_theme_mod('custom_logo');
                $logo_url = wp_get_attachment_image_src($logo_id ,'full');

				Timber::render('view.twig', [
					'logo_source' => $settings['rig_site_logo_source'],
					'wordpress_logo_url' => $logo_url[0] ?? '',
					'custom_logo_url' => $settings['rig_site_logo_custom']['url'],
				]);
			}
			
		}
