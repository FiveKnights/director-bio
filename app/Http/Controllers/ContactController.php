<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequest $request): JsonResponse
    {
        // Honeypot: real visitors never see this field. If it's filled,
        // pretend success so bots learn nothing, and send nothing.
        if ($request->filled('website')) {
            return response()->json(['message' => 'Transmission received.']);
        }

        try {
            Mail::to(config('portfolio.contact_to'))
                ->send(new ContactMessage($request->safe()->only(['name', 'email', 'message'])));
        } catch (\Throwable $e) {
            Log::error('Contact mail failed: ' . $e->getMessage());

            return response()->json(['message' => 'Dispatch failed.'], 500);
        }

        return response()->json(['message' => 'Transmission received.']);
    }
}