<?php
namespace Tests\Unit\Validators;

use Tests\TestCase;
use App\Validators\JobValidator;
use App\Repositories\PaintJobRepository;

class JobValidatorTest extends TestCase
{
	public function test_hasOpenSlotForOngoing_usesPaintJobRepository()
	{
		$pj_repo_mock = $this->createMock(PaintJobRepository::class);
		$pj_repo_mock->expects($this->once())
			->method('countActiveJobs')
			->willReturn(4);

		$validator = new JobValidator($pj_repo_mock);

		$validator->hasOpenSlotForOngoing();
	}

	/**
	* @dataProvider belowFiveProvider
	*/
	public function test_hasOpenSlotForOngoing_hasLessThanFiveOngoing_returnsTrue($below_five)
	{
		$pj_repo_stub = $this->createMock(PaintJobRepository::class);
		$pj_repo_stub->method('countActiveJobs')
			->willReturn($below_five);

		$validator = new JobValidator($pj_repo_stub);

		$this->assertTrue($validator->hasOpenSlotForOngoing());
	}

	public function test_hasOpenSlotForOngoing_hasFiveOngoing_returnsFalse()
	{
		$pj_repo_stub = $this->createMock(PaintJobRepository::class);
		$pj_repo_stub->method('countActiveJobs')
			->willReturn(5);

		$validator = new JobValidator($pj_repo_stub);

		$this->assertFalse($validator->hasOpenSlotForOngoing());
	}

	public function belowFiveProvider()
	{
		return [[1], [2], [3], [4]];
	}
}