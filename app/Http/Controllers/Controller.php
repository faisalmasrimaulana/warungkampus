<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller
 *
 * Extend dari BaseController Laravel supaya mendapatkan fitur dasar controller,
 * seperti middleware(), response handling, dll.
 * 
 * Menggunakan trait berikut:
 * - AuthorizesRequests: untuk otorisasi akses user.
 * - DispatchesJobs: untuk menjalankan job (queue/task).
 * - ValidatesRequests: untuk memvalidasi input request.
 *
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
