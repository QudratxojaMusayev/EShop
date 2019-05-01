<?php use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price for one</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($session['cart'] as $id => $item) : ?>
            <tr>
                <td><?= $item['name']; ?></td>
                <td><?= $item['qty']; ?></td>
                <td>$<?= $item['price']; ?></td>
                <td>$<?= $item['sum']; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3">Total number:</td>
            <td colspan="3"><?= $session['cart.qty']; ?> </td>
        </tr>
        <tr>
            <td colspan="3">Total price:</td>
            <td colspan="3">$<?= $session['cart.sum']; ?> </td>
        </tr>
        </tbody>
    </table>
</div>