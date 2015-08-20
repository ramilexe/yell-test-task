<?php

namespace yelltest\controller;

use yelltest\core\Application;
use yelltest\core\Controller;
use yelltest\exception\AppException;
use yelltest\model\Shape;
use yelltest\model\Writer;

class ShapeController extends Controller
{
    public function actionDraw()
    {
        //Массив с фигурами
        $shapes = $this->request->getQuery('shapes');
        if (!$shapes) {
            throw new AppException('Не указаны фигуры');
        }

        //Формат вывода, например JSON, XML
        $outputFormat = $this->request->getQuery('output');
        if (!$outputFormat) {
            throw new AppException('Не указан формат');
        }

        /** @var Writer $outputModel */
        $outputModel = $this->loadModel($outputFormat, true);

        $result = array();

        foreach ($shapes as $shape) {
            if (!isset($shape['type']) || !isset($shape['params'])) {
                throw new AppException('Неправильные входные данные');
            }

            //Тип фигуры
            $type = $shape['type'];
            //Параметры фигуры
            $params = $shape['params'];

            //Загружаем модель фигуры
            /** @var Shape $shapeModel */
            $shapeModel = $this->loadModel($type);
            $shapeModel->setParams($params);

            $result[] = $shapeModel->draw();
        }

        $outputModel->setResponse($this->response);
        $outputData = $outputModel->process($result);

        $this->renderData($outputData);
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * Загружает модель
     *
     * @param string $modelName
     * @param bool $isOutputModel
     * @return mixed
     * @throws AppException
     */
    private function loadModel($modelName, $isOutputModel = false)
    {
        $modelClassName = Application::MODEL_PREFIX . ucfirst($modelName) . ($isOutputModel ? 'Writer' : '');
        if (!class_exists($modelClassName)) {
            throw new AppException('Класс ' . $modelName . ' не найден');
        }

        return new $modelClassName;
    }
}