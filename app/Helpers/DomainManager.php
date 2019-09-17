<?php

namespace App\Helpers;

class DomainManager
{
    private static function curl_post_request($url, $data, $method) 
    {
        $headers = [
            "Content-type: application/json",
            "Authorization: Bearer " . env('DIGITALOCEAN_API_KEY')
        ];

        $ch = curl_init($url);

        if ($method === 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        } elseif ($method === 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        } else {
            curl_setopt($ch, CURLOPT_POST, 1);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));

        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }

    public static function createRecord($domain) {
        $postData = array(
            "type" => "CNAME",
            "name" => $domain,
            "data" => '@',
            "ttl" => 1800
        );

        $json = DomainManager::curl_post_request("https://api.digitalocean.com/v2/domains/".env('PROJECT_DOMAIN')."/records", $postData, 'POST'); 
        $result = json_decode($json, true);

        return $result['domain_record']['id'];
    }

    public static function updateRecord($id, $domain) {
        $postData = array(
            "name" => $domain,
            "data" => '@',
            "ttl" => 1800
        );

        $json = DomainManager::curl_post_request("https://api.digitalocean.com/v2/domains/".env('PROJECT_DOMAIN')."/records/".$id, $postData, 'PUT'); 
        $result = json_decode($json, true);

        return $result['domain_record']['id'];
    }

    public static function deleteRecord($id) {
        $json = DomainManager::curl_post_request("https://api.digitalocean.com/v2/domains/".env('PROJECT_DOMAIN')."/records/".$id, null, 'DELETE'); 
        $result = json_decode($json, true);

        return true;
    }
}
