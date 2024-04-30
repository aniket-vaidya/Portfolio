<?php
if(isset($_POST['submit']))
{
    function do_post_request($url, $data, $optional_headers = null)
    {
        $params = array('http' => array(
                        'method' => 'POST',
                        'content' => $data
                    ));
        if($optional_headers != null)
        {
            $params['http']['header'] = $optional_headers;
        }
        $ctx = stream_context_create($params);
        $fp = @fopen($url, 'rb', false, $ctx);
        if (!$fp)
        {
            throw new Exception("Problem with $url, $php_errormsg");
        }
        $response='';
        while (!feof($fp))
        {
            $response = $response.fgets($fp);
        }
        if ($response === false)
        {
            throw new Exception("Problem reading data from $url, $php_errormsg");
        }

        fclose($fp);
        return $response;
    }
    $host = 'http://mydomain.com';
    $url = 'http://mydomain.com/formHandler.php';
    $username = 'admin';
    $password = '123456';
    $data = array ('action' => 'login','lgname' => $username, 'lgpassword' => $password, 'format' => 'txt');
    $data = http_build_query($data);
    $reply = do_post_request($url, $data);
    echo "**********Response*********<pre>";
    echo var_dump($reply);
    #header('location:'.$host);
    #exit;

   } else {
       echo '<form method="post" enctype="multipart/form-data" action="'.$_SERVER['PHP_SELF'].'"><input type="text" name="uname" /><br><input type="password" name="password" /><input type="submit" name="submit"></form>';
   }

 ?>