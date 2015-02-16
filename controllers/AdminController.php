<?php

/*
 * This file is part of the chd7well project.
 *
 * (c) chd7well project <http://github.com/chd7well/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace chd7well\configmanager\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use chd7well\configmanager\models\ParameterSearch;
use chd7well\configmanager\models\Parameter;

/**
 * AdminController allows you to administrate users.
 *
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */


class AdminController extends Controller
{
	
	/**
	 * Lists all Parameters.
	 * @return mixed
	 */
	public function actionIndex() {
		$test = new Parameter();
		print_r($test);
		$searchModel = new ParameterSearch ();
		$dataProvider = $searchModel->search ( \Yii::$app->request->queryParams );
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	
	
	/**
	 * Updates an existing Parameter.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 * 
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel( $id );
		if ($model->load ( \Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [ 
					'index',
					//'id' => $model->id 
			] );
		} else {
			return $this->render ( 'update', [ 
					'model' => $model 
			] );
		}
	}
	
	/**
	 * Deletes an existing Parameter model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param  integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
			$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}
	

	/**
	 * Creates a new Parameter model.
	 * If creation is successful, the browser will be redirected to the 'index' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$parameter = new Parameter();
	
		$this->performAjaxValidation($parameter);
	
		if ($parameter->load(\Yii::$app->request->post()) && $parameter->save()) {
			\Yii::$app->getSession()->setFlash('success', \Yii::t('configmanager', 'Parameter has been created'));
			return $this->redirect(['index']);
		}
	
		return $this->render('create', [
				'parameter' => $parameter
		]);
	}
	
	
	/**
	 * Finds the Parameter model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Config the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Parameter::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	
	/**
	 * Performs AJAX validation.
	 * @param array|Model $models
	 * @throws \yii\base\ExitException
	 */
	protected function performAjaxValidation($models)
	{
		if (\Yii::$app->request->isAjax) {
			if (is_array($models)) {
				$result = [];
				foreach ($models as $model) {
					if ($model->load(\Yii::$app->request->post())) {
						\Yii::$app->response->format = Response::FORMAT_JSON;
						$result = array_merge($result, ActiveForm::validate($model));
					}
				}
				echo json_encode($result);
				\Yii::$app->end();
			} else {
				if ($models->load(\Yii::$app->request->post())) {
					\Yii::$app->response->format = Response::FORMAT_JSON;
					echo json_encode(ActiveForm::validate($models));
					\Yii::$app->end();
				}
			}
		}
	}
	
    
}
