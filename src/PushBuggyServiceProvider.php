<?php 

namespace Wndrfl\PushBuggy;

use Illuminate\Support\ServiceProvider;
use Monolog\Handler\SlackHandler;
use Monolog\Logger;
use Config;
use Log;

class PushBuggyServiceProvider extends ServiceProvider
{
  public function boot() {
    ‌‌Config::set('services.slackbots', json_decode(env('SLACK_BOTS', '[]')));

    $bots = config('services.slackbots');
    foreach($bots as $bot) {
        $logger = Log::getMonolog();
        $slackHandler = new SlackHandler($bot->token, $bot->channel, $bot->name, true, null, Logger::INFO);
        $logger->pushHandler($slackHandler);
    }
  }
}
