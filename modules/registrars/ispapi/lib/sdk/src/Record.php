<?php

#declare(strict_types=1);

/**
 * HEXONET
 * Copyright © HEXONET
 */

namespace HEXONET;

/**
 * HEXONET Record
 *
 * @package HEXONET
 */

class Record
{
     /**
     * row data container
     * e.g.
     * <code>
     * $data = [
     *   'DOMAIN' => 'mydomain.com',
     *   'USER'   => 'test.user',
     *   // ... further column data ...
     * ];
     * </code>
     * @var array
     */
    private $data;

    /**
     * Constructor
     * e.g.
     * <code>
     * $data = [
     *   'DOMAIN' => 'mydomain.com',
     *   'USER'   => 'test.user',
     *   // ... further column data ...
     * ];
     * </code>
     * @param array $data data object
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * get row data
     * @return array row data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * get row data for given column
     * @param string $key column name
     * @return string|null row data for given column or null if column does not exist
     */
    public function getDataByKey($key)
    {
        if ($this->hasData($key)) {
            return $this->data[$key];
        }
        return null;
    }

    /**
     * check if record has data for given column
     * @param string $key column name
     * @return boolean boolean result
     */
    private function hasData($key)
    {
        return array_key_exists($key, $this->data);
    }
}
