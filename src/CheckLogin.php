<?php

class Login {
        public static function isLoggedIn() {

                if (isset($_COOKIE['FBID'])) {
                        if (DB::query('SELECT user_id FROM login WHERE token=:token', array(':token'=>sha1($_COOKIE['FBID'])))) {
                                $userid = DB::query('SELECT user_id FROM login WHERE token=:token', array(':token'=>sha1($_COOKIE['FBID'])))[0]['user_id'];
                        if (isset($_COOKIE['FBID_'])) {
                                return $userid;
                        } else {
                                $strong = True;
                                $token = bin2hex(openssl_random_pseudo_bytes(64, $strong));
                                DB::query('INSERT INTO login VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$userid));
                                DB::query('DELETE FROM login WHERE token=:token', array(':token'=>sha1($_COOKIE['FBID'])));

                                setcookie("FBID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                                setcookie("FBID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                                return $userid;
                        }
                }
        }
                return false;
        }
}

?>
