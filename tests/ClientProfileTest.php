<?php

require_once 'ClientProfile.php';

class ClientProfileTest extends \PHPUnit\Framework\TestCase {

    /**
    * @covers ClientProfile::validateProfile
    */
    public function testProfileCompleted() {
        // Call the static method to validate profile fields and complete profile
        $result = ClientProfile::validateProfileFields("John Doe", "123 Main St", "Houston", "TX", "77002");
        $this->assertTrue($result);

        // Call the static method to check if profile is completed
        $profile_completed = ClientProfile::isProfileCompleted();
        $this->assertTrue($profile_completed);
    }

    /**
     * @covers ClientProfile::validateProfile
     */
    public function testProfileIncomplete() {
        // Call the static method to validate profile fields but do not complete profile
        $result = ClientProfile::validateProfileFields("John Doe", "", "Houston", "TX", "77002");
        $this->assertFalse($result);

        // Call the static method to check if profile is completed
        $profile_completed = ClientProfile::isProfileCompleted();
        $this->assertFalse($profile_completed);
    }

    /**
     * @covers ClientProfile::validateProfile
     */
    public function testMissingFields() {
        // Call the static method to validate profile fields with missing fields
        $result = ClientProfile::validateProfileFields("John Doe", "123 Main St", "Houston", "", "");
        $this->assertFalse($result);

        // Call the static method to check if profile is completed
        $profile_completed = ClientProfile::isProfileCompleted();
        $this->assertFalse($profile_completed);
    }
}
?>