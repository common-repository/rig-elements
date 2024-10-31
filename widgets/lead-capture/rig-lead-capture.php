<?php
namespace RigElements\Widgets;

use Timber\Timber;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit();
} // Exit if accessed directly

class Rig_Lead_Capture extends Widget_Base
{
    public function get_name()
    {
        return 'rig-lead-capture';
    }

    public function get_title()
    {
        return __('Lead Capture', 'rig-elements');
    }

    public function get_icon()
    {
        return 'rig-lead-capture';
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
        return ['rig-ajax'];
    }

    protected function register_controls() {
        
        // Content Controls
        $this->start_controls_section(
            'rig_lead_capture_content_controls',
            [
                'label' => __( 'Layout', 'rig-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'lead_form_layout',
            [
                'label' => esc_html__( 'Lead Form Layout', 'rig-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'vertical',
                'options' => [
                    'vertical'  => esc_html__( 'Vertical', 'rig-elements' ),
                    'horizontal'  => esc_html__( 'Horizontal', 'rig-elements' ),
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'rig_lead_capture_name_field',
            [
                'label' => __( 'Name Field', 'rig-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'rig_lead_capture_name_field_enable',
			[
				'label' => esc_html__( 'Show This Field', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'lead_from_name_field_label',
			[
				'label' => esc_html__( 'Name Field Label', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Name', 'rig-elements' ),
			]
		);

        $this->add_control(
			'lead_from_name_field_placeholder',
			[
				'label' => esc_html__( 'Name Field Placeholder', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Jhon Doe', 'rig-elements' ),
			]
		);

        $this->end_controls_section();


        $this->start_controls_section(
            'rig_lead_capture_email_field',
            [
                'label' => __( 'Email Field', 'rig-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
			'lead_from_email_field_label',
			[
				'label' => esc_html__( 'Email Field Label', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Email', 'rig-elements' ),
			]
		);


        $this->add_control(
			'lead_from_email_field_placeholder',
			[
				'label' => esc_html__( 'Email Field Placeholder', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'info@example.com', 'rig-elements' ),
			]
		);


        $this->end_controls_section();


        $this->start_controls_section(
            'rig_lead_capture_button_controls',
            [
                'label' => __( 'Button', 'rig-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'lead_from_email_button_text',
			[
				'label' => esc_html__( 'Button Text', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Submit', 'rig-elements' ),
			]
		);

        $this->add_control(
			'lead_from_submit_url', [
				'label' => esc_html__( 'After Submit URL', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'rig-elements' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);

        $this->end_controls_section();


        $this->start_controls_section(
            'rig_lead_capture_fields_style',
            [
                'label' => __( 'Fields', 'rig-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'lead_capture_fields_margin',
			[
				'label' => esc_html__( 'Margin', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rig-leads-form input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'lead_capture_fields_padding',
			[
				'label' => esc_html__( 'Padding', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rig-leads-form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'lead_capture_fields_border',
				'label' => esc_html__( 'Border', 'rig-elements' ),
				'selector' => '{{WRAPPER}} .rig-leads-form input',
			]
		);


        $this->add_responsive_control(
			'lead_capture_fields_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .rig-leads-form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Label Typography', 'rig-elements' ),
                'name' => 'lead_capture_fields_label_typography',
				'selector' => '{{WRAPPER}} .rig-leads-form label',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Text Typography', 'rig-elements' ),
                'name' => 'lead_capture_fields_text_typography',
				'selector' => '{{WRAPPER}} .rig-leads-form input',
			]
		);

        $this->add_control(
			'lead_capture_fields_label_color',
			[
				'label' => esc_html__( 'Label Color', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rig-leads-form label' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'lead_capture_fields_text_color',
			[
				'label' => esc_html__( 'Text Color', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rig-leads-form input' => 'color: {{VALUE}}',
				],
			]
		);


        $this->end_controls_section();


        $this->start_controls_section(
            'rig_lead_capture_button_style',
            [
                'label' => __( 'Submit Button', 'rig-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'lead_capture_button_margin',
			[
				'label' => esc_html__( 'Margin', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} #rig-lead-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'lead_capture_button_padding',
			[
				'label' => esc_html__( 'Padding', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} #rig-lead-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'lead_capture_button_border',
				'label' => esc_html__( 'Border', 'rig-elements' ),
				'selector' => '{{WRAPPER}} #rig-lead-submit',
			]
		);


        $this->add_responsive_control(
			'lead_capture_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} #rig-lead-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'rig-elements' ),
                'name' => 'lead_capture_button_typography',
				'selector' => '{{WRAPPER}} #rig-lead-submit',
			]
		);


        $this->add_control(
			'lead_capture_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #rig-lead-submit' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'lead_capture_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'rig-elements' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #rig-lead-submit' => 'background-color: {{VALUE}}',
				],
			]
		);
        
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        Timber::render($settings['lead_form_layout'].'.twig', [
            'enable_name_field' => $settings['rig_lead_capture_name_field_enable'],
            'name_field_label' => $settings['lead_from_name_field_label'],
            'name_field_placeholder' => $settings['lead_from_name_field_placeholder'],
            'email_field_label' => $settings['lead_from_email_field_label'],
            'email_field_placeholder' => $settings['lead_from_email_field_placeholder'],
            'button_text' => $settings['lead_from_email_button_text'],
            'action_url' => $settings['lead_from_submit_url']['url'],
        ]);
        
    }
}
