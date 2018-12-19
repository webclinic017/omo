<?php
App::uses('AppModel', 'Model');
/**
 * ReportLog Model
 *
 * @property Broker $Broker
 */
class ReportLog extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'irn';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Broker' => array(
			'className' => 'Broker',
			'foreignKey' => 'broker_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
