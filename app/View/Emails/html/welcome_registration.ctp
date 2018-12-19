<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-bottom:1px solid #e7e7e7;">
    <tr>
        <td>
            <center>
                <table border="0" cellpadding="0" cellspacing="0" width="600px" style="height:100%;">
                    <tr>
                        <td colspan="2" height="20px">
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="bottom" style="padding-left:20px; padding-bottom:20px">
                            <h1>Thanks for registering!</h1>
                            <?php
            echo $this->Html->link(
                            $this->Html->image('/assets/img/logo.gif', array('alt' => 'logo', 'border' => '0', 'class' =>
                            'img-responsive')),
                            '/',
                            array('class' => 'navbar-brand', 'escape' => false)
                            );
                            ?>
                            <br/>
                            <div class="textdark">
                                <p><?php echo $username; ?>Please click the link to activate your account: <b><?php echo $to; ?></b></p>

                            </div>
                            <br/>
                            <a href="<?php echo Router::url('/', true);?>users/activate/<?php echo $activation; ?>"><button type="button" class="btn blue">Activate</button></a>
                        </td>
                        <td align="right" valign="bottom" width="220px" style="padding-right:20px;">
                            <img src="http://keenthemes.com/assets/img/emailtemplate/iphone.png" width="174px" height="294px" alt="iphone"/>
                        </td>
                    </tr>
                </table>
            </center>
        </td>
    </tr>
</table>

