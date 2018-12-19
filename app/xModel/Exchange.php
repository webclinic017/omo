<?php
App::uses('AppModel', 'Model');
/**
 * Exchange Model
 *
 * @property Instrument $Instrument
 * @property Market $Market
 * @property Sector $Sector
 */
class Exchange extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

    var $useDbConfig = 'mainsb';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Instrument' => array(
			'className' => 'Instrument',
			'foreignKey' => 'exchange_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Market' => array(
			'className' => 'Market',
			'foreignKey' => 'exchange_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Sector' => array(
			'className' => 'Sector',
			'foreignKey' => 'exchange_id',
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
