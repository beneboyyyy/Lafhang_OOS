<?php
class database
{
    function opencon()
    {
        return new PDO('mysql:host=localhost;dbname=lafhanglechonsql', 'root', '');
    }
    function check($accounttype, $username, $password)
    {
        // Open database connection
        $con = $this->opencon();

        // Prepare the SQL query
        $stmt = $con->prepare("SELECT * FROM customer WHERE cust_user = ?");
        $stmt->execute([$username]);

        // Fetch the user data as an associative array
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // If a user is found, verify the password
        if ($user && password_verify($password, $user['cust_pass'])) {
            return $user;
        }

        // If no user is found or password is incorrect, return false
        return false;
    }

    function register($cust_image, $cust_FN, $cust_LN, $cust_user, $cust_email, $cust_pass, $cust_phone)
    {
        // Open database connection
        $dbh = $this->opencon();

        try {
            // Insert query
            $sql = "INSERT INTO customer (cust_image, cust_FN, cust_LN, cust_user, cust_email, cust_pass, cust_phone) 
                        VALUES (:cust_image, :cust_FN, :cust_LN, :cust_user, :cust_email, :cust_pass, :cust_phone)";

            $stmt = $dbh->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':cust_image', $cust_image);
            $stmt->bindParam(':cust_FN', $cust_FN);
            $stmt->bindParam(':cust_LN', $cust_LN);
            $stmt->bindParam(':cust_user', $cust_user);
            $stmt->bindParam(':cust_email', $cust_email);
            $stmt->bindParam(':cust_pass', $cust_pass);
            $stmt->bindParam(':cust_phone', $cust_phone);

            // Execute the query
            $stmt->execute();

            echo "Registration successful!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    //     function signup($firstname,$lastname,$birthday,$sex,$username, $password){
    //         $con =$this->opencon();

    //         //Check if the username already exists
    //         $query = $con->prepare("Select user_name FROM users WHERE user_name=?");
    //         $query->execute([$username]);
    //         $existingUser = $query->fetch();

    //         if($existingUser){
    //             return false;
    //     }

    //     //Insert the new username and password into the database
    //     return $con->prepare("INSERT INTO users(firstname,lastname,birthday,sex,user_name, user_pass) VALUES (?,?,?,?,?,?)")
    //     ->execute([$firstname,$lastname,$birthday,$sex,$username, $password]);
    // }
    function signupUser($firstname, $lastname, $email, $username, $password, $phone, $userimage)
    {
        $con = $this->opencon();
        // Save user data along with profile picture path to the database
        $con->prepare("INSERT INTO customer(cust_image,cust_FN,cust_LN,cust_user,cust_email, cust_pass, cust_phone) VALUES (?,?,?,?,?,?,?)")->execute([$firstname, $lastname, $email, $username, $password, $phone, $userimage]);
        return $con->lastInsertId();
    }

    function insertAddress($cust_id, $street, $barangay, $city, $province, $Zipcode)
    {
        $con = $this->opencon();

        return $con->prepare("INSERT INTO deliveryaddress(cust_ID,addressline1, Barangay, City,Province, Zipcode) VALUES (?,?, ?, ?, ?, ?)")->execute(array($cust_id, $street, $barangay, $city, $province));

    }

    // function view() {
    //     $con = $this->opencon();
    //     return $con->query("SELECT
    //     users.user_id,
    //     users.firstname,
    //     users.lastname,
    //     users.sex,
    //     users.birthday,
    //     users.user_profile_picture,
    //     users.user_name, CONCAT(
    //     user_address.user_street,' ',user_address.user_barangay,' ',user_address.user_city,' ',user_address.user_province) AS address
    // FROM
    //     users
    // INNER JOIN user_address ON users.user_id = user_address.user_id")->fetchAll();   
    // }
    // function addProduct($productName, $productDescription, $productPrice, $productImage, $productStock)
    // {
    //     $con = $this->opencon();
    //     try {
    //         $sql = "INSERT INTO product (product_name, product_description, product_price, product_image, product_stock) VALUES (?,?,?,?,?)";
    //         $stmt = $con->prepare($sql);
    //         $stmt->execute([$productName, $productDescription, $productPrice, $productImage, $productStock]);
    //         return true; // Return true if the product is successfully added
    //     } catch (PDOException $e) {
    //         echo "Error: " . $e->getMessage();
    //         return false; // Return false if there's an error adding the product
    //     }
    // }

    function addProduct($productID,$productName, $productDescription, $productPrice, $product_image_profile, $productStock){
        $con = $this->opencon();
        $stmt = $con->prepare("INSERT INTO product (productID,product_name, product_descrip, product_price, product_image, product_stock) VALUES (?,?,?,?,?,?)");
        $stmt->execute([$productID,$productName, $productDescription, $productPrice, $product_image_profile, $productStock]);
       
        // Get the ID of the last inserted row
        $last_id = $con->lastInsertId();
 
        // // Return the last inserted ID
        return $last_id;
    }

    function addCart($cartID, $cust_id, $productID, $price, $qty){
        $con = $this->opencon();
        $stmt = $con->prepare("INSERT INTO cart (cartID, cust_ID, productID, price, qty) VALUES (?,?,?,?,?)");
        $stmt->execute([$cartID, $cust_id, $productID, $price, $qty]);

    }

    function getProductPrice($productID) {
        $con = $this->opencon();
        $stmt = $con->prepare("SELECT product_price FROM product WHERE productID = ?");
        $stmt->execute([$productID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['product_price'];
    }

    function getProductData($productID)
    {
        $con = $this->opencon();
        $stmt = $con->prepare("SELECT product_price FROM product WHERE productID = ?");
        $stmt->execute([$productID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // function addProduct($productName, $productDescription, $productPrice, $productImage, $productStock)
    // {
    //     // Open database connection
    //     $dbh = $this->opencon();

    //     try {
    //         // Insert query
    //         $sql = "INSERT INTO product (product_name, product_descrip, product_price, product_image, product_stock) 
    //                     VALUES (:product_name, :product_descrip, :product_price, :product_image, :product_stock)";

    //         $stmt = $dbh->prepare($sql);

    //         // Bind parameters
    //         $stmt->bindParam(':product_name', $productName);
    //         $stmt->bindParam(':product_descrip', $productDescription);
    //         $stmt->bindParam(':product_price', $productPrice);
    //         $stmt->bindParam(':product_image', $productImage);
    //         $stmt->bindParam(':product_stock', $productStock);

    //         // Execute the query
    //         $stmt->execute();

    //         echo "Registration successful!";
    //     } catch (PDOException $e) {
    //         echo "Error: " . $e->getMessage();
    //     }
    // }



    function viewProduct()
    {
        $con = $this->opencon();
        $stmt = $con->query("SELECT
            productID,
            product_name,
            product_descrip,
            product_price,
            product_image,
            product_stock
        FROM
            product");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function viewProduct_img(){
        $con = $this->opencon();
        $stmt = $con->query("SELECT product_image from product");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //     function delete($id){
//         try{
//             $con = $this->opencon();
//             $con->beginTransaction();
//             $query = $con->prepare("DELETE FROM user_address Where user_id=? ");
//             $query->execute([$id]);
//             $query2 = $con->prepare("DELETE FROM users Where user_id=? ");
//             $query2->execute([$id]);
//             $con->commit();
//             return true; //Deletion Successful
//         }
//         catch(PDOException $e) {
//             $con->rollBack();
//             return false;
//     }

    //     }

    function viewdata($id)
    {
        $con = $this->opencon();
        $query = $con->prepare("SELECT
    customer.cust_ID,
    customer.cust_FN,
    customer.cust_LN,
    customer.cust_user,
    customer.cust_phone,
    customer.cust_pass,
    customer.cust_image,
    deliveryaddress.Addressline1,deliveryaddress.Barangay,deliveryaddress.City,deliveryaddress.Province AS address
FROM
    customer
INNER JOIN deliveryaddress ON customer.cust_ID = deliveryaddress.cust_ID WHERE customer.cust_ID=?");
        $query->execute([$id]);
        return $query->fetch();
    }



    //     function updateUser($user_id,$firstname,$lastname,$birthday,$sex,$username,$password) {
//         try{
//             $con = $this->opencon();
//             $query = $con->prepare("UPDATE users SET firstname=?,lastname=?,birthday=?,sex=?,user_name=?,user_pass=? WHERE user_id=?");
//             return $query->execute([$firstname,$lastname,$birthday,$sex,$username,$password,$user_id]);
//     }catch(PDOException $e) {
//         return false;
//     }
// }
//     function updateUserAddress($user_id,$street,$barangay,$city,$province){
//         try{
//             $con = $this->opencon();
//             $query = $con->prepare("UPDATE user_address SET user_street=?,user_barangay=?,user_city=?,user_province=? WHERE user_id=?");
//             return $query->execute([$street,$barangay,$city,$province, $user_id]);
//     }catch(PDOException $e) {
//         return false;
//     }
// }  

    // function getusercount()
// {
//     $con = $this->opencon();
//     return $con->query("SELECT SUM(CASE WHEN sex = 'Male' THEN 1 ELSE 0 END) AS male_count,
//     SUM(CASE WHEN sex = 'Female' THEN 1 ELSE 0 END) AS female_count FROM users;")->fetch();
// }

    // function validateCurrentPassword($userId, $currentPassword) {
//     // Open database connection
//     $con = $this->opencon();

    //     // Prepare the SQL query
//     $query = $con->prepare("SELECT user_pass FROM users WHERE user_id = ?");
//     $query->execute([$userId]);

    //     // Fetch the user data as an associative array
//     $user = $query->fetch(PDO::FETCH_ASSOC);

    //     // If a user is found, verify the password
//     if ($user && password_verify($currentPassword, $user['user_pass'])) {
//         return true;
//     }

    //     // If no user is found or password is incorrect, return false
//     return false;
// }


    // function updatePassword($userId, $hashedPassword){
//     try {
//         $con = $this->opencon();
//         $con->beginTransaction();
//         $query = $con->prepare("UPDATE users SET user_pass = ? WHERE user_id = ?");
//         $query->execute([$hashedPassword, $userId]);
//         // Update successful
//         $con->commit();
//         return true;
//     } catch (PDOException $e) {
//         // Handle the exception (e.g., log error, return false, etc.)
//          $con->rollBack();
//         return false; // Update failed
//     }
//     }
// function updateUserProfilePicture($userID, $profilePicturePath) {
//     try {
//         $con = $this->opencon();
//         $con->beginTransaction();
//         $query = $con->prepare("UPDATE users SET user_profile_picture = ? WHERE user_id = ?");
//         $query->execute([$profilePicturePath, $userID]);
//         // Update successful
//         $con->commit();
//         return true;
//     } catch (PDOException $e) {
//         // Handle the exception (e.g., log error, return false, etc.)
//          $con->rollBack();
//         return false; // Update failed
//     }
//      }
// function fetchAvailableCourses($userId) {
//     try {
//         $con = $this->opencon();
//         $query = $con->prepare("
//             SELECT c.course_id, c.course_name, c.course_description,
//             CASE WHEN e.course_id IS NOT NULL THEN 'Enrolled' ELSE 'Not Enrolled' END AS enrolled_status
//             FROM courses c
//             LEFT JOIN enrollments e ON c.course_id = e.course_id AND e.user_id = ?
//             WHERE e.course_id IS NULL OR e.user_id != ?
//         ");
//         $query->execute([$userId, $userId]);
//         return $query->fetchAll(PDO::FETCH_ASSOC);
//     } catch (PDOException $e) {
//         // Handle the exception (e.g., log error, return false, etc.)
//         return [];
//     }
// }

    //  function fetchSelectedCourses($selectedCourseIds) {
//     try {
//         $con = $this->opencon();
//         $placeholders = str_repeat('?,', count($selectedCourseIds) - 1) . '?';
//         $query = $con->prepare("SELECT course_id, course_name, course_description FROM courses WHERE course_id IN ($placeholders)");
//         $query->execute($selectedCourseIds);
//         return $query->fetchAll(PDO::FETCH_ASSOC);
//     } catch (PDOException $e) {
//         // Handle the exception (e.g., log error, return false, etc.)
//         return [];
//     }
// }
}

?>