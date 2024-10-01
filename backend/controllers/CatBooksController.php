<?php

namespace backend\controllers;

use Yii;
use backend\models\CatBooks;
use backend\models\CatBooksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\CatAuthors;
use yii\web\UploadedFile;

/**
 * CatBooksController implements the CRUD actions for CatBooks model.
 */
class CatBooksController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all CatBooks models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CatBooksSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CatBooks model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CatBooks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CatBooks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $authors = Yii::$app->request->post('CatBooks')['authors'];
            if (!empty($authors)) {
                foreach ($authors as $authorId) {
                    $author = CatAuthors::findOne($authorId);
                    if ($author !== null) {
                        $model->link('authors', $author);
                    }
                }
            }
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile !== null) {
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $model->imageFile->extension;
                $model->image = $fileName;
                $model->save();
                $model->imageFile->saveAs(Yii::getAlias('@webroot') . '/uploads/cat-books/' . $fileName);
            }
            Yii::$app->session->setFlash('success', 'Book has been saved.');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionTopAuthors()
    {
        $topAuthors = CatAuthors::find()
            ->select(['cat_authors.name AS author_name', 'cat_books.year AS year', 'COUNT(*) AS books_published'])
            ->joinWith('catBooks')
            ->where(['IS NOT', 'cat_books.year', NULL])
            ->groupBy('cat_authors.id, cat_books.year')
            ->orderBy(['books_published' => SORT_DESC])
            ->limit(10)
            ->asArray()
            ->all();

            return $this->render('top-authors', [
                // 'year' => $year,
                'topAuthors' => $topAuthors,
            ]);
    }

    /**
     * Updates an existing CatBooks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $selectedAuthors = $model->getAuthors()->select('id')->column();
        $currentImage = $model->image;

        if ($model->load(Yii::$app->request->post())) {
            $authors = Yii::$app->request->post('CatBooks')['authors'];
            if (!empty($authors)) {
                $model->unlinkAll('authors', true);
                foreach ($authors as $authorId) {
                    $author = CatAuthors::findOne($authorId);
                    if ($author !== null) {
                        $model->link('authors', $author);
                    }
                }
            } else {
                $model->unlinkAll('authors', true);
            }

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile !== null) {
                if ($currentImage !== null && $currentImage !== '') {
                    unlink(Yii::getAlias('@webroot') . '/uploads/cat-books/' . $currentImage);
                }
                $fileName = Yii::$app->security->generateRandomString(10) . '.' . $model->imageFile->extension;
                $model->image = $fileName;
                $model->save();
                $model->imageFile->saveAs(Yii::getAlias('@webroot') . '/uploads/cat-books/' . $fileName);
                
            } else {
                $model->image = $currentImage;
                $model->save();
            }
            Yii::$app->session->setFlash('success', 'Book has been updated.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'selectedAuthors' => $selectedAuthors,
        ]);
    }

    /**
     * Deletes an existing CatBooks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CatBooks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CatBooks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CatBooks::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
