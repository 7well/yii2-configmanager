<?php

/*
 * This file is part of the 7well project.
 *
 * (c) 7well project <http://github.com/7well/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace 7well\configmanager\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use 7well\configmanager\models\ConfigSearch;
use 7well\configmanager\models\ConfigParameterSearch;
use 7well\configmanager\models\Config;
use 7well\configmanager\models\Parameter;
use 7well\configmanager\models\ConfigParameter;
use 7well\configmanager\models\ConfigUser;
/**
 * AdminController allows you to administrate users.
 *
 * @author Christian Dumhart <christian.dumhart@chd.at>
 */


class ConfigController extends Controller
{
	
	/**
	 * Lists all Parameters.
	 * @return mixed
	 */
	public function actionIndex() {		
		$searchModel = new ConfigSearch();
		$dataProvider = $searchModel->search ( \Yii::$app->request->queryParams );
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Set User Config-Set
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUser() {
		$userid = \Yii::$app->user->id;
		$model = ConfigUser::findOne(['user_ID' => $userid]);
		if(!isset($model))
		{
			$model = new ConfigUser();
			$model->user_ID = $userid;
			$model->config_ID = null;
		}
		if ($model->load ( \Yii::$app->request->post () ) && $model->save ()) {
			return $this->render ( 'user', [
					'model' => $model
			] );
		} else {
			return $this->render ( 'user', [
					'model' => $model
			] );
		}
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
	 * Updates an existing Parameter.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdateconfigparameter($id) {
		//$model = $this->findModel($id);
		//$model = new ConfigParameter();
		$model = ConfigParameter::findOne(['ID' => $id]);
		if ($model->load ( \Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [
					'details',
					'id' => $model->config_ID
			] );
		} else {
			return $this->render ( 'updateconfigparameter', [
					'model' => $model
			] );
		}
	}
	
	/**
	 * Updates an existing Parameter.
	 * If update is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDetails($id) {
	
		$searchModel = new ConfigParameterSearch();
		$dataProvider = $searchModel->search ( \Yii::$app->request->queryParams, $id );
		return $this->render ( 'configparameter', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'id'=>$id,
		] );
	}
	
	/**
	 * Add new Parameter to existing Config-Set.
	 	 *
	 * @param integer $id
	 * @return mixed
	 */
	public function actionAddconfigparameter($id) {
	
		$configparameter = new ConfigParameter();
		$configparameter->config_ID = $id;
		$this->performAjaxValidation($configparameter);
	
		if ($configparameter->load(\Yii::$app->request->post()) && $configparameter->save()) {
			\Yii::$app->getSession()->setFlash('success', \Yii::t('configmanager', 'Parameter added to Config-Set'));
			return $this->redirect(['details', 'id'=>$id]);
		}
	
		return $this->render('addconfigparameter', [
				'configparameter' => $configparameter
		]);
	}
	
	/**
	 * Deletes an existing Parameter model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param  integer $id
	 * @return mixed
	 */
	public function actionDeleteconfigparameter($id)
	{
		$configparameter = ConfigParameter::findOne(['ID' => $id]);
		$configsetid = $configparameter->config_ID;
		$configparameter->delete();
		return $this->redirect(['details', 'id'=>$configsetid]);
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
		$config = new Config();
	
		$this->performAjaxValidation($config);
	
		if ($config->load(\Yii::$app->request->post()) && $config->save()) {
			\Yii::$app->getSession()->setFlash('success', \Yii::t('configmanager', 'Config-Set has been created'));
			return $this->redirect(['index']);
		}
	
		return $this->render('create', [
				'config' => $config
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
		if (($model = Config::findOne($id)) !== null) {
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
