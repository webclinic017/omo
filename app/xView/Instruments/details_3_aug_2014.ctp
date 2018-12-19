<?php $high=$lastTradeInfo['high_price'];  $low=$lastTradeInfo['low_price'];  $close=$lastTradeInfo['close_price']; $instrument_code=$instrumentInfo['Instrument']['instrument_code'];?>
<?php $high52=$this->StockBangladesh->get52WeekHigh($data52Weeks);  $low52=$this->StockBangladesh->get52WeekLow($data52Weeks);  $close=$lastTradeInfo['close_price'];?>
        <?php $sectorId=$instrumentInfo['SectorList']['id']?>
<div class="portlet sale-summary">
    <div class="portlet-title">
        <div class="caption">

        </div>
        <div class="tools">
            <a class="reload" href="javascript:;">
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row portfolio-block">
            <div class="col-md-5">
                <div class="portfolio-text">
                    <?php echo $this->Html->image('assets/img/abbank.gif', array('alt' => 'ABBank'));?>
                    <div class="portfolio-text-info">
                        <h3><?php echo $instrumentInfo['Instrument']['name']; ?></h3>
                        <!--<p>Update at Jul 3 2014 12:42 PM</p>-->
                    </div>
                </div>
            </div>
            <div class="col-md-5 portfolio-stat">
                <div class="portfolio-info">
                    ltp <span>
						<?php echo $this->StockBangladesh->getLastTradePrice($lastTradeInfo); ?> </span>
                </div>
                <div class="portfolio-info">
                    Total Volume <span>
											<?php echo $lastTradeInfo['total_volume'];?> </span>
                </div>
                <div class="portfolio-info">
                    Change <span>
											<?php echo $this->StockBangladesh->getPriceChangePer($lastTradeInfo); ?> </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="portfolio-btn">
                    <a href="#" class="btn bigicn-only">
											<span>
											View Chart </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-4">
        <div class="portlet sale-summary">
            <div class="portlet-title">
                <div class="caption">
Today Price Stats
                </div>
                <div class="tools">
                    <a class="reload" href="javascript:;">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <img src="<?=Router::url(array('controller'=>'instruments','action'=>"pricescalegenerator/$high/$low/$close/$instrument_code;?>")) ?>" />
                <img src="<?=Router::url(array('controller'=>'instruments','action'=>"pricescalegenerator/$high52/$low52/$close/$instrument_code-52wk;?>")) ?>" />

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="portlet sale-summary">
            <div class="portlet-title">
                <div class="caption">

                </div>
                <div class="tools">
                    <a class="reload" href="javascript:;">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <ul class="list-unstyled">
                    <li>
																<span class="sale-info">
																Open <i class="fa fa-img-up"></i>
																</span>
																<span class="sale-num">
																<?php echo $lastTradeInfo['open_price'];?> </span>
                    </li>
                    <li>
																<span class="sale-info">
																High <i class="fa fa-img-down"></i>
																</span>
																<span class="sale-num">
																<?php echo $lastTradeInfo['high_price'];?> </span>
																</span>
                    </li>
                    <li>
																<span class="sale-info">
																Low </span>
																<span class="sale-num">
																<?php echo $lastTradeInfo['low_price'];?> </span>
                    </li>
                    <li>
																<span class="sale-info">
																Prev Close </span>
																<span class="sale-num">
																<?php echo $lastTradeInfo['yday_close_price'];?> </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="portlet sale-summary">
            <div class="portlet-title">
                <div class="caption">

                </div>
                <div class="tools">
                    <a class="reload" href="javascript:;">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <ul class="list-unstyled">
                    <li>
																<span class="sale-info">
																Prev Volume <i class="fa fa-img-up"></i>
																</span>
																<span class="sale-num">
																<?php echo $this->StockBangladesh->getPrevVolume($data52Weeks,1); ?> </span> </span>
                    </li>
                    <li>
																<span class="sale-info">
																Volume Change <i class="fa fa-img-down"></i>
																</span>
																<span class="sale-num">
																<?php echo $this->StockBangladesh->getVolumeChange($data52Weeks); ?> (<?php echo $this->StockBangladesh->getVolumeChangePer($data52Weeks); ?>)</span>
                    </li>
                    <li>
																<span class="sale-info">
																Avg (last 5 days) </span>
																<span class="sale-num">
																<?php echo $this->StockBangladesh->getAvgVolume($data52Weeks,5); ?> </span>
                    </li>
                    <li>
																<span class="sale-info">
																Cmp to Avg Vol </span>
																<span class="sale-num">
                                                                    <?php echo $this->StockBangladesh->getCmpWithAvgVolume($data52Weeks,5); ?>
																</span> </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!--   <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
           <div class="btn-group btn-group btn-group-justified">
               <a href="#" class="btn red">
                   Calculate beta </a>
               <a href="#" class="btn blue">
                   Dividend yield </a>
               <a href="#" class="btn green">
                   payout ratio </a>
               <a href="#" class="btn yellow">
                   Advance Chart </a>
               <a href="#" class="btn grey-cascade">
                   Flash chart </a>
           </div>
       </div>

   </div>-->

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Minute Chart </span>
                    <span class="caption-helper">Price and volume movement per minutes</span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>

                    </a>
                    <a href="" class="reload">
                    </a>
                    <a href="" class="remove">
                    </a>
                </div>

            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-4">


                    </div>
                    <div class="col-md-8">

                    <?php echo $this->requestAction("instruments/minute_chart/$instrumentId", array("return")); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">


                    </div>
                    <div class="col-md-8">

                    <?php echo $this->requestAction("sector_intradays/minute_chart/$sectorId", array("return")); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-equalizer font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Trade Statistics </span>
                    <span class="caption-helper">Various trade statistics</span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>

                    </a>
                    <a href="" class="reload">
                    </a>
                    <a href="" class="remove">
                    </a>
                </div>

            </div>
            <div class="portlet-body">
            <div class="row">
            <div class="col-md-4">
                <!--<div class="top-news">
                    <a href="#" class="btn green">
                                            <span>
                                            Value Details </span>
                        <em>
                            <i class="fa fa-tags"></i>
                            Value statistics</em>
                        <i class="fa icon-equalizer top-news-icon"></i>
                    </a>
                </div>-->
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th>
                                <i class="fa icon-equalizer"></i> Value Details
                            </th>
                            <th class="hidden-xs">
                                <i class="fa fa-bar-chart-o"></i> Value
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Total Value </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalValue($lastTradeInfo);?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="info">
                                </div>
                                <a href="#">
                                    Total Taka from Last Minute: </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalValueChange($lastTradeInfo,$prevMinuteTradeInfo);?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Last Minutes Trade Value % </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalValueChangePer($lastTradeInfo,$prevMinuteTradeInfo); ?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="warning">
                                </div>
                                <a href="#">
                                    Trade Growth From Prev date </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalValueChangePer($lastTradeInfo,$yesterdayTradeInfo); ?>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <!--<div class="top-news">
                    <a href="#" class="btn green">
                                        <span>
                                        Volume Details </span>
                        <em>
                            <i class="fa fa-tags"></i>
                            Volume statistics</em>
                        <i class="fa icon-equalizer top-news-icon"></i>
                    </a>
                </div>-->
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th>
                                <i class="fa icon-equalizer"></i> Volume Details
                            </th>
                            <th class="hidden-xs">
                                <i class="fa fa-bar-chart-o"></i> Value
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Total Volume </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalVolume($lastTradeInfo);?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="info">
                                </div>
                                <a href="#">
                                    Share traded from Last Minute: </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalVolumeChange($lastTradeInfo,$prevMinuteTradeInfo);?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Last Minutes Volume % </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalVolumeChangePer($lastTradeInfo,$prevMinuteTradeInfo); ?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="warning">
                                </div>
                                <a href="#">
                                    Trade Growth From Prev date </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalVolumeChangePer($lastTradeInfo,$yesterdayTradeInfo); ?>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <!--<div class="top-news">
                    <a href="#" class="btn green">
                                            <span>
                                            TRADE DETAILS </span>
                        <em>
                            <i class="fa fa-tags"></i>
                           Trades / Contract statistics</em>
                        <i class="fa icon-equalizer top-news-icon"></i>
                    </a>
                </div>-->
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th>
                                <i class="fa icon-equalizer"></i> TRADE DETAILS
                            </th>
                            <th class="hidden-xs">
                                <i class="fa fa-bar-chart-o"></i> Value
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Total Trades </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalTrades($lastTradeInfo);?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="info">
                                </div>
                                <a href="#">
                                    Total Trade from Last Minute: </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalTradesChange($lastTradeInfo,$prevMinuteTradeInfo);?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Last Minutes Trade % </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalTradesChangePer($lastTradeInfo,$prevMinuteTradeInfo); ?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="warning">
                                </div>
                                <a href="#">
                                    Trade Growth From Prev date </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalTradesChangePer($lastTradeInfo,$yesterdayTradeInfo); ?>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-4">
                <!--<div class="top-news">
                    <a href="#" class="btn green">
                                            <span>
                                            Trading Nature </span>
                        <em>
                            <i class="fa fa-tags"></i>
                            Trade style or nature</em>
                        <i class="fa icon-equalizer top-news-icon"></i>
                    </a>
                </div>-->
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th>
                                <i class="fa icon-equalizer"></i> Trading Nature
                            </th>
                            <th class="hidden-xs">
                                <i class="fa fa-bar-chart-o"></i> Value
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Value Per Trade </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getPerTradesValue($lastTradeInfo);?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="info">
                                </div>
                                <a href="#">
                                    Prev day Value per trade </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getPerTradesValue($yesterdayTradeInfo);?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Last Minutes Value Per Trade </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getPerTradesValue($prevMinuteTradeInfo); ?>
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="warning">
                                </div>
                                <a href="#">
                                    Trade Growth From Prev date </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTotalTradesChangePer($lastTradeInfo,$yesterdayTradeInfo); ?>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <!--<div class="top-news">
                    <a href="#" class="btn blue">
                                            <span>
                                            52 Week High </span>
                        <em>
                            <i class="fa fa-tags"></i>
                           52 week High Stats </em>
                        <i class="fa icon-equalizer top-news-icon"></i>
                    </a>
                </div>-->
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th>
                                <i class="fa icon-equalizer"></i> 52 Week High
                            </th>
                            <th class="hidden-xs">
                                <i class="fa fa-bar-chart-o"></i> Value
                            </th>


                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    52 Wk High </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->get52WeekHigh($data52Weeks);?>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="info">
                                </div>
                                <a href="#">
                                    High Date </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->get52WeekHighDate($data52Weeks);?>
                            </td>
                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    52 Wk High (Adjusted) </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->get52WeekHigh($adjustedData52Weeks);?>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="warning">
                                </div>
                                <a href="#">
                                    Date </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->get52WeekHighDate($adjustedData52Weeks);?>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="col-md-4">
                <!--    <div class="top-news">
                        <a href="#" class="btn blue">
                                                <span>
                                                52 Week Low </span>
                            <em>
                                <i class="fa fa-tags"></i>
                                52 week Low Stats </em>
                            <i class="fa icon-equalizer top-news-icon"></i>
                        </a>
                    </div>-->
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th>
                                <i class="fa icon-equalizer"></i> 52 Week Low
                            </th>
                            <th class="hidden-xs">
                                <i class="fa fa-bar-chart-o"></i> Value
                            </th>


                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    52 Wk Low </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->get52WeekLow($data52Weeks);?>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="info">
                                </div>
                                <a href="#">
                                    Low Date </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->get52WeekLowDate($data52Weeks);?>
                            </td>
                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    52 Wk Low (Adjusted) </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->get52WeekLow($adjustedData52Weeks);?>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="warning">
                                </div>
                                <a href="#">
                                    Date </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->get52WeekLowDate($adjustedData52Weeks);?>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-paper-clip font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Fundamental Information </span>
                    <span class="caption-helper">Basic fundamental stats</span>
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>

                    </a>
                    <a href="" class="reload">
                    </a>
                    <a href="" class="remove">
                    </a>
                </div>

            </div>
            <div class="portlet-body">
            <div class="row">
            <div class="col-md-4">
                <!--<div class="top-news">
                    <a href="#" class="btn green">
                                            <span>
                                            Trading Nature </span>
                        <em>
                            <i class="fa fa-tags"></i>
                            Trade style or nature</em>
                        <i class="fa icon-equalizer top-news-icon"></i>
                    </a>
                </div>-->
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th>
                                <i class="fa icon-equalizer"></i> SHARE DRISTRIBUTION
                            </th>
                            <th class="hidden-xs">
                                <i class="fa fa-bar-chart-o"></i> Value
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Director </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $fundamentalDataOrganized['share_percentage_director']['meta_value']?>%
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="info">
                                </div>
                                <a href="#">
                                    share_percentage_govt </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $fundamentalDataOrganized['share_percentage_govt']['meta_value']?>%
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    share_percentage_institute </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $fundamentalDataOrganized['share_percentage_institute']['meta_value']?>%
                            </td>


                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="warning">
                                </div>
                                <a href="#">
                                    share_percentage_public </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $fundamentalDataOrganized['share_percentage_public']['meta_value']?>%
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="warning">
                                </div>
                                <a href="#">
                                    share_percentage_foreign </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $fundamentalDataOrganized['share_percentage_foreign']['meta_value']?>%
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <!--<div class="top-news">
                    <a href="#" class="btn blue">
                                            <span>
                                            52 Week High </span>
                        <em>
                            <i class="fa fa-tags"></i>
                           52 week High Stats </em>
                        <i class="fa icon-equalizer top-news-icon"></i>
                    </a>
                </div>-->
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th>
                                <i class="fa icon-equalizer"></i> BASIC INFO
                            </th>
                            <th class="hidden-xs">
                                <i class="fa fa-bar-chart-o"></i> Value
                            </th>


                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Lot </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $fundamentalDataOrganized['market_lot']['meta_value']?>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="info">
                                </div>
                                <a href="#">
                                    No Of Securities </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $fundamentalDataOrganized['no_of_securities']['meta_value']?>
                            </td>
                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Last agm held </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $fundamentalDataOrganized['last_agm_held']['meta_value']?>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="warning">
                                </div>
                                <a href="#">
                                    Reserve and surplus </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $fundamentalDataOrganized['reserve_and_surplus']['meta_value']?>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Last AGM Held </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $fundamentalDataOrganized['last_agm_held']['meta_value']?>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="col-md-4">
                <!--    <div class="top-news">
                        <a href="#" class="btn blue">
                                                <span>
                                                52 Week Low </span>
                            <em>
                                <i class="fa fa-tags"></i>
                                52 week Low Stats </em>
                            <i class="fa icon-equalizer top-news-icon"></i>
                        </a>
                    </div>-->
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th>
                                <i class="fa icon-equalizer"></i> Capital Details
                            </th>
                            <th class="hidden-xs">
                                <i class="fa fa-bar-chart-o"></i> Value
                            </th>


                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Paidup Capital </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $fundamentalDataOrganized['outstanding_capital']['meta_value']?> M
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="info">
                                </div>
                                <a href="#">
                                    Market Capital </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getMarketCapital($lastTradeInfo,$fundamentalDataOrganized);?>
                            </td>
                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Trade % of MCAP </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getTradePerOfMarketCapital($lastTradeInfo,$fundamentalDataOrganized);?>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="warning">
                                </div>
                                <a href="#">
                                    Public Securities </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getPublicSecurities($fundamentalDataOrganized);?>
                            </td>

                        </tr>
                        <tr>
                            <td class="highlight">
                                <div class="success">
                                </div>
                                <a href="#">
                                    Public Cap </a>
                            </td>
                            <td class="hidden-xs">
                                <?php echo $this->StockBangladesh->getPublicCapital($lastTradeInfo,$fundamentalDataOrganized);?>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>

<div class="row">
    <div class="col-md-5">

        <div class="top-news margin-top-10">
            <a href="#" class="btn blue-madison">
								<span>
								<?php echo $instrument_code;?> News </span>
                <em>
                    <i class="fa fa-tags"></i>
                    Instrument announcement </em>
                <i class="fa fa- icon-bullhorn top-news-icon"></i>
            </a>
        </div>
        <?php foreach ($newsList[$instrument_code] as $news) {
        $details=$news['details'];
        $title=$this->Text->excerpt($details, 'method', 30, '...');
        $body=$this->Text->excerpt($details, 'method', 200, '...');
        ?>
        <div class="news-blocks">
            <h3>
                <a href="page_news_item.html">
                   <?php echo $title; ?></a>
            </h3>
            <div class="news-block-tags">
                <strong><i class="icon-calendar"></i></strong>
                <em><?php echo $this->Time->nice($news['post_date']);
                    echo " (";
                    echo $this->Time->timeAgoInWords(
                    $news['post_date'],
                    array('format' => 'F jS, Y', 'end' => '+1 year')
                    );
                    echo ")";
                    ?></em>
            </div>
            <p>
                <img class="news-block-img pull-right" src="../../assets/admin/pages/media/gallery/image1.jpg" alt=""><?php echo $body; ?>
            </p>
            <a href="page_news_item.html" class="news-block-btn">
                Read more <i class="m-icon-swapright m-icon-black"></i>
            </a>
        </div>
        <?php }?>

    </div>
    <div class="col-md-4">

        <div class="top-news margin-top-10">
            <a href="#" class="btn blue-madison">
								<span>
								DSE News </span>
                <em>
                    <i class="icon-tag"></i>
                    DSE announcement </em>
                <i class="fa fa- icon-bullhorn top-news-icon"></i>
            </a>
        </div>
        <?php
        $i=0;
        foreach ($newsList['DSE NEWS'] as $news) {
        if($i>10)
        break;
        $i++;

        $details=$news['details'];
        $title=$this->Text->excerpt($details, 'method', 30, '...');
        $body=$this->Text->excerpt($details, 'method', 200, '...');
        ?>
        <div class="news-blocks">
            <h3>
                <a href="page_news_item.html">
                    <?php echo $title; ?></a>
            </h3>
            <div class="news-block-tags">
                <strong><i class="icon-calendar"></i></strong>
                <em><?php echo $this->Time->nice($news['post_date']);
                    echo " (";
                    echo $this->Time->timeAgoInWords(
                    $news['post_date'],
                    array('format' => 'F jS, Y', 'end' => '+1 year')
                    );
                    echo ")";
                    ?></em>
            </div>
            <p>
                <img class="news-block-img pull-right" src="../../assets/admin/pages/media/gallery/image1.jpg" alt=""><?php echo $body; ?>
            </p>
            <a href="page_news_item.html" class="news-block-btn">
                Read more <i class="m-icon-swapright m-icon-black"></i>
            </a>
        </div>
        <?php }?>

    </div>
    <div class="col-md-3">

        <div class="top-news margin-top-10">
            <a href="#" class="btn blue-madison">
								<span>
								BSEC News </span>
                <em>
                    <i class="fa fa-tags"></i>
                    BSEC announcement </em>
                <i class="fa fa- icon-bullhorn top-news-icon"></i>
            </a>
        </div>
        <?php
         $i=0;
        foreach ($newsList['BSEC NEWS'] as $news) {
         if($i>10)break;
        $i++;
        $details=$news['details'];
        $title=$this->Text->excerpt($details, 'method', 30, '...');
        $body=$this->Text->excerpt($details, 'method', 200, '...');
        ?>
        <div class="news-blocks">
            <h3>
                <a href="page_news_item.html">
                    <?php echo $title; ?></a>
            </h3>
            <div class="news-block-tags">
                <strong><i class="icon-calendar"></i></strong>
                <em><?php echo $this->Time->nice($news['post_date']);
                    echo " (";
                    echo $this->Time->timeAgoInWords(
                    $news['post_date'],
                    array('format' => 'F jS, Y', 'end' => '+1 year')
                    );
                    echo ")";
                    ?></em>
            </div>
            <p>
                <img class="news-block-img pull-right" src="../../assets/admin/pages/media/gallery/image1.jpg" alt=""><?php echo $body; ?>
            </p>
            <a href="page_news_item.html" class="news-block-btn">
                Read more <i class="m-icon-swapright m-icon-black"></i>
            </a>
        </div>
        <?php }?>

    </div>
</div>





<div class="row">
<div class="col-md-12">
<!-- BEGIN Portlet PORTLET-->
<div class="portlet light bordered">
<div class="portlet-title">
    <div class="caption">
        <i class="icon-paper-clip font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								jplist testing </span>
        <span class="caption-helper">Basic fundamental stats</span>
    </div>
    <div class="tools">
        <a href="" class="collapse">
        </a>

        </a>
        <a href="" class="reload">
        </a>
        <a href="" class="remove">
        </a>
    </div>

</div>
<div class="portlet-body">
<div class="row">
<div class="col-md-12">
<div id="demo" class="box jplist">

<!-- ios button: show/hide panel -->
<div class="jplist-ios-button">
    <i class="fa fa-sort"></i>
    jPList Actions
</div>

<!-- panel -->
<div class="jplist-panel box panel-top">


<div class="row">

<div class="col-md-4">

    <!-- back button button -->
    <button
            type="button"
            data-control-type="back-button"
            data-control-name="back-button"
            data-control-action="back-button">
        <i class="fa fa-arrow-left"></i> Go Back
    </button>

    <!-- reset button -->
    <button
            type="button"
            class="jplist-reset-btn"
            data-control-type="reset"
            data-control-name="reset"
            data-control-action="reset">
        Reset &nbsp;<i class="fa fa-share"></i>
    </button>
</div>

    <div class="col-md-8">

        <!-- items per page dropdown -->
        <div
                class="jplist-drop-down"
                data-control-type="drop-down"
                data-control-name="paging"
                data-control-action="paging">

            <ul>
                <li><span data-number="3"> 3 per page </span></li>
                <li><span data-number="5"> 5 per page </span></li>
                <li><span data-number="10" data-default="true"> 10 per page </span></li>
                <li><span data-number="all"> view all </span></li>
            </ul>
        </div>
        <!-- pagination results -->
        <div
                class="jplist-label"
                data-type="Page {current} of {pages}"
                data-control-type="pagination-info"
                data-control-name="paging"
                data-control-action="paging">
        </div>

        <!-- pagination -->
        <div
                class="jplist-pagination"
                data-control-type="pagination"
                data-control-name="paging"
                data-control-action="paging">
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-12">

            <!-- sort dropdown -->
            <div
                    class="jplist-drop-down"
                    data-control-type="drop-down"
                    data-control-name="sort"
                    data-control-action="sort"
                    data-datetime-format="{month} {day}, {year} {hour}:{min}"> <!-- {year}, {month}, {day}, {hour}, {min}, {sec} -->

                <ul>
                    <li><span data-path="default">Sort by</span></li>
                    <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
                    <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
                    <li><span data-path=".desc" data-order="asc" data-type="text">Description A-Z</span></li>
                    <li><span data-path=".desc" data-order="desc" data-type="text">Description Z-A</span></li>
                    <li><span data-path=".like" data-order="asc" data-type="number" data-default="true">Likes asc</span></li>
                    <li><span data-path=".like" data-order="desc" data-type="number">Likes desc</span></li>
                    <li><span data-path=".date" data-order="asc" data-type="datetime">Date asc</span></li>
                    <li><span data-path=".date" data-order="desc" data-type="datetime">Date desc</span></li>
                </ul>
            </div>

            <!-- &lt;!&ndash; filter by title &ndash;&gt;
    <div class="text-filter-box">

        <i class="fa fa-search  jplist-icon"></i>

        &lt;!&ndash;[if lt IE 10]>
        <div class="jplist-label">Filter by Title:</div>
        <![endif]&ndash;&gt;

        <input
                data-path=".title"
                type="text"
                value=""
                placeholder="Filter by Title"
                data-control-type="textbox"
                data-control-name="title-filter"
                data-control-action="filter"
                />
    </div>-->

            <!-- filter by description -->
            <div class="text-filter-box">

                <i class="fa fa-search  jplist-icon"></i>

                <!--[if lt IE 10]>
                <div class="jplist-label">Filter by Description:</div>
                <![endif]-->

                <input
                        data-path=".desc"
                        type="text"
                        value=""
                        placeholder="Filter by Description"
                        data-control-type="textbox"
                        data-control-name="desc-filter"
                        data-control-action="filter"
                        />
            </div>

            <div
                    class="jplist-group"
                    data-control-type="button-filter-group"
                    data-control-action="filter"
                    data-control-name="button-filter-group-1"
                    data-mode="single">

                <ul>

                    <li>
										<span
                                                data-path=".theme"
                                                data-button="true">
												<i class="fa fa-caret-right"></i>
												All
										</span>
                    </li>

                    <li>
										<span
                                                data-path=".architecture"
                                                data-button="true">
												<i class="fa fa-caret-right"></i>
												Architecture
										</span>
                    </li>

                    <li>
										<span
                                                data-path=".christmas"
                                                data-button="true">
												<i class="fa fa-caret-right"></i>
												Christmas
										</span>
                    </li>

                    <li>
										<span
                                                data-path=".nature"
                                                data-button="true">
												<i class="fa fa-caret-right"></i>
												Nature
										</span>
                    </li>

                    <li>
										<span
                                                data-path=".lifestyle"
                                                data-button="true">
												<i class="fa fa-caret-right"></i>
												Lifestyle
										</span>
                    </li>
                </ul>

            </div>


        </div>
    </div>


</div>


<!-- data -->
<!--<div class="list box text-shadow">


    <?php foreach ($newsList[$instrument_code] as $news) {
        $details=$news['details'];
        $title=$this->Text->excerpt($details, 'method', 30, '...');
    $body=$this->Text->excerpt($details, 'method', 1000, '...');
    ?>
    &lt;!&ndash; item 1 &ndash;&gt;
    <div class="list-item box">
        &lt;!&ndash; img &ndash;&gt;
        <div class="img left">
            <img src="../../img/thumbs/arch-2.jpg" alt="" title=""/>
        </div>

        &lt;!&ndash; data &ndash;&gt;
        <div class="block right">
            <p class="date"><i class="icon-calendar"></i> <?php
            echo $this->Time->format($news['post_date'], '%B %d, %Y, %H:%M');
            //11/22/2001?></p>
            <p class="title"><h3><?php echo $title;?></h3></p>
            <p class="desc"><?php echo $details; ?></p>
            <p class="like">25 Likes</p>
        </div>
    </div>
<?php }?>
</div>-->


<div class="box text-shadow">
<table class="demo-tbl">

    <?php foreach ($newsList[$instrument_code] as $news) {
        $details=$news['details'];
        $title=$this->Text->excerpt($details, 'method', 30, '...');
    $body=$this->Text->excerpt($details, 'method', 1000, '...');
    ?>
<!-- item 1 -->
<tr class="tbl-item">
    <!-- img -->
    <td class="img">
        <!--<img src="../../img/thumbs/arch-1.jpg" alt="" title=""/>-->
        <i class="icon-cup"></i>

    </td>

    <!-- data -->
    <td class="td-block">
        <p class="date"><i class="icon-calendar"></i> <?php
            echo $this->Time->format($news['post_date'], '%B %d, %Y, %H:%M');
            //11/22/2001?></p>
        <p class="title"><h3><?php echo $title;?></h3></p>
        <p class="desc"><?php echo $details; ?></p>
        <p class="like">5 Likes</p>
        <p class="theme">
            <span class="architecture">Architecture</span>
        </p>
    </td>
</tr>
    <?php }?>

</table>
</div>

<div class="box jplist-no-results text-shadow align-center">
    <p>No results found</p>
</div>

<!-- ios button: show/hide panel -->
<div class="jplist-ios-button">
    <i class="fa fa-sort"></i>
    jPList Actions
</div>

<!-- panel -->
<div class="jplist-panel box panel-bottom">

    <!-- items per page dropdown -->
    <div
            class="jplist-drop-down"
            data-control-type="drop-down"
            data-control-name="paging"
            data-control-action="paging"
            data-control-animate-to-top="true">

        <ul>
            <li><span data-number="3"> 3 per page </span></li>
            <li><span data-number="5"> 5 per page </span></li>
            <li><span data-number="10" data-default="true"> 10 per page </span></li>
            <li><span data-number="all"> view all </span></li>
        </ul>
    </div>

    <!-- sort dropdown -->
    <div
            class="jplist-drop-down"
            data-control-type="drop-down"
            data-control-name="sort"
            data-control-action="sort"
            data-control-animate-to-top="true"
            data-datetime-format="{month}/{day}/{year}"> <!-- {year}, {month}, {day}, {hour}, {min}, {sec} -->

        <ul>
            <li><span data-path="default">Sort by</span></li>
            <li><span data-path=".title" data-order="asc" data-type="text">Title A-Z</span></li>
            <li><span data-path=".title" data-order="desc" data-type="text">Title Z-A</span></li>
            <li><span data-path=".desc" data-order="asc" data-type="text">Description A-Z</span></li>
            <li><span data-path=".desc" data-order="desc" data-type="text">Description Z-A</span></li>
            <li><span data-path=".like" data-order="asc" data-type="number" data-default="true">Likes asc</span></li>
            <li><span data-path=".like" data-order="desc" data-type="number">Likes desc</span></li>
            <li><span data-path=".date" data-order="asc" data-type="datetime">Date asc</span></li>
            <li><span data-path=".date" data-order="desc" data-type="datetime">Date desc</span></li>
        </ul>
    </div>

    <!-- pagination results -->
    <div
            class="jplist-label"
            data-type="{start} - {end} of {all}"
            data-control-type="pagination-info"
            data-control-name="paging"
            data-control-action="paging">
    </div>

    <!-- pagination -->
    <div
            class="jplist-pagination"
            data-control-animate-to-top="true"
            data-control-type="pagination"
            data-control-name="paging"
            data-control-action="paging">
    </div>

</div>
</div>
</div>

</div>
</div>
</div>
<!-- END Portlet PORTLET-->
</div>
</div>







<?php $this->start('script_inside_doc_ready'); ?>
<!--
$('#demo').jplist({

itemsBox: '.list'
,itemPath: '.list-item'
,panelPath: '.jplist-panel'

//save plugin state
,storage: 'localstorage' //'', 'cookies', 'localstorage'
,storageName: 'jplist-div-layout'
});
-->


$('#demo').jplist({

itemsBox: '.demo-tbl'
,itemPath: '.tbl-item'
,panelPath: '.jplist-panel'

//save plugin state
,storage: 'localstorage' //'', 'cookies', 'localstorage'
,storageName: 'jplist-tabl'
});

<?php $this->end(); ?>