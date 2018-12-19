<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i>Multiple Portfolio Management List
        </div>
        <div class="tools">
            <a href="javascript:;" class="collapse" data-original-title="" title="">
            </a>
            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
            </a>
            <a href="javascript:;" class="reload" data-original-title="" title="">
            </a>
            <a href="javascript:;" class="remove" data-original-title="" title="">
            </a>
        </div>
    </div>
    <div class="portlet-body">

        <?php foreach($userListInfo as $user){ $userId=$user['User']['id'];$username=$user['User']['username'];$internal_ref_no=$user['User']['internal_ref_no'];?>
        <a href="<?php echo Router::url('/', true)?>Users/multi_access/<?php echo $userId; ?>" class="icon-btn">
            <i class="fa fa-bar-chart-o"></i>
            <div>
                <?php echo $username; ?>
            </div>
            <span class="badge badge-danger"><?php echo $internal_ref_no; ?></span>
        </a>
        <?php } ?>

    </div>
</div>