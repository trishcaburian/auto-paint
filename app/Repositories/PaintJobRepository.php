<?php
namespace App\Repositories;

use DB;

class PaintJobRepository
{
	public function insertCar($car_data)
	{
		DB::table('cars')
			->insert($car_data);

		return true;
	}

	public function countActiveJobs()
	{
		return DB::table('cars')
			->select('job_id')
			->where('status', '=', 'ongoing')
			->count();
	}

	public function getActiveJobs()
	{
		return DB::table('cars')
			->select('*')
			->where('status', '=', 'ongoing')
			->get();
	}

	public function getQueuedJobs()
	{
		return DB::table('cars')
			->select('*')
			->where('status', '=', 'queued')
			->get();
	}

	public function getTotalCompletedCars()
	{
		return DB::table('cars')
			->select('*')
			->where('status', '=', 'completed')
			->count();
	}

	public function getTotalCarColor($color)
	{
		return DB::table('cars')
			->select('*')
			->where('status', '=', 'completed')
			->where('target_color', '=', $color)
			->count();
	}

	public function completeJob($plate_number)
	{
		$this->updateJob($plate_number, 'completed');
	}

	public function startNextJob()
	{
		$next_job = DB::table('cars')
			->select('job_id', 'plate_no')
			->where('status', '=', 'queued')
			->orderBy('job_id', 'asc')
			->first();
		
		if (!empty($next_job)) {
			$this->updateJob($next_job->plate_no, 'ongoing');
		}
	}

	public function updateJob($plate_number, $to_status)
	{
		DB::table('cars')
			->where('plate_no', '=', $plate_number)
			->update(['status' => $to_status]);
	}
}