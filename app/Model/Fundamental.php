<?php
App::uses('AppModel', 'Model');
/**
 * Fundamental Model
 *
 * @property Instrument $Instrument
 * @property FundamentalMeta $FundamentalMeta
 */
class Fundamental extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    //var $useDbConfig = 'mainsb';

	//public $displayField = 'meta_value';

    //public $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Instrument' => array(
			'className' => 'Instrument',
			'foreignKey' => 'instrument_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Meta' => array(
			'className' => 'Meta',
			'foreignKey' => 'meta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
