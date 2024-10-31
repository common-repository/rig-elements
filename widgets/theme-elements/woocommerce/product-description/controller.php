<?php
		namespace RigElements\Widgets;

		use Timber\Timber;
		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;
		use RigElements\Rig_Query_Control;

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Product_Description extends Widget_Base {


			public function get_name() {
				return 'rig-product-description';
			}


			public function get_title() {
				return __( 'Product Description', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-product-description';
			}


			public function get_categories() {
				return [ 'rig_elements_woocommerce_widgets' ];
			}


			public function get_style_depends() {
				return [ 'core_css'];
			}

			public function get_script_depends() {
				return [ 'rig-main' ];
			}

			public $post_type = 'product';


			protected function register_controls() {
				$this->start_controls_section(
					'rig_product_description_content_section',
					[
						'label' => __( 'Content', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);
		
				$this->add_control(
					'rig_product_description_link',
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
						'dynamic' => [
							'active' => true,
						]
					]
				);
				
				$this->add_responsive_control(
					'rig_product_description_align',
					[
						'label' => __( 'Alignment', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'devices' => [ 'desktop', 'tablet', 'mobile' ],
						'desktop_default' => 'left',
						'tablet_default'  => 'left',
						'mobile_default'  => 'left',
						'options' => [
							'left' => [
								'title' => __( 'Left', 'rig-elements' ),
								'icon' => 'eicon-text-align-left',
							],
							'center' => [
								'title' => __( 'Center', 'rig-elements' ),
								'icon' => 'eicon-text-align-center',
							],
							'right' => [
								'title' => __( 'Right', 'rig-elements' ),
								'icon' => 'eicon-text-align-right',
							],
						],
						'default' => 'center',
						'toggle' => true,
						'selectors' => [
							'{{WRAPPER}} .product_description' => 'text-align: {{VALUE}}',
						],
					]
				);
				$this->end_controls_section();


				$this->start_controls_section(
					'rig_product_description_preview_section',
					[
						'label' => __( 'Preview', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				// $this->add_control(
				// 	'rig_product_description_preview_post_type',
				// 	[
				// 		'label' => __( 'Post Type', 'rig-elements' ),
				// 		'type' => \Elementor\Controls_Manager::SELECT,
				// 		'default' => 'post',
				// 		'options' => $post_type
				// 	]
				// );

				$this->add_control(
					'rig_product_description_preview_include',
					[
						'label' => __( 'Post', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'multiple' => false,
						'options' => (new Rig_Query_Control())->get_preview_title($this->post_type),
						'default' => ['all'],
					]
				);

				$this->end_controls_section();


				$this->start_controls_section(
					'rig_product_description_style_section',
					[
						'label' => __( 'Style', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);
		
				$this->add_control(
					'rig_product_description_color',
					[
						'label' => __( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .product_description' => 'color: {{VALUE}}',
						],
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_product_description_typography',
						'label' => __( 'Typography', 'rig-elements' ),
						// 'scheme' => Scheme_Typography::TYPOGRAPHY_1,
						'selector' => '{{WRAPPER}} .product_description',
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Text_Shadow::get_type(),
					[
						'name' => 'rig_product_description_shadow',
						'label' => __( 'Text Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .product_description',
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rig_product_description_border',
						'label' => __( 'Border', 'rig-elements' ),
						'options' => [
							'solid'  => __( 'Solid', 'rig-elements' ),
							'dashed' => __( 'Dashed', 'rig-elements' ),
							'dotted' => __( 'Dotted', 'rig-elements' ),
							'double' => __( 'Double', 'rig-elements' ),
							'none' => __( 'None', 'rig-elements' ),
						],
						'selector' => '{{WRAPPER}} .product_description',
					]
				);
				$this->add_control(
					'rig_product_description_padding',
					[
						'label' => __( 'Padding', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .product_description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->end_controls_section();
			}


			protected function render() {
				$settings = $this->get_settings_for_display();				
				$preview_description = (new Rig_Query_Control())->get_product_preview()->description;
				$product_description = (new Rig_Query_Control())->get_product_description();
				$elementor_preview_mode = (new Rig_Query_Control())->is_elementor_preview_mode();

				Timber::render('view.twig', [
					'elementor_preview_mode' => $elementor_preview_mode,
					'product_description' => $product_description,
					'preview_description' => $preview_description,
				]);
				
			}
			
		}






		