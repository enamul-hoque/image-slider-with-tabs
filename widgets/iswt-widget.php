<?php
namespace ISWT_Widget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class ISWT_Widget extends Widget_Base {
	public function get_name() {
		return 'iswt_widget';
	}
	
	public function get_title() {
		return __( 'Image Slider with Tabs', 'image-slider-with-tabs' );
	}
	
	public function get_icon() {
		return 'eicon-slides';
	}
	
	public function get_categories() {
		return [ 'basic' ];
	}
	
	public function get_style_depends() {
		return [ 'image-slider-with-tabs-style' ];
	}
	
	public function get_script_depends() {
		return [ 'image-slider-with-tabs-script' ];
	}
	
	protected function register_controls() {
		// Section: Content Start.
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'image-slider-with-tabs' ),
			]
		);
			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'tab_title',
				[
					'label' => __( 'Tab Title', 'image-slider-with-tabs' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Tab Title' , 'image-slider-with-tabs' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'tab_gallery',
				[
					'label' => __( 'Tab Gallery', 'image-slider-with-tabs' ),
					'type' => Controls_Manager::GALLERY,
				]
			);

			$repeater->add_control(
				'tab_links',
				[
					'label' => __( 'Image Links', 'image-slider-with-tabs' ),
					'type' => Controls_Manager::TEXTAREA,
					'description' => __( 'Links should be separated by new line.', 'image-slider-with-tabs' ),
					'placeholder' => __( 'https://example.com' . PHP_EOL . 'https://godaddy.com', 'image-slider-with-tabs' ),
				]
			);

			$this->add_control(
				'iswt_tabs',
				[
					'label'       => __( 'Tabs', 'image-slider-with-tabs' ),
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default'     => [
						[
							'tab_title'   => __( 'Tab 1', 'image-slider-with-tabs' ),
							'tab_gallery' => [],
						],
					],
					'title_field' => '{{{ tab_title }}}',
				]
			);
		$this->end_controls_section();
		// Section: Content End.

		// Section: Style Start.
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Tabs', 'image-slider-with-tabs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name'     => 'filter_font',
					'label'    => __( 'Typography', 'image-slider-with-tabs' ),
					'selector' => '{{WRAPPER}} .iswt_filters > li',
				]
			);
			
			$this->add_responsive_control(
				'filter_gap',
				[
					'label'      => __( 'Gap', 'image-slider-with-tabs' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						],
						'em' => [
							'min'  => 0,
							'max'  => 10,
							'step' => 0.1,
						],
						'rem' => [
							'min'  => 0,
							'max'  => 10,
							'step' => 0.1,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .iswt_filters' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'filter_padding',
				[
					'label'      => __( 'Padding', 'image-slider-with-tabs' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', 'rem' ],
					'selectors'  => [
						'{{WRAPPER}} .iswt_filters > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs(
				'tab_colors'
			);
				$this->start_controls_tab(
					'tab_colors_normal',
					[
						'label' => esc_html__( 'Normal', 'image-slider-with-tabs' ),
					]
				);
					$this->add_control(
						'filter_color',
						[
							'label'     => __( 'Color', 'image-slider-with-tabs' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .iswt_filters > li' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'filter_bg_color',
						[
							'label'     => __( 'Background Color', 'image-slider-with-tabs' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .iswt_filters > li' => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'filter_border_color',
						[
							'label'     => __( 'Border Color', 'image-slider-with-tabs' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .iswt_filters > li' => 'border-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_colors_active',
					[
						'label' => esc_html__( 'Active', 'image-slider-with-tabs' ),
					]
				);
					$this->add_control(
						'filter_active_color',
						[
							'label'     => __( 'Color', 'image-slider-with-tabs' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .iswt_filters > li.active' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'filter_active_bg_color',
						[
							'label'     => __( 'Background Color', 'image-slider-with-tabs' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .iswt_filters > li.active' => 'background-color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'filter_active_border_color',
						[
							'label'     => __( 'Border Color', 'image-slider-with-tabs' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .iswt_filters > li.active' => 'border-color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		// Section: Content End.

		// Section: Slider Style Start.
		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => __( 'Slider', 'image-slider-with-tabs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'slider_count',
				[
					'label'      => __( 'Slides Per View', 'image-slider-with-tabs' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 10,
							'step' => 1,
						],
					],
					'default'    => [
						'size' => 3,
					],
				]
			);

			$this->add_responsive_control(
				'image_height',
				[
					'label'      => __( 'Image Height', 'image-slider-with-tabs' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%'  => [
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .iswt_wrapper .swiper-slide img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		// Section: Slider Style End.

		// Section: Pagitaion Styles.
		$this->start_controls_section(
			'section_pagination_style',
			[
				'label' => __( 'Pagination', 'image-slider-with-tabs' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'pagination_color',
				[
					'label'     => __( 'Color', 'image-slider-with-tabs' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'pagination_size',
				[
					'label'      => __( 'Size', 'image-slider-with-tabs' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 100,
							'step' => 1,
						],
						'em' => [
							'min'  => 0,
							'max'  => 10,
							'step' => 0.1,
						],
						'rem' => [
							'min'  => 0,
							'max'  => 10,
							'step' => 0.1,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => '--swiper-navigation-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'pagination_gap',
				[
					'label'      => __( 'Gap', 'image-slider-with-tabs' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range'      => [
						'px' => [
							'min'  => -100,
							'max'  => 100,
							'step' => 1,
						],
						'em' => [
							'min'  => -10,
							'max'  => 10,
							'step' => 0.1,
						],
						'rem' => [
							'min'  => -10,
							'max'  => 10,
							'step' => 0.1,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .swiper-button-prev, {{WRAPPER}} .swiper-button-next' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		// Section: Pagitaion Styles.
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="iswt_wrapper">
			<ul class="iswt_filters">
				<?php foreach ($settings['iswt_tabs'] as $index => $tab) { ?>
					<li class="iswt_filter iswt-filter-<?php echo esc_attr($index . ($index === 0 ? ' active' : '')); ?>"><?php echo esc_html($tab['tab_title']); ?></li>
				<?php } ?>
			</ul>

			<div class="iswt_tabs">
				<?php foreach ($settings['iswt_tabs'] as $index => $tab) { ?>
					<div class="iswt_tab iswt-tab-<?php echo esc_attr($index . ($index === 0 ? ' active' : '')); ?>">
						<div class="swiper" data-slidesperview="<?php echo esc_attr($settings['slider_count']['size']); ?>">
							<div class="swiper-wrapper">
								<?php
									$tab['tab_links'] = explode( PHP_EOL, $tab['tab_links'] );
									$tab['tab_links'] = array_map( 'trim', $tab['tab_links'] );
									
									foreach ($tab['tab_gallery'] as $key => $image) {
										$tab_link = isset( $tab['tab_links'][$key] ) ? $tab['tab_links'][$key] : '';
								?>
									<div class="swiper-slide">
										<?php if ( ! empty( $tab_link ) ) { ?>
											<a href="<?php echo esc_url( $tab_link ); ?>" target="_blank">
												<img src="<?php echo esc_url( $image['url'] ); ?>" alt="">
											</a>
										<?php } else { ?>
											<img src="<?php echo esc_url( $image['url'] ); ?>" alt="">
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>

						<div class="swiper-button-prev iswt_prev-<?php echo esc_attr($index); ?>"></div>
						<div class="swiper-button-next iswt_next-<?php echo esc_attr($index); ?>"></div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}
