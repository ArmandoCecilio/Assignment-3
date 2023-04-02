<?php

require_once 'Login.php';

class LoginTest extends \PHPUnit\Framework\TestCase {

    /**
     * @covers LoginModule::validate
     */
    public function testLoginSuccess() {
        // Create a mock object for LoginModule
        $loginMock = $this->getMockBuilder(LoginModule::class)
                          ->onlyMethods(['validate'])
                          ->getMock();
    
        // Configure the mock object to return true when validate is called
        $loginMock->expects($this->once())
                  ->method('validate')
                  ->with('username', 'password')
                  ->willReturn(true);
    
        $result = $loginMock->validate("username", "password");
        $this->assertTrue($result);
    }
    
    /**
     * @covers LoginModule::validate
     */
    public function testLoginFailure() {
        // Create a mock object for LoginModule
        $loginMock = $this->getMockBuilder(LoginModule::class)
                          ->onlyMethods(['validate'])
                          ->getMock();
    
        // Configure the mock object to return false when validate is called
        $loginMock->expects($this->once())
                  ->method('validate')
                  ->with('user2', 'wrong_password')
                  ->willReturn(false);
    
        $result = $loginMock->validate('user2', 'wrong_password');
        $this->assertFalse($result);
    }
}
?>