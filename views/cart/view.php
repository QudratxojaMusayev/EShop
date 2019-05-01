<?php use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="container">

    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <div class="alert alert-success alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                <?= Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')) : ?>
        <div class="alert alert-danger alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($session['cart'])) : ?>

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
                        <td>
                            <a href="<?= Url::to(['product/view', 'id' => $id]) ?>"><?= Html::img("@web/images/home/{$item['img']}", ['height' => 100]); ?></a>
                        </td>
                        <td><a href="<?= Url::to(['product/view', 'id' => $id]) ?>"><?= $item['name']; ?></a></td>
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
                    <td colspan="5">Total number:</td>
                    <td colspan="5"><?= $session['cart.qty']; ?> </td>
                </tr>
                <tr>
                    <td colspan="5">Total price:</td>
                    <td colspan="5">$<?= $session['cart.sum']; ?> </td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <?php $form = ActiveForm::begin() ?>
        <?= $form->field($order, 'name'); ?>
        <?= $form->field($order, 'email'); ?>
        <?= $form->field($order, 'phone'); ?>
        <?= $form->field($order, 'address'); ?>
        <?= Html::submitButton('Order', ['class' => 'btn btn-success']); ?>
        <?php ActiveForm::end() ?>
        <hr>
    <?php else: ?>
        <h3>Cart is empty</h3>
    <?php endif; ?>
</div>