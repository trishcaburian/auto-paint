<?php
namespace App\Validators;

use App\Repositories\PaintJobRepository;

class JobValidator
{
	private $paintjob_repo;

	public function __construct(
		PaintJobRepository $paintjob_repo
	) {
		$this->paintjob_repo = $paintjob_repo;
	}

	public function hasOpenSlotForOngoing()
	{
		$total_ongoing_jobs = $this->paintjob_repo->countActiveJobs();

		if ($total_ongoing_jobs < 5) {
			return true;
		}

		return false;
	}
}