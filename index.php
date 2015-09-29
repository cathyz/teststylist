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
    $app->path('loginfacebook', function($request) use ($app) {
    $app->post(function() use ($app)  {
      //$products = Product::all();
    	$fb = new Facebook\Facebook([
  'app_id' => '302834359830725',
  'app_secret' => 'f21f8fe905aa6ce0a0dac45e65c06064',
  'default_graph_version' => 'v2.2',
  ]);

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name,first_name,last_name,email,picture{url}', 'CAAETbR5xiMUBAP02KCOHgDOXEfLgpim2uv0Ko66KZCPRQJKsHiOS0P6tZC4m9BP6oS0MgrRuk1A2LiVZCX9ZAEM14KjJdoq9SbCZBR8sl6iqO2Evv2f0ycmDpRZA8zxZCiPhtA7tCHQYu5swSSdQZCZA7DU608JjGjfHJBCH74fDQ5UwnCLZBprTzmJypLsZBJnyhJ5iZA7TZAqXDGQZDZD');
   
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();
$picobj= $user['picture'];
$picobjurl=$picobj['url'];


    	$data = array(
            'status' => array(
                'code' => '1000',
                 'message' => 'User logged out'
                ),
            'user' => array(
            	'id'=> '123abc456',
            	'type' => 'client',
            	'first_name'=>$user['first_name'],
            	'last_name'=>$user['last_name'],
            	'email'=>$user['email'],
            	'phone_number'=>'555-123-1234',
            	'profile_image'=>$picobjurl
            	),
            'user_public_key'=>'72ae5e57d318f4005808855ca5101e5073bb26ca'
            
        );
      return $data;
    });
  });
 $app->path('login', function($request) use ($app) {
    $app->post(function() use ($app)  {
      //$products = Product::all();
    	$data = array(
            'status' => array(
                'code' => '1000',
                 'message' => 'User logged out'
                ),
            'user' => array(
            	'id'=> '123abc456',
            	'type' => 'client',
            	'first_name'=>'Sarah',
            	'last_name'=>'Levin',
            	'email'=>'sarah.levin@google.com',
            	'phone_number'=>'729-302-1023',
            	'profile_image'=>'http://find-my-host.com/profile/123456'
            	),
            'user_public_key'=>'72ae5e57d318f4005808855ca5101e5073bb26ca'
            
        );
      return $data;
    }); //end post
  }); //end path logout
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
