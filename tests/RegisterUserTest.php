<?php 

use VanillaPHP\Repositories\User;
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

    public function testAddUserWorks(){
        $first_name = "test";
        $last_name = "user";
        $email = "test.user@example.com";
        $password = "pass";
        // User::add($first_name, $last_name, $email, $password);
        // $this->tester->seeInDatabase('users', [
        //     'first_name' => $first_name, 
        //     'last_name' => $last_name,
        //     'email' => $email,
        //     'pass' => $password,
        //     'is_active' => 'yes',
        //     'role' => 2
        //     ]);
        // $this->tester->amConnectedToDatabase('pet_project');
    }
}
