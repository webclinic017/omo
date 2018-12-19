<!-- BEGIN REGISTRATION FORM -->
<!--<form class="register-form" action="index.html" method="post">-->
<!--<?php echo $this->Form->create('User');?>-->

<?php echo $this->Form->create('User', array(
'class' => 'deposit-form',
'inputDefaults' => array(
'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
'div' => array('class' => 'form-group'),
'label' => array('class' => 'control-label visible-ie8 visible-ie9'),
'between' => '<div class="input-icon"><i class="fa fa-font"></i>',
    'after' => '</div>',
'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-block')),
)));?>


<h3 >Diposit</h3>
<?php
echo $this->Session->flash('flash', array('params' => array('class' => 'alert alert-danger display-block')));
?>

               <?php echo $this->Form->input('amount', array('class' => 'form-control placeholder-no-fix','placeholder' => 'Deposit Amount','required' => true,'between' => '<div class="input-icon"><i class="fa fa-number"></i>')); ?>
               <?php echo $this->Form->input('bank', array('class' => 'form-control placeholder-no-fix','placeholder' => 'Bank Name','between' => '<div class="input-icon"><i class="fa fa-font"></i>')); ?>
               <?php echo $this->Form->input('branch', array('class' => 'form-control placeholder-no-fix','placeholder' => 'Branch Name','between' => '<div class="input-icon"><i class="fa fa-font"></i>')); ?>
               <?php echo $this->Form->input('ddate', array('class' => 'form-control placeholder-no-fix','placeholder' => 'Deposit Date','between' => '<div class="input-icon"><i class="fa fa-date"></i>')); ?>



<div class="form-group">
    <label>
        <input type="radio" name="pay" value="cheque"/> Cheque <input type="radio" name="pay" value="cash"/> Cash
    </label>
    <label>
        <input type="file" name="slip"/> Supported File format: jpg, jpeg, bmp, png, gif,pdf
        Max File Size: 1MB
    </label>
    <div id="register_tnc_error"></div>
</div>
<div class="form-actions">
    <button type="submit" id="deposit-submit-btn" class="btn green">
        Submit <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>
</form>
<!-- END REGISTRATION FORM -->
