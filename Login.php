<?php
class LoginModule {
    private $users;

    public function __construct() {
        // Hard-coded list of user credentials
        $this->users = array(
            'username' => 'password',
            'john' => 'doe',
        );
    }

    public function validate($username, $password) {
        if (isset($this->users[$username]) && $this->users[$username] === $password) {
            header('Location: fuel_quote_form.php');
            return true;
        } else {
            return false;
        }
    }
}
?>
