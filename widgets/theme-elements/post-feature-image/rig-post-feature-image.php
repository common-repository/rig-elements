<?php
		namespace RigElements\Widgets;

		use Timber\Timber;
		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;
		use RigElements\Rig_Query_Control;


		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Post_Feature_Image extends Widget_Base {


			public function get_name() {
				return 'rig-post-feature-image';
			}


			public function get_title() {
				return __( 'Post Feature Image', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-post-feature-image';
			}


			public function get_categories() {
				return [ 'rig_elements_single_widgets' ];
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
					'rig_post_feature_image_preview_section',
					[
						'label' => __( 'Preview', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				$this->add_control(
					'rig_post_feature_image_preview_include',
					[
						'label' => __( 'Post', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'multiple' => false,
						'options' => (new Rig_Query_Control())->get_preview_feature_image(),
						'default' => 'To get the preview please sepect a post from the preview tab',
					]
				);

				$this->end_controls_section();


				// Style Controls

				$this->start_controls_section(
					'rig_post_feature_image_style_section',
					[
						'label' => __( 'Image', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_responsive_control(
                    'rig_post_feature_image_fit',
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
							'{{WRAPPER}} .rig-post-feature-image' => 'object-fit: {{options}}',
						],
                    ]
                );


				$this->add_responsive_control(
                    'rig_post_feature_image_width',
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
                            '{{WRAPPER}} .rig-post-feature-image' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );


                $this->add_responsive_control(
                    'rig_post_feature_image_height',
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
                            '{{WRAPPER}} .rig-post-feature-image' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rig_post_feature_image_border',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-post-feature-image',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rig_post_feature_image_border',
						'label' => esc_html__( 'Border', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-post-feature-image',
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'rig_post_feature_image_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-post-feature-image',
					]
				);

				$this->add_control(
					'rig_post_feature_entrance_animation',
					[
						'label' => esc_html__( 'Entrance Animation', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::ANIMATION,
						'prefix_class' => 'animated ',
					]
				);
		
		
				
				$this->end_controls_section();

			}


			protected function render() {
				$settings = $this->get_settings_for_display();

				$preview_image = (new Rig_Query_Control())->get_preview_feature_image();
				$post_image = (new Rig_Query_Control())->get_the_feature_image();
				$elementor_preview_mode = (new Rig_Query_Control())->is_elementor_preview_mode();

				Timber::render('view.twig', [
					'elementor_preview_mode' => $elementor_preview_mode,
					'post_image' => $post_image,
					'preview_image' => $preview_image,
					'entrance_animation' => $settings['rig_post_feature_entrance_animation'],
				]);

				
			}

            protected function _content_template() {
                ?>
				<img src="{{{settings.rig_post_feature_image_preview_include}}}" class="{{ settings.entrance_animation }}rig-post-feature-image">
				<?php
            }
			
		}