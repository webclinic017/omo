<?php
App::uses('AppModel', 'Model');
class Market extends AppModel {
    public $hasMany = array(
        'MarketStat' => array(
            'className' => 'MarketStat',
            //'foreignKey' => 'trade_date',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => 'MarketStat.id DESC',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    //public $hasMany = array('MarketStat');

}
