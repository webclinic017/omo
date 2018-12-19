<?php
App::uses('AppModel', 'Model');
/**
 * IndexValue Model
 *
 * @property Market $Market
 * @property Index $Index
 */
class IndexValue extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    var $useDbConfig = 'mainsb';

	public $displayField = 'date_time';


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
		),
		'Index' => array(
			'className' => 'Index',
			'foreignKey' => 'index_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
