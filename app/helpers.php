<?php

function fetchPexelsImage($query = 'house renovation') {
    $apiKey = 'YOUR_PEXELS_API_KEY';
    $url = "https://api.pexels.com/v1/search?query=" . urlencode($query) . "&per_page=1";

    $headers = [
        "Authorization: $apiKey"
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (!empty($data['photos'][0]['src']['medium'])) {
        $imageUrl = $data['photos'][0]['src']['medium'];
        $imageContent = file_get_contents($imageUrl);

        $filename = uniqid() . '.jpg';
        $path = storage_path('app/public/service_images/' . $filename);

        file_put_contents($path, $imageContent);

        return '/storage/service_images/' . $filename;
    }

    return null;
}
