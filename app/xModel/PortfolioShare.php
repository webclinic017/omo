<?php
App::uses('AppModel', 'Model');
/**
 * PortfolioShare Model
 *
 * @property Portfolio $Portfolio
 * @property Instrument $Instrument
 * @property Exchange $Exchange
 */
class PortfolioShare extends AppModel {


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
		)
	);
}
