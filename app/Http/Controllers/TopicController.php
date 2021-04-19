<?php

namespace App\Http\Controllers;

use App\Http\Requests\Topic\Subscribe as SubscribeRequest;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    /**
     * Subscribe a url to a topic.
     * Creates a new topic in case there is none that match the provided.
     *
     * @param SubscribeRequest $request
     * @param $topic
     * @return JsonResponse
     */
    public function subscribe(SubscribeRequest $request, $topic): JsonResponse
    {
        $topic = Topic::firstOrCreate(['name' => $topic], ['id' => Str::uuid()]);

        $topic->subscribers()->create([
            'id' => Str::uuid(),
            'url' => $request->get('url')
        ]);

//        return response()->json(new TopicResource($topic));
        return response()->json([
            'url' => $request->get('url'),
            'topic' => $topic->name
        ]);
    }
}
