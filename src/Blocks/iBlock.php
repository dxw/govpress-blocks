<?php

namespace Dxw\GovPressBlocks\Blocks;

interface iBlock
{
    public function __construct(array $args);

    public function register();
}
