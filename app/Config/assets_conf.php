<?php
/*Example of read configuration
$globalCss = Configure::read('css.global');
// controller and action name must be in lowercase
*/
$config['css']['global'] = array(
    'assets/global/plugins/font-awesome/css/font-awesome.min',
    'assets/global/plugins/simple-line-icons/simple-line-icons.min',
    'assets/global/plugins/bootstrap/css/bootstrap.min',
    'assets/global/plugins/uniform/css/uniform.default',
    'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min',
    'assets/global/plugins/bootstrap-select/bootstrap-select.min.css',
    'assets/global/plugins/icheck/skins/all.css',
    'assets/global/plugins/bootstrap-toastr/toastr.min.css',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css',
    'assets/admin/pages/css/invoice.css',
    'assets/global/plugins/bootstrap-datepicker/css/datepicker3.css',
    'assets/collected/flipcountdown/jquery.flipcountdown.css',
    'assets/admin/pages/css/timeline-old.css',
    'assets/global/plugins/nouislider/jquery.nouislider.css'

);
$config['css']['theme'] = array(
    'assets/global/css/components',
    'assets/global/css/plugins',
    '/assets/admin/pages/css/profile.css'
    //'assets/admin/layout/css/themes/default',
    //'assets/admin/layout/css/custom'
);

$config['css']['users']['login'] = array(
    'assets/global/plugins/select2/select2',
    'assets/admin/pages/css/login3.css'

);
$config['css']['users']['home'] = array(
    'assets/global/plugins/select2/select2',
    'assets/admin/pages/css/login.css',
    'assets/admin/pages/css/profile-old.css',
    '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
    'assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch',
    'assets/global/plugins/bootstrap-modal/css/bootstrap-modal',
    'assets/global/plugins/jcrop/css/jquery.Jcrop.min',
    'assets/admin/pages/css/image-crop'


);
$config['css']['dashboards']['home'] = array(
    'assets/global/plugins/fancybox/source/jquery.fancybox.css',
    'assets/admin/pages/css/portfolio.css'

);

$config['css']['markets']['home'] = array(
    'assets/global/plugins/select2/select2',
    'assets/global/plugins/select2/select2',
    'assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch',
    'assets/global/plugins/bootstrap-modal/css/bootstrap-modal',
    'assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min',
    'assets/admin/pages/css/tasks.css',
    'assets/admin/pages/css/news.css',
    'assets/global/plugins/fullcalendar/fullcalendar/fullcalendar'

);

$config['css']['markets']['market_events'] = array(
    'assets/global/plugins/fullcalendar/fullcalendar/fullcalendar',
    'assets/global/plugins/multi-date-picker/css/mdp',
    'assets/global/plugins/multi-date-picker/css/prettify'
);

$config['css']['TechnicalAnalysis']['chart_img_trac'] = array(
    'assets/global/plugins/jstree/dist/themes/default/style.min',
    'assets/global/plugins/bootstrap-colorpicker/css/colorpicker',
    'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min',
    'assets/global/plugins/bootstrap-select/bootstrap-select.min',
   // 'assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable',
  //  'assets/global/plugins/bootstrap-editable/inputs-ext/address/address',
    'assets/global/plugins/select2/select2',
    'assets/global/plugins/jquery-multi-select/css/multi-select',
    'assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3',
    'assets/global/plugins/jplist/css/jplist.min',
    'assets/global/plugins/jplist/css/vendor/jquery-ui.css',
    'assets/admin/pages/css/profile-old',
    'assets/admin/pages/css/news'
    //'assets/admin/layout/css/animate'

);
$config['css']['Downloads']['dse_data'] = array(
    'assets/global/plugins/bootstrap-select/bootstrap-select.min',
    'assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3'
  );


$config['css']['technicalAnalysis']['chart'] = array(
    'assets/global/plugins/jstree/dist/themes/default/style.min',
    'assets/global/plugins/bootstrap-colorpicker/css/colorpicker',
    'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min',
    'assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable',
    'assets/global/plugins/select2/select2',
    'assets/global/plugins/select2/select2',
    'assets/global/plugins/jquery-multi-select/css/multi-select',
    'assets/admin/layout/css/custom',
    'assets/admin/layout/css/animate'
);
$config['css']['instruments']['index'] = array(
    'assets/global/plugins/select2/select2.css',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
    'assets/admin/layout/css/custom'

);
$config['css']['instruments']['market_monitor'] = array(
    'assets/global/plugins/bootstrap-select/bootstrap-select.min',
    'assets/global/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css'


);

$config['css']['instruments']['data_matrix'] = array(
    'assets/extjs/resources/ext-theme-gray/ext-theme-gray-all.css',
    'assets/extjs/src/ux/grid/css/GridFilters.css',
    'assets/extjs/src/ux/grid/css/RangeMenu.css'

);

$config['css']['instruments']['details'] = array(
    'assets/admin/pages/css/profile-old',
    'assets/global/plugins/jplist/css/jplist.min',
    'assets/global/plugins/jplist/css/vendor/jquery-ui.css',
    'assets/admin/pages/css/news'


);
$config['css']['users']['list_users'] = array(
    'assets/global/plugins/select2/select2.css',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
    'assets/admin/layout/css/custom'

);
$config['css']['users']['home'] = array(
    '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
    '/assets/admin/pages/css/profile.css',
    '/assets/admin/pages/css/tasks.css'

);


$config['css']['fundamentals']['index'] = array(
    'assets/global/plugins/select2/select2.css',
    'assets/global/plugins/bootstrap-datepicker/css/datepicker3.css',
    'assets/admin/layout/css/custom'

);

$config['css']['portfolios']['index'] = array(
    'assets/global/plugins/select2/select2',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
    'assets/global/plugins/bootstrap-datepicker/css/datepicker3.css',

);

$config['css']['portfolios']['edit_portfolio'] = array(
    'assets/global/plugins/select2/select2',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
    'assets/global/plugins/bootstrap-datepicker/css/datepicker3.css',

);

$config['css']['DataManagements']['manualShareEntry'] = array(
    'assets/global/plugins/select2/select2',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
    'assets/global/plugins/bootstrap-datepicker/css/datepicker3.css',

);

$config['css']['portfolios']['performance'] = array(
    'assets/global/plugins/select2/select2',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
    'assets/global/plugins/bootstrap-datepicker/css/datepicker3.css',

);

$config['css']['markets']['market_composition'] = array(
  //  'assets/admin/layout3/css/custom'
);

$config['css']['events']['agm_egm'] = array(
    'assets/global/plugins/fullcalendar/fullcalendar/fullcalendar',
    'assets/global/plugins/multi-date-picker/css/mdp',
    'assets/global/plugins/jplist/css/jplist.min',
    'assets/global/plugins/multi-date-picker/css/prettify'
);


$config['css']['DataManagements']['deposit'] = array(
    'assets/global/plugins/select2/select2',
    'assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch',
    'assets/global/plugins/bootstrap-modal/css/bootstrap-modal',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css',
);


/*
 * JavaScript
 * */




$config['script']['global'] = array(
    'assets/global/plugins/jquery.min.js',
    'assets/global/plugins/jquery-migrate.min.js',
    'assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js',
    'assets/global/plugins/bootstrap/js/bootstrap.min.js',
    'assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
    'assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
    'assets/global/plugins/jquery.blockui.min.js',
    'assets/global/plugins/jquery.cokie.min.js',
    'assets/global/plugins/select2/select2.min.js',
    'assets/global/plugins/uniform/jquery.uniform.min.js',
    'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
    'assets/global/plugins/jquery-validation/js/jquery.validate.min.js',
    'assets/global/scripts/metronic.js',
    'assets/global/plugins/bootstrap-select/bootstrap-select.min.js',
    'assets/global/plugins/icheck/icheck.min.js',
    'assets/global/plugins/bootstrap-toastr/toastr.min.js',
    'assets/global/plugins/select2/select2.min.js',
    'assets/global/plugins/datatables/media/js/jquery.dataTables.min2.js',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
    'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
    'assets/global/plugins/datatables/media/js/jquery.dataTables.min.js',
    'assets/admin/pages/scripts/custom.js',
    'assets/global/plugins/bootbox/bootbox.min.js',
    'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
    'assets/collected/flipcountdown/jquery.flipcountdown.js',
    'assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js',
    'assets/global/plugins/nouislider/jquery.nouislider.all.min.js'

);

$config['script']['dashboards']['home'] = array(
    'assets/global/plugins/jquery-mixitup/jquery.mixitup.min.js',
    'assets/global/plugins/fancybox/source/jquery.fancybox.pack.js'

);

$config['script']['markets']['market_composition'] = array(
    'assets/highcharts/modules/drilldown.js'
);

$config['script']['markets']['home'] = array(
    'assets/global/plugins/select2/select2.min.js',
    //'assets/global/plugins/bootstrap/js/bootstrap2-typeahead.min.js',
    'assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js',
    'assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js',
    'assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js',
    'assets/global/plugins/jquery.sparkline.min.js',
    'assets/admin/pages/scripts/tasks.js',
    'assets/global/plugins/holder.js',
    'assets/global/plugins/bootstrap-daterangepicker/moment.min.js',
    'assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js'


);
$config['script']['markets']['market_events'] = array(
    'assets/global/plugins/bootstrap-daterangepicker/moment.min.js',
    'assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js',
    'assets/global/plugins/multi-date-picker/jquery-ui.multidatespicker.js'
);


$config['script']['users']['home'] = array(
    'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
    '/assets/global/plugins/jquery.sparkline.min.js',
    'assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js',
    'assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js',
    'assets/global/plugins/jcrop/js/jquery.color.js',
    'assets/global/plugins/jcrop/js/jquery.Jcrop.min.js',
    'assets/admin/pages/scripts/form-image-crop.js',
    'assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js',
    'assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js',
    'assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js'
);


$config['script']['users']['login'] = array(
    'assets/global/plugins/jquery-validation/js/jquery.validate.min.js',
    'assets/global/plugins/select2/select2.min.js',
    'assets/admin/pages/scripts/login.js'
);


$config['script']['users']['password_reset'] = array(
    'assets/global/plugins/jquery-validation/js/jquery.validate.min.js'

);



$config['script']['Downloads']['dse_data'] = array(
    'assets/global/plugins/bootstrap-select/bootstrap-select.min.js',
    'assets/global/plugins/bootstrap-daterangepicker/moment.min.js',
    'assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js'

);
$config['script']['technicalAnalysis']['chart_img_trac'] = array(
    'assets/global/plugins/select2/select2.min.js',
    'assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js',
    'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
    'assets/global/plugins/bootstrap-select/bootstrap-select.min.js',
    'assets/global/plugins/bootstrap-daterangepicker/moment.min.js',
    'assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js',
    '/high_charts/js/highcharts.js',
    'assets/admin/pages/scripts/cdjcv.js',
    'assets/global/plugins/jplist/js/jplist.min.js',
    'assets/admin/pages/scripts/sbchart.js'
);


$config['script']['TechnicalAnalysis']['chart'] = array(
    'assets/global/plugins/select2/select2.min.js',
    'assets/global/plugins/jstree/dist/jstree.min.js',
    'assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js',
    'assets/global/plugins/fuelux/js/spinner.min.js',
    'assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js',
    'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
    'assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js',
    'js/AnyChartStock.js?v=1.0.0r7416',
    'assets/admin/pages/scripts/indicator.js'

);

$config['script']['TechnicalAnalysis']['advance_chart'] = array(

    'assets/tradingview/charting_library/charting_library.min.js',
    'assets/tradingview/charting_library/datafeed/udf/datafeed.js',

);

$config['script']['instruments']['index'] = array(
    'assets/global/plugins/datatables/media/js/jquery.dataTables.min.js',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
    'assets/admin/pages/scripts/table-editable.js'

);
$config['script']['instruments']['details'] = array(
    'assets/global/plugins/jplist/js/jplist.min.js'

);
$config['script']['instruments']['data_matrix'] = array(
   // 'assets/extjs/ext-all.js',
  //  'assets/extjs/stockscreener/app.js'
    //'assets/extjs/writer.js'

);
$config['script']['instruments']['market_monitor'] = array(
    'assets/admin/pages/scripts/portlet-draggable.js',
    'assets/global/plugins/bootstrap-select/bootstrap-select.min.js',
    'assets/global/plugins/jquery.sparkline.min.js',
    'assets/global/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js'


);
$config['script']['users']['list_users'] = array(
    'assets/global/plugins/datatables/media/js/jquery.dataTables.min2.js',
    'assets/global/plugins/datatables/media/js/jquery.jeditable.js',
    'assets/global/plugins/datatables/media/js/jquery.dataTables.editable.js',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
    'assets/admin/pages/scripts/table-editable.js'

);
$config['script']['users']['list_users2'] = array(
    'assets/global/plugins/datatables/media/js/jquery.dataTables.min2.js',
    'assets/global/plugins/datatables/media/js/jquery.jeditable.js',
    'assets/global/plugins/datatables/media/js/jquery.dataTables.editable.js',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
    'assets/admin/pages/scripts/table-editable.js'

);

$config['script']['fundamentals']['index'] = array(
    'assets/global/plugins/datatables/media/js/jquery.dataTables.min2.js'

);

$config['script']['portfolios']['index'] = array(
    'assets/global/plugins/select2/select2.min.js',
    'assets/global/plugins/datatables/media/js/jquery.dataTables.min2.js',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
    'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
    'assets/admin/pages/scripts/portfolio_edit.js',

);
$config['script']['portfolios']['edit_portfolio'] = array(
    'assets/global/plugins/select2/select2.min.js',
    'assets/global/plugins/datatables/media/js/jquery.dataTables.min2.js',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
    'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',

);

$config['script']['DataManagements']['manualShareEntry'] = array(
    'assets/global/plugins/select2/select2.min.js',
    'assets/global/plugins/datatables/media/js/jquery.dataTables.min2.js',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
    'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
    'assets/admin/pages/scripts/portfolio_edit.js',

);
$config['script']['portfolios']['performance'] = array(
    'assets/global/plugins/select2/select2.min.js',
    'assets/global/plugins/datatables/media/js/jquery.dataTables.min2.js',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
    'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'
);
$config['script']['portfolios']['realizedGainLoss'] = array(
    'assets/global/plugins/select2/select2.min.js',
    'assets/global/plugins/datatables/media/js/jquery.dataTables.min2.js',
    'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
    'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
    'assets/admin/pages/scripts/portfolio_edit.js',

);


$config['script']['events']['agm_egm'] = array(
    'assets/global/plugins/bootstrap-daterangepicker/moment.min.js',
    'assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js',
    'assets/global/plugins/multi-date-picker/jquery-ui.multidatespicker.js',
    'assets/global/plugins/jplist/js/jplist.min.js'
);


$config['script']['DataManagements']['deposit'] = array(
    'assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js',
    'assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js',

   // 'assets/global/plugins/datatables/media/js/jquery.dataTables.min2.js',
   // 'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
);

$config['script']['agents']['agentRegistration'] = array(
    'assets/global/plugins/jquery-validation/js/jquery.validate.min.js',
    'assets/global/plugins/jquery-validation/js/additional-methods.min.js',
    'assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js',
    'assets/admin/pages/scripts/form-wizard.js',
 

);




















$temp=array();
foreach($config['script'] as $key=>$actionArr)
{
    foreach($actionArr as $actionKey=>$arr)
    {
        $temp[strtolower($key)][strtolower($actionKey)]=$arr;
    }

}
$config['script']=$temp;

$temp=array();
foreach($config['css'] as $key=>$actionArr)
{
    foreach($actionArr as $actionKey=>$arr)
    {
        $temp[strtolower($key)][strtolower($actionKey)]=$arr;
    }

}

$config['css']=$temp;
