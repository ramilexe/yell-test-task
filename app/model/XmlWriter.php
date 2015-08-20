<?php

namespace yelltest\model;


class XmlWriter extends Writer
{
    public function process($data)
    {
        $this->response->setHeader('Content-Type', 'text/xml');

        //$xml = new \XMLWriter();
        //$xml->startDocument();
        //.....

        return '<?xml version="1.0" encoding="utf-8"?>
        <shapes>
            <shape type="square" size="5">
                <points>
                    <point x="0" y="0"></point>
                    <point x="5" y="0"></point>
                    <point x="5" y="5"></point>
                    <point x="0" y="5"></point>
                </points>
            </shape>
        </shapes>';
    }
}