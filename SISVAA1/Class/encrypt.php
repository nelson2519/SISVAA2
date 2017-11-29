<?Php

class encrypt 
{
    public function encriptado($string){
        $key = 'sisvaa';
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result.=$char;
        }
        return base64_encode($result);
    }

    public function desencriptar($string){
        $key = 'sisvaa';
        $result = '';
        $string = base64_decode($string);
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)-ord($keychar));
            $result.=$char;
        }
        return $result;
    }
}
    /*echo '<pre>'.print_r (mcrypt_list_algorithms(), true).'</pre>';
    echo '<pre>'.print_r (mcrypt_list_modes(),true).'</pre>';*/
?>