<?
/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 02.07.2013
 * Time: 19:27:00
 * Format: http://book.cakephp.org/2.0/en/models.html
 */

App::uses('HttpSourceModel', 'HttpSource.Model');

class Twitter extends HttpSourceModel {
    public $name = 'Twitter';
}