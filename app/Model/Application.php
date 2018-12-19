<?php
App::uses('AppModel', 'Model');
/**
 * Application Model
 *
 * @property Feedback $Feedback
 */
class Application extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
    var $useDbConfig = 'mainsb';

	public $hasMany = array(
		'Feedback' => array(
			'className' => 'Feedback',
			'foreignKey' => 'application_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
