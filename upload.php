<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type,X-Auth-Token,Origin,Authorization");
header("Access-Control-Allow-Methods: POST,GET,OPTIONS,DELETE");
$conn=mysqli_connect('localhost:3308','root','','reactimage');
if(isset($_POST['name'])){
$files=$_FILES['picture'];
$name=mysqli_real_escape_string($conn,$_POST['name']);
// file properties
print_r($files);   
$filename=$files['name'];
$templocation=$files['tmp_name'];
$uploaderrors=$files['error'];
$splitedname=explode('.',$filename);
$fileextension=strtolower(end($splitedname));
$allowedextensions=['png','jpg','jpeg','xlsx','docx'];
if(in_array($fileextension,$allowedextensions)){
    if($uploaderrors===0){
        $new_file_name=uniqid().'.'.$fileextension;
        $file_destination='public/images'.$new_file_name;
        if(move_uploaded_file($templocation,$file_destination)){
            $connection="INSERT INTO image(name,picture)VALUES('$name','$new_file_name')";
            if(mysqli_query($conn,$connection)){
                echo "success";
            }else{
                echo "could not insert data into database";
            }

        }
        else{
            echo 'could not upload the image';

    }
}else{
        echo 'There was an error in the upload';
    }
}
    else{
echo 'files with this extension is not allowed';

    }
}
    if(isset($_POST['fetch'])){
    // $query='SELECT * FROM image';
    // $result=mysqli_query($conn,$query);
    // $image=mysqli_fetch_all($result,MYSQLI_ASSOC);
    // echo json_encode($image);
    // }
    echo 'posted';
    }







