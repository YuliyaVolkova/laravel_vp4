<?php

namespace App\Http\Controllers\DataClear;

trait InputTrait
{
    protected function clear($field)
    {
        $field = strip_tags($field);
        $field = htmlspecialchars($field, ENT_QUOTES);
        $field = trim($field);
        return $field;
    }

    protected function clearAll($dataArray)
    {
        return array_map(array($this, 'clear'), $dataArray);
    }
}
