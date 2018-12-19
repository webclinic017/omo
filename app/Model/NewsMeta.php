<?php
App::uses('AppModel', 'Model');
/**
 * NewsMeta Model
 *
 * @property News $News
 */
class NewsMeta extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    var $useDbConfig = 'mainsb';
	public $displayField = 'meta_key';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'News' => array(
			'className' => 'News',
			'foreignKey' => 'news_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
