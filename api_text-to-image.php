<?php
$path           = "images/";
$valid_ext      = array('jpg','jpeg','png','gif');
$eWrongFormat   = "Please upload image (*.jpg, *.jpeg *.png, *.gif) file Only";
$eNoFile        = "No files found for upload.";
$url = "https://api.deepai.org/api/fast-style-transfer";

if (!empty($_FILES['imageFile'])) {

    if (!file_exists('images')) {							// Check if directory exists.
        mkdir('images', 0777, true);
        chmod('images', 0777);
    }

    $oldName    = pathinfo($_FILES['imageFile']['name'],PATHINFO_FILENAME);
    $ext        = pathinfo($_FILES['imageFile']['name'],PATHINFO_EXTENSION);
    
    if(in_array($ext,$valid_ext)){
        $file = $_FILES["imageFile"]["tmp_name"];
        $info = new finfo(FILEINFO_MIME);
        $type = $info->buffer(file_get_contents($file));
        $au = explode('/',$type);

        if(strcmp('image',$au[0]) === 0){
            $newName = $path.$oldName."-".date('YmdHis.').$ext;
            move_uploaded_file($_FILES['imageFile']["tmp_name"],$newName); 

            $headers = array(
                'Content-Type' => 'application/json',
                'Api-Key: 2350dbe7-ecfd-47ed-9ffa-b29ecc988b2e'
            ); 
            $postfields = array(
                "content" => "https://boredhumans.b-cdn.net/faces2/30.jpg", 
                "style" => "https://boredhumans.com/image_style_transfer/styles/Picassso.jpg"
            );  

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => $postfields,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_HTTPHEADER => $headers,
            ));
        
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }
            
        }else echo json_encode(['error' => $eInvalid]);
    } else echo json_encode(['error' => $eWrongFormat]);
}else echo json_encode(['error' => $eNoFile]);