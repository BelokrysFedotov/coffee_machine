<?php

$app['debug'] = true;


// Twig
$app['twig.path'] = array(__DIR__ . '/../templates');
//$app['twig.options'] = array('cache' => __DIR__ . '/../tmp/cache/twig');
$app['twig.options'] = array('cache' => '/tmp/cache/twig');


$app['defaultCoffeeMachine'] =
	[
		'coffeeMachine' => [
			'balance' => 0,
			'storage' => [
				'items' => [
					[
						'id'    => 'product_1',
						'name'  => 'Чай',
						'count' => 10,
						'price' => 13
					],
					[
						'id'    => 'product_2',
						'name'  => 'Кофе',
						'count' => 20,
						'price' => 18
					],
					[
						'id'    => 'product_3',
						'name'  => 'Кофе с молоком',
						'count' => 20,
						'price' => 21
					],
					[
						'id'    => 'product_4',
						'name'  => 'Сок',
						'count' => 15,
						'price' => 35
					]
				]
			],
			'cashBox' => [
				'items' => [
					[
						'value' => 1,
						'count' => 100
					],
					[
						'value' => 2,
						'count' => 100
					],
					[
						'value' => 5,
						'count' => 100
					],
					[
						'value' => 10,
						'count' => 100
					]
				]
			],

		],
		'user'          => [
			'cashBox' => [
				'items' => [
					[
						'value' => 1,
						'count' => 100
					],
					[
						'value' => 2,
						'count' => 100
					],
					[
						'value' => 5,
						'count' => 100
					],
					[
						'value' => 10,
						'count' => 100
					]
				]
			]
		]
	];
