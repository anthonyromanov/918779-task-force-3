<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;

use app\models\Task;
use app\models\Category;
use app\models\City;
use app\models\TaskFilterForm;
use app\models\Response;

use yii\db\Expression;
use yii\web\NotFoundHttpException;

class TasksController extends Controller {

    const STATUS_NEW = 'new';

    public function actionIndex() {

        $filter = new TaskFilterForm();

        if (Yii::$app->request->post()) {
            $filter->load(Yii::$app->request->post());
        }

        $task = Task::find()
        ->where(['status' => self::STATUS_NEW])
        ->joinWith(['category', 'city'])
        ->andWhere(['category_id' => $filter->categories]);

        if ($filter->remoteWork == 1) {
        $task->andWhere(['city_id' => null]);
        }

        if ($filter->noResponse == 1) {
        $task->andWhere(['status' => null]);
        }

        settype($filter->period, 'integer');
        if ($filter->period > 0) {
            $expression = new Expression("DATE_SUB(NOW(), INTERVAL {$filter->period} HOUR)");
            $task->andWhere(['>', 'creation', $expression]);
        }

        $task->orderBy(['creation' => SORT_DESC]);
        $tasks = $task->all();

        $response = Response::find()->all();
        $categories = Category::find()->all();

        return $this->render('index', [
            'tasks' => $tasks,
            'model' => $filter,
            'categories' => $categories,
            'period_values' => TaskFilterForm::PERIOD_VALUES
        ]);
    }

    public function actionView ($id) {

        $task = Task::findOne($id);
        if (!$task) {
            throw new NotFoundHttpException("Задача с ID $id не найдена");
        }

        $task->runtime = $task->runtime ? Yii::$app->formatter->asDatetime($task->runtime) : 'Срок не определен';

        $responses = Response::find()
            ->where(['task_id' => $id])
            ->all();

        return $this->render('view', [
            'task' => $task,
            'responses' => $responses,
            ]);
   }

}
