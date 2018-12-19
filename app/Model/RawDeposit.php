<?php
App::uses('AppModel', 'Model');
/**
 * RawDeposit Model
 *
 * @property PortfolioTransaction $PortfolioTransaction
 */
class RawDeposit extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'PortfolioTransaction' => array(
			'className' => 'PortfolioTransaction',
			'foreignKey' => 'portfolio_transaction_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
