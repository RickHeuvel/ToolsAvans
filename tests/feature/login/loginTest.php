<?php
class SeleniumTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('firefox');
	$this->setBrowserUrl('http://localhost:8000');
    }

    public function testPass()
    {
        $this->url('http://localhost:8000');
	sleep(10);
    }
}
?>
