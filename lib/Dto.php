<?php
namespace Lib;

abstract class Dto
{
    abstract function is_invalid(array &$errors): bool;
}
