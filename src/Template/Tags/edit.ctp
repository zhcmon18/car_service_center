<?php
$loguser = $this->request->session()->read('Auth.User')
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag $tag
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    <li class="heading"><?= __('Navigation') ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Cars'), ['controller' => 'Cars', 'action' => 'index']) ?> </li>
         <li><?= $this->Html->link(__('List Bookings'), ['controller' => 'Bookings', 'action' => 'index']) ?> </li>         
         
         <?php if($loguser['role'] === 'admin') : ?>
            <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
         <?php endif?>

        <li><?= $this->Html->link(__('List Photos'), ['controller' => 'Photos', 'action' => 'index']) ?></li>
        
        <?php 
            if($loguser['status'] == 1) : ?>
                <li class="heading"><?= __('Actions') ?></li>
                <li><?= $this->Html->link(__('New Tag'), ['action' => 'add']) ?></li>
         <?php 
            endif
        ?>
        <?php 
            if($loguser['role'] === 'admin') : ?>
                <li><?= $this->Form->postLink(__('Delete Tag'), ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete the tag #{0}?', $tag->id)]) ?> </li>
         <?php 
            endif
        ?>

    </ul>
</nav>
<div class="tags form large-9 medium-8 columns content">
    <?= $this->Form->create($tag) ?>
    <fieldset>
        <legend><?= __('Edit Tag') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('bookings._ids', ['options' => $bookings]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
