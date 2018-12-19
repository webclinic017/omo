// app/View/Common/view.ctp

<?php echo $this->fetch('content'); ?>
<h1><?php echo $this->fetch('title'); ?></h1>
<div class="actions">
    <h3>Related actions</h3>
    <ul>
        <?php echo $this->fetch('testingsidebar'); ?>
    </ul>
</div>