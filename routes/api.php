<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::post('/submission', [SubmissionController::class, 'add']);
