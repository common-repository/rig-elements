<?php
    namespace RigElements\Widgets;
    use Timber\Timber;
    use Elementor\Widget_Base;
    use Elementor\Controls_Manager;

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    class Rig_Imgur_Embed extends Widget_Base {
        
        public function get_name(){
            
            return 'rig-imgur';
        }

        public function get_title() {
            return __('Imgur', 'rig-elements');
        }

        public function get_icon() {
            return 'rig-imgur';
        }

        public function get_categories() {
            return ['rig_elements_widgets'];
        }

        public function get_style_depends() {
            return ['rig-app'];
        }

        public function get_script_depends() {
            return ['rig-elements'];
        }

        protected function _register_controls() {
            // Content Controls

            $this->start_controls_section(
                'rig_imgur_embed_contols',
            [
                'label' => __('Imgur Link', 'rig-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_control(
                'imgur_link',
                [
                    'label' => esc_html__( 'Link', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'rig-elements' ),
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                        'custom_attributes' => '',
                    ],
                ]
            );
    

            $this->end_controls_section();


            // Style Controls

            $this->start_controls_section(
                'rig_imgur_embed_style',
            [
                'label' => __('Embed Background', 'rig-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]);

            $this->add_control(
                'imgur_padding',
                [
                    'label' => esc_html__( 'Padding', 'rig-elements' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .rig-imgur-embed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'imgur_background_color',
                [
                    'label' => esc_html__( 'Background Color', 'plugin-name' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rig-imgur-embed' => 'background-color: {{VALUE}}',
                    ],
                ]
            );
    
    


            $this->end_controls_section();

        }

        protected function render() {
            $settings = $this->get_settings_for_display();

            $url = $settings['imgur_link']['url'];
            $oembed = _wp_oembed_get_object();
            $oembed_provider = $oembed->get_provider( $url);
            $oembed_data = $oembed->fetch( $oembed_provider, $url);

            Timber::render('view.twig', [
                'oembed_data' => $oembed_data->html,
            ]);
            
        }
    }
