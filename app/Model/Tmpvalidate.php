<?php
App::uses('CakeTime', 'Utility');
/**
 * SeatForm Model
 *
 */
class Tmpvalidate extends AppModel {

	public $useTable = 'backend_users';
	public $validate = array(
		'lastname' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Please fill in your last name'
			),
			'alphabets' => array(
				// 'rule' => 'alphaNumeric',
				'rule' => '/^[\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF} ―]+$/Du',
				'message' => 'Lastname is only contained aphabet characters'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Not longer 100 characters'
			)
		),
		'firstname' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Please fill in your first name'
			),
			'alphabets' => array(
				'rule' => '/^[\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF} ―]+$/Du',
				'message' => 'Firstname is only contained aphabet characters'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 100),
				'message' => 'Not longer 100 characters'
			)
		),
		'mail' => array(
			'email' => array(
				'rule' => 'email',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Please fill in your email or email not valid'
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This email is already taken'
			)
		),
		'phone' => array(
			'phone' => array(
				'rule' => '/^\(?[0-9]{2,4}\)?[-. ]?([0-9]{3,4})[-. ]?([0-9]{3,4})$/i',
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Your phone number is not valid (03-456-6789 123-3456-7890 0123456789)'
			),
			'minLength' => array(
				'rule' => array('minLength', 10),
				'message' => 'Your phone number is not valid (03-456-6789 123-3456-7890 0123456789)'
			)
		),
		'contact' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'required' => true,
				'allowEmpty' => false
			)
		),
		'preferred1' => array(
			'date' => array(
				'rule' => array('date', 'ymd'),
				'required' => true,
				'allowEmpty' => false,
				'message' => 'Please select your first preferred date'
			),
			'future' => array(
				'rule' => array('checkFutureDate'),
				'message' => 'First preferred date must not be smaller than the current date'
			),
			'availabletour'=>null
		),
		'preferred2' => array(
			'date' => array(
				'rule' => array('date', 'ymd'),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Please select your second preferred date'
			),
			'future' => array(
				'rule' => array('checkFutureDate'),
				'message' => 'Second preferred date must not be smaller than the current date'
			),
			'availabletour'=>null
		),
		'question' => array(
			'between' => array(
				'rule' => array('between', 0, 1000),
				'required' => true,
				'allowEmpty' => true,
				'message' => 'Not longer 1000 characters'
			)
		)
	);

	/**
	 * checkFutureDate
	 * Custom validation rule: ensures a selected date is either the current date or
	 * in the future
	 *
	 * @param array $check containts the value passed from the view to be validated
	 * @return bool False if in the past, True otherwise
	 */
	public function checkFutureDate($check) {
		$value = array_values($check);
		return CakeTime::fromString($value[0]) >= CakeTime::fromString(date('Y-m-d'));
	}

}