<?php

namespace app\admin\controllers;

use Yii;
use app\common\models\Operator;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * OperatorController implements the CRUD actions for Operator model.
 */
class OperatorController extends Controller
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
     * Lists all Operator models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$query = Operator::find();
    	
    	if( $search ){
    	}
    	
    	$user = \Yii::$app->user->getIdentity();
    	
    	$roles = ArrayHelper::getColumn($user->attach, 'role_attach_role');
    	
    	if( !in_array(1, $roles) ){
    		$query = $query->joinWith(['attach'])->andWhere(['in', 'role_attach_role', $roles]);
    	}
    	
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    	]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Operator model.
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
     * Creates a new Operator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Operator();
        
        $post = Yii::$app->request->post();
        if( $post ){
        	$post['Operator']['operator_pswd'] = md5($post['Operator']['operator_pswd']);
        }

        if ($model->load($post) && $model->save()) {
        	\Yii::$app->db->transaction(function() use($post, $model) {
        		$roles = $post['Operator']['attach'];
        		$attachNew = [];
        		foreach( $roles as $role ){
        			$attachNew[] = [$model->operator_id, $role];
        		}
        		\Yii::$app->db->createCommand()->batchInsert(\app\common\models\RoleAttach::tableName(),
        				['role_attach_operator', 'role_attach_role'], $attachNew)->execute();
        	});
            return $this->redirect(['view', 'id' => $model->operator_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Operator model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$model = $this->findModel($id);
    	
    	$post = Yii::$app->request->post();
    	if( $post ){
    		if( $post['Operator']['operator_pswd'] != '******' ){
    			$post['Operator']['operator_pswd'] = md5($post['Operator']['operator_pswd']);
    		}
    		else{
    			$post['Operator']['operator_pswd'] = $model->operator_pswd;
    		}
    	}

        if ($model->load($post) && $model->save()) {
        	
        	\Yii::$app->db->transaction(function() use($post, $id) {
        		$roles = $post['Operator']['attach'];
        		$rolesNew = [];
        		\app\common\models\RoleAttach::deleteAll(['and', ['not in', role_attach_role, $roles], ['role_attach_operator'=>$id]]);
        		$attach = \app\common\models\RoleAttach::find()->where(['role_attach_operator'=>$id])->all();
        		$rolesOld = \yii\helpers\ArrayHelper::getColumn($attach, 'role_attach_role');
        		foreach( $roles as $role ){
        			if( !in_array($role, $rolesOld)){
        				$rolesNew[] = [$id, $role];
        			}
        		}
        		\Yii::$app->db->createCommand()->batchInsert(\app\common\models\RoleAttach::tableName(), 
        				['role_attach_operator', 'role_attach_role'], $rolesNew)->execute();
        	});   	
            return $this->redirect(['view', 'id' => $model->operator_id]);
        } else {
        	$model->operator_pswd = '******';
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Operator model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$this->findModel($id)->delete();
    	\app\common\models\RoleAttach::deleteAll(['role_attach_operator'=>$id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Operator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Operator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Operator::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
