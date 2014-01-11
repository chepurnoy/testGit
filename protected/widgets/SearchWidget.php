<?php

class SearchWidget extends CWidget {
    
    public function run() { 
        $model = new SearchForm;
        $this->render('_searchWidget',array(
            'model' => $model
        ));
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

