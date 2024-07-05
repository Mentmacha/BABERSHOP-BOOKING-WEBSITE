<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // File upload handling
    $target_dir = "CUTS/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.<br>";
            
            // Update haircuts.json
            $haircuts_file = 'haircuts.json';
            if (file_exists($haircuts_file)) {
                $haircuts = json_decode(file_get_contents($haircuts_file), true);
            } else {
                $haircuts = [];
            }
            
            $new_haircut = [
                'name' => $_POST['haircut_name'],
                'price' => $_POST['haircut_price'],
                'image' => $target_file  // Store the path to the uploaded image
            ];
            
            $haircuts[] = $new_haircut;
            
            // Save updated data
            file_put_contents($haircuts_file, json_encode($haircuts));
            echo "Haircuts JSON updated.<br>";
            
            // Redirect to BARBERSHOP_BOOKING_PAGE.HTML
            echo '<script>window.location.href = "BARBERSHOP_BOOKING_PAGE.HTML";</script>';
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
}
?>
