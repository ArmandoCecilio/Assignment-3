<?php

session_start();

class ClientProfile {

    public static function validateProfileFields($fullName, $address1, $city, $state, $zip) {
        if (!isset($fullName) || empty(trim($fullName)) ||
            !isset($address1) || empty(trim($address1)) ||
            !isset($city) || empty(trim($city)) ||
            !isset($state) || empty(trim($state)) ||
            !isset($zip) || empty(trim($zip))) {
            return false;
        } else {
            $_SESSION["profile_completed"] = true;
            return true;
        }
    }

    public static function isProfileCompleted() {
        return isset($_SESSION["profile_completed"]) && $_SESSION["profile_completed"];
    }
}
