<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=restaurant';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig');
    });

    $app->get("/cuisines", function() use ($app) {
        return $app['twig']->render('cuisines.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->post("/cuisines", function() use ($app) {
        $cuisine_name = $_POST['cuisine_name'];
        $new_cuisine = new Cuisine($cuisine_name);
        $new_cuisine->save();
        return $app['twig']->render('cuisines.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->patch("/cuisines/{id}", function($id) use ($app) {
        $new_cuisine_name = $_POST['new_cuisine_name'];
        $cuisine = Cuisine::find($id);
        $cuisine->update($new_cuisine_name);
        return $app['twig']->render('cuisines.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->delete("/cuisines/{id}", function($id) use ($app){
        $cuisine = Cuisine::find($id);
        $cuisine->delete();
        return $app['twig']->render('cuisines.html.twig', array('cuisines' => Cuisine::getAll()));
    });

    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisines.html.twig', array('cuisine' => $cuisine));
    });

    $app->get("/restaurants", function() use ($app){
        return $app['twig']->render('restaurants.html.twig');
    });

    return $app;
?>
