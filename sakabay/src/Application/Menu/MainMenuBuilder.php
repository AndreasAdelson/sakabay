<?php

namespace App\Application\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class MainMenuBuilder
{
    private $factory;

    /**
     * Add any other dependency you need...
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('home', ['route' => 'home']);
        $menu->addChild('home_links', ['route' => 'example_index']);
        // ... add more children
        return $menu;
    }
}
