<?php
/**
 * Part of ci-phpunit-test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */
// use \Mockery;

class Welcome_test extends TestCase
{

	public function setUp() {

		$this->resetInstance();
		$this->CI->load->model('users');
		$this->users = $this->CI->users;
	}

	public function test_index()
	{
		$output = $this->request('GET', 'welcome/index');
		$this->assertContains('<title>Welcome to CodeIgniter</title>', $output);
	}

	// public function test_method_404()
	// {
	// 	$this->request('GET', 'welcome/method_not_exist');
	// 	$this->assertResponseCode(404);
	// }

	// public function test_APPPATH()
	// {
	// 	$actual = realpath(APPPATH);
	// 	$expected = realpath(__DIR__ . '/../..');
	// 	$this->assertEquals(
	// 		$expected,
	// 		$actual,
	// 		'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
	// 	);
	// }

	// public function test_mock() {
	// 	$service = Mockery::mock('service');
 //        $service->shouldReceive('readTemp')
 //            ->times(3)
 //            ->andReturn(10, 12, 14);

 //        $this->assertEquals(10, $service->readTemp(12, 123, 23), "Failed");
 //        $this->assertEquals(12, $service->readTemp(), "Failed");
 //        $this->assertEquals(15, $service->readTemp(), "Failed");
	// }

	public function test_getEncryptedEmail() {

		$result_array = [
            [
                    "encrypted_email" => "News test",
                    "text" => "News text",
            ],
            [
                    "encrypted_email" => "News2",
                    "text" => "Testo news2",
            ],
	    ];
	    $db_result=$this->getMockBuilder('CI_DB_result')->disableOriginalConstructor()->getMock();
	    $db_result->method('result_array')->willReturn($result_array);

	    $db = $this->getMockBuilder('CI_DB')->disableOriginalConstructor()->getMock();
	    $db->expects($this->once())->method('query')->willReturn($db_result);
	    $this->users->db=$db;
	    echo $this->users->getEncryptedEmail('samdhani@sureify.com');exit();
	    

	}


}
