<?php

class Mars_Clock_test extends TestCase
{
	public function setUp(): void {	}

	public function test_get_correct_mars_date(){
		$data = json_encode([
			'earth_date' => '22-05-2020 04:17:13'
		]);

		$this->request->setHeader('Content-type', 'application/json');

		$output = $this->request('POST', 'api/mars_time/mars_date', $data);

		$this->assertResponseCode(200);
		$this->assertStringContainsStringIgnoringCase('52039.057712218', $output);
	}

	public function test_get_correct_mars_time(){
		$data = json_encode([
			'earth_date' => '22-05-2020 04:17:13'
		]);

		$this->request->setHeader('Content-type', 'application/json');

		$output = $this->request('POST', 'api/mars_time/mars_time', $data);

		$this->assertResponseCode(200);
		$this->assertStringContainsStringIgnoringCase('01:23:06', $output);
	}

	public function test_get_mars_date_invalid_format(){
		$data = json_encode([
			'earth_date' => '04:17:13'
		]);

		$this->request->setHeader('Content-type', 'application/json');

		$this->request('POST', 'api/mars_time/mars_date', $data);

		$this->assertResponseCode(400);
	}

	public function test_get_mars_time_invalid_format(){
		$data = json_encode([
			'earth_date' => '04:17:13'
		]);

		$this->request->setHeader('Content-type', 'application/json');

		$this->request('POST', 'api/mars_time/mars_time', $data);

		$this->assertResponseCode(400);
	}
}
