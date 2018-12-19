

    <div>
        <button type="button" data-loading-text="loading..." id="loadButton"
                class="demo-loading-btn btn btn-primary btn-block">
            Click to load Today's circuit breaker (only one time before trade)
        </button>
    </div>


    <?php echo Xcrud::load_css() ?>

    <?php echo $xcrud->render(); ?>



    <?php $this->start('script_at_page_end'); ?>

    <?php echo Xcrud::load_js() ?>

    <?php $this->end(); ?>


<script>
    $(function ()
    {

        $("#loadButton").on('click',function(){

            var ajaxUrl = '<?php echo Router::url('/', true)?>DataManagements/readCircuitBreaker';
            var btn = $(this);
            btn.button('loading');

            $.ajax({
                url:ajaxUrl,
                type: 'post',
                data: {circuit_breaker:'A'},

                success: function(jsonArr) {
                    btn.button('reset');

                    window.location.replace(ajaxUrl);

                },
                error: function(xhr, desc, err) {
                    console.log(xhr);
                    console.log("Details: " + desc + "\nError:" + err);
                }

            })

         });
    });
    </script>