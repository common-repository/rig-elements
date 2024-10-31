<?php
		namespace RigElements\Widgets;

		use Timber\Timber;
		use Elementor\Widget_Base;
		use Elementor\Controls_Manager;
		use RigElements\Rig_Query_Control;


		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


		class Rig_Post_Title extends Widget_Base {


			public function get_name() {
				return 'rig-post-title';
			}


			public function get_title() {
				return __( 'Post Title', 'rig-elements' );
			}


			public function get_icon() {
				return 'rig-post-title';
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


			protected function _register_controls() {

				$this->start_controls_section(
					'rig_post_title_content_section',
					[
						'label' => __( 'Content', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);
		
				$this->add_control(
					'rig_post_title_link',
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
				$this->add_control(
					'rig_post_title_tag',
					[
						'label' => __( 'HTML Tag', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'default' => 'h2',
						'options' => [
							'h1'  => __( 'H1', 'rig-elements' ),
							'h2' => __( 'H2', 'rig-elements' ),
							'h3' => __( 'H3', 'rig-elements' ),
							'h4' => __( 'H4', 'rig-elements' ),
							'h5' => __( 'H5', 'rig-elements' ),
							'h6' => __( 'H6', 'rig-elements' ),
							'div' => __( 'div', 'rig-elements' ),
							'p' => __( 'p', 'rig-elements' ),
						],
					]
				);
				$this->add_responsive_control(
					'rig_post_title_align',
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
							'{{WRAPPER}} .rig-post-title' => 'text-align: {{VALUE}}',
						],
					]
				);
				$this->end_controls_section();


				$this->start_controls_section(
					'rig_post_title_preview_section',
					[
						'label' => __( 'Preview', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
					]
				);

				// $this->add_control(
				// 	'rig_post_title_preview_post_type',
				// 	[
				// 		'label' => __( 'Post Type', 'rig-elements' ),
				// 		'type' => \Elementor\Controls_Manager::SELECT,
				// 		'default' => 'post',
				// 		'options' => $post_type
				// 	]
				// );

				$this->add_control(
					'rig_post_title_preview_include',
					[
						'label' => __( 'Post', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::SELECT2,
						'multiple' => false,
						'options' => (new Rig_Query_Control())->get_preview_title(),
						'default' => 'To get the preview please sepect a post from the preview tab',
					]
				);	

				$this->end_controls_section();


				$this->start_controls_section(
					'rig_post_title_style_section',
					[
						'label' => __( 'Style', 'rig-elements' ),
						'tab' => \Elementor\Controls_Manager::TAB_STYLE,
					]
				);
		
				$this->add_control(
					'rig_post_title_color',
					[
						'label' => __( 'Text Color', 'rig-elements' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .rig-post-title' => 'color: {{VALUE}}',
						],
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'rig_post_title_typography',
						'label' => __( 'Typography', 'rig-elements' ),
						// 'scheme' => Scheme_Typography::TYPOGRAPHY_1,
						'selector' => '{{WRAPPER}} .rig-post-title',
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Text_Shadow::get_type(),
					[
						'name' => 'rig_post_title_shadow',
						'label' => __( 'Text Shadow', 'rig-elements' ),
						'selector' => '{{WRAPPER}} .rig-post-title',
					]
				);
				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'rig_post_title_border',
						'label' => __( 'Border', 'rig-elements' ),
						'options' => [
							'solid'  => __( 'Solid', 'rig-elements' ),
							'dashed' => __( 'Dashed', 'rig-elements' ),
							'dotted' => __( 'Dotted', 'rig-elements' ),
							'double' => __( 'Double', 'rig-elements' ),
							'none' => __( 'None', 'rig-elements' ),
						],
						'selector' => '{{WRAPPER}} .rig-post-title',
					]
				);
				// $this->add_control(
				// 	'margin',
				// 	[
				// 		'label' => __( 'Margin', 'plugin-domain' ),
				// 		'type' => Controls_Manager::DIMENSIONS,
				// 		'size_units' => [ 'px', '%', 'em' ],
				// 		'selectors' => [
				// 			'{{WRAPPER}} .your-class' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				// 		],
				// 	]
				// );
				$this->end_controls_section();

			}


			protected function render() {
				$settings = $this->get_settings_for_display();
				$title_tag = $settings['rig_post_title_tag'];

				$preview_title = (new Rig_Query_Control())->get_preview_title();
				$post_title = (new Rig_Query_Control())->get_the_title();
				$elementor_preview_mode = (new Rig_Query_Control())->is_elementor_preview_mode();

				Timber::render('view.twig', [
					'elementor_preview_mode' => $elementor_preview_mode,
					'title_tag' => $title_tag,
					'post_title' => $post_title,
					'preview_title' => $preview_title,
				]);

				
			}

            protected function _content_template() {
                ?>
				<{{{settings.rig_post_title_tag}}} class="rig-post-title">
				{{{settings.rig_post_title_preview_include}}}
				</{{{settings.rig_post_title_tag}}}>
				<?php
            }
			
		}






		