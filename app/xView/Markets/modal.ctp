<?php
//echo $this->Html->css('assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min', null, array('inline' => false));
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Modal header</h3>
</div>
<div class="modal-body">


    <div class="portlet-body form">

        <form id="target" action="#" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="control-label col-md-3">Default Markdown</label>
                    <div class="col-md-9">
                        <textarea id="feedbacktext" name="content" data-provide="markdown" rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Email Address</label>

                    <div class="col-md-4">
                        <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-envelope"></i>
															</span>
                            <input type="email" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>


    <button class="btn update">Send</button>
</div>
<div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn">Close</button>
    <button type="button" class="btn btn-primary">Ok</button>
</div>

<?php
//echo $this->Html->script('assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js',array('inline' => false));
                ?>

        <script>
            $("#feedbacktext").markdown({autofocus:false,savable:false});

        </script>