<?php

#declare(strict_types=1);

/**
 * HEXONET
 * Copyright © HEXONET
 */

namespace HEXONET;

/**
 * HEXONET Logger
 *
 * @package HEXONET
 */

class Logger
{
    /**
     * output/log given data
     */
    public function log(string $post, Response $r, string $error = null): void
    {
         echo implode("\n", [
            print_r($r->getCommand(), true),
            $post,
            $error ? "HTTP communication failed: " . $error : "",
            $r->getPlain()
         ]);
    }
}
