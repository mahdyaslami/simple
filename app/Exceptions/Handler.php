<?php

namespace App\Exceptions;

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
        throw $e;
    }
}
