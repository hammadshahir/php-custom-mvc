<?php

class Signup
{
    use Controller;
    public function index()
    {
       $user = new User();

       if($user->validate($_POST))
       {
           $user->insert($_POST);
           redirect('login');
       }
       
       $data['errors'] = $user->errors;
       
       $this->view('signup', $data);
    }
}