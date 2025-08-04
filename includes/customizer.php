<?php

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// =================== Notice =================== // 


new \Kirki\Panel(
	'elevate_alerts_panel',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Elevate Alerts', 'elevate-alerts' ),
		'description' => esc_html__( 'Elevate Alerts Settings.', 'elevate-alerts' ),
	]
);

new \Kirki\Section(

	'elevate_alerts_notice',
	  [
		  'priority'    => 2,
		  'title'       => esc_html__( 'General Settings', 'elevate-alerts' ),
      'panel'       =>  'elevate_alerts_panel'
	  ]
  
  );


new \Kirki\Field\Toggle(
	[
		'settings'    => 'elevate_alerts_notice_status',
		'label'       => esc_html__( 'Show notice', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice',
		'default'     => '0',
		'priority'    => 10,
        'option_type' => 'option',
		'transport'   => 'refresh'
	]
);


new \Kirki\Field\Editor(
	[
		'settings' => 'elevate_alerts_notice_content',
		'label'    => esc_html__( 'Notice', 'elevate-alerts' ),
		'section'  => 'elevate_alerts_notice',
		'default'  => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting', 'elevate-alerts' ),
		'priority' => 20,
        'option_type' => 'option'
	]
);


new \Kirki\Field\Color(
	[
		'settings'    => 'elevate_alerts_notice_background_color',
		'label'       => __( 'Notice background color', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice',
		'default'     => '#c2ece7',
		'priority'    => 30,
        'option_type' => 'option',
		'output' => [
			[
				'element'  => ':root',
				'property' => '--notice-background-color',
			],
		],

	]

);


new \Kirki\Field\Typography(
	[
		'settings'    => 'elevate_alerts_notice_typography',
		'label'       => esc_html__( 'Notice Typography', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice',
		'priority'    => 40,
		'transport'   => 'auto',
        'option_type' => 'option',

		'default'     => [
			'font-style'      => 'normal',
			'color'           => '#3e625d',
			'font-size'       => '16px',
			'line-height'     => '1.618',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
		],
		'output'      => [
			[
				'element' => '.elevate-alerts-notice',
			],
		],
	]
);


new \Kirki\Field\Dimensions(
	[
		'settings'    => 'elevate_alerts_notice_height',
		'label'       => esc_html__( 'Dimensions', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice',
		'default'     => [
			'height'  => '80px',
		],
		'choices'     => [
			'labels' => [
				'min-height' => esc_html__( 'Height', 'elevate-alerts' ),
			],
		],

		
		'output' => [
			[
				'element'  => '.elevate-alerts-notice',
			]
		]
	]
);


// Button Settings

new \Kirki\Section(

	'elevate_alerts_notice_button_section',
	  [
		  'priority'    => 2,
		  'title'       => esc_html__( 'Button Settings', 'elevate-alerts' ),
      'panel'       =>  'elevate_alerts_panel'
	  ]
  
  );



new \Kirki\Field\Toggle(
	[
		'settings'    => 'elevate_alerts_notice_button_status',
		'label'       => esc_html__( 'Activate Button', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice_button_section',
		'default'     => '0',
		'priority'    => 10,
		'transport'	  => 'refresh',
        'option_type' => 'option',
    ],

);

new \Kirki\Field\Text(
	[
		'settings'    => 'elevate_alerts_notice_button_text',
		'label'       => esc_html__( 'Button text', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice_button_section',
		'default'     => __( 'Buy Now', 'elevate-alerts' ),
		'priority'    => 20,
        'option_type' => 'option',
    ],

);


new \Kirki\Field\Color(
	[
		'settings'    => 'notice_button_background_color',
		'label'       => __( 'Button background color', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice_button_section',
		'default'     => '#77b5ac',
		'priority'    => 30,
        'option_type' => 'option',
		'output' => [
			[
				'element'  => ':root',
				'property' => '--notice-button-background',
			],
		],

	]

);

new \Kirki\Field\Dimensions(
	[
		'settings'    => 'notice_button_background_dimensions',
		'label'       => esc_html__( 'Dimensions', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice_button_section',
		'priority' => 60,

		'default'     => [
			'padding-top'    => '9px',
			'padding-bottom' => '12px',
			'padding-left'   => '28px',
			'padding-right'  => '28px',
			'min-width'  => '42px',
		],

		'choices'     => [
			'labels' => [
				'padding-top'  => esc_html__( 'Padding Top', 'elevate-alerts' ),
				'padding-bottom'  => esc_html__( 'Padding Bottom', 'elevate-alerts' ),
				'padding-left' => esc_html__( 'Padding Left', 'elevate-alerts' ),
				'padding-right' => esc_html__( 'Padding Right', 'elevate-alerts' ),
			],
		],

		'output' => [
			[
			  'element'  => '.elevate-alerts-notice__link',
			],
		],

	]
);



new \Kirki\Field\Typography(
	[
		'settings'    => 'elevate_alerts_notice_button_typography',
		'label'       => esc_html__( 'Notice Typography', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice_button_section',
		'priority'    => 40,
		'transport'   => 'auto',
        'option_type' => 'option',

		'default'     => [
			'font-style'      => 'normal',
			'color'           => '#ffffff',
			'font-size'       => '1em',
			'line-height'     => '1.618',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',

		],
		
   		'output'      => [
			[
				'element' => '.elevate-alerts-notice__link',
			],
		],

	]
);


new \Kirki\Field\URL(
	[
		'settings' => 'elevate_alerts_button_url',
		'label'    => esc_html__( 'Button URL', 'elevate-alerts' ),
		'section'  => 'elevate_alerts_notice_button_section',
		'default'  => '#',
        'option_type' => 'option',
		'priority' => 50,

	]
);


new \Kirki\Field\Checkbox(
	[
		'settings'    	=> 'elevate_alerts_button_url_target',
		'label'       	=> esc_html__( 'Open Link In New Tab', 'elevate-alerts' ),
		'section'     	=> 'elevate_alerts_notice_button_section',
		'priority' 		=> 60,
        'option_type' => 'option',
		'default'     	=> false,

	]
);

// Count Down


new \Kirki\Section(

	'elevate_alerts_notice_countdown',
	[
		'priority'    => 4,
		'title'       => esc_html__( 'Count Down', 'elevate-alerts' ),
		'description' =>  sprintf( 
			/* translators: %s: Current server date and time */
			esc_html__( 'The countdown is calculated according to the server clock %s', 'elevate-alerts' ),
			sprintf( "<code>%s</code>", esc_html( gmdate("F j, Y, g:i a") ) )
		),

		'panel'       =>  'elevate_alerts_panel'
	]

);

new \Kirki\Field\Toggle(
	[
		'settings'    => 'elevate_alerts_notice_countdown_status',
		'label'       => esc_html__( 'Activate Countdown', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice_countdown',
		'default'     => "0",
		'priority'    => 10,
        'option_type' => 'option',

    ],

);


new \Kirki\Field\Date(
	[
	'settings'    => 'elevate_alerts_notice_countdown_date',
	'label'       => esc_html__( 'End Date', 'elevate-alerts' ),
	'section'     => 'elevate_alerts_notice_countdown',
	'option_type' => 'option',
	'priority' => 10,
	
	'default'     => '',
	]
);


new \Kirki\Field\Text(
	[
		'settings' => 'elevate_alerts_notice_countdown_time',
		'label'    => esc_html__( 'End Time', 'elevate-alerts' ),
		'section'  => 'elevate_alerts_notice_countdown',
		'default'  => '00:00:00',
		'option_type' => 'option',
		'description' => esc_html__( 'Time Format hh:mm:ss', 'elevate-alerts' ),
		'priority' => 20,
	]
);


new \Kirki\Field\Color(
	[
		'settings' => 'elevate_alerts_notice_countdown_background',
		'label'    => esc_html__( 'Background Color', 'elevate-alerts' ),
		'section'  => 'elevate_alerts_notice_countdown',
		'default'  => 'rgba(255,255,255,0.25)',
		'option_type' => 'option',
		'priority' => 30,
		'choices'     => [
			'alpha' => true,
		],
		'output' => [

			[
			  'element'  => '.elevate-alerts-notice .elevate-alerts-countdown__element',
			  'property' => 'background-color',
			],
		]
	]
);


new \Kirki\Field\Typography(
	[
		'settings'    => 'elevate_alerts_notice_countdown_typography',
		'label'       => esc_html__( 'Typography', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice_countdown',
		'priority'    => 40,
		'transport'   => 'auto',
        'option_type' => 'option',

		'default'     => [
			'font-style'      => 'normal',
			'color'           => '#3e625d',
			'font-size'       => '.78em',
			'line-height'     => '1.618',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',

		],
		
   		'output'      => [
			[
				'element'  => '.elevate-alerts-notice .elevate-alerts-countdown__element .value',
			],
		],

	]
);



new \Kirki\Field\Typography(
	[
		'settings'    => 'elevate_alerts_notice_countdown_unit_typography',
		'label'       => esc_html__( 'Typography (unit)', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice_countdown',
		'priority'    => 50,
		'transport'   => 'auto',
        'option_type' => 'option',

		'default'     => [
			'font-style'      => 'bolder',
			'color'           => '#6d908b',
			'font-size'       => '.5em',
			'line-height'     => '1.618',
			'letter-spacing'  => '0',
			'text-transform'  => 'uppercase',
			'text-decoration' => 'none',
		],
		
   		'output'      => [
			[
				'element'  => '.elevate-alerts-notice .elevate-alerts-countdown__element .unit',
			],
		],

	]
);


new \Kirki\Field\Dimensions(
	[
		'settings'    => 'elevate_alerts_notice_countdown_dimensions',
		'label'       => esc_html__( 'Dimensions', 'elevate-alerts' ),
		'section'     => 'elevate_alerts_notice_countdown',
		'priority' => 60,

		'default'     => [
			'padding-top'    => '5px',
			'padding-bottom' => '5px',
			'padding-left'   => '7px',
			'padding-right'  => '7px',
			'min-width'  => '42px',
		],

		'choices'     => [
			'labels' => [
				'padding-top'  => esc_html__( 'Padding Top', 'elevate-alerts' ),
				'padding-bottom'  => esc_html__( 'Padding Bottom', 'elevate-alerts' ),
				'padding-left' => esc_html__( 'Padding Left', 'elevate-alerts' ),
				'padding-right' => esc_html__( 'Padding Right', 'elevate-alerts' ),
			],
		],

		'output' => [
			[
			  'element'  => '.elevate-alerts-notice .elevate-alerts-countdown__element',
			],
		]

	]
);

