# Incus

[![image](http://img.shields.io/badge/license-MIT-blue.svg?style=flat)](http://opensource.org/licenses/mit)


Incus is an easy to use Mandrill webhooks processor. The Webhooks data sent by Mandrill can sometimes be a bit confusing, so Incus simplifies the matter.

## Status
Incus is under development and although it works, and you can use it right away, it's far from perfect. Mandrill is a service I used constantly, so Incus will grow as I need to add features to it.

If you find bugs, please use the issue tracker here: [Issue Tracker](https://github.com/warrickbayman/incus/issues)


## Installation
Incus can be installed via Composer. Add the following to the `require` section of your `composer.json` file:

```
{
	require: {
		"warrickbayman\Incus": "dev-master"
	}
}

```

And run `composer update`.

## The Basics
Create a working POST route that accepts POSTs and write a route controller to look something like:

```
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

## Event Handlers
The following methods are provided by the `Listener` class. For each event found in the `mandrill_events` object, the appropriate event handler is fired once.

```
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

Event handler receives an object of type `StdClass` which, currently, contains a single parameter `raw`. The `raw` parameter is the event object as it was received from Mandrill. Note that no data is altered or processed. Future versions of Incus will process this data in meaningful and useful ways.
