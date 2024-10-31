<?php
		namespace RigElements\Widgets;

		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_WooCommerce_Checkout extends Widget_Base {


			public function get_name() {
				return 'rig-woocommerce-checkout';
			}


			public function get_title() {
				return __( 'WooCommerce Checkout', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-woocommerce';
			}


			public function get_categories() {
				return [ 'rig_elements_widgets' ];
			}


			public function get_style_depends() {
				return [ 'core_css'];
			}

			public function get_script_depends() {
				return [ 'rig-main'];
			}


			protected function _register_controls() {
				$this->start_controls_section(
					'rig_woocommerce_checkout_container',
					[
						'label' => __( 'Container', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);
	
	
				$this->add_control(
					'rig_woocommerce_checkout_container_background_color',
					[
						'label' => __( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .woocommerce' => 'background-color: {{VALUE}}',
						],
					]
				);
	
	
				$this->add_responsive_control(
					'rig_woocommerce_checkout_container_padding',
					[
						'label' => __( 'Padding', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .woocommerce' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
		
	
				$this->end_controls_section();


				// Checkout Form Controls


				$this->start_controls_section(
					'rig_woocommerce_checkout_form_control',
					[
						'label' => __( 'Checkout Form', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_woocommerce_checkout_form_heading_typography',
						'label' => __( 'Heading Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .woocommerce-billing-fields h3',
					]
				);
	
	
	
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_woocommerce_checkout_form_title_typography',
						'label' => __( 'Field Name Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .woocommerce-billing-fields label',
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_woocommerce_checkout_form_field_typography',
						'label' => __( 'Field Text Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .woocommerce-billing-fields input, .woocommerce-billing-fields select',
					]
				);


				$this->add_control(
					'rig_woocommerce_checkout_form_typography_divider',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);
	


				$this->add_responsive_control(
					'rig_woocommerce_checkout_form_width',
					[
						'label' => __( 'Form Width', 'rig-elements' ),
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
						'default' => [
							'unit' => '%',
							'size' => 100,
						],
						'selectors' => [
							'{{WRAPPER}} .woocommerce-billing-fields input' => 'width: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .woocommerce-billing-fields select' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'rig_woocommerce_checkout_form_margin',
					[
						'label' => __( 'Margin', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .woocommerce-billing-fields input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .woocommerce-billing-fields select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'rig_woocommerce_checkout_form_padding',
					[
						'label' => __( 'Padding', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .woocommerce-billing-fields input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .woocommerce-billing-fields select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rig_woocommerce_checkout_form_border',
						'label' => __( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .woocommerce-billing-fields input, .woocommerce-billing-fields select',
					]
				);

				$this->add_control(
					'rig_woocommerce_checkout_form_border_radius',
					[
						'label' => __( 'Border Radius', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .woocommerce-billing-fields input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .woocommerce-billing-fields select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
		
	
				$this->add_control(
					'rig_woocommerce_checkout_form_dimension_divider',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);
	
	
				$this->add_control(
					'rig_woocommerce_checkout_form_heading_color',
					[
						'label' => __( 'Form Heading Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .woocommerce-billing-fields h3' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'rig_woocommerce_checkout_form_title_color',
					[
						'label' => __( 'Form Title Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .woocommerce-billing-fields label' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'rig_woocommerce_checkout_form_field_color',
					[
						'label' => __( 'Form Field Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .woocommerce-billing-fields input' => 'color: {{VALUE}}',
							'{{WRAPPER}} .woocommerce-billing-fields select' => 'color: {{VALUE}}',
						],
					]
				);
	
	
	
				$this->end_controls_section();


				// Additional Fields Controls


				$this->start_controls_section(
					'rig_woocommerce_additional_fields_control',
					[
						'label' => __( 'Additional Fields', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_woocommerce_additional_fields_heading_typography',
						'label' => __( 'Heading Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .woocommerce-additional-fields h3',
					]
				);
	
	
	
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_woocommerce_additional_fields_title_typography',
						'label' => __( 'Field Name Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .woocommerce-additional-fields label',
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_woocommerce_additional_fields_text_typography',
						'label' => __( 'Field Text Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .woocommerce-additional-fields textarea, .woocommerce-additional-fields input, .woocommerce-additional-fields select',
					]
				);

				$this->add_control(
					'rig_woocommerce_additional_fields_typography_divider',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);


				$this->add_responsive_control(
					'rig_woocommerce_additional_fields_form_width',
					[
						'label' => __( 'Field Width', 'rig-elements' ),
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
						'default' => [
							'unit' => '%',
							'size' => 100,
						],
						'selectors' => [
							'{{WRAPPER}} .woocommerce-additional-fields textarea' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'rig_woocommerce_additional_fields_margin',
					[
						'label' => __( 'Margin', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .woocommerce-additional-fields textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'rig_woocommerce_additional_fields_padding',
					[
						'label' => __( 'Padding', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .woocommerce-additional-fields textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rig_woocommerce_additional_fields_border',
						'label' => __( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .woocommerce-additional-fields textarea',
					]
				);

				$this->add_control(
					'rig_woocommerce_additional_fields_border_radius',
					[
						'label' => __( 'Border Radius', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .woocommerce-additional-fields textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_control(
					'rig_woocommerce_additional_fields_dimension_divider',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);


				$this->add_control(
					'rig_woocommerce_additional_fields_heading_color',
					[
						'label' => __( 'Heading Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .woocommerce-additional-fields h3' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'rig_woocommerce_additional_fields_title_color',
					[
						'label' => __( 'Field Title Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .woocommerce-additional-fields label' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'rig_woocommerce_additional_fields_text_color',
					[
						'label' => __( 'Field Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .woocommerce-additional-fields textarea,  .woocommerce-additional-fields textarea::placeholder' => 'color: {{VALUE}}',
						],
					]
				);


				$this->end_controls_section();


				// Order Review Controls


				$this->start_controls_section(
					'rig_woocommerce_order_review_control',
					[
						'label' => __( 'Order Review', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_woocommerce_order_review_heading_typography',
						'label' => __( 'Heading Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} #order_review_heading',
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_woocommerce_order_review_form_title_typography',
						'label' => __( 'Form Title Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order th',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_woocommerce_order_review_form_description_typography',
						'label' => __( 'Form Description Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order td',
					]
				);


				$this->add_control(
					'rig_woocommerce_order_review_typography_divider',
					[
						'type' => \Elementor\Controls_Manager::DIVIDER,
					]
				);


				$this->add_responsive_control(
					'rig_woocommerce_order_review_form_spacing',
					[
						'label' => __( 'Spacing', 'rig-elements' ),
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
						'default' => [
							'unit' => '%',
							'size' => 5,
						],
						'selectors' => [
							'{{WRAPPER}} #order_review_heading' => 'margin-top: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'rig_woocommerce_order_review_form_margin',
					[
						'label' => __( 'Margin', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .woocommerce-checkout-review-order table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'rig_woocommerce_order_review_form_padding',
					[
						'label' => __( 'Padding', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .woocommerce-checkout-review-order table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rig_woocommerce_order_review_form_border',
						'label' => __( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order table',
					]
				);



				$this->end_controls_section();


				// Payment Controls


				$this->start_controls_section(
					'rig_woocommerce_payment_control',
					[
						'label' => __( 'Payment', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);


				$this->add_responsive_control(
					'rig_woocommerce_payment_control_spacing',
					[
						'label' => __( 'Spacing', 'rig-elements' ),
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
						'default' => [
							'unit' => '%',
							'size' => 2,
						],
						'selectors' => [
							'{{WRAPPER}} #payment' => 'margin-top: {{SIZE}}{{UNIT}};',
						],
					]
				);


				$this->add_responsive_control(
					'rig_woocommerce_payment_control_padding',
					[
						'label' => __( 'Padding', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} #payment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_woocommerce_payment_control_typography',
						'label' => __( 'Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} #payment',
					]
				);


				$this->add_control(
					'rig_woocommerce_payment_control_background_color',
					[
						'label' => __( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} #payment' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'rig_woocommerce_payment_control_text_color',
					[
						'label' => __( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} #payment' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rig_woocommerce_payment_control_border',
						'label' => __( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} #payment',
					]
				);


				$this->add_control(
					'rig_woocommerce_payment_control_border_radius',
					[
						'label' => __( 'Border Radius', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} #payment' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->end_controls_section();


				// Place Order Button Controls


				$this->start_controls_section(
					'rig_woocommerce_place_order_button_control',
					[
						'label' => __( 'Place Order Button', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_woocommerce_place_order_button_typography',
						'label' => __( 'Typography', 'rig-elements' ),
						'selector' => '{{WRAPPER}} #place_order',
					]
				);

				$this->add_responsive_control(
					'rig_woocommerce_place_order_button_width',
					[
						'label' => __( 'Button Width', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} #place_order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->start_controls_tabs(
					'rig_woocommerce_place_order_button_tab'
				);

				$this->start_controls_tab(
					'rig_woocommerce_place_order_button_normal',
					[
						'label' => __( 'Normal', 'rig-elements' ),
					]
				);


				$this->add_control(
					'rig_woocommerce_place_order_button_background_color',
					[
						'label' => __( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} #place_order' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'rig_woocommerce_place_order_button_text_color',
					[
						'label' => __( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} #place_order' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rig_woocommerce_place_order_button_border',
						'label' => __( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} #place_order',
					]
				);


				$this->add_control(
					'rig_woocommerce_place_order_button_border_radius',
					[
						'label' => __( 'Border Radius', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} #place_order' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'rig_woocommerce_place_order_button_box_shadow',
						'label' => __( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} #place_order',
					]
				);

				$this->end_controls_tab();


				$this->start_controls_tab(
					'rig_woocommerce_place_order_button_hover',
					[
						'label' => __( 'Hover', 'rig-elements' ),
					]
				);

				$this->add_control(
					'rig_woocommerce_place_order_button_background_color_hover',
					[
						'label' => __( 'Background Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} #place_order:hover' => 'background-color: {{VALUE}}',
						],
					]
				);


				$this->add_control(
					'rig_woocommerce_place_order_button_text_color_hover',
					[
						'label' => __( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} #place_order:hover' => 'color: {{VALUE}}',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rig_woocommerce_place_order_button_border_hover',
						'label' => __( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} #place_order:hover',
					]
				);


				$this->add_control(
					'rig_woocommerce_place_order_button_border_radius_hover',
					[
						'label' => __( 'Border Radius', 'rig-elements' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} #place_order:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);


				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'rig_woocommerce_place_order_button_box_shadow_hover',
						'label' => __( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} #place_order:hover',
					]
				);


				$this->end_controls_tab();
				
				$this->end_controls_tabs();

				$this->end_controls_section();
	

			}


			protected function render() {
                    echo do_shortcode('[woocommerce_checkout]');
				}
			
			
		}

		
