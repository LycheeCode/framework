<?php

namespace Lychee;

use Lychee\Container;

class Lychee
{
    protected $base_path;

    protected $container;

    public function __construct(string $base_path)
    {
        $this->base_path = $base_path;

        $this->container = new Container;
    }

    public function start()
    {
        //
    }

    public function getContainer()
    {
        return $this->container;
    }
}
