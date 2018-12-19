<?php
App::uses('AppModel', 'Model');
/**
 * EventInformation Model
 *
 * @property Event $Event
 * @property Meta $Meta
 */
class EventInformation extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'meta_id';

    var $useDbConfig = 'mainsb';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'event_id',
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
