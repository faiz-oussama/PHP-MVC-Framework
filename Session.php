<?php 


namespace faizavel\mvc;
class session
{
    protected const FLASH_KEY = 'flash_messages';
    public function __construct(){
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessages as $key => &$flashMessage)
        {  
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
    public function setFlash($key, $val){ 
        $_SESSION[self::FLASH_KEY][$key] = [
            'value' => $val,
            'remove' => false
        ];

    }
    public function getFlash($key){
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function set($key,$value)
    {
        $_SESSION[$key] = $value;
    }
    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function __destruct(){

        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [] ;
        foreach($flashMessages as $key => &$flashMessage)
        {  
            if(is_array($flashMessage) && isset($flashMessage['remove']) && $flashMessage['remove']){
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
        
    }

}