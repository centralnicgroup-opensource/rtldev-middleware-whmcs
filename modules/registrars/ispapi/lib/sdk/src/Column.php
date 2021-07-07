<?php

#declare(strict_types=1);

/**
 * HEXONET
 * Copyright © HEXONET
 */

namespace HEXONET;

/**
 * HEXONET Column
 *
 * @package HEXONET
 */

class Column
{

    /**
     * count of column data entries
     * @var int
     */
    public $length;

    /**
     * column key name
     * @var string
     */
    private $key;
    /**
     * column data container
     * @var string[]
     */
    private $data;

    /**
     * Constructor
     *
     * @param string $key Column Name
     * @param string[] $data Column Data
     */
    public function __construct($key, $data)
    {
        $this->key = $key;
        $this->data = $data;
        $this->length = count($data);
    }

    /**
     * Get column name
     * @return string column name
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get column data
     * @return string[] column data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get column data at given index
     * @param integer $idx data index
     * @return string|null data at given index
     */
    public function getDataByIndex($idx)
    {
        return $this->hasDataIndex($idx) ? $this->data[$idx] : null;
    }

    /**
     * Check if column has a given data index
     * @param integer $idx data index
     * @return boolean result
     */
    private function hasDataIndex($idx)
    {
        return ($idx >= 0 && $idx < $this->length);
    }
}
