<?php
App::uses('AppModel', 'Model');
/**
 * PortfolioLedger Model
 *
 * @property Portfolio $Portfolio
 * @property Instrument $Instrument
 * @property TransactionType $TransactionType
 * @property PortfolioTransaction $PortfolioTransaction
 */
class PortfolioLedger extends AppModel {


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
		),
		'PortfolioTransaction' => array(
			'className' => 'PortfolioTransaction',
			'foreignKey' => 'portfolio_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
