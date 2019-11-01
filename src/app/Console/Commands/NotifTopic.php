<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Topic;
use App\Http\Resources\Topic as TopicResource;
use App\Notifications\TopicComing;
use Carbon\Carbon;

class NotifTopic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'topic-coming:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a mail to users 24hrs before their lightning talk start';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dateN = new Carbon('tomorrow');
        $dateN= $dateN->toDateString();
        $topics = Topic::where('date','=',$dateN)->get();
        
        foreach ($topics as $topic) {
            if($topic->status == 1) {
                $user = $topic->user;
                $user->notify(new TopicComing($topic));
            }
        }

    }
}
