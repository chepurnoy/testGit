<?php

class SearchFrom extends CFormModel
{

    public $title;

    public function rules()
    {
        return array(
            array('title', 'required'),
            array('title','length', 'max' => 100),

        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'title' => 'Title',
        );
    }

}

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

