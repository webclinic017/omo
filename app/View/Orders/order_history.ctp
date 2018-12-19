<div class="row">

    <div class="col-md-12 ">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title tabbable-line">
                <!-- <div class="caption">
                     <i class="icon-pin font-yellow-lemon"></i>
                                             <span class="caption-subject bold font-yellow-lemon uppercase">
                                             Tabs </span>
                     <span class="caption-helper">more samples...</span>
                 </div>-->
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#portlet_tab2" data-toggle="tab" aria-expanded="false">
                            ACTIVE ORDER <span id="new_active_table"></span> </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab3" data-toggle="tab" aria-expanded="false">
                            LOCKED ORDER <span id="new_locked_table"></span> </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab4" data-toggle="tab" aria-expanded="false">
                            EXECUTED ORDER <span id="new_executed_table"></span> </a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab5" data-toggle="tab" aria-expanded="false">
                            ADVANCE ORDER <span id="new_advance_table"></span></a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab6" data-toggle="tab" aria-expanded="true">
                            DELETED ORDER <span id="new_delete_table"></span></a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab7" data-toggle="tab" aria-expanded="true">
                            WITHDRAW ORDER <span id="new_withdraw_table"></span></a>
                    </li>
                    <li class="">
                        <a href="#portlet_tab8" data-toggle="tab" aria-expanded="true">
                            ALL ORDER <span id="new_all_table"></span></a>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">
                <div class="tab-content">

                    <div class="tab-pane active" id="portlet_tab2">

                        <table class="table table-striped table-bordered table-advance table-hover" id="active_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> Action column
                                </th>
                            </tr>
                            </thead>
                            <tbody id="active_order">

                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane" id="portlet_tab3">
                        <table class="table table-striped table-bordered table-advance table-hover" id="locked_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> Action column
                                </th>
                            </tr>
                            </thead>
                            <tbody id="locked_order">

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab4">
                        <table class="table table-striped table-bordered table-advance table-hover" id="executed_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> Action column
                                </th>
                            </tr>
                            </thead>
                            <tbody id="executed_order">

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab5">
                        <table class="table table-striped table-bordered table-advance table-hover" id="advance_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> Action column
                                </th>
                            </tr>
                            </thead>
                            <tbody id="advance_order">

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab6">
                        <table class="table table-striped table-bordered table-advance table-hover" id="delete_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> Action column
                                </th>
                            </tr>
                            </thead>
                            <tbody id="delete_order">

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab7">
                        <table class="table table-striped table-bordered table-advance table-hover" id="withdraw_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> Action column
                                </th>
                            </tr>
                            </thead>
                            <tbody id="withdraw_order">

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab8">
                        <table class="table table-striped table-bordered table-advance table-hover" id="all_table">
                            <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th class="hidden-xs">
                                    <i class="icon-user"></i> BO Code
                                </th>
                                <th>
                                    <i class="icon-bag"></i> Type
                                </th>
                                <th>
                                    <i class="fa fa-unlink"></i> Symbol
                                </th>
                                <th>
                                    <i class="fa fa-sliders"></i> Qty
                                </th>
                                <th>
                                    <i class="icon-arrow-right"></i> Start Range
                                </th>
                                <th>
                                    <i class="icon-arrow-left"></i> End Range
                                </th>
                                <th>
                                    <i class="icon-calendar"></i> Order Time
                                </th>
                                <th>
                                    <i class="icon-note"></i> Drip
                                </th>
                                <th>
                                    <i class="icon-layers"></i> Status
                                </th>
                                <th>
                                    <i class="icon-grid"></i> Action column
                                </th>
                            </tr>
                            </thead>
                            <tbody id="all_order">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>