<?php
App::uses('AppModel', 'Model');
/**
 * Fundamental Model
 *
 * @property Instrument $Instrument
 * @property FundamentalMeta $FundamentalMeta
 */
class Fundamental extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
    public $actsAs = array('Linkable','Containable');
	public $belongsTo = array(
		'Instrument' => array(
			'className' => 'Instrument',
			'foreignKey' => 'instrument_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FundamentalMeta' => array(
			'className' => 'FundamentalMeta',
			'foreignKey' => 'fundamental_meta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
