<?php

namespace Bvanharen\LicensePlate\Tests;

class TestLicense extends \PHPUnit\Framework\TestCase
{


    /**
     * Test that true does in fact equal true
     */
    public function testTrueIsTrue()
    {
		$licenseNumber = 'XN-901-V';
		$licensePlate = new \Bvanharen\LicensePlate\LicensePlate();
		$licensePlate->set(str_replace('-','',$licenseNumber));
		$result = $licensePlate->get();
		if($result == $licenseNumber){
			$this->assertTrue(true);	
		}else{
	 		$this->fail('Wrong result');       
	    }
	}
}
