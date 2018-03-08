<?php

namespace app\admin\controllers;

use Yii;
use app\common\models\Owner;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;

/**
 * OwnerController implements the CRUD actions for Owner model.
 */
class OwnerController extends Controller
{
    /**
     * @inheritdoc
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
        	[
        		'class' => \app\common\components\PrivilegeCheck::className(),
        	]
        ];
    }

    /**
     * Lists all Owner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Owner::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Owner model.
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
     * Creates a new Owner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Owner();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {        	
        	\Yii::$app->db->transaction(function() use($model) {
        		$role = new \app\common\models\Role();
        		$role->role_name = 'managers';
        		$role->role_owner = $model->owner_id;
        		$role->save();
        		
        		$privileges = \app\common\models\Privilege::find()->where(['privilege_role'=>2])->all();
        		
        		$privilegesNew = [];
        		foreach( $privileges as $privilege ){
        			$privilegesNew[] = [$privilege->privilege_action, $role->role_id];
        		}
        		\Yii::$app->db->createCommand()->batchInsert(\app\common\models\Privilege::tableName(),
        				['privilege_action', 'privilege_role'], $privilegesNew)->execute();
        		
        		$operator = new \app\common\models\Operator();
        		$operator->operator_name = 'manager'.$model->owner_id;
        		$operator->operator_pswd = md5('123456');
        		$operator->save();
        		
        		$roleAttach = new \app\common\models\RoleAttach();
        		$roleAttach->role_attach_operator = $operator->operator_id;
        		$roleAttach->role_attach_role = $role->role_id;
        		$roleAttach->save();
        	});
            return $this->redirect(['view', 'id' => $model->owner_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Owner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->owner_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Owner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	\Yii::$app->db->transaction(function() use($id) {
    		$this->findModel($id)->delete();    		
    		$roles = ArrayHelper::getColumn(\app\common\models\Role::find()->where(['role_owner'=>$id])->all(), 'role_id');    		
    		\app\common\models\Privilege::deleteAll(['in', 'privilege_role', $roles]);    		
    		\app\common\models\RoleAttach::deleteAll(['in', 'role_attach_role', $roles]);    		
    		\app\common\models\Role::deleteAll(['in', 'role_id', $roles]);    		
    	});

        return $this->redirect(['index']);
    }

    /**
     * Finds the Owner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Owner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Owner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
