<?php
defined("BASEPATH") OR exit("No direct script access allowed");

use chriskacerguis\RestServer\RestController;

class Mars_Clock_Controller extends RestController
{
	public function __construct(){
		parent::__construct();
		$this->load->helper('mars_clock_calculation');
	}

	public function get_mars_date(){
		$earth_date = $this->post('date') ?? NULL;

		if($earth_date === NULL){
			return $this->response(
				[
					'success' => FALSE,
					'message' => 'Missing date parameter'
				],
				422,
				TRUE
			);
		}

		$date_in_millis = calculate_date_in_milliseconds($earth_date);

		if($date_in_millis === -1){
			return $this->response(
				[
					'success' => FALSE,
					'message' => 'Invalid date format. Expected date format d-m-Y H:i:s'
				],
				REST_Controller::HTTP_BAD_REQUEST ,
				TRUE
			);
		}

		$mars_date = calculate_mars_date($date_in_millis);

		return $this->response(
			[
				'success' => TRUE,
				'mars_date' => $mars_date
			],
			REST_Controller::HTTP_OK,
			TRUE
		);
	}

	public function get_mars_time(){
		$earth_date = $this->post('date') ?? NULL;

		if($earth_date === NULL){
			return $this->response(
				[
					'success' => FALSE,
					'message' => 'Missing date parameter'
				],
				422,
				TRUE
			);
		}

		$date_in_millis = calculate_date_in_milliseconds($earth_date);

		if($date_in_millis === -1){
			return $this->response(
				[
					'success' => FALSE,
					'message' => 'Invalid date format. Expected date format d-m-Y H:i:s'
				],
				REST_Controller::HTTP_BAD_REQUEST ,
				TRUE
			);
		}

		$mars_time = calculate_mars_time($date_in_millis);

		return $this->response(
			[
				'success' => TRUE,
				'mars_time' => $mars_time
			],
			REST_Controller::HTTP_OK,
			TRUE
		);
	}
}
