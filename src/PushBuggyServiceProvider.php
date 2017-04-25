<?php 

namespace Wndrfl\PushBuggy;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Logging\Log;
use Monolog\Handler\SlackHandler;
use Monolog\Logger;

class PushBuggyServiceProvider extends ServiceProvider
{
  public function register() {
    // Nothing for now
  }

  public function boot(Repository $config, Log $log) {
    $config->set('services.slackbots', json_decode(env('SLACK_BOTS', '[]')));

    $bots = $config->get('services.slackbots');
    foreach($bots as $bot) {
        $logger = $logger = $log->getMonolog();
        $slackHandler = new SlackHandler($bot->token, $bot->channel, $bot->name, true, null, Logger::INFO, true, false, true);
        $logger->pushHandler($slackHandler);
    }
  }
}
