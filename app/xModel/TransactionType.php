<?php
App::uses('AppModel', 'Model');
/**
 * TransactionType Model
 *
 * @property PortfolioTransaction $PortfolioTransaction
 */
class TransactionType extends AppModel {

    var $useDbConfig = 'mainsb';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PortfolioTransaction' => array(
			'className' => 'PortfolioTransaction',
			'foreignKey' => 'transaction_type_id',
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
