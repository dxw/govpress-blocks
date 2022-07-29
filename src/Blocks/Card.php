<?php

namespace Dxw\GovPressBlocks\Blocks;

class Card implements iBlock
{
    private $args;

    // Path to the default template for this block
    // Relative to the root of this package
    private $templatePath = '/templates/card.php';

    public function __construct(array $args)
    {
        $defaults = [
            'template' => ''
        ];
        $this->args = wp_parse_args($args, $defaults);
    }

    public function register()
    {
        add_action('acf/init', [$this, 'registerBlock']);
        add_action('acf/init', [$this, 'registerFields']);
    }

    public function registerBlock()
    {
        if (function_exists('acf_register_block_type')) {
            acf_register_block_type([
                'name'              => 'dxw-govpress-blocks-card',
                'title'             => 'Content Card',
                'render_callback'   => [$this, 'render'],
                'mode'              => 'auto',
                'category'          => 'common',
                'icon'              => '<svg width="24" height="24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.029 8.793s0-5 3-5l-.058 5.835c0 .6-.4 1-1 1h-10c-.6 0-1-.4-1-1l.058-2.835c2 0 2.942 2.835 2.942 2.835s1.058-2.835 3.058-2.835c2 0 3 2 3 2ZM3.979 12.466h12v1.101h-12ZM2.307 11.265h15.152v.44H2.307Z"/><path d="M2.2 1h15.5c.7 0 1.3.6 1.3 1.2l.052 15.974c0 .7-.6 1.2-1.2 1.2h-15.6c-.6.1-1.2-.5-1.2-1.1L1 2.2C1 1.6 1.6 1 2.2 1ZM17 17.377V3H3v14.377Z"/><path d="M3.993 14.409h12l.018.408h-12ZM4.002 15.609h12l.018.408h-12Z"/></svg>',
                'keywords'          => ['card', 'text'],
                'supports'          => [
                    'align' => false
                ]
            ]);
        }
    }

    public function registerFields()
    {
        if (function_exists('acf_add_local_field_group')) {
            $fields = new \StoutLogic\AcfBuilder\FieldsBuilder('dxw-govpress-blocks-card', [
                'style' => 'seamless',
            ]);
            $fields
                ->addButtonGroup('card_style', [
                    'label'         => 'Card style',
                    'choices'       => [
                        'simple' => "Simple",
                        'full' => "Full"
                    ],
                    'default_value' => 'simple',
                    'return_format' => 'Value'
                ])
                ->addLink('link')
                ->addTextarea('description')
                ->conditional('card_style', '==', 'full')
                ->setLocation('block', '==', 'acf/dxw-govpress-blocks-card');

            acf_add_local_field_group($fields->build());
        }
    }

    public function render()
    {
        if ($this->args['template'] == '') {
            load_template(dirname(__DIR__, 2) . $this->templatePath, false);
        } else {
            load_template($this->args['template'], false);
        }
    }
}
