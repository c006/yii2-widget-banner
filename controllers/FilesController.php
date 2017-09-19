<?php

namespace c006\widget\banner\controllers;

use c006\alerts\Alerts;
use c006\core\assets\CoreHelper;
use c006\widget\banner\assets\ImageHelper;
use c006\widget\banner\models\search\WidgetBannerFiles as WidgetBannerFilesSearch;
use c006\widget\banner\models\WidgetBannerFiles;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * FilesController implements the CRUD actions for WidgetBannerFiles model.
 */
class FilesController extends Controller
{

    function init()
    {
        //$this->layout = '@c006/widget/banner/views/layouts/main';
        if (CoreHelper::isGuest()) {
            return $this->redirect('/user');
        }
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all WidgetBannerFiles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WidgetBannerFilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WidgetBannerFiles model.
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
     * Creates a new WidgetBannerFiles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WidgetBannerFiles();
        if (isset($_POST['WidgetBannerFiles'])) {
            $image = new ImageHelper();
            $tmp_file = $_FILES['WidgetBannerFiles']['tmp_name']['file'];
            $file = $_FILES['WidgetBannerFiles']['name']['file'];

            if (!$tmp_file) {
                Alerts::setMessage('File too large -- Increase upload size or reduce image size');
                Alerts::setAlertType(Alerts::ALERT_DANGER);
                Alerts::setCountdown(8);
            } else {
                $suffix = ImageHelper::getFileExtension($file);
                $model->name = $_POST['WidgetBannerFiles']['name'];
                $model->file = preg_replace('/[\s|\.]+/', '-', microtime(FALSE)) . '.' . $suffix;
                $image->saveImage($model->file, $tmp_file);
                $size = getimagesize($image->base_path . '/' . $model->file);
                $model->width = $size[0];
                $model->height = $size[1];
                if ($model->validate() && $model->save()) {
                    Alerts::setMessage('Updated Successfully');
                    Alerts::setAlertType(Alerts::ALERT_SUCCESS);
                    Alerts::setCountdown(4);
                } else {
                    Alerts::setMessage('Error, please try again');
                    Alerts::setAlertType(Alerts::ALERT_DANGER);
                    Alerts::setCountdown(8);
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing WidgetBannerFiles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (isset($_POST['WidgetBannerFiles'])) {
//            print_r($_FILES);
//            exit;
            if (isset($_FILES['WidgetBannerFiles']['name']['file'])) {
                if ($model->file != $_FILES['WidgetBannerFiles']['name']['file']) {
                    $image = new ImageHelper();
                    $file = $_FILES['WidgetBannerFiles']['name']['file'];
                    $tmp_file = $_FILES['WidgetBannerFiles']['tmp_name']['file'];
                    $suffix = ImageHelper::getFileExtension($file);
                    $model->file = preg_replace('/[\s|\.]+/', '-', microtime(FALSE)) . '.' . $suffix;
                    $image->saveImage($model->file, $tmp_file);
                    $size = getimagesize($image->base_path . '/' . $model->file);
                    $model->width = $size[0];
                    $model->height = $size[1];
                }
            }
            $model->name = $_POST['WidgetBannerFiles']['name'];

            if ($model->validate() && $model->save()) {
                Alerts::setMessage('Updated Successfully');
                Alerts::setAlertType(Alerts::ALERT_SUCCESS);
                Alerts::setCountdown(4);
            } else {
                Alerts::setMessage('Error, please try again');
                Alerts::setAlertType(Alerts::ALERT_DANGER);
                Alerts::setCountdown(8);
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing WidgetBannerFiles model.
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
     * Finds the WidgetBannerFiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return WidgetBannerFiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WidgetBannerFiles::findOne($id)) !== NULL) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
