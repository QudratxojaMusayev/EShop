<?php use yii\helpers\Html;
use yii\helpers\Url;

if (!empty($session['cart'])) : ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Image</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price for one</th>
                <th>Price</th>
                <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($session['cart'] as $id => $item) : ?>
                <tr>
                    <td><?= Html::img("@web/images/home/{$item['img']}", ['height' => 100]); ?></td>
                    <td><?= $item['name']; ?></td>
                    <td><?= $item['qty']; ?></td>
                    <td>$<?= $item['price']; ?></td>
                    <td>$<?= $item['sum']; ?></td>
                    <th>
                            <span class="glyphicon glyphicon-remove text-danger del-item" data-id="<?= $id; ?>"
                                  aria-hidden="true"></span>
                    </th>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">Total number:</td>
                <td colspan="4"><?= $session['cart.qty']; ?> </td>
            </tr>
            <tr>
                <td colspan="4">Total price:</td>
                <td colspan="4">$<?= $session['cart.sum']; ?> </td>
            </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h3>Cart is empty</h3>
<?php endif; ?>