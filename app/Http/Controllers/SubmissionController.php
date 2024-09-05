<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmissionPostRequest;
use App\Jobs\ProcessSubmissionsJob;

class SubmissionController extends Controller
{
    public function add(SubmissionPostRequest $request)
    {
        try {
            $validated = $request->validated();
            dispatch(new ProcessSubmissionsJob($validated));
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'message' => [$th->getMessage()]
                ],
            ], 400);
        }

        return response()->json(['success' => true]);
    }
}
