<?php 
    function credential_administrator($level) {
        $ci     =& get_instance();
        $login  = $ci->session->userdata('pengguna');
        
        if ((!ISSET($login['username'])) || ($login['username'] == '')) {
            redirect('home');
        } else {
            if (is_array($level)) {
                if (!in_array($login['id_level'], $level)) {
                    redirect('home'.$level);
                }
            } else {
                $level = array($level);
                if (!in_array($login['id_level'], $level)) {
                    redirect('home');
                }
            }
        }
    }


    function credential(){
        $ci     =& get_instance();
        $session  = $ci->session->userdata('pengguna');

        if(!ISSET($session) || count($session) <= 0) {
            redirect('');
        }
    }

    function get_profile(){
        $ci     =& get_instance();
        $session  = $ci->session->userdata('pengguna');

        if(ISSET($session) || count($session) <= 0) {
            return $session;
        }
        else {
            return [];
        }
    }

    function is_auth($level = []){
        $ci     =& get_instance();
        $session  = $ci->session->userdata('pengguna');
        
        if(!ISSET($session) || count($session) <= 0) {
            return false;
        } else {
            //dumper($session);
            if(empty($level)){ return true; }

            if (is_array($level)) {
                if (!in_array(level(), $level)) {
                    return false;
                }
            } else {
                $level = array($level);
                if (!in_array(level(), $level)) {
                    return false;
                }
            }
        }



        return true;
    }

    function full_name()    { $profile = get_profile();return $profile['nama']; }
    function username()     { $profile = get_profile();return $profile['username']; }
    function phone()        { $profile = get_profile();return $profile['no_telp']; }
    function level()        { $profile = get_profile();return $profile['id_level']; }
    function userid()       { $profile = get_profile();return $profile['id_user']; }
    function id_desa()      { $profile = get_profile();return $profile['id_desa']; }
    function user_status()  { $profile = get_profile();return $profile['user_status']; }


?>