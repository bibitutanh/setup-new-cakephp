<?php
App::uses('Component','Controller');
App::uses('BackendEventListener','Backend.Event');

Configure::load('backend');

/**
 *
 * @author flow
 * @property AuthComponent $Auth
 * @property SessionComponent $Session
 */
class BackendComponent extends Component {

	public $components = array('Session');

	public $Auth;

	/**
	 * @see Controller::$layout
	 * @var string
	 */
	public $layout = 'Backend.backend';

	public $errorLayout = 'Backend.error';

	/**
	 * @see AuthComponent::$authenticate
	 * @var array
	 */
	public $authenticate = array(
		'Form' => array(
			'userModel' => 'Backend.BackendUser',
			'scope' => array('BackendUser.published' => true)
		)
	);

	/**
	 * @see AuthComponent::$authorize
	 * @var array
	 */
	public $authorize = array(
		'Actions' => array('actionPath' => 'controllers','userModel'=>'Backend.BackendUser')
	);

	/**
	 * @see AuthComponent::$loginAction
	 * @var array
	 */
	public $loginAction = array(
			'plugin' => 'backend',
			'controller'=> 'auth',
			'action'=>'login',
	);

	private $_isBackendRequest = false;

	/**
	 * Initialize Controller and CakeRequest
	 *
	 * This method applies Controller attributes.
	 * Should be called in Component::initialize() or Controller::beforeFilter()
	 *
	 * @param Controller $controller
	 * @param CakeRequest $request
	 * @return boolean
	*/
	public function initialize(Controller $controller) {

		// attach event listeners
		$controller->getEventManager()->attach(new BackendEventListener());

		// add backend detector
		$controller->request->addDetector('backend', array('callback' => array($this,'isBackendRequest')));
		$controller->request->addDetector('iframe', array('callback' => array($this,'isIframeRequest')));

		// is a plugin using backend?
		if ($controller->request->params['plugin']) {
			$this->plugin = $controller->request->params['plugin'];
		}

		if ($controller->request->is('backend')) {

			$this->_isBackendRequest = true;

			// Load plugin specif config
			if ($this->plugin && $this->plugin != "backend") {
				try {
					Configure::load(Inflector::camelize($this->plugin).'.backend');
				} catch(Exception $e) {
					// this plugin has no backend configuration
				}
			}

			// Controller
			$controller->layout = $this->layout;
			$controller->viewClass = 'Backend.Backend';


			// load AuthComponent
			if (Configure::read('Backend.Auth.enabled') === true && !$controller->Components->loaded('Auth')) {
				$controller->Auth = $controller->Components->load('Auth');
				$controller->Auth->initialize($controller);
			}

			// Auth
			if (Configure::read('Backend.Auth.enabled') === true && $controller->Auth) {
				//TODO check if backend auth sessionkey overwrite can be avoided
				AuthComponent::$sessionKey = "Auth.Backend";

				$controller->Auth->authenticate = $this->authenticate;
				$controller->Auth->loginAction = $this->loginAction;

				// enable Access Control List
				if (Configure::read('Backend.Acl.enabled') === true) {
					//TODO check if acl tables are present
					$controller->Auth = $this->authorize;
				}
			}

			// Error Handling
			if (is_a($controller,'CakeErrorController')) {
				// use backend error layout
				$controller->layout = $this->errorLayout;
			}
		}
	}

	public function startup(Controller $controller) {

		//iframe
		if ($controller->request->is('iframe')) {
			$controller->layout = "Backend.iframe";
		}
	}

	public function beforeRender(Controller $controller) {

		if ($this->_isBackendRequest) {

			// load backendhelpers
			$controller->helpers[] = 'Backend.BackendHtml';

			//TODO check if this won't lead to bugs
			if ($controller->layout) {
				$controller->helpers[] = 'Backend.BackendLayout';
			}

			// pretty flash messages
			//TODO make configurable option to enable/disable this feature
			$messages = $this->Session->read('Message');
			if (is_array($messages)) {
				foreach($messages as $key => $message) {
					$type = $message['element'];
					if (!in_array($type,array('default','success', 'error','info','warning')))
						continue;

					$params = am(array(
						'plugin'=>'backend',
						'class'=>'alert',
						'type'=>$type,
						'title'=>Inflector::humanize($type)
					),$message['params']);

					if (isset($params['validationErrors'])) {
						$params['validationErrors'] = $controller->{$params['validationErrors']}->validationErrors;
					}

					$this->Session->write('Message.'.$key, array(
						'message' => $message['message'],
						'element' => 'flash',
						'params' => $params
					));
				}
			}
		}

	}

	/**
	 * Check if given CakeRequest should be handled by Backend
	 * by checking registered routing prefixes.
	 * Backend can be bound to one or more routing prefixes.
	 *
	 * @param CakeRequest $request
	 * @return string|bool If valid, returns name of the prefix, otherwise FALSE
	 */
	public function isBackendRequest(CakeRequest $request) {

		//TODO BACKEND constant should be flagged deprecated. Used by BackendDispatcher
		if (defined('BACKEND'))
			return true;

		if (isset($request->params['admin']) && $request->params['admin'] === true)
			return true;
	}

	/**
	 * Detector function for Iframes
	 *
	 * @param CakeRequest $request
	 * @return boolean
	 */
	public function isIframeRequest(CakeRequest $request) {
		return (isset($request->params['named']['iframe'])) ? $request->params['named']['iframe'] : false;
	}

	public function log($msg, $type = 4, $scope = NULL) {
		CakeLog::write($type, $msg, 'backend');
	}
}
?>