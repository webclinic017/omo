<?php
App::uses('AppModel', 'Model');
/**
 * CorporateAction Model
 *
 * @property Instrument $Instrument
 */
class CorporateAction extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
    var $useDbConfig = 'mainsb';

	public $useTable = 'corporate_action';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'action';


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
		)
	);
}
