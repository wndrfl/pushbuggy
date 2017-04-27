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
    $config->set('services.slackbots', json_decode(env('PUSHBUGGY', '[]')));

    $bots = $config->get('services.slackbots');
    if (is_array($bots)) {
      foreach($bots as $bot) {
        if (!property_exists($bot, 'token')) {
          continue;
        }

        $logger = $logger = $log->getMonolog();
        $slackHandler = new SlackHandler(
            $bot->token,
            property_exists($bot, 'channel') ? $bot->channel : '#general',
            property_exists($bot, 'name') ? $bot->name : 'PushBuggy',
            true, // use attachment
            null, // icon Emoji
            property_exists($bot, 'log_level') ? $bot->log_level : Logger::WARNING,
            true, // bubble
            false, // use short attachment
            true // include context and extra
        );
        $logger->pushHandler($slackHandler);
      }
    }
  }
}
