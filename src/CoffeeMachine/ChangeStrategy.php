<?php

namespace CoffeeMachine;

/**
 * Class ChangeStrategy
 * Стратегия выбора монет для сдачи с целью минимизировать кол-во монет
 *
 * @package CoffeeMachine
 */
class ChangeStrategy implements ChangeStrategyInterface {

	/**
	 * Выдача сдачи $balance из кассы $cashBox
	 *
	 * @param int $balance
	 * @param CashBoxInterface $cashBox
	 *
	 * @return array|CashBoxItemInterface[]
	 * @throws CoffeeMachineException
	 */
	public function getChange(int $balance, CashBoxInterface $cashBox) {

		if ($balance < 0) {
			throw new CoffeeMachineException('Отрицательный баланс');
		}

		if ($balance == 0) {
			return [];
		}

		$coins   = $cashBox->values();

		foreach ($coins as $key => $value) {
			$coins[$key] = [
				'id'    => $key,
				'value' => $value
			];
		}

		usort($coins, function ($a, $b) {
			return $b['value'] <=> $a['value'];
		});

		/** @var CashBoxItemInterface[] $change */
		$change = [];

		foreach ($coins as $coin) {
			try {
				while ($balance >= $coin['value']) {
					$tmpCoin = $cashBox->getOne($coin['id']);
					if (array_key_exists( $tmpCoin->id(), $change)) {
						$change[$tmpCoin->id()]->push($tmpCoin->count());
					} else {
						$change[$tmpCoin->id()] = $tmpCoin;
					}
					$balance -= $tmpCoin->value();
				}
			} catch (\Exception $exception) {
				// Не получилось снять очередную монету, переходим к следующей
			}
			if($balance <= 0) {
				break;
			}
		}

		return $change;

	}

}