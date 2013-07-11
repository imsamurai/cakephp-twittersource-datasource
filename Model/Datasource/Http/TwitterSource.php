<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 02.07.2013
 * Time: 19:27:00
 * Format: https://github.com/imsamurai/cakephp-httpsource-datasource
 */
App::uses('HttpSource', 'HttpSource.Model/Datasource');

class TwitterSource extends HttpSource {

    /**
     * Twitter API Datasource
     *
     * @var string
     */
    public $description = 'TwitterSource DataSource';


//	 /**
//     * Sets credentials data and fetch auth header
//     *
//     * @param array $credentials
//     */
//    public function setCredentials(array $credentials = array()) {
//        if (empty($credentials['oauth_token'])) {
//            throw new HttpSourceException('oauth_token not found in credentials');
//        }
//        if (empty($credentials['oauth_token_secret'])) {
//            throw new HttpSourceException('oauth_token_secret not found in credentials');
//        }
//
//        parent::setCredentials($credentials);
//    }
//
//	/**
//	 * {@inheritdoc}
//	 */
//    public function beforeRequest($request, $request_method) {
//		$request['auth'] = array(
//			'auth' => array(
//				'method' => 'OAuth',
//				'oauth_token' => $this->_credentials['token'],
//				'oauth_token_secret' => $this->_credentials['secret'],
//				'oauth_consumer_key' => Configure::read('Opauth.Strategy.Twitter.key'),
//				'oauth_consumer_secret' => Configure::read('Opauth.Strategy.Twitter.secret')
//		));
////        $this->Http->configAuth('GoogleReaderSource.GoogleClientLogin', $this->credentials);
//        return $request;
//    }
}