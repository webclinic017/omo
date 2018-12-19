<?php
App::uses('AppModel', 'Model');
/**
 * OrderLog Model
 *
 * @property User $User
 * @property Instrument $Instrument
 * @property Broker $Broker
 */
class OrderLog extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'dse_order_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Instrument' => array(
			'className' => 'Instrument',
			'foreignKey' => 'instrument_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Broker' => array(
			'className' => 'Broker',
			'foreignKey' => 'broker_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
