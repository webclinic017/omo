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
                            <h1>Deposit form Submitted</h1>

                            <br/>
                            <div class="textdark">
                                <p><b><?php echo $internal_ref_no; ?></b> has submitted the deposit slip </p>
                                <p>Deposit on <?php echo $paymentType ; ?> <b><?php echo $amount; ?></b> tk</p>
                                <p>Bank :<?php echo $bank; ?></p>
                                 <p>Branch :<?php echo $branch; ?></p>
                                <p>Deposit Date:<b><?php echo $ddate; ?></b></p>

                            </div>
                            <br/>
                            <a href="<?php echo Router::url('/', true)?>files/uploads/deposit/<?=$cheque_ref?>"><button type="button" class="btn blue">Click to see his/her deposit slip</button></a>
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

