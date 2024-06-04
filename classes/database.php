<?php
    class database {
        function opencon() {
            return new PDO('mysql:host=localhost;dbname=lafhanglechonsql','root','');
        }
        function check($email, $password) {
            // Open database connection
            $con = $this->opencon();
        
            // Prepare the SQL query
            $stmt = $con->prepare("SELECT * FROM customer WHERE cust_email = ?");
            $stmt->execute([$email]);
        
            // Fetch the user data as an associative array
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // If a user is found, verify the password
            if ($user && password_verify($password, $user['cust_pass'])) {
                return $user;
            }
        
            // If no user is found or password is incorrect, return false
            return false;
        }
    }