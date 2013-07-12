TwitterSource Plugin
=====================

CakePHP TwitterSource Plugin with DataSource for [Twitter API](https://dev.twitter.com/)

## WARNING

Not all endpoints where added. I will add others later.
If you want to use this plugin with other endpoints you can fork and add it (with pull request),
or just create issue.

## Installation

### Step 1: Clone or download [HttpSource](https://github.com/imsamurai/cakephp-httpsource-datasource)

### Step 2: Clone or download to `Plugin/TwitterSource`

  cd my_cake_app/app git://github.com/imsamurai/cakephp-twittersource-datasource.git Plugin/TwitterSource

or if you use git add as submodule:

	cd my_cake_app
	git submodule add "git://github.com/imsamurai/cakephp-twittersource-datasource.git" "app/Plugin/TwitterSource"

then update submodules:

	git submodule init
	git submodule update

### Step 3: Add your configuration to `database.php` and set it to the model

```
:: database.php ::
public $twitter = array(
  'datasource' => 'TwitterSource.Http/TwitterSource',
        'host' => 'api.twitter.com/1.1',
        'port' => 443
        'auth' => array(
		'name' => 'oauth',
		'version' => '1.0',
		'oauth_consumer_key' => 'xxx',
		'oauth_consumer_secret' => 'xxx'
	)
);

Then make model

:: Freebase.php ::
public $useDbConfig = 'twitter';
public $useTable = '<desired endpoint, for ex: "statuses/mentions_timeline">';

```

### Step 4: Load plugin

```
:: bootstrap.php ::
CakePlugin::load('HttpSource', array('bootstrap' => true, 'routes' => false));
CakePlugin::load('TwitterSource');

```
#Tests

To run tests add and fill in your app:

```
Configure::write('TwitterSourceTest', array(
	'credentials' => array(
		'oauth_token' => 'xxx',
		'oauth_token_secret' => 'xxx'
	),
	'consumer' => array(
		'oauth_consumer_key' => 'xxx',
		'oauth_consumer_secret' => 'xxx'
	)
));
```

#Documentation

Please read [HttpSource Plugin README](https://github.com/imsamurai/cakephp-httpsource-datasource/blob/master/README.md)
