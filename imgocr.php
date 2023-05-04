<?php

// Set the JSON data to send
// $data = array(
//     "start_date" => "2023-04-01",
//     "end_date" => "2023-04-30",
//     "item_name" => "example_item"
// );
// $json_data = json_encode($data);


// var_dump($_FILES['fileToUpload']); die();

if (isset($_FILES['fileToUpload'])) {
    $file_name = $_FILES['fileToUpload']['name'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_error = $_FILES['fileToUpload']['error'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
  
    // Check if file is uploaded without errors
    if ($file_error === UPLOAD_ERR_OK) {
      // Check if file size is less than or equal to 2MB
      if ($file_size <= 2097152) {
        // Generate a unique file name
        // $file_new_name = uniqid('', true) . '.' . $file_ext;
        $file_new_name = $file_name;
        // Set the file upload path
        $file_upload_path = 'img/ocr/' . $file_new_name;
        // Move the uploaded file to the desired location


        // var_dump(move_uploaded_file($file_tmp, './junada.png')); die();

        // var_dump(move_uploaded_file($file_tmp, $file_upload_path)); die();

        if (move_uploaded_file($file_tmp, $file_upload_path)) {
          // echo "File uploaded successfully. File path: " . $file_upload_path;
          
        // Set the request data including the image file
        $data = array(
          "image_path" => "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/".explode('/', $_SERVER["REQUEST_URI"])[1].'/'.$file_upload_path
          // "image_path" => "http://localhost:81/cute_cut/img/ocr/image.png"
          
        );

        // var_dump($data); die;

        $json_data = json_encode($data);

        // Encode the data as multipart form data
        // $multipart_data = http_build_query($data);

        // Set the request headers
        // $headers = array(
        //     "Content-Type: multipart/form-data",
        //     "Content-Length: " . strlen($multipart_data)
        // );


        // Initialize cURL session
        $curl = curl_init();

        // Set the URL and other cURL options
        $url = "http://127.0.0.1:5000/";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //MUST ENABLE AFTER CONFIG
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/json",
          "Content-Length: " . strlen($json_data)
          // "Content-Type: multipart/form-data",
          // "Content-Length: " . strlen($multipart_data)
        ));

        // Send the request and get the response
        $response = curl_exec($curl);

        // Check for errors
        if(curl_errno($curl)) {
          $error_msg = "cURL Error: " . curl_error($curl);
          echo $error_msg;
          exit;
        }

        // Close the cURL session
        curl_close($curl);

        // Convert the JSON response to a PHP array
        $data = json_decode($response, true);

        // Do something with the data
        print_r($data);

        $ingred = $data['ocrimg'];
        header("Location: Cart_Page.php?ingred=" . urlencode($ingred));

        } else {
          echo "Failed to move the uploaded file.";
        }
      } else {
        echo "File size is too large. Maximum file size is 2MB.";
      }
    } else {
      echo "An error occurred while uploading the file.";
    }
  }
  
  // echo('end');
  // exit;

// Set the image file path and mime type
// $image = $_POST['fileToUpload'];

// // Create the CURLFile object
// $image = new CURLFile($file_upload_path, $file_ext);

// // Set the request data including the image file
// $data = array(
//     "image_path" => "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/".explode('/', $_SERVER["REQUEST_URI"])[1].'/'.$file_upload_path
//     // "image_path" => "http://localhost:81/cute_cut/img/ocr/image.png"
    
// );

// // var_dump($data); die;

// $json_data = json_encode($data);

// // Encode the data as multipart form data
// // $multipart_data = http_build_query($data);

// // Set the request headers
// // $headers = array(
// //     "Content-Type: multipart/form-data",
// //     "Content-Length: " . strlen($multipart_data)
// // );


// // Initialize cURL session
// $curl = curl_init();

// // Set the URL and other cURL options
// $url = "http://127.0.0.1:5000/";
// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// //MUST ENABLE AFTER CONFIG
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array(
//     "Content-Type: application/json",
//     "Content-Length: " . strlen($json_data)
//     // "Content-Type: multipart/form-data",
//     // "Content-Length: " . strlen($multipart_data)
// ));

// // Send the request and get the response
// $response = curl_exec($curl);

// // Check for errors
// if(curl_errno($curl)) {
//     $error_msg = "cURL Error: " . curl_error($curl);
//     echo $error_msg;
//     exit;
// }

// // Close the cURL session
// curl_close($curl);

// // Convert the JSON response to a PHP array
// $data = json_decode($response, true);

// // Do something with the data
// print_r($data);

// $ingred = $data['ocrimg'];
// header("Location: Cart_Page.php?ingred=" . urlencode($ingred));

?>