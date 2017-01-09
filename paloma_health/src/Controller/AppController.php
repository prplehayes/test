<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Database\Type;
Time::$defaultLocale = 'en-US';
Time::setToStringFormat('MM-dd-YYYY');
Type::build('datetime')->useLocaleParser();

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
	public $components = [
    'Acl' => [
        'className' => 'Acl.Acl'
    	],
		
		'Cookie'
	];
	
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
		$this->loadComponent('Auth',array('authenticate' => array(
            'Form' => array(
                'fields' => array('username' => 'email')
            )
        )), [
    'authorize' => [
        'Acl.Actions' => ['actionPath' => 'controllers/']
    ],
    'loginAction' => [
        'plugin' => false,
        'controller' => 'Users',
        'action' => 'login'
    ],
    'loginRedirect' => [
        'plugin' => false,
        'controller' => 'Users',
        'action' => 'index'
    ],
    'logoutRedirect' => [
        'plugin' => false,
        'controller' => 'Users',
        'action' => 'login'
    ],
    'unauthorizedRedirect' => [
        'controller' => 'Cameras',
        'action' => 'index',
        'prefix' => false
    ],
    'authError' => 'You are not authorized to access that location.',
    'flash' => [
        'element' => 'error'
    ]
]);
    }
	
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
