<?php

namespace c006\widget\banner\controllers;

use c006\alerts\Alerts;
use c006\core\assets\CoreHelper;
use c006\widget\banner\assets\AppAssets;
use c006\widget\banner\assets\AppHelpers;
use c006\widget\banner\models\search\WidgetBannerItems as WidgetBannerItemsSearch;
use c006\widget\banner\models\WidgetBannerFiles;
use c006\widget\banner\models\WidgetBannerItems;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ItemsController implements the CRUD actions for WidgetBannerItems model.
 */
class ItemsController extends Controller
{

    function init()
    {
        //$this->layout = '@c006/widget/banner/views/layouts/main';
        if (CoreHelper::checkLogin() && CoreHelper::isGuest()) {
            return $this->redirect('/user');
        }
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all WidgetBannerItems models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WidgetBannerItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WidgetBannerItems model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new WidgetBannerItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        parent::init();
        AppAssets::register($this->getView());

        $model = new WidgetBannerItems();

        if ($model->load(Yii::$app->request->post())) {

            $model->date_start = AppHelpers::dateToTime($model->date_start, 'DD-MM-YYYY') + AppHelpers::hoursToSeconds($model->date_start_hour);
            $model->date_end = AppHelpers::dateToTime($model->date_end, 'DD-MM-YYYY') + AppHelpers::hoursToSeconds($model->date_start_hour);
            $model->save();

            return $this->redirect(['index', 'id' => $model->id]);
        } else {

            $m = WidgetBannerFiles::find()->asArray()->all();
            if (!sizeof($m)) {
                Alerts::setMessage('<p> </p>No images found, please <a href="/?r=/banners/files/index">upload images</a> first<p> </p>');
                Alerts::setAlertType(Alerts::ALERT_DANGER);
                Alerts::setCountdown(30);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing WidgetBannerItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->date_start = AppHelpers::dateToTime($model->date_start, 'MM/DD/YYYY') + AppHelpers::hoursToSeconds($model->date_start_hour);
            $model->date_end = AppHelpers::dateToTime($model->date_end, 'MM/DD/YYYY') + AppHelpers::hoursToSeconds($model->date_start_hour);
            $model->save();

            return $this->redirect(['index', 'id' => $model->id]);
        } else {

            $model->date_start = date('m/d/Y', (($model->date_start) ? $model->date_start : time()));
            $model->date_end = date('m/d/Y', (($model->date_end) ? $model->date_end : (time() + 86000 * 7)));

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WidgetBannerItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WidgetBannerItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return WidgetBannerItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WidgetBannerItems::findOne($id)) !== NULL) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
