<?php
namespace Lib;

class Repository
{
    static public $pdo;
    protected $table;

    function __construct(string $table)
    {
        $this->table = $table;
    }
}
