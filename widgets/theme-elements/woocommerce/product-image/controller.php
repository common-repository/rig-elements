<?php
		namespace RigElements\Widgets;

		use Timber\Timber;
        use Elementor\Widget_Base;
		use Elementor\Controls_Manager;
		use RigElements\Rig_Query_Control;


		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Product_Image extends Widget_Base {


			
			public function get_name() {
				return 'rig-product-image';
			}


			public function get_title() {
				return __( 'Product Image', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-product-image';
			}


			public function get_categories() {
				return [ 'rig_elements_woocommerce_widgets' ];
			}


			public function get_style_depends() {
				return [ 'core_css'];
			}

			public function get_script_depends() {
				return [ 'rig-main'];
			}


			protected function register_controls() {
				$this->start_controls_section(
					'rig_product_image_content_section',
					[
						'label' => __( 'Image', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);
                $this->add_control(
                    'rig_product_image_important_note',
                    [
                        'label' => __( 'Important Note', 'plugin-name' ),
                        'type' => \Elementor\Controls_Manager::RAW_HTML,
                        'raw' => __( 'A very important message to show in the panel.', 'plugin-name' ),
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                    ]
                );
                $this->add_control(
                    'rig_product_image_align',
                    [
                        'label' => __( 'Alignment', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::CHOOSE,
                        'options' => [
                            'start' => [
                                'title' => __( 'Left', 'rig-elements' ),
                                'icon' => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => __( 'Center', 'rig-elements' ),
                                'icon' => 'eicon-text-align-center',
                            ],
                            'end' => [
                                'title' => __( 'Right', 'rig-elements' ),
                                'icon' => 'eicon-text-align-right',
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .elementor-widget-container' => 'display:flex;justify-content:{{VALUE}}',
                            // '{{WRAPPER}} .elementor-widget-container' => 'justify-content:{{VALUE}};',
                        ],
                        'default' => 'center',
                        'toggle' => true,
                    ]
                );
				
				$this->end_controls_section();

                $this->start_controls_section(
					'rig_product_image_default_image_section',
					[
						'label' => __( 'Default Image', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

                $this->add_control(
                    'rig_product_image_default_image_switcher',
                    [
                        'label' => __( 'Enable Default Image', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'enable' => __( 'Enable', 'your-plugin' ),
                        'disable' => __( 'Disable', 'your-plugin' ),
                        'return_value' => 'enable',
                        'default' => 'disable',
                    ]
                );

                $this->add_control(
                    'rig_product_image_default_image',
                    [
                        'label' => __( 'Choose Image', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                        'conditions' => [
                            'relation' => 'and',
                            'terms' => [
								[
                                    'name' => 'rig_product_image_default_image_switcher',
                                    'operator' => '==',
                                    'value' => 'enable',
                                ],
                            ],
						],
                    ]
                );

				$this->end_controls_section();

				$this->start_controls_section(
					'rig_product_image_preview_section',
					[
						'label' => __( 'Preview', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				$this->end_controls_section();
                $this->start_controls_section(
                    'rig_product_image_style',
                    [
                        'label' => __( 'Style', 'rig-elements' ),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    ]
                );
                $this->add_responsive_control(
                    'rig_product_image_width',
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
                            '{{WRAPPER}} .rig-single-products-img' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );


                $this->add_responsive_control(
                    'rig_product_image_height',
                    [
                        'label' => __( 'Image Height', 'rig-elements' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px'],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 2500,
                                'step' => 1,
                            ],
                        ],
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => 700,
                        ],
						'tablet_default' => [
                            'unit' => 'px',
                            'size' => 300,
                        ],
						'mobile_default' => [
                            'unit' => 'px',
                            'size' => 150,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .rig-single-products-img' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                 
				$this->add_responsive_control(
                    'rig_product_image_image_fit',
                    [
                        'label' => __( 'Image Fit', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
						'devices' => [ 'desktop', 'tablet', 'mobile' ],
						'desktop_default' => 'auto',
						'tablet_default'  => 'auto',
						'mobile_default'  => 'auto',
                        'options' => [
                            'contain'  => __( 'Contain', 'rig-elements' ),
                            'cover' => __( 'Cover', 'rig-elements' ),
                            'auto' => __( 'Auto', 'rig-elements' ),
                            'fill' => __( 'Fill', 'rig-elements' ),
                            'none' => __( 'None', 'rig-elements' ),
                        ],

						'selectors' => [
							'{{WRAPPER}} .rig-single-products-img' => 'object-fit: {{options}}',
						],
                    ]
                );
                $this->add_group_control(
                    \Elementor\Group_Control_Border::get_type(),
                    [
                        'name' => 'rig_product_image_border',
                        'label' => __( 'Border', 'rig-elements' ),
                        'selector' => '{{WRAPPER}} .wrapper',
                    ]
                );
                $this->add_group_control(
                    \Elementor\Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'rig_product_image_
                        box_shadow',
                        'label' => __( 'Box Shadow', 'rig-elements' ),
                        'selector' => '{{WRAPPER}} .wrapper',
                    ]
                );
                $this->end_controls_section();
			}


			protected function render() {
				$settings = $this->get_settings_for_display();
				$product_image = (new Rig_Query_Control())->get_product_image();
				$preview_image = (new Rig_Query_Control())->get_product_preview_image();
                $elementor_preview_mode = (new Rig_Query_Control())->is_elementor_preview_mode();

                $default_image_switcher = $settings['rig_product_image_default_image_switcher'];
                $product_default_image = $settings['rig_product_image_default_image'];

                Timber::render('view.twig', [
					'elementor_preview_mode' => $elementor_preview_mode,
                    'product_image' => $product_image,
					'preview_image' => $preview_image,
                    'default_image_switcher' => $default_image_switcher,
                    'product_default_image' => $product_default_image,
				]);
                
			}

		}






		