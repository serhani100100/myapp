<?php

class User {
    public function show() {
        if (Session::getValue('logged')):
            if (Session::getValue('admin')):
                Html::setPage ('user-show-admin.html');
            else:    
                Html::setPage ('user-show.html');
            endif;
       Html::setFilter(array('username'));
        Html::setSelect("SELECT * FROM users");
        return Html::generate();
        else:
            header('Location:'.URL);
        endif;
    }

    public function create() {
        return $this->form();
    }

    public function read() {
        return $this->form();

    }
    public function update() {
        return $this->form();

    }
    public function delete() {
        return $this->form();
    }

    public function form() {
        $user = R::load('users',App::$key);
        $back = URL.App::$module."/show";
        $readonly = true;
        if(App::$action=='create' or App::$action=='update'){
            $action = URL.App::$module."/save/".App::$key;
            $readonly = false;
        }
        if (App::$action == 'delete') {
            $action = URL.App::$module."/remove/".App::$key;
        }
        $form = new Dataform(array('action'=>$action));
        $form->add('header',array('value'=>App::$action));
        $form->add('input',array('name'=>'username','value'=>$user->username,'class'=>'form-control','readonly'=>$readonly,'label'=>array('value'=>'Username')));
        $form->add('input',array('name'=>'password','value'=>$user->password,'class'=>'form-control','readonly'=>$readonly,'label'=>array('value'=>'password')));

        $back = "document.location.href='".$back."'";
        $form->add('button',array('type'=>'submit','class'=>'btn btn-primary btn-sm me-md-2','value'=>App::$action,'onclick'=>$back));
        $form->add('button',array('type'=>'button','class'=>'btn btn-outline-dark btn-sm','value'=>'Cancel','onclick'=>$back));
        $html = $form->build_form();
        return $html;

    }
}