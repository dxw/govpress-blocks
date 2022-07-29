<?php

use Kahlan\Plugin\Double;

use function Kahlan\expect;

describe(\Dxw\GovPressBlocks\Blocks\Card::class, function () {
    beforeEach(function () {
        allow('wp_parse_args')->toBeCalled();
        $this->card = new \Dxw\GovPressBlocks\Blocks\Card([]);
    });

    it('implements the iBlock interface', function () {
        expect($this->card)->toBeAnInstanceOf(\Dxw\GovPressBlocks\Blocks\iBlock::class);
    });

    describe('->register()', function () {
        it('adds the actions', function () {
            allow('add_action')->toBeCalled();
            expect('add_action')->toBeCalled()->times(2);
            expect('add_action')->toBeCalled()->once()->with('acf/init', [$this->card, 'registerBlock']);
            expect('add_action')->toBeCalled()->once()->with('acf/init', [$this->card, 'registerFields']);

            $this->card->register();
        });
    });

    describe('->registerBlock()', function () {
        it('registers the card block', function () {
            allow('function_exists')->toBeCalled()->andReturn(true);
            allow('acf_register_block_type')->toBeCalled();
            expect('acf_register_block_type')->toBeCalled()->once()->with(\Kahlan\Arg::toBeAn('array'));

            $this->card->registerBlock();
        });
        it('does nothing if ACF is not activated', function () {
            allow('function_exists')->toBeCalled()->andReturn(false);

            $this->card->registerBlock();
        });
    });

    describe('->registerFields()', function () {
        it('registers the card fields', function () {
            allow('function_exists')->toBeCalled()->andReturn(true);
            $fieldsBuilderDouble = \Kahlan\Plugin\Double::instance();
            allow('StoutLogic\AcfBuilder\FieldsBuilder')->toBe($fieldsBuilderDouble);
            allow($fieldsBuilderDouble)->toReceive('build')->andReturn('built fields');
            allow('acf_add_local_field_group')->toBeCalled();
            expect('acf_add_local_field_group')->toBeCalled()->once()->with('built fields');
    
            $this->card->registerFields();
        });
        it('does nothing if ACF is not activated', function () {
            allow('function_exists')->toBeCalled()->andReturn(false);

            $this->card->registerFields();
        });
    });

    describe('->render()', function () {
        context('no template was passed in the args', function () {
            it('loads the default template', function () {
                allow('wp_parse_args')->toBeCalled()->andReturn([
                    'template' => ''
                ]);
                $this->card = new \Dxw\GovPressBlocks\Blocks\Card([]);
                allow('dirname')->toBeCalled();
                expect('dirname')->toBeCalled()->once()->with(\Kahlan\Arg::toBeA('string'), 2);
                allow('load_template')->toBeCalled();
                expect('load_template')->toBeCalled()->once();
    
                $this->card->render();
            });
        });
        context('no template was passed in the args', function () {
            it('loads the default template', function () {
                allow('wp_parse_args')->toBeCalled()->andRun(function ($args, $defaultArgs) {
                    return $args;
                });
                $this->card = new \Dxw\GovPressBlocks\Blocks\Card([
                    'template' => 'foo.php'
                ]);
                allow('load_template')->toBeCalled();
                expect('load_template')->toBeCalled()->once()->with('foo.php', false);
    
                $this->card->render();
            });
        });
    });
});
