<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Controller Base do Laravel
 * 
 * Todas as controllers da aplicação podem herdar desta classe.
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}