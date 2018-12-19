<div class="tabbable-custom ">
    <ul class="nav nav-tabs ">
        <li class="active">
            <a href="#tab_5_1" data-toggle="tab">Day</a>
        </li>
        <li>
            <a href="#tab_5_2" data-toggle="tab">Last minute</a>
        </li>
        <li>
            <a href="#tab_5_3" data-toggle="tab">Sector</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_5_1">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php echo Hash::get(Hash::extract($lastIndexValues, '{n}.{s}[instrument_id=10001]'), '0.capital_value');?>
                            </div>
                            <div class="desc">
                                <!--<div><i class="fa fa-level-up"></i><span class="label label-sm">DS30 <?php /*echo Hash::get(Hash::extract($lastIndexValues, '{n}.{s}[instrument_id=10002]'), '0.capital_value'); echo ' ('.$this->Number->toPercentage(Hash::get(Hash::extract($lastIndexValues, '{n}.{s}[instrument_id=10002]'), '0.percentage_deviation')).')'; */?></span></div>-->
                                <div><i class="fa fa-level-up"></i><span class="label label-sm">DSEX <?php echo Hash::get(Hash::extract($lastIndexValues, '{n}.{s}[instrument_id=10001]'), '0.capital_value'); echo ' ('.$this->Number->toPercentage(Hash::get(Hash::extract($lastIndexValues, '{n}.{s}[instrument_id=10001]'), '0.percentage_deviation')).')';?></span></div>

                            </div>
                        </div>
                        <a class="more" href="#">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="details">
                            <div class="number"> <?php echo Hash::get(Hash::extract($lastTradeStats, '{s}[TRD_TOTAL_VALUE]'), '0.TRD_TOTAL_VALUE');?></div>
                            <div class="desc">
                                Total Trade (MN)
                            </div>
                        </div>
                        <a class="more" href="#">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="glyphicon glyphicon-arrow-up"></i>
                        </div>
                        <div class="details">
                            <div class="number"><?php echo Hash::apply($lastTradeInfo, '{n}[change>0]', 'count'); ?></div>
                            <div class="desc">
                                <?php
                              //  echo count($lastTradeInfo);
                          //      echo Hash::apply($lastTradeInfo, '{n}[change=0]', 'count');
                            $databank_change_up=Hash::sort(Hash::extract($lastTradeInfo, '{n}[change>0]'), '{n}.change_per', 'desc');
                                $i=1;
                                foreach($databank_change_up as $row){
                                if($i>2)
                                break;
                                ++$i;
                                ?>
                                <div><i class="fa fa-level-up"></i><span class="label label-sm"><?php echo $row['instrument_code']; echo ' ('.$this->Number->toPercentage($row['change_per']).')';?></span></div>
                                <?php
                            }
                            ?>
                                <!--<div><i class="fa fa-level-up"></i><span class="label label-sm">(4.56%)</span></div>-->
                            </div>
                        </div>
                        <a class="more" href="#">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red">
                        <div class="visual">
                            <i class="glyphicon glyphicon-arrow-down"></i>
                        </div>
                        <div class="details">
                            <div class="number"><?php echo Hash::apply($lastTradeInfo, '{n}[change<0]', 'count'); ?></div>
                            <div class="desc">
                                <?php
                            $databank_change_down=Hash::sort(Hash::extract($lastTradeInfo, '{n}[change<0]'), '{n}.change_per', 'asc');
                            $i=1;
                            foreach($databank_change_down as $row){
                             if($i>2)
                                break;
                                ++$i;
                                ?>
                                <div><i class="fa fa-level-down"></i><span class="label label-sm"><?php echo $row['instrument_code']; echo ' ('.$this->Number->toPercentage($row['change_per']).')';?></span></div>
                                <?php
                            }
                            ?>
                            </div>
                        </div>
                        <a class="more" href="#">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_5_2">
            <p>
                Howdy, I'm in Section 2.
            </p>
            <p>
                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat. Ut wisi enim ad minim veniam, quis nostrud exerci tation.
            </p>
            <p>
                <a class="btn green" href="ui_tabs_accordions_navs.html#tab_5_2" target="_blank">Activate this tab via URL</a>
            </p>
        </div>
        <div class="tab-pane" id="tab_5_3">
            <p>
                Howdy, I'm in Section 3.
            </p>
            <p>
                Duis autem vel eum iriure dolor in hendrerit in vulputate. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat
            </p>
            <p>
                <a class="btn yellow" href="ui_tabs_accordions_navs.html#tab_5_3" target="_blank">Activate this tab via URL</a>
            </p>
        </div>
    </div>
</div>