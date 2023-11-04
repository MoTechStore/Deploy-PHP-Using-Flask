<?php

if(isset($_POST['submit']) && !empty($_POST['comment']))
{
    // Define flask API endpoint URL
    $api_url = 'http://127.0.0.1:5000/predict';

    // Receive data from post method
    $data = $_POST['comment'];
    
    // Convert data into json format
    $data_json = json_encode($data);

    // Initialize cURL session
    $ch = curl_init($api_url);

    // set cURL options
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Excute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if(curl_errno($ch)){
        echo 'cURL error: '. curl_error($ch);
    }

    // close cURL session
    curl_close($ch);

    // echo $response;



}else{
    if(isset($_POST['submit']) && empty($_POST['comment'])){
        $error_message = "Please fill before submiting";
    }

}
?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>PHP ML</title>
  </head>
  <body>

  <div class="row">
  <div class="col-sm-4">

   <div class="container-fluid"> 

   
  <form action="" method="post">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Enter Comment To Predict</label>
    
    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>

  </div>
  
  <button type="submit" name="submit" class="btn btn-primary">Predict</button> 
 
<p>

<?php 

if(isset($_POST['submit']) && !empty($_POST['comment'])){
    $data = json_decode($response);
    foreach($data as $result){
        echo 'Comment is ' . $result .'';
    }
}

?>
</p>

<div>
    <?php 
    if(!empty($error_message)){
        echo '<p style="color:red">' . $error_message . '</p>';
    }
    
    ?>
</div>


</form>


    </div>

  </div>
</div>
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
