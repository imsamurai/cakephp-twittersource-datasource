<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 02.07.2013
 * Time: 19:27:00
 * Format: https://github.com/imsamurai/cakephp-httpsource-datasource
 */
$config['TwitterSource']['config_version'] = 2;

$CF = HttpSourceConfigFactory::instance();
$Config = $CF->config();

$Config
		/*
		 * Returns the 20 most recent mentions (tweets containing a users's @screen_name) for the authenticating user.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/mentions_timeline
		 */
		->add(
				$CF->endpoint()
				->id(1)
				->methodRead()
				->table('statuses/mentions_timeline')
				->path('statuses/mentions_timeline.json')
				->addCondition($CF->condition()->name('count'))
				->addCondition($CF->condition()->name('since_id'))
				->addCondition($CF->condition()->name('max_id'))
				->addCondition($CF->condition()->name('trim_user'))
				->addCondition($CF->condition()->name('contributor_details'))
				->addCondition($CF->condition()->name('include_entities'))
		)

		/*
		 * Returns a collection of the most recent Tweets posted by the user indicated by the screen_name or user_id parameters.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
		 */
		->add(
				$CF->endpoint()
				->id(2)
				->methodRead()
				->table('statuses/user_timeline')
				->path('statuses/user_timeline.json')
				->addCondition($CF->condition()->name('user_id'))
				->addCondition($CF->condition()->name('screen_name'))
				->addCondition($CF->condition()->name('since_id'))
				->addCondition($CF->condition()->name('count'))
				->addCondition($CF->condition()->name('max_id'))
				->addCondition($CF->condition()->name('trim_user'))
				->addCondition($CF->condition()->name('exclude_replies'))
				->addCondition($CF->condition()->name('contributor_details'))
				->addCondition($CF->condition()->name('include_rts'))
		)

		/*
		 * Returns a collection of the most recent Tweets and retweets posted
		 * by the authenticating user and the users they follow. The home timeline
		 * is central to how most users interact with the Twitter service.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/home_timeline
		 */
		->add(
				$CF->endpoint()
				->id(3)
				->methodRead()
				->table('statuses/home_timeline')
				->path('statuses/home_timeline.json')
				->addCondition($CF->condition()->name('count'))
				->addCondition($CF->condition()->name('since_id'))
				->addCondition($CF->condition()->name('max_id'))
				->addCondition($CF->condition()->name('trim_user'))
				->addCondition($CF->condition()->name('exclude_replies'))
				->addCondition($CF->condition()->name('contributor_details'))
				->addCondition($CF->condition()->name('include_entities'))
		)

		/*
		 * Returns the most recent tweets authored by the authenticating user that
		 * have been retweeted by others. This timeline is a subset of
		 * the user's GET statuses/user_timeline.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/retweets_of_me
		 */
		->add(
				$CF->endpoint()
				->id(4)
				->methodRead()
				->table('statuses/retweets_of_me')
				->path('statuses/retweets_of_me.json')
				->addCondition($CF->condition()->name('count'))
				->addCondition($CF->condition()->name('since_id'))
				->addCondition($CF->condition()->name('max_id'))
				->addCondition($CF->condition()->name('trim_user'))
				->addCondition($CF->condition()->name('include_entities'))
				->addCondition($CF->condition()->name('include_user_entities'))
		)

		/*
		 * Returns up to 100 of the first retweets of a given tweet.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/retweets/%3Aid
		 */
		->add(
				$CF->endpoint()
				->id(5)
				->methodRead()
				->table('statuses/retweets')
				->path('statuses/retweets/:id.json')
				->addCondition($CF->condition()->name('id')->required())
				->addCondition($CF->condition()->name('count'))
				->addCondition($CF->condition()->name('trim_user'))
		)

		/*
		 * Returns a single Tweet, specified by the id parameter. The Tweet's author will also be embedded within the tweet.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/show/%3Aid
		 */
		->add(
				$CF->endpoint()
				->id(6)
				->methodRead()
				->table('statuses/show')
				->path('statuses/show/:id.json')
				->addCondition($CF->condition()->name('id')->required())
				->addCondition($CF->condition()->name('trim_user'))
				->addCondition($CF->condition()->name('include_my_retweet'))
				->addCondition($CF->condition()->name('include_entities'))
				->result($CF->result()->map(function($result) {
									return array($result);
								}))
		)

		/*
		 * Returns information allowing the creation of an embedded representation of a Tweet on third party sites.
		 * See the oEmbed specification for information about the response format.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/oembed
		 */
		->add(
				$CF->endpoint()
				->id(7)
				->methodRead()
				->table('statuses/oembed')
				->path('statuses/oembed.json')
				->addCondition($CF->condition()->name('id'))
				->addCondition($CF->condition()->name('url'))
				->addCondition($CF->condition()->name('maxwidth'))
				->addCondition($CF->condition()->name('hide_media'))
				->addCondition($CF->condition()->name('hide_thread'))
				->addCondition($CF->condition()->name('omit_script'))
				->addCondition($CF->condition()->name('align'))
				->addCondition($CF->condition()->name('related')->map(function ($resources) {
									return implode(',', $resources);
								}))
				->addCondition($CF->condition()->name('lang'))
				->result($CF->result()->map(function($result) {
									return array($result);
								}))
		)

		/*
		 * Returns a collection of up to 100 user IDs belonging to users who have retweeted the tweet specified by the id parameter.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/retweeters/ids
		 */
		->add(
				$CF->endpoint()
				->id(8)
				->methodRead()
				->table('statuses/retweeters/ids')
				->path('statuses/retweeters/ids.json')
				->addCondition($CF->condition()->name('id')->required())
				->addCondition($CF->condition()->name('cursor'))
				->addCondition($CF->condition()->name('stringify_ids'))
				->addCondition($CF->condition()->name('count'))
				->result($CF->result()->map(function($result) {
									$_result = array();
									foreach ((array) Hash::get($result, 'ids') as $id) {
										$_result[] = array('id' => $id);
									}
									return $_result;
								}))
		)

		/*
		 * Returns a collection of relevant Tweets matching a specified query.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/search/tweets
		 */
		->add(
				$CF->endpoint()
				->id(9)
				->methodRead()
				->table('search/tweets')
				->path('search/tweets.json')
				->addCondition($CF->condition()->name('q')->required())
				->addCondition($CF->condition()->name('geocode'))
				->addCondition($CF->condition()->name('lang'))
				->addCondition($CF->condition()->name('locale'))
				->addCondition($CF->condition()->name('result_type'))
				->addCondition($CF->condition()->name('count'))
				->addCondition($CF->condition()->name('until'))
				->addCondition($CF->condition()->name('since_id'))
				->addCondition($CF->condition()->name('max_id'))
				->addCondition($CF->condition()->name('include_entities'))
				->addCondition($CF->condition()->name('callback'))
		)

		/*
		 * Returns a small random sample of all public statuses. The Tweets returned by
		 * the default access level are the same, so if two different clients connect to
		 * this endpoint, they will see the same Tweets.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/sample
		 */
		->add(
				$CF->endpoint()
				->id(10)
				->methodRead()
				->table('statuses/sample')
				->path('statuses/sample.json')
				->addCondition($CF->condition()->name('delimited'))
				->addCondition($CF->condition()->name('stall_warnings'))
				->result($CF->result()->map(function($result) {
									return array($result);
								}))
		)

		/*
		 * Returns all public statuses. Few applications require this level of access.
		 * Creative use of a combination of other resources
		 * and various access levels can satisfy nearly every
		 * application use case.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/firehose
		 */
		->add(
				$CF->endpoint()
				->id(11)
				->methodRead()
				->table('statuses/firehose')
				->path('statuses/firehose.json')
				->addCondition($CF->condition()->name('count'))
				->addCondition($CF->condition()->name('delimited'))
				->addCondition($CF->condition()->name('stall_warnings'))
		)

		/*
		 * Streams messages for a single user, as described in User streams.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/user
		 */
		->add(
				$CF->endpoint()
				->id(12)
				->methodRead()
				->table('user')
				->path('user.json')
				->addCondition($CF->condition()->name('delimited'))
				->addCondition($CF->condition()->name('stall_warnings'))
				->addCondition($CF->condition()->name('with'))
				->addCondition($CF->condition()->name('replies'))
				->addCondition($CF->condition()->name('track'))
				->addCondition($CF->condition()->name('locations'))
		)

		/*
		 * Streams messages for a set of users, as described in Site streams.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/site
		 */
		->add(
				$CF->endpoint()
				->id(13)
				->methodRead()
				->table('site')
				->path('site.json')
				->addCondition($CF->condition()->name('follow')->required()->map(function ($ids) {
									return implode(',', $ids);
								}))
				->addCondition($CF->condition()->name('delimited'))
				->addCondition($CF->condition()->name('stall_warnings'))
				->addCondition($CF->condition()->name('with'))
				->addCondition($CF->condition()->name('replies'))
		)

		/*
		 * Returns the 20 most recent direct messages sent to the authenticating user.
		 * Includes detailed information about the sender and recipient user.
		 * You can request up to 200 direct messages per call, up
		 * to a maximum of 800 incoming DMs.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/direct_messages
		 */
		->add(
				$CF->endpoint()
				->id(14)
				->methodRead()
				->table('direct_messages')
				->path('direct_messages.json')
				->addCondition($CF->condition()->name('since_id'))
				->addCondition($CF->condition()->name('max_id'))
				->addCondition($CF->condition()->name('count'))
				->addCondition($CF->condition()->name('include_entities'))
				->addCondition($CF->condition()->name('skip_status'))
		)

		/*
		 * Returns the 20 most recent direct messages sent by the authenticating user.
		 * Includes detailed information about the sender and recipient user.
		 * You can request up to 200 direct messages per call, up to a maximum of 800 outgoing DMs.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/direct_messages/sent
		 */
		->add(
				$CF->endpoint()
				->id(15)
				->methodRead()
				->table('direct_messages/sent')
				->path('direct_messages/sent.json')
				->addCondition($CF->condition()->name('since_id'))
				->addCondition($CF->condition()->name('max_id'))
				->addCondition($CF->condition()->name('count'))
				->addCondition($CF->condition()->name('include_entities'))
				->addCondition($CF->condition()->name('page'))
		)

		/*
		 * Returns a single direct message, specified by an id parameter.
		 * Like the /1.1/direct_messages.format request, this method will include
		 * the user objects of the sender and recipient.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/direct_messages/show
		 */
		->add(
				$CF->endpoint()
				->id(16)
				->methodRead()
				->table('direct_messages/show')
				->path('direct_messages/show.json')
				->addCondition($CF->condition()->name('id')->required())
				->result($CF->result()->map(function($result) {
									return array($result);
								}))
		)

		/*
		 * Returns a collection of user_ids that the currently authenticated
		 * user does not want to receive retweets from.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/friendships/no_retweets/ids
		 */
		->add(
				$CF->endpoint()
				->id(17)
				->methodRead()
				->table('friendships/no_retweets/ids')
				->path('friendships/no_retweets/ids.json')
				->addCondition($CF->condition()->name('stringify_ids'))
				->result($CF->result()->map(function($result) {
									$_result = array();
									foreach ((array) $result as $id) {
										$_result[] = array('id' => $id);
									}
									return $_result;
								}))
		)

		/*
		 * Returns a cursored collection of user IDs for every user the specified
		 * user is following (otherwise known as their "friends").
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/friends/ids
		 */
		->add(
				$CF->endpoint()
				->id(18)
				->methodRead()
				->table('friends/ids')
				->path('friends/ids.json')
				->addCondition($CF->condition()->name('user_id'))
				->addCondition($CF->condition()->name('screen_name'))
				->addCondition($CF->condition()->name('cursor'))
				->addCondition($CF->condition()->name('stringify_ids'))
				->addCondition($CF->condition()->name('count'))
				->result($CF->result()->map(function($result) {
									$_result = array();
									foreach ((array) Hash::get($result, 'ids') as $id) {
										$_result[] = array('id' => $id);
									}
									return $_result;
								}))
		)

		/*
		 * Returns a cursored collection of user IDs for every user following the specified user.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/followers/ids
		 */
		->add(
				$CF->endpoint()
				->id(19)
				->methodRead()
				->table('followers/ids')
				->path('followers/ids.json')
				->addCondition($CF->condition()->name('user_id'))
				->addCondition($CF->condition()->name('screen_name'))
				->addCondition($CF->condition()->name('cursor'))
				->addCondition($CF->condition()->name('stringify_ids'))
				->addCondition($CF->condition()->name('count'))
				->result($CF->result()->map(function($result) {
									$_result = array();
									foreach ((array) Hash::get($result, 'ids') as $id) {
										$_result[] = array('id' => $id);
									}
									return $_result;
								}))
		)

		/*
		 * Returns the relationships of the authenticating user to the comma-separated
		 * list of up to 100 screen_names or user_ids provided. Values for connections
		 * can be: following, following_requested, followed_by, none.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/friendships/lookup
		 */
		->add(
				$CF->endpoint()
				->id(20)
				->methodRead()
				->table('friendships/lookup')
				->path('friendships/lookup.json')
				->addCondition($CF->condition()->name('screen_name')->map(function ($value) {
									return implode(',', $value);
								}))
				->addCondition($CF->condition()->name('user_id')->map(function ($value) {
									return implode(',', $value);
								}))
		)

		/*
		 * Returns a collection of numeric IDs for every user who has a pending request
		 * to follow the authenticating user.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/friendships/incoming
		 */
		->add(
				$CF->endpoint()
				->id(21)
				->methodRead()
				->table('friendships/incoming')
				->path('friendships/incoming.json')
				->addCondition($CF->condition()->name('cursor'))
				->addCondition($CF->condition()->name('stringify_ids'))
				->result($CF->result()->map(function($result) {
									$_result = array();
									foreach ((array) Hash::get($result, 'ids') as $id) {
										$_result[] = array('id' => $id);
									}
									return $_result;
								}))
		)

		/*
		 * Returns a collection of numeric IDs for every protected user for whom the authenticating user
		 * has a pending follow request.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/friendships/outgoing
		 */
		->add(
				$CF->endpoint()
				->id(22)
				->methodRead()
				->table('friendships/outgoing')
				->path('friendships/outgoing.json')
				->addCondition($CF->condition()->name('cursor'))
				->addCondition($CF->condition()->name('stringify_ids'))
				->result($CF->result()->map(function($result) {
									$_result = array();
									foreach ((array) Hash::get($result, 'ids') as $id) {
										$_result[] = array('id' => $id);
									}
									return $_result;
								}))
		)

		/*
		 * Returns detailed information about the relationship between two arbitrary users.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/friendships/show
		 */
		->add(
				$CF->endpoint()
				->id(23)
				->methodRead()
				->table('friendships/show')
				->path('friendships/show.json')
				->addCondition($CF->condition()->name('source_id'))
				->addCondition($CF->condition()->name('source_screen_name'))
				->addCondition($CF->condition()->name('target_id'))
				->addCondition($CF->condition()->name('target_screen_name'))
				->result($CF->result()->map(function($result) {
									return array(Hash::get($result, 'relationship'));
								}))
		)


		/*
		 * Returns a cursored collection of user objects for every user the
		 * specified user is following (otherwise known as their "friends").
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/friends/list
		 */
		->add(
				$CF->endpoint()
				->id(24)
				->methodRead()
				->table('friends/list')
				->path('friends/list.json')
				->addCondition($CF->condition()->name('user_id'))
				->addCondition($CF->condition()->name('screen_name'))
				->addCondition($CF->condition()->name('cursor'))
				->addCondition($CF->condition()->name('skip_status'))
				->addCondition($CF->condition()->name('include_user_entities'))
				->addCondition($CF->condition()->name('count'))
				->result($CF->result()->map(function($result) {
									$_result = array();
									foreach ((array) Hash::get($result, 'users') as $user) {
										$_result[] = $user;
									}
									return $_result;
								}))
		)

		/*
		 * Returns a cursored collection of user objects for users following the specified user.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/followers/list
		 */
		->add(
				$CF->endpoint()
				->id(25)
				->methodRead()
				->table('followers/list')
				->path('followers/list.json')
				->addCondition($CF->condition()->name('user_id'))
				->addCondition($CF->condition()->name('screen_name'))
				->addCondition($CF->condition()->name('cursor'))
				->addCondition($CF->condition()->name('skip_status'))
				->addCondition($CF->condition()->name('include_user_entities'))
				->addCondition($CF->condition()->name('count'))
				->result($CF->result()->map(function($result) {
									$_result = array();
									foreach ((array) Hash::get($result, 'users') as $user) {
										$_result[] = $user;
									}
									return $_result;
								}))
		)
/*
		 * Returns an HTTP 200 OK response code and a representation of the requesting user if authentication was successful;
 *		 * returns a 401 status code and an error message if not. Use this method to test if supplied user credentials are valid.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/account/verify_credentials
		 */
		->add(
				$CF->endpoint()
				->id(26)
				->methodRead()
				->table('account/verify_credentials')
				->path('account/verify_credentials.json')
				->addCondition($CF->condition()->name('include_entities'))
				->addCondition($CF->condition()->name('skip_status'))
				->result($CF->result()->map(function($result) {
									return array($result);
								}))
		)
		/*
		 * Returns the current rate limits for methods belonging to the specified resource families.
		 *
		 * @link https://dev.twitter.com/docs/api/1.1/get/application/rate_limit_status
		 */
		->add(
				$CF->endpoint()
				->id(200)
				->methodRead()
				->table('application/rate_limit_status')
				->path('application/rate_limit_status.json')
				->addCondition($CF->condition()->name('resources')->map(function ($resources) {
									return implode(',', $resources);
								}))
				->result($CF->result()->map(function($result) {
									return array($result);
								}))
		)
		->readParams(array(
			'count' => 'limit+offset'
		))
		->result($CF->result()->map(function($result) {
							return $result;
						}))

;


$config['TwitterSource']['config'] = $Config;