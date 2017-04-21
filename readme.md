# PushBuggy

This is a convenience library to make it easy to send log entries to a slack
channel

## Usage

To use the library first add the service PushBuggyServiceProvider

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

Next, add a config entry `SLACK_BOTS` to your .env file

```
SLACK_BOTS=[{"token":"chat_user_token","channel":"#my-logs","name":"PushBuggy"}]
```
