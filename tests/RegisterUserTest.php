<?php 

use VanillaPHP\Helpers\Validator;

class RegisterUserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testNameContainsCorrectCharacters()
    {
        $name = "name123@";
        $check = Validator::check_name($name);
        $this->assertEquals($check, 0);
        
    }

    public function testEmailValidatesCorrectly()
    {
        $email = "test@example";
        $check = Validator::check_email($email);
        $this->assertEquals($check, 0);
        
    }
}
