<?php
App::uses('AppController', 'Controller');
/**
 * Markets Controller
 *
 * @property Market $Market
 */
class MarketsController extends AppController {

     /**
     * home method
     *
     * @return void
     */
    public $components = array('HighCharts.HighCharts');
    public $chartData = array( 7.0,6.9,9.5,14.5,18.2,21.5,25.2,26.5,23.3,18.3,13.9,9.6,7.0,6.9,9.5,14.5,18.2,21.5,25.2,26.5,23.3,18.3,13.9,9.6,7.0,6.9,9.5,14.5,18.2,21.5,25.2,26.5,23.3,18.3,13.9,9.6,7.0,6.9,9.5,14.5,18.2,21.5,25.2,26.5,23.3,18.3,13.9,9.6);
    public function home() {
        $this->layout = 'default3';
        //debug($this->Market->find('all'));
        $lastTradeInfo = $this->Market->find('first', array(
            'order' => array('Market.id' => 'desc'),
            'recursive' => 1
        ));
        //debug($lastTradeInfo);
        $this->set('lastTradeInfo',$lastTradeInfo);


        $pieData = array(
            array(
                'name' => 'Chrome',
                'y' => 45.0,
                'sliced' => true,
                'selected' => true
            ),
            array('IE', 26.8),
            array('Firefox', 12.8),
            array('Safari', 8.5),
            array('Opera', 6.2),
            array('Others', 0.7)
        );

        $chartName = 'Pie Chart';

        $pieChart = $this->HighCharts->create( $chartName, 'pie' );

        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo'				=> 'piewrapper',  // div to display chart inside
                //'chartWidth'			=> 102,
                //'chartHeight'			=> 76,
                'chartMarginTop' 			=> 6,
                'chartMarginLeft'			=> 9,
                'chartMarginRight'			=> 3,
                'chartMarginBottom'			=> 11,
                'chartSpacingRight'			=> 1,
                'chartSpacingBottom'		=> 1,
                'chartSpacingLeft'			=> 0,
                'chartAlignTicks'			=> FALSE,
                'chartBackgroundColorLinearGradient' 	=> array(0,0,0,300),
                'chartBackgroundColorStops'		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                'title'				=> '',
                'titleAlign'			=> 'left',
                'titleFloating'			=> TRUE,
                'titleStyleFont'			=> '18px Metrophobic, Arial, sans-serif',
                'titleStyleColor'			=> '#0099ff',
                'titleX'				=> 2,
                'titleY'				=> 2,

                'legendEnabled' 			=> TRUE,
                'legendLayout'			=> 'horizontal',
                'legendAlign'			=> 'center',
                'legendVerticalAlign '		=> 'bottom',
                'legendItemStyle'			=> array('color' => '#222'),
                'legendBackgroundColorLinearGradient' 	=> array(0,0,0,25),
                'legendBackgroundColorStops' 		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                'tooltipEnabled' 			=> TRUE,
                'tooltipBackgroundColorLinearGradient' => array(0,0,0,50),   // triggers js error
                'tooltipBackgroundColorStops' => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

            )
        );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Browser Share')
            ->addData($pieData);

        $pieChart->addSeries($series);

// AREA CHART

        $chartName = 'AreaSpline Chart';

        $mychart = $this->HighCharts->create( $chartName, 'areaspline' );

        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo'				=> 'areasplinewrapper',  // div to display chart inside
             //   'chartWidth'				=> 450,
                'chartHeight'				=> 200,
                'chartMarginTop' 			=> 60,
                'chartMarginLeft'			=> 90,
                'chartMarginRight'			=> 30,
                'chartMarginBottom'			=> 110,
                'chartSpacingRight'			=> 10,
                'chartSpacingBottom'			=> 15,
                'chartSpacingLeft'			=> 0,
                'chartAlignTicks'			=> FALSE,
                //'chartBackgroundColorLinearGradient' 	=> array(0,0,0,300),
                //'chartBackgroundColorStops'             => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),
                'chartBorderWidth'=>1,
                'chartBorderColor'=>'#DDDDDD',

                //'title'					=> 'Monthly Sales Summary',
                'titleAlign'				=> 'left',
                'titleFloating'				=> TRUE,
                'titleStyleFont'			=> '18px Metrophobic, Arial, sans-serif',
                'titleStyleColor'			=> '#0099ff',
                'titleX'				=> 20,
                'titleY'				=> 20,

                'legendEnabled' 			=> TRUE,
                'legendLayout'				=> 'horizontal',
                'legendAlign'				=> 'center',
                'legendVerticalAlign '			=> 'bottom',
                'legendItemStyle'			=> array('color' => '#222'),
                'legendBackgroundColorLinearGradient' 	=> array(0,0,0,25),
                'legendBackgroundColorStops'            => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                'tooltipEnabled' 			=> FALSE,
                // 'tooltipBackgroundColorLinearGradient' => array(0,0,0,50),   // triggers js error
                // 'tooltipBackgroundColorStops' => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),

                //'plotOptionsLinePointStart' 		=> strtotime('-30 day') * 1000,
                //'plotOptionsLinePointInterval' 	=> 24 * 3600 * 1000,

                //'xAxisType' 				=> 'datetime',
                //'xAxisTickInterval' 			=> 10,
                //'xAxisStartOnTick' 			=> TRUE,
                //'xAxisTickmarkPlacement' 		=> 'on',
                //'xAxisTickLength' 			=> 10,
                //'xAxisMinorTickLength' 		=> 5,

                'xAxisLabelsEnabled' 			=> TRUE,
                'xAxisLabelsAlign' 			=> 'right',
                'xAxisLabelsStep' 			=> 2,
                //'xAxisLabelsRotation' 		=> -35,
                'xAxislabelsX' 				=> 5,
                'xAxisLabelsY' 				=> 20,
                'xAxisCategories'           		=> array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'),

                //'yAxisMin' 				=> 0,
                //'yAxisMaxPadding'			=> 0.2,
                //'yAxisEndOnTick'			=> FALSE,
                //'yAxisMinorGridLineWidth' 		=> 0,
                //'yAxisMinorTickInterval' 		=> 'auto',
                //'yAxisMinorTickLength' 		=> 1,
                //'yAxisTickLength'			=> 2,
                //'yAxisMinorTickWidth'			=> 1,


               // 'yAxisTitleText' 			=> 'Y Axis Title Text',
                //'yAxisTitleAlign' 			=> 'high',
                //'yAxisTitleStyleFont' 		=> '14px Metrophobic, Arial, sans-serif',
                //'yAxisTitleRotation' 			=> 0,
                //'yAxisTitleX' 			=> 0,
                //'yAxisTitleY' 			=> -10,
                //'yAxisPlotLines' 			=> array( array('color' => '#808080', 'width' => 1, 'value' => 0 )),

                // autostep options
                'enableAutoStep' 			=> FALSE
            )
        );

        $series = $this->HighCharts->addChartSeries();

        $series->addName('Tokyo')
            ->addData($this->chartData);

        $mychart->addSeries($series);

    }


}
