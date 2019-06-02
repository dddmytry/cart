<?php

namespace app\modules\admin\controllers\product;

use app\store\Forms\Product\PhotosForm;
use app\store\Forms\Product\ProductCreateForm;
use app\store\Forms\Product\ProductEditForm;
use app\store\Services\Product\ProductManageService;
use app\store\Entities\Product\Product;
use app\modules\admin\forms\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
	private $service;

	public function __construct(
		$id,
		$module,
		ProductManageService $service,
		$config = []
	)
	{
		parent::__construct($id, $module, $config);
		$this->service = $service;
	}

	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'draft' => ['POST'],
                    'activate' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
    	$product = $this->findModel($id);
		$photosForm = new PhotosForm();

		if ($photosForm->load(\Yii::$app->request->post()) && $photosForm->validate()){
			try{
				$this->service->addPhotos($product->id, $photosForm);
				return $this->redirect(['view', 'id' => $product->id, '#' => 'photos']);
			} catch (\DomainException $e) {
				\Yii::$app->errorHandler->logException($e);
				\Yii::$app->session->setFlash('error', $e->getMessage());
			}
		}
        return $this->render('view', [
            'product' => $product,
	        'photosForm' => $photosForm,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new ProductCreateForm();

        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
        	try{
        		$product = $this->service->create($form);
        		\Yii::$app->session->setFlash('success', 'Товар успешно создан.');
		        return $this->redirect(['view', 'id' => $product->id]);
	        } catch (\DomainException $e) {
		        \Yii::$app->errorHandler->logException($e);
		        \Yii::$app->session->setFlash('error', $e->getMessage());
	        }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $product = $this->findModel($id);
        $form = new ProductEditForm($product);

        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
        	try{
        		$this->service->edit($product->id, $form);
        		\Yii::$app->session->setFlash('success', 'Товар успешно отредактирован.');
		        return $this->redirect(['view', 'id' => $product->id]);
	        } catch (\DomainException $e) {
		        \Yii::$app->errorHandler->logException($e);
		        \Yii::$app->session->setFlash('error', $e->getMessage());
	        }
        }
        return $this->render('update', [
            'model' => $form,
	        'product' => $product,
        ]);
    }

    public function actionMovePhotoUp($id, $photoId)
    {
    	$this->service->movePhotoUp($id, $photoId);
    	return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    public function actionMovePhotoDown($id, $photoId)
    {
    	$this->service->movePhotoDown($id, $photoId);
	    return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    public function actionRemovePhoto($id, $photoId)
    {
    	$this->service->removePhoto($id, $photoId);
	    return $this->redirect(['view', 'id' => $id, '#' => 'photos']);
    }

    public function actionDraft($id)
    {
    	$this->service->draft($id);
    	return $this->redirect(['view', 'id' => $id]);
    }

    public function actionActivate($id)
    {
    	$this->service->activate($id);
	    return $this->redirect(['view', 'id' => $id]);
    }

	/**
	 * Deletes an existing Product model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
    public function actionDelete($id)
    {
    	try{
		    $this->service->remove($id);
	    } catch (\DomainException $e) {
		    \Yii::$app->errorHandler->logException($e);
		    \Yii::$app->session->setFlash('error', $e->getMessage());
	    }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
