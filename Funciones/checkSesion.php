<?php

    session_start();    

    function isActive()
    {
        if(empty($_SESSION)){
            return FALSE;
        }

        return TRUE;
    }

?>