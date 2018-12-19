<?php
App::uses('AppModel', 'Model');
/**
 * Symbol Model
 *
 * @property Sector $Sector
 */
class Symbol extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    var $useDbConfig = 'mainsb';
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */

	public $belongsTo = array(
		'Sector' => array(
			'className' => 'Sector',
			'foreignKey' => 'sector_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
