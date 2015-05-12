<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Posts;
use yii\web\UploadedFile;
use app\models\UploadForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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

       $this->layout='//mainS';
        return $this->render('index');

    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
	
	public function actionAddContent() 
	{

$model = new AddContent;
if ($model->load(Yii::$app->request->post()) && $model->validate()) 
{ // valid data received in $model            
// do something meaningful here about $model ...            
return $this->render('entry-confirm', ['model' => $model]);        
} 
else 
{ 
// either the page is initially displayed or there is some validation error 
return $this->render('entry', ['model' => $model]);        
}
		$this->layout='//mainS';
		return $this->render('addcontent');
		
	}


public function actionAdd()
    { 
        $model = new Posts();
       $this->layout='//adminka';
       
        if ($model->load(Yii::$app->request->post())) 
        {
        $form = Yii::$app->request->post('Posts');
       
        $model->saved($form['text']);
        }

               $query = Posts::find();
              // var_dump($query);
              
               $listpost = $query->orderBy('dateadd')->all();
              
               return  $this->render('add',['model'=>$model,'listpost' => $listpost]);
         

    }


 public function actionUpload()
    {
        $model = new UploadForm();
         $this->layout='//adminka';

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstances($model, 'file');
            
            if ($model->file && $model->validate()) {

              

                foreach ($model->file as $file) {

                        $form = Yii::$app->request->post('UploadForm');
                        $filename=$file->baseName . '.' . $file->extension;
                        $pathfile='uploads/' . $file->baseName . '.' . $file->extension;
                        $model->onlysave($form['subject'],$form['destription'],$filename,$pathfile);

                    $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
                }
            }
        }
         
        $data=$model->GetData();
        //var_dump($data);
          //   die();            
        return $this->render('upload', ['model' => $model,'data'=>$data]);
    }



public function actionShedule() 
{
$this->layout='//mainS';
return $this->render('showshedule');

}
	
}
