<?php

namespace App\Exceptions;

use Simple\FastRoute\Exceptions\HttpException;

class Handler
{
    /**
     * Handler app errors here.
     * 
     * @param  \Throwable  $e
     * @return void
     */
    public function register(\Throwable $e)
    {
        if ($e instanceof HttpException) {
            echo $e->getCode();

            return;
        }

        throw $e;
    }
}
