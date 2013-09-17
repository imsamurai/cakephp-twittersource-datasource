<?

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 02.07.2013
 * Time: 19:27:00
 * Format: http://book.cakephp.org/2.0/en/development/testing.html
 */
require_once dirname(__FILE__) . DS . 'models.php';

class TwitterTest extends CakeTestCase {

	/**
	 * Twitter Model
	 *
	 * @var Twitter
	 */
	public $Twitter = null;

	public function setUp() {
		parent::setUp();
		$this->_setConfig();
	}

	protected function _setConfig() {
		Configure::delete('TwitterSource');
		Configure::load('TwitterSource.TwitterSource');
	}

	protected function _loadModel($config_name = 'twitterSource', $config = array()) {
		$db_configs = ConnectionManager::enumConnectionObjects();

		if (!empty($db_configs['twitterTest'])) {
			$TestDS = ConnectionManager::getDataSource('twitterTest');
			$config += $TestDS->config;
		} else {
			$config += array(
				'datasource' => 'TwitterSource.Http/TwitterSource',
				'host' => 'api.twitter.com/1.1',
				'port' => 443,
				'timeout' => 5,
				'auth' => array(
			'name' => 'oauth',
			'version' => '1.0'
				) + Configure::read('TwitterSourceTest.consumer')
			);
		}

		ConnectionManager::create($config_name, $config);
		$this->Twitter = new Twitter(false, null, $config_name);
	}

	public function test_statuses_mentions_timeline() {
		$this->_loadModel();
		$this->Twitter->setSource('statuses/mentions_timeline');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'since_id' => '352121246869241850',
				'max_id' => '352121246869241858',
				'trim_user' => 'true',
				'contributor_details' => 'true',
				'include_entities' => 'true'
			),
			'limit' => 1
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_application_rate_limit_status() {
		$this->_loadModel();
		$this->Twitter->setSource('application/rate_limit_status');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'resources' => array('help')
			)
		);

		$result = $this->Twitter->find('first', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_statuses_user_timeline() {
		$this->_loadModel();
		$this->Twitter->setSource('statuses/user_timeline');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'user_id' => '245284963',
				'screen_name' => 'imsamurai',
				'since_id' => '352121246869241850',
				'max_id' => '352121246869241858',
				'trim_user' => 'true',
				'contributor_details' => 'true',
				'include_rts' => 'true'
			),
			'limit' => 200
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_statuses_home_timeline() {
		$this->_loadModel();
		$this->Twitter->setSource('statuses/home_timeline');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'since_id' => '352121246869241850',
				'max_id' => '352121246869241858',
				'trim_user' => 'true',
				'exclude_replies' => 'true',
				'contributor_details' => 'true',
				'include_entities' => 'true'
			),
			'limit' => 200
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_statuses_retweets_of_me() {
		$this->_loadModel();
		$this->Twitter->setSource('statuses/retweets_of_me');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'since_id' => '352021124038664190',
				'max_id' => '352021124038664192',
				'trim_user' => 'true',
				'include_user_entities' => 'true',
				'include_entities' => 'true'
			),
			'limit' => 200
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_statuses_retweets() {
		$this->_loadModel();
		$this->Twitter->setSource('statuses/retweets');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'id' => '352021124038664192',
				'trim_user' => 'true'
			),
			'limit' => 200
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_statuses_show() {
		$this->_loadModel();
		$this->Twitter->setSource('statuses/show');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'id' => '352021124038664192',
				'trim_user' => 'true',
				'include_my_retweet' => 'true',
				'include_entities' => 'false'
			)
		);

		$result = $this->Twitter->find('first', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_statuses_oembed() {
		$this->_loadModel();
		$this->Twitter->setSource('statuses/oembed');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'id' => '352021124038664192',
				'maxwidth' => 250,
				'hide_media' => 'true',
				'hide_thread' => 'false',
				'omit_script' => 'false',
				'align' => 'center',
				'related' => array('twitterapi', 'twittermedia', 'twitter'),
				'lang' => 'en'
			)
		);

		$result = $this->Twitter->find('first', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_statuses_retweeters_ids() {
		$this->_loadModel();
		$this->Twitter->setSource('statuses/retweeters/ids');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'id' => '352021124038664192',
				'cursor' => -1,
				'stringify_ids' => 'true'
			)
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_search_tweets() {
		$this->_loadModel();
		$this->Twitter->setSource('search/tweets');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'q' => 'tweet',
			),
			'limit' => 10
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_statuses_sample() {
		$this->markTestSkipped('Seems we need additional authorization');
		$this->_loadModel('twitterSource', array('host' => 'stream.twitter.com/1.1'));
		$this->Twitter->setSource('statuses/sample');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
			)
		);

		$result = $this->Twitter->find('first', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_statuses_firehose() {
		$this->markTestSkipped('Seems we need additional authorization');
		$this->_loadModel('twitterSource', array('host' => 'stream.twitter.com/1.1'));
		$this->Twitter->setSource('statuses/firehose');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
			)
		);

		$result = $this->Twitter->find('first', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_user() {
		$this->markTestSkipped('Seems we need additional authorization');
		$this->_loadModel('twitterSource', array('host' => 'userstream.twitter.com/1.1'));
		$this->Twitter->setSource('statuses/firehose');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
			)
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_site() {
		$this->markTestSkipped('Seems we need additional authorization');
		$this->_loadModel('twitterSource', array('host' => 'sitestream.twitter.com/1.1'));
		$this->Twitter->setSource('statuses/firehose');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'follow' => array(
					'245284963'
				)
			)
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_direct_messages() {
		$this->_loadModel();
		$this->Twitter->setSource('direct_messages');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
			),
			'limit' => 5
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_direct_messages_sent() {
		$this->_loadModel();
		$this->Twitter->setSource('direct_messages/sent');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
			),
			'limit' => 5
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_direct_messages_show() {
		$this->_loadModel();
		$this->Twitter->setSource('direct_messages/show');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'id' => '337573302459572225'
			)
		);

		$result = $this->Twitter->find('first', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_friendships_no_retweets_ids() {
		$this->_loadModel();
		$this->Twitter->setSource('friendships/no_retweets/ids');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
			)
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_friends_ids() {
		$this->_loadModel();
		$this->Twitter->setSource('friends/ids');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
			),
			'limit' => 5
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_followers_ids() {
		$this->_loadModel();
		$this->Twitter->setSource('followers/ids');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
			),
			'limit' => 5
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_friendships_lookup() {
		$this->_loadModel();
		$this->Twitter->setSource('friendships/lookup');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'screen_name' => array(
					'twitterapi',
					'twitter'
				)
			)
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_friendships_incoming() {
		$this->_loadModel();
		$this->Twitter->setSource('friendships/incoming');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
			)
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_friendships_outgoing() {
		$this->_loadModel();
		$this->Twitter->setSource('friendships/outgoing');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
			)
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_friendships_show() {
		$this->_loadModel();
		$this->Twitter->setSource('friendships/show');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'source_id' => '245284963',
				'target_screen_name' => 'halfpix'
			)
		);

		$result = $this->Twitter->find('first', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_friends_list() {
		$this->_loadModel();
		$this->Twitter->setSource('friends/list');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'user_id' => '245284963'
			),
			'limit' => 5
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_followers_list() {
		$this->_loadModel();
		$this->Twitter->setSource('followers/list');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
			'conditions' => array(
				'user_id' => '245284963'
			),
			'limit' => 5
		);

		$result = $this->Twitter->find('all', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}

	public function test_account_verify_credentials() {
		$this->_loadModel();
		$this->Twitter->setSource('account/verify_credentials');
		$this->Twitter->setCredentials(Configure::read('TwitterSourceTest.credentials'));
		$params = array(
		);

		$result = $this->Twitter->find('first', $params);
		debug($result);
		$this->assertNotSame(false, $result);
	}
}