<?php

namespace He4rt\Message\Http\Controllers;

use App\Http\Controllers\Controller;
use He4rt\Message\Actions\NewMessage;
use He4rt\Message\Actions\NewVoiceMessage;
use He4rt\Message\Http\Requests\CreateMessageRequest;
use He4rt\Message\Http\Requests\CreateVoiceMessageRequest;
use Illuminate\Http\Response;

class MessagesController extends Controller
{
    public function postMessage(
        CreateMessageRequest $request,
        string $provider,
        NewMessage $newMessage,
    ): Response {
        $newMessage->persist($request->validated());

        return response()->noContent();
    }

    public function postVoiceMessage(
        CreateVoiceMessageRequest $request,
        string $provider,
        NewVoiceMessage $voiceMessage,
    ): Response {
        $voiceMessage->persist($request->validated());

        return response()->noContent();
    }
}