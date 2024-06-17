<?php
require_once dirname(__FILE__) . "/src/config/conf.php";
session_start();


$request = $_SERVER['REQUEST_URI'];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
      switch($request){
            case $request == ROUTE_PATH ."index" :
                  require __DIR__ . '/app/Http/Controllers/Controller.php';
                  $controller = new Controller();
                  $controller->index();
                  break;

         
      }
  } else if($_SERVER['REQUEST_METHOD'] === 'GET'){
      switch (true) {
          
            case $request == ROUTE_PATH ."index" :
                  require __DIR__ . '/app/Http/Controllers/Controller.php';
                  $controller = new Controller();
                  $controller->index();
                  break;
          
            // case $request == ROUTE_PATH ."screenshot" :
            //       require __DIR__ . '/app/controller/Controller.php';
            //       $controller = new Controller();
            //       $controller->screenshot();
            //       break;
         
      }
  }