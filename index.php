<?php
// set up Composer autoloader
//require __DIR__ . '/lib/vendor/autoload.php';
//require '/lib/vendor/autoload.php';
require '/home/vcap/app/lib/vendor/autoload.php';

// initialize application
$app = new Bullet\App();
$app->path('v1', function($request) use ($app) {

  $app->path('user', function($request) use ($app) {
    // GET /v1/products
    $app->path('login', function($request) use ($app) {
    $app->get(function() use ($app)  {
      //$products = Product::all();
    	$data = array(
            '_links' => array(
                'restaurants' => array(
                    'title' => 'Restaurants',
                    'href' => 'some link'
                ),
                'events' => array(
                    'title' => 'Events',
                    'href' => 'some other link'
                )
            )
        );
      return $data;
    });
  });
 
  $app->path('logout', function($request) use ($app) {
    $app->post(function() use ($app)  {
      //$products = Product::all();
    	$data = array(
            'status' => array(
                'code' => '1000',
                 'message' => 'User logged out'
                )
            
        );
      return $data;
    }); //end post
  }); //end path logout
 }); //end path user
}); //end path v1

echo $app->run(new Bullet\Request());
