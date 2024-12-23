<?php
/**
 * Created by PhpStorm.
 * User: Mohammed Z Skaik
 * Date: 4/6/2017
 * Time: 1:34 PM
 */

return [
    'mode'                 => '',
    'format'               => 'A4',
    'default_font_size'    => '12',
    'default_font'         => 'tahoma',
    'margin_left'          => 10,
    'margin_right'         => 10,
    'margin_top'           => 10,
    'margin_bottom'        => 10,
    'margin_header'        => 0,
    'use_kwt'              => true,
    'margin_footer'        => 0,
    'orientation'          => 'P',
    'title'                => 'Document',
    'author'               => '',
    'show_watermark'       => false,
    'watermark_font'       => 'tahoma',
    'display_mode'         => 'fullpage',
    'watermark_text_alpha' => 0.1,
    'shrink_tables_to_fit' => 1,
    'setAutoTopMargin' => 'stretch',
    'custom_font_path' => public_path('/fonts/'), // don't forget the trailing slash!
    'custom_font_data' => [
        'naskharabic' => [
            'R'  => 'notonaskharabic/NotoNaskhArabic-Regular.ttf',    // regular font
            'B'  => 'notonaskharabic/NotoNaskhArabic-Bold.ttf',       // optional: bold font
            'I'  => 'notonaskharabic/NotoNaskhArabic-Regular.ttf',     // optional: italic font
            'BI' => 'notonaskharabic/NotoNaskhArabic-Bold.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
        'Ubuntu' => [
            'R'  => 'Ubuntu-R.ttf',    // regular font
            'B'  => 'Ubuntu-B.ttf',       // optional: bold font
            'I'  => 'Ubuntu-R.ttf',     // optional: italic font
            'BI' => 'Ubuntu-B.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ]
        // ...add as many as you want.
    ]
];
