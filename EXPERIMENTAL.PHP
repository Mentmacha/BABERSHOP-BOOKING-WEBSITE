    <?php
        $dir = "uploads/";
        $images = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
        foreach ($images as $image) {
            echo "<img src='$image' alt='Uploaded Image'>";
        }
        ?>