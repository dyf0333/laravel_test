<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function index(){
        Log::info('info 级别的日志');
        Log::warning('warning 级别的日志');
        Log::error('error 级别的日志');
    }
}
