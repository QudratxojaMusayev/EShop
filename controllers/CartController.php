<?php


namespace app\controllers;


use app\models\Cart;
use app\models\OrderItems;
use app\models\Product;
use app\models\Purchase;
use Yii;

class CartController extends AppController
{
    public function actionAdd() {
        $id = Yii::$app->request->get('id');
        $qty = (int) Yii::$app->request->get('qty');

        if (!$qty) {
            $qty = 1;
        }

        $product = Product::findOne($id);

        if (empty($product))
            return false;

        $session = Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->addToCart($product, $qty);

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear() {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelete() {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->deleteItem($id);

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow() {
        $session = Yii::$app->session;
        $session->open();

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView() {
        $session = Yii::$app->session;
        $session->open();

        $this->setMeta('Cart');
        $order = new Purchase();

        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];

            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', "Your order has been confirmed. We'll contact you soon!");
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', "Error in order confirmation!");
                return $this->refresh();
            }
        }
        return $this->render('view', compact('session', 'order'));
    }

    protected function saveOrderItems($items, $order_id) {
        foreach ($items as $id => $item) {
            $ordered_item = new OrderItems();
            $ordered_item->order_id = $order_id;
            $ordered_item->product_id = $id;
            $ordered_item->name = $item['name'];
            $ordered_item->price = $item['price'];
            $ordered_item->qty_item = $item['qty'];
            $ordered_item->sum_item = $item['sum'];
            $ordered_item->save();
        }
    }
}