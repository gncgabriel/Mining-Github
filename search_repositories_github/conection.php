<?php
function executaQuery($query, $token)
{
    $ch = curl_init('https://api.github.com/graphql');
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
            'user-agent: index.php'
        ),
        CURLOPT_POSTFIELDS => json_encode($query)
    ));

    // Send the request
    $response = curl_exec($ch);

    if ($response === FALSE) {
        die(curl_error($ch));
    }
    $responseData = json_decode($response, TRUE);
    return $responseData;
}