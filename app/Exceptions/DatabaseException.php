<?php

namespace App\Exceptions;

use Exception;

class DatabaseException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'message' => 'There was an error while processing your request. Please try again later.',
        ], 500);
    }
}