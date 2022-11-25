<?php

if(isset($_POST['crit']) && !empty($_POST['crit']))
{
    $str = strtolower($_POST['crit']);

	$file="badwords2.txt";
	$fopen = fopen($file, 'r');
	$fread = fread($fopen,filesize($file));
	fclose($fopen);

	$lb = "\n";
	$bw = array_map('trim', explode($lb, $fread));
	
	if ($str == trim($str) && strpos($str, ' ') !== false) {
		$cr = explode(' ',$str);
		for($i = 0; $i < count($cr); $i++)
		{
			if(in_array($cr[$i],$bw))
			{
				echo json_encode("E2");
				die();
			}
		}
	}else if(in_array($str,$bw))
	{
		echo json_encode("E2");
		die();
	}
	setCk();
}



function setCk(){
	ob_start();
    $MaxCount = 10;						// set the max of the counter.

    if(!isset($_COOKIE['stChange']))
    {
        setcookie('stChange',date("Y-m-d"),time()+24*60*60);
        searchFile();
    }
    else{
        if($_COOKIE['stChange'] != date("Y-m-d"))
        {
            setcookie('stChange',date("Y-m-d"),time()+24*60*60);
            setcookie('VisitCount', 1, time()+24*60*60);
        }
            
    }

if(!isset($_COOKIE['VisitCount'])) 		
    {
        setcookie('VisitCount', 1, time()+24*60*60);
        searchFile();
    }
    else
    {
        $lastNum = $_COOKIE['VisitCount']; 	//hold the last number if it was set before
        if($lastNum >= $MaxCount && $_COOKIE['stChange'] == date("Y-m-d"))
        {
            echo "E1";
            ob_end_flush();
            die();
        }
        if($lastNum == 1)					//some logic to avoid repeats
        {
            if($lastNum < $MaxCount)		//if below max, add 1
            {
                $lastNum++;
                setcookie('VisitCount', $lastNum, time()+24*60*60);   
                searchFile();
            }
        }
        else
        {
            setcookie('VisitCount', $_COOKIE['VisitCount']+1, time()+24*60*60);   
            searchFile();
        }
    }
    ob_end_flush();
}

function searchFile()
{ 
    if(isset($_POST['crit']) && !empty($_POST['crit']))
        $key = $_POST['crit'];
        $key = rawurlencode($key);
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => 'https://lexica.art/api/v1/search?q='.$key,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 240,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
            CURLOPT_HTTPHEADER => array(
            'Content-Type' => 'application/json'
            )
        );
      
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
};