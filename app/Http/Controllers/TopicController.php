<?php

namespace App\Http\Controllers;

use App\Http\Requests\Topic\Subscribe as SubscribeRequest;
use App\Models\Subscriber;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    /**
     * Publish a message to a topic subscribers.
     *
     * @param $topic
     * @param Request $request
     * @return JsonResponse
     */
    public function publish($topic, Request $request): JsonResponse
    {
        /**
         * The Topic Model.
         *
         * @var Topic $topic
         */
        $topic = Topic::whereName($topic)->first();

        if (!$topic) {
            return response()->json('Topic Not Found', Response::HTTP_NOT_FOUND);
        }

        $topic->subscribers()->cursor()->each(fn(Subscriber $subscriber) => $subscriber->publish($request->all()));

        return response()->json(['message' => 'Message Published Successfully', 'topic' => $topic->name]);
    }
}
