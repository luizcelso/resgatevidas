<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Contact;
use yii\web\UploadedFile;
use app\models\Animal;
use app\models\Blog;
use yii\data\Pagination;
use dosamigos\google\maps\services\GeocodingClient;
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'adopt', 'create-animal'],
                'rules' => [
                    [
                        'actions' => ['logout', 'adopt', 'create-animal'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $animals = Animal::find()->where(['status_id' => '1'])->orderBy('id DESC')->limit(3)->all();
        //die(var_dump($animals));
        return $this->render('index', [
                'animals' => $animals
            ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionViewAnimal($id)
    {
    return $this->render('view_animal', [
    'model' => $this->findAnimal($id),
    ]);
    }

    public function actionAdopt($id)
    {
        $model = new Contact();
        $model->ip_address_from = Yii::$app->request->userIP;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->save(false);
            Yii::$app->session->setFlash('adoptFormSubmitted');

            return $this->refresh();
        }
        return $this->render('adopt', [
        'animal' => $this->findAnimal($id),
        'model' => $model
        ]);
    }

    public function actionAnimals()
    {
        $query = Animal::find()->where(['status_id' => '1'])->orderBy('id DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('animals', [
             'models' => $models,
             'pages' => $pages,
        ]);
    }

    public function actionBlog()
    {
        $query = Blog::find()->orderBy('id DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('blog', [
             'models' => $models,
             'pages' => $pages,
            
        ]);
    }

    public function actionAdoption()
    {
        $query = Animal::find()->where(['status_id' => '2']);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('adoption', [
             'models' => $models,
             'pages' => $pages,
        ]);
    }

    protected function findAnimal($id)
    {
    if (($model = Animal::findOne($id)) !== null) {
    return $model;
    } else {
    throw new HttpException(404, 'The requested page does not exist.');
    }
    }

    public function actionCreateAnimal()
    {
        //todo setar user e status
        $model = new Animal;
        $model->status_id = '3'; 
        $model->username_id = Yii::$app->user->id;
        try {
    if ($model->load($_POST)) {
        if (isset($_FILES) && strlen($_FILES['Animal']['name']['photo']) > 0) {
                 $model->upload();
                 $model->photo = $_FILES['Animal']['name']['photo'];
            }
        if ($model->save()){
            //return $this->redirect(Url::previous());
            Yii::$app->session->setFlash('animalFormSubmitted');

            return $this->refresh();
        }

    } elseif (!\Yii::$app->request->isPost) {
    $model->load($_GET);
    }
    } catch (\Exception $e) {
    $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
    $model->addError('_exception', $msg);
    }
    return $this->render('create_animal', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {

        $model = new Contact();
        $model->ip_address_from = Yii::$app->request->userIP;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->save(false);
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionGmapsList($q = null, $id = null)
    {
        //die(var_dump($q, $id));
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    //$out = ['results' => ['id' => '', 'text' => '']];
    $out = array();
    if (!is_null($q)) {
        $geo_coding_client = new GeocodingClient();

        $geo_coding_client = $geo_coding_client->lookup([
        'address' => $q,
        'region' => 'br'
        ]);
        //$data = $command->queryAll();
        $i =1;
        foreach ($geo_coding_client['results'] as $key => $value) {
            //$out['results'][] = $value['formatted_address'][$value['formatted_address']];
            //die(var_dump($key['formatted_address'], $value['formatted_address']));
            //$out['results'][$i]['id'] = $i;//$value['formatted_address'][$value['formatted_address']];
            $out['results'][$i]['id'] = $value['geometry']['location']['lat'] . ';' . $value['geometry']['location']['lng'] . ';' . $value['formatted_address'];//$value['formatted_address'][$value['formatted_address']];
            $out['results'][$i]['text'] = $value['formatted_address'];//$value['formatted_address'][$value['formatted_address']];
            $i++;
        }
        //$out['results'] = array_values($geo_coding_client['results']);
        $out['results'] = array_values($out['results']);
        //die(var_dump($out));
    }
    elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => City::find($id)->name];
    }
    return $out;
    }
}
