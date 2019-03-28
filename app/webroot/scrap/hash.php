<?php
//hash
$pk = md5(time());
print_r($pk);
print_r("<br>");
$sk = "Nilam Doctor";
$data = "This is the first message";
$sign = sign($data,$pk);
print_r($sign);

$verify = verify($sign,$pk);
print_r($verify);

function sign($cleartext,$private_key)
{
    $msg_hash = md5($cleartext);
    openssl_private_encrypt($msg_hash, $sig, $private_key);
    $signed_data = $cleartext . "----SIGNATURE:----" . $sig;
    return mysql_real_escape_string($signed_data);
}

function verify($my_signed_data,$public_key)
{
    list($plain_data,$old_sig) = explode("----SIGNATURE:----", $my_signed_data);
    openssl_public_decrypt($old_sig, $decrypted_sig, $public_key);
    $data_hash = md5($plain_data);
    if($decrypted_sig == $data_hash && strlen($data_hash)>0)
        return $plain_data;
    else
        return "ERROR -- untrusted signature";
}


?>