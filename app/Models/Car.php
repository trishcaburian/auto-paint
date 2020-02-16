<?php
namespace App\Models;

use App\Repositories\PaintJobRepository;
use App\Validators\JobValidator;

class Car 
{
	private $paintjob_repo;
	private $job_validator;

	public function __construct(
		PaintJobRepository $paintjob_repo,
		JobValidator $job_validator
	) {
		$this->paintjob_repo = $paintjob_repo;
		$this->job_validator = $job_validator;
	}

	public function getPaintJobList()
	{

		$active = $this->paintjob_repo->getActiveJobs();
		$queued = $this->paintjob_repo->getQueuedJobs();

		return [
			'active' => $this->paintjob_repo->getActiveJobs()->toArray(),
			'queued' => $this->paintjob_repo->getQueuedJobs()->toArray()
		];
	}

	public function getJobStats()
	{
		$stats = [
			'total_cars' => $this->paintjob_repo->getTotalCompletedCars(),
			'blue_cars' => $this->paintjob_repo->getTotalCarColor('Blue'),
			'red_cars'	=> $this->paintjob_repo->getTotalCarColor('Red'),
			'green_cars' => $this->paintjob_repo->getTotalCarColor('Green'),
		];

		return $stats;
	}

	public function setUpPaintJob(Array $request)
	{
		unset($request['_token']);

		$request['plate_no'] = strtoupper($request['plate_no']);

		if ($this->job_validator->hasOpenSlotForOngoing()) {
			$request['status'] = 'ongoing';
		} else {
			$request['status'] = 'queued';
		}

		$this->paintjob_repo->insertCar($request);

		return true;
	}

	public function finishPaintJob($plate_number)
	{
		$this->paintjob_repo->completeJob($plate_number);
		$this->paintjob_repo->startNextJob();
	}
}