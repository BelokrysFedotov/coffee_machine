<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));
/** @var $app \Silex\Application */

$app->get('/', function () use ($app) {
	try {
		$repository  = new \CoffeeMachine\Repository($app['defaultCoffeeMachine'] ?: []);
		$application = \CoffeeMachine\Factory::getApplication($repository->load());
		$data        = $application->getState();
	} catch (\Exception $exception) {
		//
		$data = [];
	}
	return $app['twig']->render('index.html.twig', ['data' => $data]);
})
->bind('homepage');

$app->get('/test', function () use ($app) {
	return new JsonResponse("Ok");
});

$app->post('/reset/', function () use ($app) {

	$jsonResponse = new JsonResponse();
	try {
		$repository  = new \CoffeeMachine\Repository($app['defaultCoffeeMachine'] ?: []);
		$application = \CoffeeMachine\Factory::getApplication($app['defaultCoffeeMachine'] ?: []);

		$jsonResponse->setData($application->getState());
		$repository->save($application->save());
	} catch (\Exception $exception) {
		$jsonResponse->setData(['error' => $exception->getMessage()]);
	}

	return $jsonResponse;
});

$app->post('/take/{id}', function ($id) use ($app) {

	$jsonResponse = new JsonResponse();
	try {
		$repository  = new \CoffeeMachine\Repository($app['defaultCoffeeMachine'] ?: []);
		$application = \CoffeeMachine\Factory::getApplication($repository->load());

		$application->take($id);

		$jsonResponse->setData($application->getState());
		$repository->save($application->save());
	} catch (\Exception $exception) {
		$jsonResponse->setData(['error' => $exception->getMessage()]);
	}

	return $jsonResponse;
});

$app->post('/buy/{id}', function ($id) use ($app) {

	$jsonResponse = new JsonResponse();
	try {
		$repository  = new \CoffeeMachine\Repository($app['defaultCoffeeMachine'] ?: []);
		$application = \CoffeeMachine\Factory::getApplication($repository->load());

		$application->buy($id);

		$jsonResponse->setData($application->getState());
		$repository->save($application->save());
	} catch (\Exception $exception) {
		$jsonResponse->setData(['error' => $exception->getMessage()]);
	}

	return $jsonResponse;
});

$app->post('/get_change/', function () use ($app) {

	$jsonResponse = new JsonResponse();
	try {
		$repository  = new \CoffeeMachine\Repository($app['defaultCoffeeMachine'] ?: []);
		$application = \CoffeeMachine\Factory::getApplication($repository->load());

		$application->getChange();

		$jsonResponse->setData($application->getState());
		$repository->save($application->save());
	} catch (\Exception $exception) {
		$jsonResponse->setData(['error' => $exception->getMessage()]);
	}

	return $jsonResponse;
});

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
