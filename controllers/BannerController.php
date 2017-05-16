<?php

namespace thyseus\banner\controllers;

use Yii;
use thyseus\banner\models\Banner;
use thyseus\banner\models\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\GoneHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['admin', 'create', 'update', 'delete', 'view'],
                        'roles' => Yii::$app->getModule('banner')->allowedRoles,
                    ],
                    [
                        'allow' => true,
                        'actions' => ['visit'],
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Administrate all Banners.
     * @return mixed
     */
    public function actionAdmin()
    {
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * View detailed banner information
     * @param $id slug of the banner of which to display detailed information
     */
    public function actionView($id)
    {
        $banner = $this->findModel($id);

        return $this->render('view', [
            'banner' => $banner,
        ]);
    }

    /**
     * Counts the banner visit and redirects to the given banner url.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException when the banner can not be found in the database
     * @throws GoneHttpException when the banner is not active anymore (current date outside of valid_from and valid_until)
     */
    public function actionVisit($id)
    {
        $banner = $this->findModel($id);

        if (!$banner->isActive()) {
            throw new GoneHttpException(Yii::t('banner', 'The requested banner is not active anymore.'));
        }

        $banner->updateCounters(['visit_count' => 1]);

        return $this->redirect($banner->url);
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'admin' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();

        $model->active = true;
        $model->visit_count = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['admin']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['admin']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::find()->where(['slug' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested banner does not exist.');
        }
    }
}
