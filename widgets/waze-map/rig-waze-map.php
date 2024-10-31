<?php
namespace RigElements\Widgets;

use Timber\Timber;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit();
} // Exit if accessed directly

class Rig_waze_map extends Widget_Base
{
    public function get_name()
    {
        return 'Waze Map';
    }

    public function get_title()
    {
        return __('Waze Map', 'rig-elements');
    }

    public function get_icon()
    {
        return 'rig-waze-map';
    }

    public function get_categories()
    {
        return ['rig_elements_widgets'];
    }

    public function get_style_depends()
    {
        return ['rig-app'];
    }

    public function get_script_depends()
    {
        return ['rig-elements'];
    }

    protected function _register_controls()
    {
        // Content Controls
        $this->start_controls_section(
            'rig_waze_map_content',
        [
            'label' => __('Waze Map Content', 'rig-elements'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control(
            'rig_waze_map_latitude',
        [
            'label' => __('Latitude', 'rig-elements'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 37.332,
        ]);
        $this->add_control(
            'rig_waze_map_longtitude',
        [
            'label' => __('Longtitude', 'rig-elements'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => -122.033,
        ]);

        $this->add_responsive_control('rig_waze_map_height', [
            'label' => __('Height', 'rig-elements'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 40,
                    'max' => 1440,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .rig_waze_map .rig_waze_map_frame' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]);


        $this->add_responsive_control('rig_waze_map_width', [
            'label' => __('Width', 'rig-elements'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 40,
                    'max' => 1440,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .rig_waze_map .rig_waze_map_frame' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('rig_waze_map_zoom', [
            'label' => __('Zoom', 'rig-elements'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 3,
                    'max' => 17,
                ],
            ],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        Timber::render('view.twig', [
            'waze_map_zoom' => $settings['rig_waze_map_zoom'],
			'waze_map_latitude' => $settings['rig_waze_map_latitude'],
            'waze_map_longtitude' => $settings['rig_waze_map_longtitude'],
        ]);
    }
}
