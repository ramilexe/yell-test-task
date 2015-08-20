<?php

namespace yelltest\model;


/**
 * Класс "Круг"
 *
 * @property int $radius
 *
 * @package yelltest\model
 */
class Circle extends Shape
{
    public function __construct()
    {
        $this->requiredParams = array(
            'radius',
        );
    }

    public function draw()
    {
        //Тут немного математики
        //....
        //Координаты
        $points = array(
            array(1, 0),
            //.....
            array(0, 1),
            //....
        );

        return $points;
    }
}