<?php

class Home extends Controller
{
    public function index()
    {
        $model = new Model();

        $arr['name'] = 'Mary';
        $arr['age'] = 100;

        $result = $model->update(2, $arr);
        
       show($result);

        $this->view('home');
    }
}