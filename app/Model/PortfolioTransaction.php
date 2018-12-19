<?php
App::uses('AppModel', 'Model');
/**
 * PortfolioTransaction Model
 *
 * @property Portfolio $Portfolio
 * @property Instrument $Instrument
 * @property TransactionType $TransactionType
 */
class PortfolioTransaction extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'portfolio_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Portfolio' => array(
			'className' => 'Portfolio',
			'foreignKey' => 'portfolio_id',
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
		'TransactionType' => array(
			'className' => 'TransactionType',
			'foreignKey' => 'transaction_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
