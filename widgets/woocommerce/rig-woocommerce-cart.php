<?php
		namespace RigElements\Widgets;

		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_WooCommerce_Cart extends Widget_Base {


			public function get_name() {
				return 'rig-woocommerce-cart';
			}


			public function get_title() {
				return __( 'WooCommerce Cart', 'rig-elements' );
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


            //  Controls Start


            // Container Styles

            $this->start_controls_section(
                'rig_woocommerce_cart_container',
                [
                    'label' => __( 'Container', 'rig-elements' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_container_background_color',
                [
                    'label' => __( 'Background Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce' => 'background-color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_responsive_control(
                'rig_woocommerce_cart_container_padding',
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


            // Cart Form Controls


            $this->start_controls_section(
                'rig_woocommerce_cart_form_control',
                [
                    'label' => __( 'Cart Form', 'rig-elements' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );



            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_form_title_typography',
                    'label' => __( 'Form Title Typography', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .woocommerce-cart-form__contents th',
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_form_description_typography',
                    'label' => __( 'Form Description Typography', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .woocommerce-cart-form__contents td',
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_form_divider',
                [
                    'type' => \Elementor\Controls_Manager::DIVIDER,
                ]
            );



            $this->add_control(
                'rig_woocommerce_cart_form_header_background_color',
                [
                    'label' => __( 'Form Header Background Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce thead' => 'background-color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_form_footer_background_color',
                [
                    'label' => __( 'Form Footer Background Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .actions' => 'background-color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_form_title_color',
                [
                    'label' => __( 'Form Title Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-cart-form__contents th' => 'color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_form_description_color',
                [
                    'label' => __( 'Form Description Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-cart-form__contents td' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'rig_woocommerce_cart_form_link_color',
                [
                    'label' => __( 'Form Link Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .woocommerce-cart-form__contents td a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->end_controls_section();


            // Cart Total Style Controls


            $this->start_controls_section(
                'rig_woocommerce_cart_total_control',
                [
                    'label' => __( 'Cart Total', 'rig-elements' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_total_heading_typography',
                    'label' => __( ' Cart Total Heading Typography', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .cart_totals h2',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_total_description_typography',
                    'label' => __( 'Cart Total Description Typography', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .cart_totals table',
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_total_divider',
                [
                    'type' => \Elementor\Controls_Manager::DIVIDER,
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_total_heading_color',
                [
                    'label' => __( 'Cart Total Heading Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cart_totals h2' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'rig_woocommerce_cart_total_description_color',
                [
                    'label' => __( 'Cart Total Description Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cart_totals table' => 'color: {{VALUE}}',
                    ],
                ]
            );


            $this->end_controls_section();


            // Common Button Controls

            $this->start_controls_section(
                'rig_woocommerce_cart_button_control',
                [
                    'label' => __( 'Common Buttons', 'rig-elements' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_button_typography',
                    'label' => __( 'Typography', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .button',
                ]
            );


            $this->start_controls_tabs(
                'cart_button_tabs'
            );


            $this->start_controls_tab(
                'cart_button_normal',
                [
                    'label' => __( 'Normal', 'rig-elements' ),
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_button_color',
                [
                    'label' => __( 'Text Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .button' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'rig_woocommerce_cart_button_background_color',
                [
                    'label' => __( 'Background Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .button' => 'background-color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_button_border',
                    'label' => __( 'Border', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .button',
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_button_box_shadow',
                    'label' => __( 'Box Shadow', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .button',
                ]
            );
    

            $this->end_controls_tab();


            $this->start_controls_tab(
                'cart_button_hover',
                [
                    'label' => __( 'Hover', 'rig-elements' ),
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_button_color_hover',
                [
                    'label' => __( 'Text Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .button:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_button_background_color_hover',
                [
                    'label' => __( 'Background Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .button:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_button_border_hover',
                    'label' => __( 'Border', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .button:hover',
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_button_box_shadow_hover',
                    'label' => __( 'Box Shadow', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .button:hover',
                ]
            );


            $this->end_controls_tab();

            $this->end_controls_tabs();


            $this->add_control(
                'rig_woocommerce_cart_button_border_radius',
                [
                    'label' => __( 'Border Radius', 'rig-elements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );


            $this->end_controls_section();


            // Checkout Button Controls

            $this->start_controls_section(
                'rig_woocommerce_cart_chaekout_button_control',
                [
                    'label' => __( 'Checkout Button', 'rig-elements' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_checkout_button_typography',
                    'label' => __( 'Typography', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .checkout-button',
                ]
            );


            $this->start_controls_tabs(
                'checkout_button_tabs'
            );

            $this->start_controls_tab(
                'checkout_button_normal',
                [
                    'label' => __( 'Normal', 'rig-elements' ),
                ]
            );

            $this->add_control(
                'rig_woocommerce_cart_checkout_button_color',
                [
                    'label' => __( 'Text Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .checkout-button' => 'color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_checkout_button_background_color',
                [
                    'label' => __( 'Background Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .checkout-button' => 'background-color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_checkout_button_border',
                    'label' => __( 'Border', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .checkout-button',
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_checkout_button_box_shadow',
                    'label' => __( 'Box Shadow', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .checkout-button',
                ]
            );

            $this->end_controls_tab();


            $this->start_controls_tab(
                'checkout_button_hover',
                [
                    'label' => __( 'Hover', 'rig-elements' ),
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_checkout_button_color_hover',
                [
                    'label' => __( 'Text Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .checkout-button:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_control(
                'rig_woocommerce_cart_checkout_button_background_color_hover',
                [
                    'label' => __( 'Background Color', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .checkout-button:hover' => 'background-color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_checkout_button_border_hover',
                    'label' => __( 'Border', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .checkout-button:hover',
                ]
            );


            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'rig_woocommerce_cart_checkout_button_box_shadow_hover',
                    'label' => __( 'Box Shadow', 'rig-elements' ),
                    'selector' => '{{WRAPPER}} .checkout-button:hover',
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();


            $this->add_control(
                'rig_woocommerce_cart_checkout_button_border_radius',
                [
                    'label' => __( 'Border Radius', 'rig-elements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .checkout-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );


            $this->end_controls_section();


			}


			protected function render() {
                    echo do_shortcode('[woocommerce_cart]');
				}
			
			
			
		}

		
