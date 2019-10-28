<?php
namespace Lib;

class Dto
{
    function is_valid(array $fields): bool
    {
        foreach ($fields as $field)
        {
            if ($this->field === FALSE)
            {
                return false;
            }
            return true;
        }
    }
}
