<?php
namespace Lib;

/**
 * DTOs are for parsing and validating data
 */
abstract class Dto
{
    /**
     * Checks if the parsed data is invalid or unparseable
     *
     * @return Data is invalid or unparseable
     */
    abstract function is_invalid(array &$errors): bool;
}
