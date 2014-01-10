
<?php

/**
 * Helper Text
 * @author    Igor Chepurnoy <Chepurnoy@zfort.com>
 */
class TruncateText {

    /**
     * Function Truncate Text
     * @param type $text
     * @param type $param
     * @return string
     */
    public static function truncate($text, $param = array()) {
        //Limit Param,if isset limit
        if (isset($param['limit'])) {
            $limit = $param['limit'];
        }
        //Else default value limit = 30
        else {
            $limit = 30;
        }
        $len = strlen($text);
        $maxLength = $len - $limit;
        if ($len <= $maxLength) {
            return $text;
        } else {
            $value = substr($text, $maxLength) . '...';
            return $value;
        }
    }

}
