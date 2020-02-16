<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validators\RequestValidator;
use App\Models\Car;

class PageController extends Controller
{
	private $request_validator;
	private $car_model;

    public function __construct(
    	RequestValidator $request_validator,
    	Car $car_model
    ) {
    	$this->request_validator = $request_validator;
    	$this->car_model = $car_model;
    }

    public function processJob(Request $request)
    {
    	$request_array = $request->all();

    	if ($this->request_validator->validate($request_array)) {

    		$this->car_model->setUpPaintJob($request_array);
    		
    		$all_jobs = $this->car_model->getPaintJobList();

    		$job_stats = $this->car_model->getJobStats();

            return view('paint-jobs', array_merge($all_jobs, $job_stats));
    	}

    	echo 'FAILED!';
    	return redirect('new-paint-job');
    }

    public function paintJobs()
    {
        $all_jobs = $this->car_model->getPaintJobList();

        $job_stats = $this->car_model->getJobStats();

        return view('paint-jobs', array_merge($all_jobs, $job_stats));
    }


    public function markJobFinished($plate_number)
    {
        $this->car_model->finishPaintJob($plate_number);

        return redirect('paint-queue');
    }
}
