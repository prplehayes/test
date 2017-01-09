
<div class="orders view large-9 medium-8 content custom_design">
    <h3><?= h($order->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $order->has('user') ? $this->Html->link($order->user->id, ['controller' => 'Users', 'action' => 'view', $order->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($order->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Total') ?></th>
            <td><?= $this->Number->format($order->total) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($order->created) ?></td>
        </tr>
    </table>
    <div class="row1">
        <h4><?= __('Payment Status') ?></h4>
        <?= $this->Text->autoParagraph(h($order->payment_status)); ?>
    </div>
    <div class="row1">
        <h4><?= __('Notes') ?></h4>
        <?= $this->Text->autoParagraph(h($order->notes)); ?>
    </div>
</div>
