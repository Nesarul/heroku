<?php
setCk();

$msg = array(
    "path"          => "celeb-lookalike",
    "valid_ext"     => array("jpg","jpeg", "png", "gif"),
    "eInvalid"      => "Please upload only valid audio file.",
    "eWrongFormat"  => "Please upload image (*.jpg, *.jpeg *.png, *.gif) file Only",
    "eNoFile"       => "No files found for upload."

);

$retVal = '<ul class="image-list">';
if (!empty($_FILES['fileCust'])) {

    if (!file_exists($msg['path'])) {							// Check if directory exists.
        mkdir($msg['path'], 0777, true);
        chmod($msg['path'], 0777);
    }
    $oldName    = str_replace(' ','_',pathinfo($_FILES['fileCust']['name'],PATHINFO_FILENAME));
    $ext        = pathinfo($_FILES['fileCust']['name'],PATHINFO_EXTENSION);
    if(in_array($ext,$msg["valid_ext"])){

        $file = $_FILES["fileCust"]["tmp_name"];

        $info = new finfo(FILEINFO_MIME);
        $type = $info->buffer(file_get_contents($file));
        $au = explode('/',$type);
        if(strcmp('image',$au[0]) === 0){
            $newName = $msg['path'].'/'.$oldName.'-'.date('YmdHis').'.'.$ext;
            move_uploaded_file($_FILES['fileCust']["tmp_name"],$newName); 
            
            //http://51.68.206.144:8800/celeb?url=https://boredhumans.com/nesarul/Eric.jpg&n=5          <= Reference Line
            $data = getData('http://51.68.206.144:8800/celeb?url=https://boredhumans.com/'.$newName.'&n=5');
            // $data = json_decode(getData('http://51.68.206.144:8800/celeb?url=https://boredhumans.com/celeb-lookalike/T_swift-20221206183747.jpg&n=5'));
            $kt = "";
            foreach($data as $key => $rec){
                $kt.='<li><img src="https://boredhumans.com/celebs/'.str_replace(' ','_',$rec).'.jpg" alt="'.$rec.'"/><span><a href="https://www.google.com/search?tbm=isch&q='.str_replace(' ','+',$rec).'" target="_blank">'.$rec.'</a></span> </li>';
            }
            $pi = $retVal.$kt.'</ul>';
            echo json_encode($pi);
        }else echo json_encode(['error' => $msg['eInvalid']]);
    } else echo json_encode(['error' => $msg['eWrongFormat']]);
}else echo json_encode(['error' => $msg['eNofile']]);
	

function setCk(){
	ob_start();
    $MaxCount = 10;						// set the max of the counter.


    if(!isset($_COOKIE['audUpd']))
    {
        setcookie('audUpd',date("Y-m-d"),time()+24*60*60);
    }
    else{
        if($_COOKIE['audUpd'] != date("Y-m-d"))
        {
            setcookie('audUpd',date("Y-m-d"),time()+24*60*60);
            setcookie('VisitCount', 1, time()+24*60*60);
        }
            
    }

					
    if(!isset($_COOKIE['VisitCount'])) 		
    {
        setcookie('VisitCount', 1, time()+24*60*60);
    }
    else
    {
        $lastNum = $_COOKIE['VisitCount']; 	//hold the last number if it was set before
        if($lastNum >= $MaxCount && $_COOKIE['audUpd'] == date("Y-m-d"))
        {
            echo json_encode(['error' => 'You have reached your limit of 10 images a day. Please try again tomorrow.']);
            ob_end_flush();
            die();
        }
        if($lastNum == 1)					//some logic to avoid repeats
        {
            if($lastNum < $MaxCount)		//if below max, add 1
            {
                $lastNum++;
                setcookie('VisitCount', $lastNum, time()+24*60*60);   
            }
        }
        else
        {
            setcookie('VisitCount', $_COOKIE['VisitCount']+1, time()+24*60*60);   
        }
    }
    ob_end_flush();
}

function getData($str)
	{
		// $str = rawurlencode($str);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $str,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 60,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
			// CURLOPT_SSL_VERSION => CURL_SSLVERSION_SSLv2,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
			),
		));


		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
            return $response;
		}
	}
