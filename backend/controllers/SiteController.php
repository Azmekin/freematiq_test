<?php

namespace backend\controllers;
use backend\models\usrBalance;
use backend\models\sort;
use backend\models\excel;
use frontend\models\transac;
use common\models\LoginForm;
use Yii;
use PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','import','operations','croles','create'],
                        'allow' => true,
                        'roles' => ['admin'],
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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isPost){

            switch (Yii::$app->request->post()['sort']['sort']){
            case 1:
                 $query = usrBalance::find();
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
            
                return $this->render('index', [
                     'models' => $models,
                     'pages' => $pages,
                ]);
                break;
            case 2:
                $query = usrBalance::find()->orderBy('login');
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
            
                return $this->render('index', [
                     'models' => $models,
                     'pages' => $pages,
                ]);
                break;
                case 3:
                    $query = usrBalance::find()->orderBy('sum');
                    $countQuery = clone $query;
                    $pages = new Pagination(['totalCount' => $countQuery->count()]);
                    $models = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();
                
                    return $this->render('index', [
                         'models' => $models,
                         'pages' => $pages,
                    ]);
                    break;
            }

        }



        $query = usrBalance::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
    
        return $this->render('index', [
             'models' => $models,
             'pages' => $pages,
        ]);
  //      return $this->render('index');
    }

    public function actionImport()
    {    $model = new excel();

        if (Yii::$app->request->isPost){
            $model->file = UploadedFile::getInstance($model,'file');
            $model->file->saveAs('uploads/file.'.$model->file->extension);
            $inputFile = 'uploads/file.xls';
/*            try{
                $reader = IOFactory::createReader('Xls');
                $spreadsheet = $reafer->load($inputFile);



            }catch(Exception $e){
                die('Error of understand');
            } */

        }

        return $this->render('import');
    }
    public function actionOperations()
    {
        $query = transac::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
    
        return $this->render('operations', [
             'models' => $models,
             'pages' => $pages,
        ]);

    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionCroles()
    {
/*$role = Yii::$app->authManager->createRole('admin');
$role->description='Dangeon Master';
Yii::$app->authManager->add($role);

$slave = Yii::$app->authManager->createRole('slave');
$slave->description='Only for frontend';
Yii::$app->authManager->add($slave);

return 1;*/

    }
    public function actionCreate()
    {
        if (Yii::$app->request->isPost){
            $user=usrBalance::find()->where(['login'=>Yii::$app->request->post()['transac']['login']])->one();
            $operation=Yii::$app->request->post()['transac']['sum'];
            if (Yii::$app->request->post()['transac']['type']){
            $result = (int)$user->sum - (int)Yii::$app->request->post()['transac']['sum'];
            // I guess, admin account have endless money, so there are no modification admin account. And I can't change language on keyboard at ubuntu, so I write on English.
        }
            else{
            $result = (int)$user->sum + (int)Yii::$app->request->post()['transac']['sum'];
        }


               $user->sum=$result;
                Yii::$app->db->createCommand()->update('balances', ['sum' => $user->sum], 'login = :localLogin')->bindValue(':localLogin',Yii::$app->request->post()['transac']['login'] )->execute();
                Yii::$app->db->createCommand()->insert('operations', [
                    'login' => Yii::$app->request->post()['transac']['login'] ,
                    'final_login'=>Yii::$app->user->identity->username ,
                    'sum' => (int)Yii::$app->request->post()['transac']['sum'],
                    'date'=> date('Y-m-d H:i:s'),
                    'type'=>!Yii::$app->request->post()['transac']['type'],

                ])->execute();
 

              Yii::$app->getResponse()->redirect(Yii::$app->getRequest()->getUrl());
        }
        return $this->render('create');


    }
}
