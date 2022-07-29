# GovPress Blocks

A library of reusable blocks for use in GovPress projects.

## How to use

1. Install the package in your theme:
   ```
   composer require dxw/govpress-blocks
   ```
1. Use the factory to create the blocks you want to use, and pass them any configuration, e.g.
   To create a card block with default config:
   ```
   \Dxw\GovPressBlocks\Factory::create('card');
   ```
   To create a card block that renders a custom template:
   ```
   \Dxw\GovPressBlocks\Factory::create('card', [
     'template' => '\the\full\path\to\your\custom\template.php`
   ]);
   ```
   For dxw projects, the recommended approach is to add this code to your theme's `app/di.php`, if the theme uses [Iguana](https://github.com/dxw/iguana).

The available blocks are documented below.

## Blocks

### Card

`\Dxw\GovPressBLocks\Factory::create('card', array $config)`

Config options:

```
[
    'template' => string $theFullPathToYourCustomCardTemplate
]
