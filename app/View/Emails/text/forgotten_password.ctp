Hi <?php echo $name; ?>,

Someone (hopefully you) has requested a password reset on your account. In order to reset your password please click on the link below:


<a href="<?php echo Router::url('/', true);?>users/password_reset/<?php echo $reset_key; ?>">Reset password</a>

Regards,
StockBangladesh Ltd. Staff