<?php
require_once dirname(__FILE__) . "/src/config/conf.php";
session_start();


$request = $_SERVER['REQUEST_URI'];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
      switch($request){
            case $request == ROUTE_PATH ."index" :
                  require __DIR__ . '/app/Http/Controllers/LpController.php';
                  $controller = new LpController();
                  $controller->index();
                  break;
            case $request == ROUTE_PATH ."group/create" :
                  require __DIR__ . '/app/Http/Controllers/GroupController.php';
                  $controller = new GroupController();
                  $controller->create();
                  break;
            case $request == ROUTE_PATH ."lp/create" :
                  require __DIR__ . '/app/Http/Controllers/LpController.php';
                  $controller = new LpController();
                  $controller->create();
                  break;
            case $request == ROUTE_PATH ."lp/edit" :
                  require __DIR__ . '/app/Http/Controllers/LpController.php';
                  $controller = new LpController();
                  $controller->edit();
                  break;
            case $request == ROUTE_PATH ."lp/delete" :
                  require __DIR__ . '/app/Http/Controllers/LpController.php';
                  $controller = new LpController();
                  $controller->delete();
                  break;
            case $request == ROUTE_PATH ."group/edit" :
                  require __DIR__ . '/app/Http/Controllers/GroupController.php';
                  $controller = new GroupController();
                  $controller->edit();
            
         
      }
  } else if($_SERVER['REQUEST_METHOD'] === 'GET'){
      switch (true) {
          
            case $request == ROUTE_PATH ."index" :
                  require __DIR__ . '/app/Http/Controllers/LpController.php';
                  $controller = new LpController();
                  $controller->index();
                  break;
            case $request == ROUTE_PATH ."error" :
                  require __DIR__ . '/app/Http/Controllers/ErrorController.php';
                  $controller = new ErrorController();
                  $controller->index();
                  break;
      
          
            // case $request == ROUTE_PATH ."screenshot" :
            //       require __DIR__ . '/app/controller/Controller.php';
            //       $controller = new Controller();
            //       $controller->screenshot();
            //       break;
         
      }
  }