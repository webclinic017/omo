<?php
App::uses('AppModel', 'Model');
/**
 * Portfolio Model
 *
 * @property User $User
 */
class Portfolio extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'portfolio_name';

    public $actsAs = array('Containable');


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	/*public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'PortfolioTransaction' => array(
            'className' => 'PortfolioTransaction',
            'foreignKey' => 'portfolio_id',
            'dependent' => false,
            'conditions' => '',
            'order' => array('PortfolioTransaction.transaction_time ASC'),
            'limit' => '',
            'group' =>'',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),'PortfolioShare' => array(
            'className' => 'PortfolioShare',
            'foreignKey' => 'portfolio_id',
            'dependent' => false,
            'conditions' => '',
            'order' => array('PortfolioShare.transaction_time ASC'),
            'limit' => '',
            'group' =>'',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
}
