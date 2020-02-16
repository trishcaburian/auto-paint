<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Car;
use App\Validators\JobValidator;
use App\Repositories\PaintJobRepository;

class CarTest extends TestCase
{
	public function test_setUpPaintJob_callsHasOpenSlotForOngoing()
	{
		$request = [
			'test_contents'
		];

		$jv_mock = $this->createMock(JobValidator::class);
		$jv_mock->expects($this->once())
			->method('hasOpenSlotForOngoing')
			->willReturn(true);

		$pj_mock = $this->createMock(PaintJobRepository::class);
		$pj_mock->method('insertCar')
			->willReturn(true);

		$car = new Car($pj_mock, $jv_mock);

		$car->setUpPaintJob($request);
	}

	public function test_setUpPaintJob_callsInsertCar()
	{
		$request = [
			'test_contents'
		];

		$jv_mock = $this->createMock(JobValidator::class);
		$jv_mock->method('hasOpenSlotForOngoing')
			->willReturn(true);

		$pj_mock = $this->createMock(PaintJobRepository::class);
		$pj_mock->expects($this->once())
			->method('insertCar')
			->willReturn(true);

		$car = new Car($pj_mock, $jv_mock);

		$car->setUpPaintJob($request);
	}
}