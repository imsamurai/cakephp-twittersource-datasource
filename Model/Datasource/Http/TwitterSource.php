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

}