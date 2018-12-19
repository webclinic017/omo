<?php

/*Example of read configuration
$globalCss = Configure::read('css.global');


array(
    array(
        'title' => 'Home',
        'url' => array('controller' => 'markets', 'action' => 'home'),
    )
 )


*/
$config['menu'] = array(
   /* array(
        'title' => 'Trade Panel 2',
        'icon' => 'icon-globe',
        'ajax' => 0,
        'url' => array('controller' => 'dashboards', 'action' => 'trade2'),
        'allowed_group' => array('1','2','4')
    ),*/
    array(
        'title' => 'User Home',
        'icon' => 'icon-globe',
        'ajax' => 1,
        'url' => array('controller' => 'users', 'action' => 'home'),
        'allowed_group' => array('1','2','4')
    ),
    array(
        'title' => 'View Report',
        'icon' => 'icon-bar-chart',
        'ajax' => 1,
        'url' => array('controller' => 'TechnicalAnalysis', 'action' => 'chart2'),
        'allowed_group' => array('1','2')
    ),
    array(
        'title' => 'Deposit',
        'icon' => 'icon-bar-chart',
        'ajax' => 1,
        'url' => array('controller' => 'TechnicalAnalysis', 'action' => 'chart2'),
        'allowed_group' => array('1')
    ),
    array(
        'title' => 'IA Program',
        'icon' => 'icon-briefcase',
        'ajax' => 1,
        'url' => array('controller' => 'Portfolios', 'action' => 'index'),
        'allowed_group' => array('1')
    ),

    array(
        'title' => 'Notice',
        'icon' => 'icon-bar-chart',
        'ajax' => 1,
        'url' => array('controller' => 'TechnicalAnalysis', 'action' => 'chart2'),
        'allowed_group' => array('1','2'),
        'submenu' => array(

            array(
                'title' => 'Company Details',
                'icon' => 'icon-pie-chart',
                'ajax' => 1,
                'url' => array('controller' => 'instruments', 'action' => 'details'),
            ),
            array(
                'title' => 'Event calender',
                'icon' => 'icon-pie-chart',
                'ajax' => 1,
                'url' => array('controller' => 'events', 'action' => 'agm_egm'),
            )
        )
    ),
    array(
        'title' => 'Portfolio',
        'icon' => 'fa fa-rss',
        'ajax' => 1,
        'url' => array('controller' => 'Portfolios', 'action' => 'index'),
        'allowed_group' => array('1','2','4')
    ),
    array(
        'title' => 'Transaction history',
        'icon' => 'fa fa-history',
        'ajax' => 1,
        'url' => array('controller' => 'PortfolioTransactions', 'action' => 'transaction_stat'),
        'allowed_group' => array('1','2','4')
    ),
    array(
        'title' => 'Portfolio Edit-No Adjustment',
        'icon' => 'icon-briefcase',
        'ajax' => 0,
        'url' => array('controller' => 'Portfolios', 'action' => 'edit_no_adjustment'),
        'allowed_group' => array('1')
    ),
    array(
        'title' => 'Portfolio Edit-With Adjustment',
        'icon' => 'icon-briefcase',
        'ajax' => 0,
        'url' => array('controller' => 'Portfolios', 'action' => 'edit_with_adjustment'),
        'allowed_group' => array('1')
    ),
    array(
        'title' => 'Stations Panel',
        'icon' => 'fa fa-cogs',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'panel'),
        'allowed_group' => array('1','2','3','5')
    ),
    array(
        'title' => 'Purchase Power',
        'icon' => 'fa fa-money',
        'ajax' => 0,
        'url' => array('controller' => 'DataManagements', 'action' => 'purchase_power'),
        'allowed_group' => array('1','2','3','5')
    ),
    array(
        'title' => 'Share edit',
        'icon' => 'icon-briefcase',
        'ajax' => 0,
        'url' => array('controller' => 'DataManagements', 'action' => 'adjustShare'),
        'allowed_group' => array('1','2','3','5'),
        'allowed_house' => array('3','5','6','9','12')
    ),

    array(
        'title' => 'Share edit',
        'icon' => 'icon-briefcase',
        'ajax' => 0,
        'url' => array('controller' => 'DataManagements', 'action' => 'adjustShare'),
        'allowed_group' => array('5'),
        'allowed_house' => array('11')
    ),

    array(
        'title' => 'Auto execute report',
        'icon' => 'fa fa-bar-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Downloads', 'action' => 'execute_report'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('11')
    ),
    array(
        'title' => 'Auto execute report',
        'icon' => 'fa fa-bar-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Downloads', 'action' => 'execute_report_hac'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('5')
    ),
    array(
        'title' => 'Auto execute report',
        'icon' => 'fa fa-bar-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Downloads', 'action' => 'execute_report_sharp'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('6')
    ),
    array(
        'title' => 'Auto execute report',
        'icon' => 'fa fa-bar-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Downloads', 'action' => 'execute_report_sbsharp'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('3')
    ),
    array(
        'title' => 'Auto execute report',
        'icon' => 'fa fa-bar-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Downloads', 'action' => 'execute_report_commerce'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('12')
    ),array(
        'title' => 'Auto execute report',
        'icon' => 'fa fa-bar-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Downloads', 'action' => 'execute_report_fis'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('9')
    ),



    array(
        'title' => "Users' Information",
        'icon' => 'icon-users',
        'ajax' => 0,
        'url' => array('controller' => 'stations', 'action' => 'All_users'),
        'allowed_group' => array('1','2','3','5'),
        'submenu' => array(

            array(
                'title' => 'All Users',
                'icon' => 'icon-user',
                'ajax' => 1,
                'url' => array('controller' => 'stations', 'action' => 'All_users'),
            ),
            array(
                'title' => 'Active Users',
                'icon' => 'fa fa-check-circle',
                'ajax' => 1,
                'url' => array('controller' => 'stations', 'action' => 'active_users'),
            ),
            array(
                'title' => 'Inactive Users',
                'icon' => 'fa fa-ban',
                'ajax' => 1,
                'url' => array('controller' => 'stations', 'action' => 'inactive_users'),
            ),
            array(
                'title' => 'Monthly Registrations',
                'icon' => 'fa fa-calendar',
                'ajax' => 1,
                'url' => array('controller' => 'stations', 'action' => 'monthlyRegistration'),
            ),
        )
    ),

    array(
        'title' => 'Run TradeIns Script',
        'icon' => 'fa fa-line-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runTradeIns'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('11')
    ),
    array(
        'title' => 'Run TradeIns Script',
        'icon' => 'fa fa-line-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runTradeInsHac'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('5')
    ),

    array(
        'title' => 'Run TradeIns Script',
        'icon' => 'fa fa-line-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runTradeInsSharp'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('6')
    ),

    array(
        'title' => 'Run TradeIns Script',
        'icon' => 'fa fa-line-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runTradeInsSbsharp'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('3')
    ),

    array(
        'title' => 'Run TradeIns Script',
        'icon' => 'fa fa-line-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runTradeInsCommerce'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('12')
    ),array(
        'title' => 'Run TradeIns Script',
        'icon' => 'fa fa-line-chart',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runTradeInsFis'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('9')
    ),



    array(
        'title' => 'Update Portfolios',
        'icon' => 'fa fa-cloud-upload',
        'ajax' => 0,
        'url' => array('controller' => 'portfolios', 'action' => 'portfolio_update'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('11')
    ),
    array(
        'title' => 'Update Portfolios',
        'icon' => 'fa fa-cloud-upload',
        'ajax' => 0,
        'url' => array('controller' => 'portfolios', 'action' => 'portfolio_update_hac'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('5')
    ),
    array(
        'title' => 'Update Portfolios',
        'icon' => 'fa fa-cloud-upload',
        'ajax' => 0,
        'url' => array('controller' => 'portfolios', 'action' => 'portfolio_update_sharp'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('6')
    ),
    array(
        'title' => 'Update Portfolios',
        'icon' => 'fa fa-cloud-upload',
        'ajax' => 0,
        'url' => array('controller' => 'portfolios', 'action' => 'portfolio_update_sbsharp'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('3')
    ),
    array(
        'title' => 'Update Portfolios',
        'icon' => 'fa fa-cloud-upload',
        'ajax' => 0,
        'url' => array('controller' => 'portfolios', 'action' => 'portfolio_update_fis'),
        'allowed_group' => array('1', '2', '3'),
        'allowed_house' => array('9')
    ),array(
        'title' => 'Update Bonus/Right',
        'icon' => 'fa fa-cloud-upload',
        'ajax' => 0,
        'url' => array('controller' => 'downloads', 'action' => 'bonusRightFis'),
        'allowed_group' => array('1', '2', '3'),
        'allowed_house' => array('9')
    ),

//BrokerReports
    array(
        'title' => 'Broker Trade Report',
        'icon' => 'fa fa-usd',
        'ajax' => 0,
        'url' => array('controller' => 'BrokerReports', 'action' => 'reportSummary'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('9')
    ),

    array(
        'title' => 'Run Balance Script',
        'icon' => 'fa fa-usd',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runBalance'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('11')
    ),
    array(
        'title' => 'Run Balance Script',
        'icon' => 'fa fa-usd',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runBalanceHac'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('5')
    ),
    array(
        'title' => 'Run Balance Script',
        'icon' => 'fa fa-usd',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runBalanceSharp'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('6')
    ),
    array(
        'title' => 'Run Balance Script',
        'icon' => 'fa fa-usd',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runBalanceSbsharp'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('3')
    ),
    array(
        'title' => 'Run Balance Script',
        'icon' => 'fa fa-usd',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runBalanceCommerce'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('12')
    ),
    array(
        'title' => 'Run Balance Script',
        'icon' => 'fa fa-usd',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runBalanceFis'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('9')
    ),


    array(
        'title' => 'Run Margin Script',
        'icon' => 'fa fa-strikethrough',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runMargin2'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('11')
    ),


    array(
        'title' => 'Run Margin Script',
        'icon' => 'fa fa-strikethrough',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runMarginHac'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('5')
    ),

    array(
        'title' => 'Run Loan Script',
        'icon' => 'fa fa-exclamation-triangle',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runLoan'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('11')
    ),

    array(
        'title' => 'Run Loan Script',
        'icon' => 'fa fa-exclamation-triangle',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runLoanHac'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('5')
    ),
    array(
        'title' => 'Portfolio Empty',
        'icon' => 'icon-briefcase',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'emptyPortfolioHac'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('5')
    ),

    /*array(
        'title' => 'Portfolio Reset',
        'icon' => 'icon-briefcase',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'runLedgerHac'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('5')
    ),
    array(
        'title' => 'Portfolio Check',
        'icon' => 'icon-briefcase',
        'ajax' => 0,
        'url' => array('controller' => 'Portfolios', 'action' => 'portfolio_update_hac_new'),
        'allowed_group' => array('1','2','3'),
        'allowed_house' => array('5')
    ),*/

   
    array(
        'title' => 'Access portfolio',
        'icon' => 'fa fa-unlock',
        'ajax' => 0,
        'url' => array('controller' => 'Stations', 'action' => 'access_portfolio'),
        'allowed_group' => array('1','2','3','5')
    ),
    array(
    'title' => 'Admin',
    'icon' => 'icon-briefcase',
    'ajax' => 0,
    'url' => array('controller' => 'Stations', 'action' => 'runTradeIns'),
    'allowed_group' => array('1')
    ),
    array(
        'title' => 'Withdraw/Deposit Information',
        'icon' => 'fa fa-exchange',
        'ajax' => 0,
        'url' => array('controller' => 'DataManagements', 'action' => 'deposit_withdraw_document'),
        'allowed_group' => array('4'),
        'allowed_house' => array('11','5','6','12','3')
    ),

    array(
        'title' => "SB Daily Technical Report",
        'icon' => 'fa fa-file-pdf-o',
        'ajax' => 0,
        'url' => array('controller' => 'DataManagements', 'action' => 'downloadDailyTechnicalReport'),
        'allowed_group' => array('1','2','4')
    ),
    array(
        'title' => "SB Daily News Summary",
        'icon' => 'fa fa-file-pdf-o',
        'ajax' => 0,
        'url' => array('controller' => 'DataManagements', 'action' => 'downloadDailyNewsSummary'),
        'allowed_group' => array('1','2','4')
    ),

);
