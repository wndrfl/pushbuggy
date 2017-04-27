# PushBuggy

This is a convenience library to make it easy to send log entries to a slack
channel

## Usage

### Slack

To begin you'll need to create a Bot user on slack,

https://my.slack.com/services/new/bot

Once you create the bot, take note of the access token

### Install the library

Use composer to install PushBuggy in your current project

```
composer require wndrfl/pushbuggy
```

### Configure PushBuggy

Add the service provider `PushBuggyServiceProvider` to your list of providers in
the `config/app.php`

```php
// config/app.php
return [
  // All the app config...

    'providers' => [
      // All the other providers ...
      
      // Add this provider
      Wndrfl\PushBuggy\PushBuggyServiceProvider::class,
    ];
    
    // ...
];
```

Next, add a config entry `PUSHBUGGY` to your .env file

```
PUSHBUGGY=[{"token":"chat_user_token","channel":"#my-logs","name":"PushBuggy","log_level":200}]
```

The configuration variable is a json array so you could have many bot users in
the same project. These are the fields available:

| Field     | Description                                   | Default value
|-----------|-----------------------------------------------|-----------
| token     | Authentication token assigned to the Bot user | * *required*
| channel   | Channel name where the log messages will be posted | #general
| name      | Name the bot user should use in the slack channel | PushBuggy
| log_level | Monolog log level. These values are defined in https://github.com/Seldaek/monolog/blob/master/src/Monolog/Logger.php | 300 (Logger::WARNING)

To add another Bot user simply add more elements to the array, e.g.

```
PUSHBUGGY=[{"token":"chat_user_token","channel":"#my-logs","log_level":200},{"token":"some_other_token","log_level":100}]
```
