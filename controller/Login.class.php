<?php

class Login {
    public function form(){
        $formAction = URL.App::$module."/login";
        $backButtonOnClick = "document.location.href='".URL."'";

        $formData = new Dataform(['action'=>$formAction]);
        $formData->add('header',['value'=>'Login Form']);

        $formData->add('input',['name'=>'username','class'=>'form-control','label'=>['value'=>'username']]);
        $formData->add('input',['type'=>'password','name'=>'password','class'=>'form-control','label'=>['value'=>'Password']]);
        $formData->add('button',['type'=>'submit','class'=>'btn btn-primary btn-sm me-md-2','value'=>'Login', 'onclick'=>$backButtonOnClick]);
        $formData->add('button',['type'=>'button','class'=>'btn btn-outline-dark btn-sm','value'=>'Cancel', 'onclick'=>$backButtonOnClick]);
        return $formData->build_form();
    }

    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = R::findOne('users','username = ?',array($username));
        if (isset($user) and $password ==$user->password):
            Session::setValue('logged',true);
            Session::setValue('admin',false);
            if($username == 'admin'):
                Session::setValue('admin',true);
            endif;
        else:
            return 'Username/Password invalid! <br>'.$this->form();
        endif;
        header ('Location: '.URL);
                
    }

    public function logout(){
        Session::setValue('logged',false);
        Session::setValue('admin',false);
        header('Location: '.URL);
    }
}
