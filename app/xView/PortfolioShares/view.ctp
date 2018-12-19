<div class="portfolioShares view">
<h2><?php echo __('Portfolio Share'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Portfolio'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioShare['Portfolio']['portfolio_name'], array('controller' => 'portfolios', 'action' => 'view', $portfolioShare['Portfolio']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Instrument'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioShare['Instrument']['instrument_code'], array('controller' => 'instruments', 'action' => 'view', $portfolioShare['Instrument']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('No Of Shares'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['no_of_shares']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Buying Price'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['buying_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Buying Date'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['buying_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['is_active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Share Status'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['share_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sell Price'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['sell_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sell Date'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['sell_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Commission'); ?></dt>
		<dd>
			<?php echo h($portfolioShare['PortfolioShare']['commission']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exchange'); ?></dt>
		<dd>
			<?php echo $this->Html->link($portfolioShare['Exchange']['name'], array('controller' => 'exchanges', 'action' => 'view', $portfolioShare['Exchange']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Portfolio Share'), array('action' => 'edit', $portfolioShare['PortfolioShare']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Portfolio Share'), array('action' => 'delete', $portfolioShare['PortfolioShare']['id']), array(), __('Are you sure you want to delete # %s?', $portfolioShare['PortfolioShare']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Portfolio Shares'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio Share'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Portfolios'), array('controller' => 'portfolios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Portfolio'), array('controller' => 'portfolios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Instruments'), array('controller' => 'instruments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instrument'), array('controller' => 'instruments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exchanges'), array('controller' => 'exchanges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exchange'), array('controller' => 'exchanges', 'action' => 'add')); ?> </li>
	</ul>
</div>
