<?php

namespace Tests\Unit\Validators;

use Tests\TestCase;
use App\Validators\RequestValidator;

class RequestValidatorTest extends TestCase
{
	public function test_validate_userLacksPlateNumber_returnsFalse()
	{
		$request = [
			'current_color' => 'red',
			'target_color'	=> 'blue'
		];

		$validator = new RequestValidator;

		$this->assertFalse($validator->validate($request));
	}

	public function test_validate_userLacksCurrentColor_returnsFalse()
	{
		$request = [
			'plate_no'	=> 'abc 123',
			'target_color'	=> 'blue'
		];

		$validator = new RequestValidator;

		$this->assertFalse($validator->validate($request));
	}

	public function test_validate_userLacksTargetColor_returnsFalse()
	{
		$request = [
			'plate_no'	=> 'abc 123',
			'current_color' => 'red'
		];

		$validator = new RequestValidator;

		$this->assertFalse($validator->validate($request));
	}

	public function test_validate_userHasCompleteInput_returnsTrue()
	{
		$request = [
			'plate_no'	=> 'abc 123',
			'current_color' => 'red',
			'target_color'	=> 'blue'
		];

		$validator = new RequestValidator;

		$this->assertTrue($validator->validate($request));
	}

	/**
	* @dataProvider invalidColorProvider
	*/
	public function test_isValidColor_colorIsInvalid_returnsFalse($color)
	{
		$validator = new RequestValidator;

		$this->assertFalse($validator->isValidColor($color));
	}

	/**
	* @dataProvider validColorProvider
	*/
	public function test_isValidColor_colorIsValid_returnsTrue($color)
	{
		$validator = new RequestValidator;

		$this->assertTrue($validator->isValidColor($color));
	}

	public function invalidColorProvider()
	{
		return [['orange'], ['yellow'], ['asdfjahfksdf']];
	}

	public function validColorProvider()
	{
		return [['red'], ['blue'], ['green'], ['Red'], ['blUe']];
	}
}