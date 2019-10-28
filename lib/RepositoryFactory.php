<?php
namespace Lib;

class RepositoryFactory
{
    private $pdo_init;
    private $pdo;

    function __construct(Callable $pdo_init)
    {
        $this->pdo_init = $pdo_init;
        $this->pdo = NULL;
    }

    function get(string $name)
    {
        if (is_null($this->pdo))
        {
            $this->pdo = $this->pdo_init();
        }

        return new $name($this->pdo);
    }
}
