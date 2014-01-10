<?php

/**
 * @author Igor Chepurnoy 
 */
class GitRepositories {

    /**
     * Get full data repository
     * @param type $repos
     * @return type
     */
    public static function getFullDataRepository($owner, $repos) {
        $url = "/repos/$owner/$repos";
        $data = self::getJsonData($url);
        if (isset($data['message'])) {
            return false;
        } else {
            return $data;
        }
    }

    /**
     * Get json data
     * @param type $repos
     * @return type
     */
    public static function getJsonData($url) {
        $baseUrl = "https://api.github.com";
        $fullUrl = $baseUrl . $url;
        $ch = curl_init();
        $timeout = 30;
        $url = $fullUrl;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
        $data = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($data, true);
        return $data;
    }

    /**
     * Get Contributors User
     * @param type $repos
     * @return boolean]
     */
    public static function getContributorsUsers($repos) {
        $url = "/repos/" . $repos . "/contributors";
        $data = self::getJsonData($url);
        if (!isset($data['message']) && $data != null) {
            return array_slice($data, 0, 7);
        } else {
            return false;
        }
    }

    /**
     * Get Single User
     * @param type $name
     * @return boolean
     */
    public static function getSingleUser($name) {
        $url = "/users/" . $name;
        $data = self::getJsonData($url);
        if ($data != null) {
            return $data;
        } else {
            return false;
        }
    }

    /**
     * Get Seacrh items
     * @param type $title
     * @return boolean
     */
    public static function getSearchItems($title) {
        $url = "/search/repositories?q=" . $title;
        $data = self::getJsonData($url);
        if ($data != null) {
            return $data;
        } else {
            return false;
        }
    }

}
