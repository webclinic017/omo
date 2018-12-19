<!-- BEGIN PAGE CONTENT INNER -->
<div class="row profile">
<div class="col-md-12">
<!--BEGIN TABS-->
<div class="tabbable tabbable-custom tabbable-noborder">
<ul class="nav nav-tabs">
    <li class="active">
        <a href="#tab_1_1" data-toggle="tab">
            Overview </a>
    </li>
    <li>
        <a href="#tab_1_3" data-toggle="tab">
            Account </a>
    </li>

</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab_1_1">
<div class="row">
<div class="col-md-3">
    <ul class="list-unstyled profile-nav">
        <li>
            <img id="profile" src="<?php echo Router::url('/', true)."files/profiles/$profile_pic"?>" class="img-responsive"
                 alt="" />
            <a href="#1" class="profile-edit" data-target="#static" data-toggle="modal">edit </a>
        </li>
        <li>
            <a href="#">
                Projects </a>
        </li>
        <li>
            <a href="#">
                Messages <span>
												3 </span>
            </a>
        </li>
        <li>
            <a href="#">
                Friends </a>
        </li>
        <li>
            <a href="#">
                Settings </a>
        </li>
    </ul>
</div>
<div class="col-md-9">
<div class="row">
    <div class="col-md-8 profile-info">
        <h1><?php  echo $this->Session->read('Auth.User.username'); ?></h1>
        <p>
            <?php if(isset($userData['UserInformation']['about'])) echo $userData['UserInformation']['about']?>
        </p>
        <p>
            <a href="#">
                <?php if(isset($userData['UserInformation']['website_url'])) echo $userData['UserInformation']['website_url']?> </a>
        </p>
        <ul class="list-inline">
            <?php if(isset($userData['UserInformation']['mobile_number']))
                echo '<li>
                <i class="fa fa-map-marker"></i> ';
                echo $userData['UserInformation']['mobile_number'];
            echo '</li>';
            ?>

            <?php if(isset($userData['UserInformation']['interests']))
                echo '<li>
                <i class="fa fa-map-marker"></i> ';
            echo $userData['UserInformation']['interests'];
            echo '</li>';
            ?>
            <?php if(isset($userData['UserInformation']['occupation']))
                echo '<li>
                <i class="fa fa-map-marker"></i> ';
            echo $userData['UserInformation']['occupation'];
            echo '</li>';
            ?>

        </ul>
    </div>
    <!--end col-md-8-->
    <div class="col-md-4">
        <div class="portlet sale-summary">
            <div class="portlet-title">
                <div class="caption">
                    Portfolio value
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
																TODAY GAIN <i class="fa fa-img-up"></i>
																</span>
																<span class="sale-num">
																23 </span>
                    </li>
                    <li>
																<span class="sale-info">
																WEEKLY GAIN <i class="fa fa-img-down"></i>
																</span>
																<span class="sale-num">
																87 </span>
                    </li>
                    <li>
																<span class="sale-info">
																GAIN SINCE PURCHASED </span>
																<span class="sale-num">
																2377 </span>
                    </li>
                    <li>
																<span class="sale-info">
																REALIZED </span>
																<span class="sale-num">
																$37.990 </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end col-md-4-->
</div>
<!--end row-->

    <h3 class="block-head">What They Said About Us</h3>



        <h3 class="widget-head">Tag Cloud</h3>
        <div class="widget-content">
            <div class="tags">
                <a href="#">Design</a>
                <a href="#">User interface</a>
                <a href="#">Performance</a>
                <a href="#">Development</a>
                <a href="#">WordPress</a>
                <a href="#">SEO</a>
                <a href="#">Joomla</a>
                <a href="#">ASP.Net</a>
                <a href="#">SharePoint</a>
            </div>
        </div>



</div>
</div>
</div>
<!--tab_1_2-->
<div class="tab-pane" id="tab_1_3">
    <div class="row profile-account">
        <div class="col-md-3">
            <ul class="ver-inline-menu tabbable margin-bottom-10">
                <li class="active">
                    <a data-toggle="tab" href="#tab_1-1">
                        <i class="fa fa-cog"></i> Personal info </a>
												<span class="after">
												</span>
                </li>
              <!--  <li>
                    <a data-toggle="tab" href="#tab_2-2">
                        <i class="fa fa-picture-o"></i> Change Avatar </a>
                </li>-->
                <li>
                    <a data-toggle="tab" href="#tab_3-3">
                        <i class="fa fa-lock"></i> Change Password </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tab_4-4">
                        <i class="fa fa-eye"></i> My Settings </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div id="tab_1-1" class="tab-pane active">
                    <!--<form role="form" action="<?php /*echo Router::url('/', true);*/?>users/password_reset/<?php /*echo $reset_key; */?>">-->
                        <form id="UserProfileForm" action="<?php echo Router::url('/', true);?>UserInformations/update_users<?php echo $reset_key; ?>" method="post">
                        <div class="form-group">
                            <label class="control-label">First Name</label>
                            <input name="data[UserInformation][first_name]" value="<?php if(isset($userData['UserInformation']['first_name'])) echo $userData['UserInformation']['first_name']?>" type="text" placeholder="Mohammad" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Last Name</label>
                            <input name="data[UserInformation][last_name]" value="<?php if(isset($userData['UserInformation']['last_name'])) echo $userData['UserInformation']['last_name']?>" type="text" placeholder="Ibrahim" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Mobile Number</label>
                            <input name="data[UserInformation][mobile_number]" value="<?php if(isset($userData['UserInformation']['mobile_number'])) echo $userData['UserInformation']['mobile_number']?>" type="text" placeholder="017105254780" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Interests</label>
                            <input name="data[UserInformation][interests]" value="<?php if(isset($userData['UserInformation']['interests'])) echo $userData['UserInformation']['interests']?>" type="text" placeholder="Share, Investing etc." class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Occupation</label>
                            <input name="data[UserInformation][occupation]" value="<?php if(isset($userData['UserInformation']['occupation'])) echo $userData['UserInformation']['occupation']?>" type="text" placeholder="Full time trader" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">About</label>
                            <textarea name="data[UserInformation][about]" value="<?php if(isset($userData['UserInformation']['about'])) echo $userData['UserInformation']['about']?>" class="form-control" rows="3" placeholder="We are member of StockBangladesh Familly!!!"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Website Url</label>
                            <input name="data[UserInformation][website_url ]" value="<?php if(isset($userData['UserInformation']['website_url'])) echo $userData['UserInformation']['website_url']?>" type="text" placeholder="http://www.mywebsite.com" class="form-control"/>
                        </div>
                     <!--   <div class="margiv-top-10">
                            <a href="#" class="btn green">
                                Save Changes </a>
                            <a href="#" class="btn default">
                                Cancel </a>
                        </div>-->
                            <div class="form-actions">
                                <button type="submit" id="submit-btn" class="btn green pull-left">
                                    Save Changes <i class="m-icon-swapright m-icon-white"></i>
                                </button>
                            </div>
                    </form>
                </div>
<!--                <div id="tab_2-2" class="tab-pane">
                    <p>
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                    </p>
                    <form action="#" role="form">
                        <div class="form-group">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                </div>
                                <div>
																<span class="btn default btn-file">
																<span class="fileinput-new">
																Select image </span>
																<span class="fileinput-exists">
																Change </span>
																<input type="file" name="...">
																</span>
                                    <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                        Remove </a>
                                </div>
                            </div>
                            <div class="clearfix margin-top-10">
															<span class="label label-danger">
															NOTE! </span>
															<span>
															Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                            </div>
                        </div>
                        <div class="margin-top-10">
                            <a href="#" class="btn green">
                                Submit </a>
                            <a href="#" class="btn default">
                                Cancel </a>
                        </div>
                    </form>
                </div>-->
                <div id="tab_3-3" class="tab-pane">
                    <form id="UserPasswordResetForm" action="<?php echo Router::url('/', true);?>users/change_password/<?php echo $reset_key; ?>" method="post">
                        <div class="form-group">
                            <label class="control-label">Current Password</label>
                            <input name="data[User][cpassword]" type="password" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">New Password</label>
                            <!--<input type="password" class="form-control"/>-->
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="UserPasswordRe" placeholder="Password" name="data[User][password]"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Re-type New Password</label>
                            <!--<input type="password" class="form-control"/>-->
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
                        </div>
                        <div class="margin-top-10">
                          <!--  <a href="#" class="btn green">
                                Change Password </a>
                            <a href="#" class="btn default">
                                Cancel </a>-->

                            <button type="submit" id="register-submit-btn" class="btn green">
                                Change Password <i class="m-icon-swapright m-icon-white"></i>
                            </button>

                        </div>
                    </form>
                </div>
                <div id="tab_4-4" class="tab-pane">
                    <form action="#">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus..
                                </td>
                                <td>
                                    <label class="uniform-inline">
                                        <input type="radio" name="optionsRadios1" value="option1"/>
                                        Yes </label>
                                    <label class="uniform-inline">
                                        <input type="radio" name="optionsRadios1" value="option2" checked/>
                                        No </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                </td>
                                <td>
                                    <label class="uniform-inline">
                                        <input type="checkbox" value=""/> Yes </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                </td>
                                <td>
                                    <label class="uniform-inline">
                                        <input type="checkbox" value=""/> Yes </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Enim eiusmod high life accusamus terry richardson ad squid wolf moon
                                </td>
                                <td>
                                    <label class="uniform-inline">
                                        <input type="checkbox" value=""/> Yes </label>
                                </td>
                            </tr>
                        </table>
                        <!--end profile-settings-->
                        <div class="margin-top-10">
                            <a href="#" class="btn green">
                                Save Changes </a>
                            <a href="#" class="btn default">
                                Cancel </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end col-md-9-->
    </div>
</div>

</div>
</div>
<!--END TABS-->
</div>
</div>
<!-- END PAGE CONTENT INNER -->


<!--    -->





<div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-body">
        <form class="login-form" action="<?php echo Router::url('/', true); ?>users/login" id="UserLoginForm"
              method="post">
            <div class="form-group ">

                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" style="width: 400px;">
                        <img src="<?php echo "http://graph.facebook.com/$facebook_id/picture?type=large"; ?>"
                             class="img-responsive" alt="" width="400"/>
                    </div>
                    <div>
													<span class="btn default btn-file">
													<span class="fileinput-new">
													Select image </span>
													<span class="fileinput-exists">
													Change </span>
													<!--<input type="file" name="...">-->
<input id="fileupload" type="file" name="files" data-url="<?php echo Router::url('/', true); ?>users/upload">
													</span>
                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput" id="rmv">
                            Remove </a>
                    </div>
                </div>

            </div>
        </form>
        <div id="progress" class="progress progress-striped active">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                 aria-valuemax="100" style="width: 0%">

            </div>
        </div>
        <!--<div id="progress">
            <div class="bar" style="width: 20%;"></div>
        </div>-->
    </div>

    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
        <button type="button" id="upload" class="btn blue">Upload</button>
    </div>
</div>


<div id="crop" class="modal container fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <!--<div id="full-width" class="modal container fade" tabindex="-1">-->

    <div class="modal-body">

        <div class="row">
            <div class="col-md-8">
                <div class="fileinput-preview thumbnail" >
                    <img id="demo8" src="<?php echo "http://graph.facebook.com/$facebook_id/picture?type=large"; ?>"
                         class="img-responsive" alt=""/>
                </div>
                <div>

                    <!-- This is the form that our event handler fills -->
                    <form action="../../assets/global/plugins/jcrop/crop-demo.php"  method="post">
                        <input type="hidden" id="crop_x" name="x"/>
                        <input type="hidden" id="crop_y" name="y"/>
                        <input type="hidden" id="crop_w" name="w"/>
                        <input type="hidden" id="crop_h" name="h"/>
                        <input id="demo8_form" type="button" value="Crop Image" class="btn btn-large green"/>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div id="preview-pane">
                    <div class="preview-container">
                        <img id="prvimg" src="../../assets/global/plugins/jcrop/demos/demo_files/image3.jpg" class="jcrop-preview" alt="Preview"/>
                    </div>
                </div>
            </div>
        </div>





    </div>

    <div class="modal-footer">

    </div>
</div>

<?php $this->start('script_inside_doc_ready'); ?>



<?php $this->end(); ?>

<script>

    $(function () {
        $('#fileupload').fileupload({
            dataType: 'json',
            // maxNumberOfFiles:1,
            singleFileUploads: false,
            add: function (e, data) {
                //alert(data);
                //alert(data.files.toSource())
                data.context = $('#upload').click(function () {
//data.context = $('<p/>').text('Uploading...').replaceAll($(this));
                    data.submit();
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            },
            done: function (e, data) {
                data.context.text('Upload finished.');
                $('#upload').unbind('click');
                $('#static').modal('hide');

                /*if ($('#demo8').data('Jcrop')) {
                 $('#demo8').data('Jcrop').destroy();
                 }*/
                $('#demo8').attr("src", data['result']['files'][0]['url']);
                $('#prvimg').attr("src", data['result']['files'][0]['url']);
                Metronic.blockUI();
                $( "#demo8" ).load(function() {



                    //  alert("here");

                    Metronic.unblockUI();
                    var jcrop_api,
                        boundx,
                        boundy,
                    // Grab some information about the preview pane
                        $preview = $('#preview-pane'),
                        $pcnt = $('#preview-pane .preview-container'),
                        $pimg = $('#preview-pane .preview-container img'),

                        xsize = $pcnt.width(),
                        ysize = $pcnt.height();

                    console.log('init',[xsize,ysize]);


                    $('#demo8').Jcrop({
                        aspectRatio: 1,
                        //aspectRatio: xsize / ysize,
                        onChange: updateCoords,
                        //onSelect: updatePreview,
                        onSelect: updateCoords
                    },function(){
                        // Use the API to get the real image size
                        var bounds = this.getBounds();
                        boundx = bounds[0];
                        boundy = bounds[1];
                        // Store the API in the jcrop_api variable
                        jcrop_api = this;
                        // Move the preview into the jcrop container for css positioning
                        $preview.appendTo(jcrop_api.ui.holder);
                    });

                    $('#crop').modal('show');

                    function updateCoords(c)
                    {
                        $('#crop_x').val(c.x);
                        $('#crop_y').val(c.y);
                        $('#crop_w').val(c.w);
                        $('#crop_h').val(c.h);

                        if (parseInt(c.w) > 0)
                        {
                            var rx = xsize / c.w;
                            var ry = ysize / c.h;

                            $pimg.css({
                                width: Math.round(rx * boundx) + 'px',
                                height: Math.round(ry * boundy) + 'px',
                                marginLeft: '-' + Math.round(rx * c.x) + 'px',
                                marginTop: '-' + Math.round(ry * c.y) + 'px'
                            });
                        }




                    };




                });



                $('#demo8_form').click(function(){
                    if (parseInt($('#crop_w').val()))
                    {
                        var ajaxUrl ='<?php echo Router::url('/', true)?>users/crop';

                        $.ajax({
                            type: "POST",
                            url: ajaxUrl,
                            data: { imgsrc:data['result']['files'][0]['name'], x: parseInt($('#crop_x').val()),y: parseInt($('#crop_y').val()),w: parseInt($('#crop_w').val()),h: parseInt($('#crop_h').val())
                            }

                        }).done(function (msg) {
                                $('#profile').attr("src", msg);
                                $('#crop').modal('hide');

                            });
                    }else
                    {
                        alert('Please select a crop region then press crop.');
                    }







                });



                //alert(data['result']['files'][0]['name']);
            }
        })
    });
    $(function () {
        $('#fileupload').click(function () {
            $('#upload').unbind('click');
            $('#upload').text('Upload');
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        });
        $('#rmv').click(function () {
            $('#upload').unbind('click');
            $('#upload').text('Upload');
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        });
    });


</script>


<script type="text/javascript">

    $(function () {



        $('#UserPasswordResetForm').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

                'data[User][password]': {
                    required: true,
                    minlength: 5
                },
                rpassword: {
                    equalTo: "#UserPasswordRe"
                }
            },
            /* messages: {

             'data[User][password]': {
             required: "Please provide a password",
             minlength: "Your password must be at least 5 characters long"
             },
             rpassword: {
             equalTo: "Please enter the same password as above"
             }
             },*/
            invalidHandler: function (event, validator) { //display error alert on form submit

            },

            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group

            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function (error, element) {
                if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            }/*,
             submitHandler: function (form) {
             form.submit();
             }*/
        });



    });

</script>

