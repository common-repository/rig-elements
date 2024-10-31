<?php
		namespace RigElements\Widgets;

		use Timber\Timber;
		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Lottie_Animation extends Widget_Base {


			public function get_name() {
				return 'rig-lottie-animation';
			}


			public function get_title() {
				return __( 'Lottie Animation', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-lottie-animation';
			}


			public function get_categories() {
				return [ 'rig_elements_widgets' ];
			}


			public function get_style_depends() {
				return [ 'rig-app'];
			}

			public function get_script_depends() {
				return [ 'rig-lottie' ];
			}


			protected function _register_controls() {

				// Content Controls
                
                $this->start_controls_section(
					'lottie_animation_content_controls',
					[
						'label' => __( 'Animation Source', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				$this->add_control(
					'animation_source',
					[
						'label' => esc_html__( 'Select Source', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'external',
						'options' => [
							'external'  => esc_html__( 'External URL', 'rig-elements' ),
						],
					]
				);

                $this->add_control(
                    'animation_url',
                    [
                        'label' => esc_html__( 'Animation URL', 'rig-elements' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'placeholder' => esc_html__( 'https://your-link.com', 'rig-elements' ),
						'conditions' => [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name' => 'animation_source',
                                    'operator' => '==',
                                    'value' => 'external',
                                ],
                            ],
						],
                        'default' => [
                            'url' => 'https://assets7.lottiefiles.com/packages/lf20_rhnmhzwj.json',
                            'is_external' => true,
                            'nofollow' => true,
                            'custom_attributes' => '',
                        ],
                    ]
                );
		

                $this->end_controls_section();


				$this->start_controls_section(
					'lottie_animation_settings',
					[
						'label' => __( 'Animation Settings', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				$this->add_control(
					'animation_play_mode',
					[
						'label' => esc_html__( 'Play Mode', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'normal',
						'options' => [
							'normal'  => esc_html__( 'Normal', 'rig-elements' ),
							'bounce' => esc_html__( 'Bounce', 'rig-elements' ),
						],
					]
				);


				$this->add_control(
					'animation_direction',
					[
						'label' => esc_html__( 'Direction', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => '1',
						'options' => [
							'1'  => esc_html__( 'Forward', 'rig-elements' ),
							'-1' => esc_html__( 'Backward', 'rig-elements' ),
						],
					]
				);

				$this->add_control(
					'animation_autoplay',
					[
						'label' => esc_html__( 'Autoplay', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'autoplay',
						'options' => [
							'autoplay'  => esc_html__( 'Yes', 'rig-elements' ),
							'' => esc_html__( 'No', 'rig-elements' ),
						],
					]
				);


				$this->add_control(
					'animation_hover',
					[
						'label' => esc_html__( 'Play On Hover', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => '',
						'options' => [
							'hover'  => esc_html__( 'Yes', 'rig-elements' ),
							'' => esc_html__( 'No', 'rig-elements' ),
						],
					]
				);

				$this->add_control(
					'animation_repet',
					[
						'label' => esc_html__( 'Repet', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'loop',
						'options' => [
							'loop'  => esc_html__( 'Yes', 'rig-elements' ),
							'' => esc_html__( 'No', 'rig-elements' ),
						],
					]
				);

				$this->add_control(
					'animation_speed',
					[
						'label' => esc_html__( 'Animation Speed', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'range' => [
							'min' => 1,
							'max' => 100,
						],
						'default' => [
							'size' => 1,
						],
					]
				);
		

				$this->end_controls_section();


				$this->start_controls_section(
					'lottie_animation_height_width',
					[
						'label' => __( 'Height & Width', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_control(
					'animation_width',
					[
						'label' => esc_html__( 'Width', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
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
							'unit' => 'px',
							'size' => 300,
						],
					]
				);


				$this->add_control(
					'animation_height',
					[
						'label' => esc_html__( 'Height', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
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
							'unit' => 'px',
							'size' => 300,
						],
					]
				);


				$this->end_controls_section();


				$this->start_controls_section(
					'lottie_animation_background_color',
					[
						'label' => __( 'Background Color', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);

				$this->add_control(
					'background_color',
					[
						'label' => esc_html__( 'Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
					]
				);

				$this->end_controls_section();

			}


			protected function render() {
				$settings = $this->get_settings_for_display();
				
				Timber::render('view.twig', [
                    'animation_url' => $settings['animation_url'],
					'animation_play_mode' => $settings['animation_play_mode'],
					'animation_direction' => intval($settings['animation_direction']),
					'animation_repet' => $settings['animation_repet'],
					'animation_autoplay' => $settings['animation_autoplay'],
					'animation_hover' => $settings['animation_hover'],
					'animation_speed' => $settings['animation_speed']['size'],
					'animation_width' => $settings['animation_width'],
					'animation_height' => $settings['animation_height'],
					'background_color' => $settings['background_color'],
					
				]);
				

			}
			
		}
