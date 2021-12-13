<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use App\Notifications\ContactNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Notification;

class InfoController extends Controller
{
    public function contact(Request $request): JsonResponse
    {
        $validated = $request->validate([
                'name' => ['bail', 'required', 'string', 'min:2'],
                'email' => ['bail', 'required', 'email:dns'],
                'message' => ['required', 'string', 'min:5']
        ]);

        $validated['name'] = strip_tags($validated['name']);
        $validated['message'] = strip_tags($validated['message']);

        Notification::route('mail', config('services.deel.contact.email'))
                ->notify(new ContactNotification($validated));

        return $this->success([], 'Message Received');
    }
}
