<?php


namespace app\controllers;


use app\models\Product;
use Yii;

class ProductController extends AppController
{
    public function actionView($id) {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        $hits = Product::find()->where(['hit' => '1'])->limit(3)->all();
//        $product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one();
        $this->setMeta("E-Shopper | " . $product->name, $product->keywords, $product->description);
        return $this->render('view', compact('product', 'hits'));
    }
}