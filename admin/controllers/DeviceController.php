<?php

namespace app\admin\controllers;

use Yii;
use app\common\models\Device;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * DeviceController implements the CRUD actions for Device model.
 */
class DeviceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
    	\Yii::trace('get behaviors', __METHOD__);
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        	[
        		'class' => \app\common\components\PrivilegeCheck::className(),
        	]
        ];
    }

    /**
     * Lists all Device models.
     * @return mixed
     */
    public function actionIndex($search='')
    {
    	$query = Device::find();
    	
    	if( $search ){
    		$query = $query->where(['like', 'device_imei', $search])
    			->orWhere(['like', 'device_phone', $search])
    			->orWhere(['like', 'device_name', $search]);
    	}
    	
    	$user = \Yii::$app->user->getIdentity();
    	
    	$roles = ArrayHelper::getColumn($user->attach, 'role_attach_role');
    	$owners = ArrayHelper::getColumn(\app\common\models\Role::find()->where(['in', 'role_id', $roles])->all(), 'role_owner');
    	
    	if( !in_array(1, $roles) ){
    		$query = $query->andWhere(['in', 'device_owner', $owners]);
    	}
    	
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        	'search' => $search,
        ]);
    }

    /**
     * Displays a single Device model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Device model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Device();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->device_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Device model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->device_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Device model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Device model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Device the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Device::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionImport()
    {
    	$model = new \app\common\models\DeviceImport();
	if(Yii::$app->request->isPost) {
    		if( $model->load(Yii::$app->request->post(), '') ){
    			$objExcel = \PHPExcel_IOFactory::load($model->filename);
    			$fields = [];
			$cols = [];
    			foreach( $model->columns as $key=>$val){
    				if( $val != '0' ){
    					$fields[] = $val;
    					$cols[] = $key;
    				}
    			}
    			$start = $model->header ? 2 : 1;
    			$worksheet = $objExcel->getActiveSheet();
    			$data = [];
    			$rows = $worksheet->getHighestRow();
    			for( $row = $start; $row <= $rows; $row++){
    				$record = [];
    				foreach($cols as $col){
    					$record[] = (string)$worksheet->getCellByColumnAndRow($col, $row)->getValue();
    				}
    				$data[] = $record;
    			}
    			\Yii::$app->db->createCommand()->batchInsert(\app\common\models\Device::tableName(),
    					$fields, $data)->execute();
    		}
    		return $this->redirect(['index']);
    	}
    	return $this->render('import', ['model'=>new \app\common\models\DeviceImportCheck()]);
    }
    
    public function actionImportCheck($filename='', $header='')
    {
    	$model = new \app\common\models\DeviceImportCheck();
    	if(Yii::$app->request->isPost) {
    		$model->file = \yii\web\UploadedFile::getInstance($model, 'file');
    		
    		if ($model->file && $model->validate()) {
    			$filename = 'uploads/' . $model->file->baseName . '.' . $model->file->extension;
    			$model->file->saveAs($filename);
    			$objExcel = \PHPExcel_IOFactory::load($filename);
    			return $this->render('import-check', ['model'=>$model, 'excel'=>$objExcel, 'filename'=>$filename, 'header'=>$header]);
    		}
    	};
    	if( $filename ){
    		$objExcel = \PHPExcel_IOFactory::load($filename);
    		return $this->render('import-check', ['model'=>$model, 'excel'=>$objExcel, 'filename'=>$filename, 'header'=>$header]);
    	}
    	return $this->redirect('import');
    }
    
    public function actionOutport()
    {
    	return $this->render(['outport']);
    }
    
    public function actionControl($id)
    {
    	$model = $this->findModel($id);
    	
    	return $this->render('control', ['model'=>$model]);
    }
}
