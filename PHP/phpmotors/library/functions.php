<?php

function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}
function checkPrice($invPrice) {
    if (!is_numeric($invPrice) || $invPrice <= 0 || (strpos($invPrice, '.') !== false && strlen(substr(strrchr($invPrice, '.'), 1)) > 2)) {
        return false;
    } else {
        return true;
    }
}

// Build a navigation bar using the $classifications array
function buildNav($classifications) {
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
     $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// classifications list
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
   }

// display vehicles in unordered list
function buildVehiclesDisplay($vehicles){ 
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) { 
        $dv .= "<li><a href='/phpmotors/vehicles/?action=buildVehicleDisplay&vehicleId=".urlencode($vehicle['invId'])."' title='View this $vehicle[invMake] vehicle'>";
        $dv .= "<img src='$vehicle[primaryThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>$" . number_format($vehicle['invPrice']) . "</span>";
        $dv .= '</a></li>';
    }
    $dv .= '</ul>';
    return $dv;
}

// display vehicle in detail
function buildVehicleDisplay($vehicle) {
    $dv = '<section id="vehicle-display">';
    $dv .= "<div class='vehicle-images'><img src='$vehicle[largePrimaryImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></div>";
    $dv .= "<div class='vehicle-info'><h2>$vehicle[invMake] $vehicle[invModel]</h2><span>$" . number_format($vehicle['invPrice']) . "</span>";
    $dv .= "<p>$vehicle[invDescription]</p>";
    $dv .= '</div>';
    $dv .= '</section>';
    return $dv;
}

/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
}

// Build the vehicles select list
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
  global $image_dir, $image_dir_path;
  if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
  }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
    case IMAGETYPE_JPEG:
     $image_from_file = 'imagecreatefromjpeg';
     $image_to_file = 'imagejpeg';
    break;
    case IMAGETYPE_GIF:
     $image_from_file = 'imagecreatefromgif';
     $image_to_file = 'imagegif';
    break;
    case IMAGETYPE_PNG:
     $image_from_file = 'imagecreatefrompng';
     $image_to_file = 'imagepng';
    break;
    default:
     return;
   } // ends the swith
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
} // ends resizeImage function
// While this may sound insane, there seems to be an issue when a image file is created with the ".jpeg" extension. If you attempt to upload such a file, it will usually fail to actually save the physical image file.
// So, my advice is to use an image editing application to open and then export the file as a ".jpg" file. You can't simply change the extension, you have to export or save the file as a JPG file with the three letter extension.
// Once that is done, then run the image through the upload process. This seems to solve the issue.


// build thumbnail display for detailed view of a vechicle
function buildThumbnailDisplay($imageArray) {
    $img = '<ul id="detailThumbnails">';
    foreach ($imageArray as $image) {
        $img .= '<li>';
        $img .= "<img src='$image[imgPath]' alt='$image[imgName]'>";
        $img .= '</li>';
    }
    $img .= '</ul>';
    return $img;
}

// build search display
function buildSearchDisplay($searchArray) {
    $sd = "<div class='searchDisplay'> ";
    foreach ($searchArray as $item) {
    $sd .= "<h2><a href='/phpmotors/vehicles/index.php?action=buildVehicleDisplay&vehicleId=$item[invId]' title='View the $item[invYear] $item[invMake] $item[invModel]'>$item[invYear] $item[invMake] $item[invModel]</a></h2>";
    $sd .= "<p>$item[invDescription]</p>";
    }
    $sd .= '</div>';
    return $sd;
}

// adds the page number with links to other pages to the bottom of the view search
function pagination($totalPages, $page, $searchText) {
    $encodedSearchText = urlencode($searchText);
    $startPage = $page - 4;
    $counter = 0;
    $pag = '<div class="paginationDisplay">';
    if ($page > 1) {
        $pag .= "<a class='arrow-flip' href='/phpmotors/search/index.php?action=searchAction&searchText=$encodedSearchText&page=" . ($page - 1) . "'>&#10146;</a>";
    }
    while ($startPage <= 0) {
        $startPage++;
    }
    $pageNum = $startPage + $counter;
    while ($counter < 10 && $pageNum <= $totalPages && $startPage > 0) {
        if ($pageNum == $page) {
            $pag .= "<span class='currentPage'>$pageNum</span>";
        } else {
            $pag .= "<a href='/phpmotors/search/index.php?action=searchAction&page=$pageNum&searchText=$encodedSearchText'>$pageNum</a>";
        }
        $counter++;
        $pageNum++;
    }
    if ($page < $totalPages) {
        $pag .= "<a href='/phpmotors/search/index.php?action=searchAction&searchText=$encodedSearchText&page=" . ($page + 1) . "'>&#10146;</a>";
    }
    $pag .= '</div>';
    return $pag;
} 