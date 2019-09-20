<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Egrp extends Model
{
    public function vedomost($id = null, $userin = null, $ip = null)
    {
        if (strpos($id, '21') != 0) {
            return 0;
        } else {
            $id = substr($id, (strpos($id, '2300') + 4), (strlen($id) - (strpos($id, '2300') + 4) - 1));
            //21000023000001523181
        }

        if ($id == 0) { return 0; }

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "http://10.23.113.147/web/index.php?r=egrp/vedomost&id=" . $id . '&userin=' . str_replace(' ', '%20', $userin) . "&ip=" . $ip);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $src = curl_exec($c);
        curl_close($c);

        return($src);
    }

    public function vedomostm($num = 0, $userin = null, $ip = null)
    {
        if ($num == 0) { return 0; }

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "http://10.23.113.147/web/index.php?r=egrp/vedomostm&num=" . $num . "&userin=" . str_replace(' ', '%20', $userin) . "&ip=" . $ip);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $src = curl_exec($c);
        curl_close($c);

        return($src);
    }

    public function vedomostlist($num = 0, $userin = null, $ip = null) {
        if ($num == 0) { return 0; }

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "http://10.23.113.147/web/index.php?r=egrp/vedomostl&num=" . $num);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $src = curl_exec($c);
        curl_close($c);

        return($src);
    }
}
