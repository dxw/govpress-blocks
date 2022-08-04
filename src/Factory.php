<?php

namespace Dxw\GovPressBlocks;

class Factory
{
    const BLOCKS = [
        'card' => 'Dxw\GovPressBlocks\Blocks\Card'
    ];

    private static $registeredBlocks = [];

    public static function create(string $blockName, array $args = [])
    {
        if (!array_key_exists($blockName, self::BLOCKS)) {
            throw new \Exception('GovPressBlock type does not exist: ' . $blockName);
        }
        if (in_array($blockName, self::$registeredBlocks)) {
            throw new \Exception('GovPressBlock type already created: ' . $blockName);
        }
        $block = self::BLOCKS[$blockName];
        self::$registeredBlocks[] = $blockName;
        $blockInstance = new $block($args);
        $blockInstance->register();
        return $blockInstance;
    }
}
