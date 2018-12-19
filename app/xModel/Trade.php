<?php
App::uses('AppModel', 'Model');
/**
 * Trade Model
 *
 * @property Market $Market
 */
class Trade extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    var $useDbConfig = 'mainsb';

	public $displayField = 'TRD_LM_DATE_TIME';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Market' => array(
			'className' => 'Market',
			'foreignKey' => 'market_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
