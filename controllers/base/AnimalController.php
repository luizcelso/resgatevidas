<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\controllers\base;

use app\models\Animal;
    use app\models\search\Animal as AnimalSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;
use yii\web\UploadedFile;
use Yii;
/**
* AnimalController implements the CRUD actions for Animal model.
*/
class AnimalController extends Controller
{
/**
* @var boolean whether to enable CSRF validation for the actions in this controller.
* CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
*/
public $enableCsrfValidation = false;

    /**
    * @inheritdoc
    */
    public function behaviors()
    {
    return [
    // 'access' => [
    // 'class' => AccessControl::className(),
    // 'rules' => [
    // [
    // 'allow' => true,
    // 'matchCallback' => function ($rule, $action) {return \Yii::$app->user->can($this->module->id . '_' . $this->id . '_' . $action->id, ['route' => true]);},
    // ]
    // ]
    // ]
    'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
    ];
    }

/**
* Lists all Animal models.
* @return mixed
*/
public function actionIndex()
{
    if (Yii::$app->user->identity->role_id == 1) {
    $searchModel  = new AnimalSearch;
    $dataProvider = $searchModel->search($_GET);

Tabs::clearLocalStorage();

Url::remember();
\Yii::$app->session['__crudReturnUrl'] = null;

return $this->render('index', [
'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
]);
} else {
            throw new \yii\web\ForbiddenHttpException('Credenciais insuficientes.');
        }
}

/**
* Displays a single Animal model.
* @param integer $id
*
* @return mixed
*/
public function actionView($id)
{
    if (Yii::$app->user->identity->role_id == 1) {
\Yii::$app->session['__crudReturnUrl'] = Url::previous();
Url::remember();
Tabs::rememberActiveState();

return $this->render('view', [
'model' => $this->findModel($id),
]);
} else {
            throw new \yii\web\ForbiddenHttpException('Credenciais insuficientes.');
        }
}

/**
* Creates a new Animal model.
* If creation is successful, the browser will be redirected to the 'view' page.
* @return mixed
*/
public function actionCreate()
{
    if (Yii::$app->user->identity->role_id == 1) {
$model = new Animal;

try {
if ($model->load($_POST)) {
    if (isset($_FILES) && strlen($_FILES['Animal']['name']['photo']) > 0) {
             $model->upload();
             $model->photo = $_FILES['Animal']['name']['photo'];
        }
    if ($model->save()){
        return $this->redirect(Url::previous());
    }

} elseif (!\Yii::$app->request->isPost) {
$model->load($_GET);
}
} catch (\Exception $e) {
$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
$model->addError('_exception', $msg);
}
return $this->render('create', ['model' => $model]);
} else {
            throw new \yii\web\ForbiddenHttpException('Credenciais insuficientes.');
        }
}

/**
* Updates an existing Animal model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param integer $id
* @return mixed
*/
public function actionUpdate($id)
{
    if (Yii::$app->user->identity->role_id == 1) {
$model = $this->findModel($id);

if ($model->load($_POST)) {
    if (isset($_FILES) && strlen($_FILES['Animal']['name']['photo']) > 0) {
        //die(var_dump($model->photo, $_FILES));
             $model->upload();
             $model->photo = $_FILES['Animal']['name']['photo'];
        } else {
            $model_ = $this->findModel($id);
            $model->photo = $model_->photo;
            //die(var_dump($model->photo));
        }

        if ($model->save()) {
        return $this->redirect(Url::previous());
}
}
 else {
return $this->render('update', [
'model' => $model,
]);
}
} else {
            throw new \yii\web\ForbiddenHttpException('Credenciais insuficientes.');
        }
}

/**
* Deletes an existing Animal model.
* If deletion is successful, the browser will be redirected to the 'index' page.
* @param integer $id
* @return mixed
*/
public function actionDelete($id)
{
    if (Yii::$app->user->identity->role_id == 1) {
try {
$this->findModel($id)->delete();
} catch (\Exception $e) {
$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
\Yii::$app->getSession()->addFlash('error', $msg);
return $this->redirect(Url::previous());
}

// TODO: improve detection
$isPivot = strstr('$id',',');
if ($isPivot == true) {
return $this->redirect(Url::previous());
} elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
Url::remember(null);
$url = \Yii::$app->session['__crudReturnUrl'];
\Yii::$app->session['__crudReturnUrl'] = null;

return $this->redirect($url);
} else {
return $this->redirect(['index']);
}
} else {
            throw new \yii\web\ForbiddenHttpException('Credenciais insuficientes.');
        }
}

/**
* Finds the Animal model based on its primary key value.
* If the model is not found, a 404 HTTP exception will be thrown.
* @param integer $id
* @return Animal the loaded model
* @throws HttpException if the model cannot be found
*/
protected function findModel($id)
{
if (($model = Animal::findOne($id)) !== null) {
return $model;
} else {
throw new HttpException(404, 'The requested page does not exist.');
}
}
}