<?php

class ClassLoader {

    public  function handle($class) {

     //   var_dump($class);//die;
        $file = str_replace("\\", '/', $class.'.php');


       // $file = "CheckoutFactory.php";
      //  var_dump($file);//die;
        if(!file_exists($file)){
            throw new \Exception('class '.$class.' file not exists');
        }
        include_once $file;
    }

}

$autloader = new ClassLoader();
spl_autoload_register(array($autloader, 'handle'));