<?php

namespace App\Services;

class ClearData
{
    protected function clear($field)
    {
        $field = strip_tags($field);
        $field = htmlspecialchars($field, ENT_QUOTES);
        $field = trim($field);
        return $field;
    }

    public function clearAll($dataArray)
    {
        return array_map(array($this, 'clear'), $dataArray);
    }
}
