<?php
App::uses('AppModel', 'Model');
/**
 * Market Model
 *
 * @property Exchange $Exchange
 * @property DataBanksIntraday $DataBanksIntraday
 * @property IndexValue $IndexValue
 * @property MarketStat $MarketStat
 */
class Market extends AppModel {

    var $useDbConfig = 'mainsb';
    public $actsAs = array('Containable');

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Exchange' => array(
            'className' => 'Exchange',
            'foreignKey' => 'exchange_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'DataBanksIntraday' => array(
            'className' => 'DataBanksIntraday',
            'foreignKey' => 'market_id',
            'dependent' => false,
            'conditions' => '',
            //'fields' => 'DISTINCT trade_time,id, market_id, instrument_id, instrument_code, quote_bases, open_price, pub_last_traded_price, spot_last_traded_price, high_price, low_price, close_price, yday_close_price, total_trades, total_volume, total_value, public_total_trades, public_total_volume, public_total_value, spot_total_trades, spot_total_volume, spot_total_value, lm_date_time',
           // 'fields' => array('DataBanksIntraday.id','DataBanksIntraday.trade_time'),
            'order' => 'DataBanksIntraday.trade_time DESC',
            'limit' => '1100',
            'group' => array('DataBanksIntraday.trade_time','DataBanksIntraday.instrument_id'),
            //'group' => "trade_time, instrument_id",
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'IndexValue' => array(
            'className' => 'IndexValue',
            'foreignKey' => 'market_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            //'order' => 'IndexValue.id DESC',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'MarketStat' => array(
            'className' => 'MarketStat',
            'foreignKey' => 'market_id',
            'dependent' => false,
            //'order' => 'MarketStat.id DESC',
            'fields' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
