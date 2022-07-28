<?php

use Kahlan\Plugin\Double;

describe('\Dxw\GovPressBlocks\Factory::class', function () {
    describe('::create()', function () {
        it('returns an instance of a block if it exists, and throws an exception if you try to create a block twice', function () {
            foreach (\Dxw\GovPressBlocks\Factory::BLOCKS as $blockName => $className) {
                allow($className)->toBeOk();
                allow($className)->toReceive('register');
                $result = \Dxw\GovPressBlocks\Factory::create($blockName, []);
                expect($result)->toBeAnInstanceOf($className);
            }
            // Ideally this would be a separate test
            // But can't find a way to stop the class persisting across tests
            $closure = function () {
                \Dxw\GovPressBlocks\Factory::create('card');
            };
            expect($closure)->toThrow(new Exception('GovPressBlock type already created: card'));
        });

        xit('passes the optional args array to the block constructor', function () {
            // Can't find a way to create a double that correctly implements the iBlock interface
        });

        it('throws an exception if you try to new up a card type that does not exist', function () {
            $closure = function () {
                \Dxw\GovPressBlocks\Factory::create('foo', []);
            };
            expect($closure)->toThrow(new Exception('GovPressBlock type does not exist: foo'));
        });
    });
});
