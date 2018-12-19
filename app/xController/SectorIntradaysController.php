<?php
App::uses('AppController', 'Controller');
/**
 * SectorIntradays Controller
 *
 * @property SectorIntraday $SectorIntraday
 * @property PaginatorComponent $Paginator
 */
class SectorIntradaysController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
    public function beforeFilter()
    {
        parent::beforeFilter();

        //$this->Auth->allow('test');
        $this->Auth->allow();

    }
    public function minute_chart($sectorId=2)
    {
      //   Configure::write('debug', 2);
        App::uses('CakeTime', 'Utility');



        $StockBangladesh = $this->Components->load('StockBangladesh');
        $marketId = $StockBangladesh->getMarketInfo(0);

        $sectorData = $this->SectorIntraday->find('all', array(
            'contain' => 'SectorList',
            'conditions' => "SectorIntraday.market_id=$marketId and SectorIntraday.sector_list_id=$sectorId and SectorIntraday.volume>0",
            'recursive' => 0
        ));
        $index_change=Hash::extract($sectorData, '{n}.SectorIntraday.index_change');
        $index_change = Hash::map($index_change, '{n}', function ($newArr) {
            return $newArr*100;
        });

        $volume=Hash::extract($sectorData, '{n}.SectorIntraday.volume');
        $volume=$StockBangladesh->calculate_difference(array_reverse($volume)); // sending volume in desc ordering by time as calculate_difference function requirement

        $volume=array_reverse($volume); // reversing again to get back to previous order

        /*
         * This is temporary measure to hide the negative volume. Real solution in corn and should be removed after real solution
         * */
      /*  $volume = Hash::map($volume, '{n}', function ($newArr) {

            return abs($newArr);
        });*/

        $index_time=Hash::extract($sectorData, '{n}.SectorIntraday.index_time');
        $index_time = Hash::map($index_time, '{n}', function ($newArr) {
            return "'$newArr'";
        });

        $sectorName=Hash::get($sectorData, '0.SectorList.name');

        $chartData['div'] = 'sector_chart_div'; // required
        $chartData['height'] = 300; // required
        $chartData['title'] = $sectorName;
        $chartData['xcat'] = $index_time;
        $chartData['ydata'] = $volume;
        $chartData['xdata'] = $index_change;

        $this->set("chartData", $chartData);

    }

}
