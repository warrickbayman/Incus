# Incus

[![Build Status](https://travis-ci.org/warrickbayman/Incus.svg)](https://travis-ci.org/warrickbayman/Incus)
[![Stable](https://poser.pugx.org/warrickbayman/incus/v/stable.svg)](https://packagist.org/packages/warrickbayman/incus)
[![Latest Unstable Version](https://poser.pugx.org/warrickbayman/incus/v/unstable)](https://packagist.org/packages/warrickbayman/incus)
[![License](https://poser.pugx.org/warrickbayman/incus/license)](https://packagist.org/packages/warrickbayman/incus)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/02b6ee54-c786-4de4-b387-38defe63f142/small.png)](https://insight.sensiolabs.com/projects/02b6ee54-c786-4de4-b387-38defe63f142)

Incus is an easy to use Mandrill webhooks processor. The Webhooks data sent by Mandrill can sometimes be a bit confusing, so Incus simplifies the matter.

## Status
Incus is under development and although it works, and you can use it right away, it's far from perfect. Mandrill is a service I used constantly, so Incus will grow as I need to add features to it.

If you find bugs, please use the issue tracker here: [Issue Tracker](https://github.com/warrickbayman/incus/issues).

Please also be aware that the documentation is fairly incomplete as it is growing with the project. As I complete features, so I will write better documentation.

Sometimes my tests get away from me and I find myself writing tests for code I've written. But at least the tests exist, right. Anyway, it's not quite 100% covered, but I'm getting there.


## Installation
Incus can be installed via Composer. Add the following to the `require` section of your `composer.json` file:

```json
{
	"require": {
		"warrickbayman/Incus": "~0.1"
	}
}

```

And run `composer update`.

If you feel like living on the edge, replace "~0.1" with "dev-master".

## The Basics
Create a working POST route and write a controller to look something like:

```php
use Incus\Incus;
use Incus\Listener;

class MyMandrillApp extends Controller
{
	public funtion webhooks()
	{
		Incus::listen(function(Listener $listener)
		{			
			$listener->send(function($event)
			{
				...
				...
			})
			
			->open(function($event)
			{
				...
				...
			});
			
			->softBounce(function($event)
			{
				...
				...
			});
		});
	}
}
```

The `listen()` method will respond to any POST request containing a `mandrill_events` property. Pass a closure with a parameter of type `Listener` to the `listen()` method. The `Listener` class provides a number of methods as event handlers.

The Listen method also returns an array of the recieved events so you can process them yourself if don't want to use the Incus event handlers.

```php
class MyMandrillApp extends Controller
{
	public function webhooks()
	{
		$events = Incus::listen();
		
		foreach ($events as $event) {
			echo "Event occured: " . $event->at()->format('d F Y');
		}		
	}
}
```

## Event Handlers
The following methods are provided by the `Listener` class. For each event found in the `mandrill_events` object, the appropriate event handler is fired once.

```php
$listener
	->send()
	->deferral()
	->open()
	->click()
	->softBounce()
	->hardBounce()
	->spam()
	->unsub()
	->reject()
```

Each event handler recieves a function as a parameter, which in turn takes an instance of the `Event` class as a parameter. The `Event` class provides a number of methods for working with the actual Mandrill Event. The following methods are provided by the `Event` object.

### ->at()
The `at` property is the time when the event was fired as a `Carbon` instance, so you have all the Carbon functionality on it.

```php
$listener->send(function($event)
{
	echo $event->at()->format('d F Y');
});
```

### ->indexed()
Whether or not the message has been indexed. The property will always return false if the `->raw->msg` property is empty, or doesn't exist. Mandrill messages may not be indexed if an event occures soon after the message is delivered.

```php
	if ($event->indexed()) {
		echo 'Message has been indexed'
	}
```

### ->message()
Grab the message from the event. This method returns an instance of the `Message` class.

```php
$listener->softBounce(function($event))
{
	$message = $event->message();
	Log::info('Message was sent to ' . $message->to());
}
```

### ->raw()
The `raw` property will return the Mandrill event as a json object as it was received from the webhook. Nothing return by this property is altered or processed.

```php
$listener->click(function($event)
{
	if ($event->raw()->user_agent_parsed->mobile) {
		echo 'User agent is mobile!';
	}
});
```

### ->type()
Returns the type of event that occured. This is only really useful if you collect an array of events from the `listen()` method. The `Listener` class also provides a set of constants that you can use for comparrison.

```php
$events = Incus::listen();
foreach ($events as $event) {
	if ($event->type() === Listener::EVENT_CLICK) {
		Log::info('Click event!');
	}
}
```


## Message
The `Message` object provides a whole bunch of information about the actual message. The basic ones include:

    ->id()          Returns the unique ID of the message.
    ->at()          Returns a Carbon instance for when the message was sent.
    ->to()          Returns the email address the message was sent to.
    ->from()        Returns the email address the message was sent from.
    ->subject()     Returns the subject of the message.
    ->state()       Returns the state of the message as a string.
    ->subAccount()  Returns the sub account used for the message.
    ->template()    Returns the name of the template used for the message.
    ->tags()        Returns an array of tags applied to the message.
    
For bounced messages, there is also a `diag()` method which returns a diagnosis message, and a `bounceDescription()` method which returns a short reason for the message bouncing.

There is also a `metadata()` method which returns an instance of the `Metadata` class. This class provides three methods: `all()`, `has()` and `get()`.

```php
$listener->click(function($event)
{
    if ($event->message()->metadata()->has('user_id')) {
        $userId = $event->message->metadata()->get('user_id');
    }
});
```

If Mandrill has not index the message (which is possible if the message is very new, or older than 30 days), then the `message()` method will return null. To avoid any problems, it's advisable to check if the message has been indexed using the `indexed()` method detailed earlier.
