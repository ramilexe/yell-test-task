<?php

namespace yelltest\model;

/**
 * Класс "Квадрат"
 *
 * @property int $size
 *
 * @package yelltest\model
 */
class Square extends Shape
{
    public function __construct()
    {
        $this->requiredParams = array(
            'size',
        );
    }

    public function draw()
    {
        $points = array(
            array(0, 0),
            array(5, 0),
            array(5, 5),
            array(0, 5),
        );

        return $points;
    }
}