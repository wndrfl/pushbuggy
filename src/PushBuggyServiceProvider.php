<?php 

namespace Wndrfl\PushBuggy;

use Illuminate\Support\ServiceProvider;
use Monolog\Handler\SlackHandler;
use Monolog\Logger;
use Log;

class PushBuggyServiceProvider extends ServiceProvider
{
  public function boot() {
    ‌‌app('config')->set('services.slackbots', env('SLACK_BOTS', '[]'));

    $bots = config('services.slack');
    foreach($bots as $bot) {
        $logger = Log::getMonolog();
        $slackHandler = new SlackHandler($bot->token, $bot->channel, $bot->name, true, null, Logger::INFO);
        $logger->pushHandler($slackHandler);
    }
  }
}
