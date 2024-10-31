<?php
		namespace RigElements\Widgets;

		use Timber\Timber;
		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;
		use RigElements\Rig_Query_Control;

		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Post_Content extends Widget_Base {


			public function get_name() {
				return 'rig-post-content';
			}


			public function get_title() {
				return __( 'Post Content', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-post-description';
			}


			public function get_categories() {
				return [ 'rig_elements_single_widgets' ];
			}


			public function get_style_depends() {
				return [ 'core_css'];
			}

			public function get_script_depends() {
				return [ 'rig-main' ];
			}


			protected function register_controls() {

				$this->start_controls_section(
					'rig_post_content',
					[
						'label' => __( 'Content', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				
				$this->add_responsive_control(
					'rig_post_content_align',
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
							'{{WRAPPER}} .rig-post-content' => 'text-align: {{VALUE}}',
						],
					]
				);
				$this->end_controls_section();

				$this->start_controls_section(
					'rig_post_content_preview_section',
					[
						'label' => __( 'Preview', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				$this->add_control(
					'rig_post_content_preview_include',
					[
						'label' => __( 'Post', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'multiple' => false,
						'options' => (new Rig_Query_Control())->get_preview_content(),
						'default' => 'To get the preview please sepect a post from the preview tab',
					]
				);


				$this->end_controls_section();

				$this->start_controls_section(
					'rig_post_content_style_section',
					[
						'label' => __( 'Style', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);
				$this->add_control(
					'rig_post_content_color',
					[
						'label' => __( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						// 'scheme' => [
						// 	'type' => \Elementor\Scheme_Color::get_type(),
						// 	'value' => \Elementor\Scheme_Color::COLOR_1,
						// ],
						'selectors' => [
							'{{WRAPPER}} .rig-post-content p' => 'color: {{VALUE}}',
						],
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_post_content_typography',
						'label' => __( 'Typography', 'rig-elements' ),
						// 'scheme' => Scheme_Typography::TYPOGRAPHY_1,
						'selector' => '{{WRAPPER}} .rig-post-content',
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Text_Shadow::get_type(),
					[
						'name' => 'rig_post_content_shadow',
						'label' => __( 'Text Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-post-content',
					]
				);
				$this->end_controls_section();
			}


			protected function render() {
				$settings = $this->get_settings_for_display();				
				$preview_content = (new Rig_Query_Control())->get_preview_content();
				$post_content = (new Rig_Query_Control())->get_the_content();
				$elementor_preview_mode = (new Rig_Query_Control())->is_elementor_preview_mode();

				Timber::render('view.twig', [
					'elementor_preview_mode' => $elementor_preview_mode,
					'post_content' => $post_content,
					'preview_content' => $preview_content,
				]);

			}


			protected function _content_template() {
                ?>
				<div class="rig-post-content">
				{{{settings.rig_post_content_preview_include}}}
			</div>
				<?php
            }

		}
