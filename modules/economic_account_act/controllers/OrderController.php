<?php

namespace app\modules\economic_account_act\controllers;

use Yii;
use app\modules\economic_account_act\models\Order;
use app\modules\economic_account_act\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex($account_id)
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'account_id' => $account_id
        ]);
    }


    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
   
			$searchModel = new OrderSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		
			 return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'account_id' => $model->account_id
        ]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

  

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

		  $model = $this->findModel($id);

           $searchModel = new OrderSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		
			 return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'account_id' => $model->account_id
        ]);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
