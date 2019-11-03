<?php

namespace App\Http\Controllers\Api\V1;

use App\Topic;
use App\Http\Controllers\Controller;
use App\Http\Resources\Topic as TopicResource;
use App\Http\Requests\Admin\StoreTopicsRequest;
use App\Http\Requests\Admin\UpdateTopicsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Notifications\TopicCreated;
use Carbon\Carbon;


class TopicsController extends Controller
{
    public function index()
    {
        $dateN = $this->getNextTalk();
        return new TopicResource( Topic::where('date','=',$dateN)->where('status','=',1)->get());
    }

    public function drafts()
    {
        $dateN = $this->getNextTalk();
        return new TopicResource( Topic::where('status','=',0)->get());
    }

    private function getNextTalk() {

        $now = new Carbon();
        $carbon1 = new Carbon('first tuesday of this month');
        if( (int)$now->month % 2 == 0 && $now < $carbon1 ) 
            $dateTalk = $carbon1;
        else {
            if( (int) $now->month % 2 == 0)
                $dateTalk = new Carbon("first tuesday of ".date("Y")."-".($now->month + 2));
            else {
                $dateTalk = new Carbon("first tuesday of next month");
            }
        }
        return( $dateTalk->toDateString());
    }

    public function show($id)
    {
        if (Gate::denies('topic_view')) {
            return abort(401);
        }

        $topic = Topic::with([])->findOrFail($id);

        return new TopicResource($topic);
    }

    public function store(StoreTopicsRequest $request)
    {
        if (Gate::denies('topic_create')) {
            return abort(401);
        }
        $user = auth('api')->user();
        $myNewData = $request->request->add(['user_id' => $user->id ]);
        
        $topic = Topic::create($request->all());
        
        return (new TopicResource($topic))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateTopicsRequest $request, $id)
    {
        if (Gate::denies('topic_edit')) {
            return abort(401);
        }

        $topic = Topic::findOrFail($id);
        $topic->update($request->all());

        // notify user of the creation
        if($topic->status == 1) {
            $user = auth('api')->user();
            $user->notify(new TopicCreated($topic));
        }
            

        return (new TopicResource($topic))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('topic_delete')) {
            return abort(401);
        }

        $topic = Topic::findOrFail($id);
        $topic->delete();

        return response(null, 204);
    }
}
