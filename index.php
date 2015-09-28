<?php
// set up Composer autoloader
//require __DIR__ . '/lib/vendor/autoload.php';
//require '/lib/vendor/autoload.php';
require '/home/vcap/app/lib/vendor/autoload.php';

// initialize application
$app = new Bullet\App();
$app->path('v1', function($request) use ($app) {

  $app->path('products', function($request) use ($app) {
    // GET /v1/products
    // list all products
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
    
});

echo $app->run(new Bullet\Request());
