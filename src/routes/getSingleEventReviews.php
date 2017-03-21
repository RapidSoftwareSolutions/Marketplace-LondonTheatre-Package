<?php

$app->post('/api/LondonTheatreDirect/getSingleEventReviews', function ($request, $response) {
    /** @var \Slim\Http\Response $response */
    /** @var \Slim\Http\Request $request */
    /** @var \Models\checkRequest $checkRequest */

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'eventId']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $postData = $validateRes;
    }

    $url = $settings['apiUrl'] . "/Events/" . $postData['args']['eventId'] . "/Reviews";

    $params = [];

    if (isset($postData['args']['reviewsOrder']) && strlen($postData['args']['reviewsOrder']) > 0) {
        $params['ReviewsOrder'] = $postData['args']['reviewsOrder'];
    }
    if (isset($postData['args']['nbOfReviews']) && strlen($postData['args']['nbOfReviews']) > 0) {
        $params['NbOfReviews'] = $postData['args']['nbOfReviews'];
    }
    if (isset($postData['args']['nbFrom']) && strlen($postData['args']['nbFrom']) > 0) {
        $params['NbFrom'] = $postData['args']['nbFrom'];
    }

    try {
        /** @var GuzzleHttp\Client $client */
        $client = $this->httpClient;
        $vendorResponse = $client->get($url, [
            'headers' => [
                'Api-Key' => $postData['args']['apiKey'],
                'Content-Type' => "application/json"
            ],
            'query' => [
                'DateFrom' => $postData['args']['dateFrom'],
                'DateTo' => $postData['args']['dateTo'],
                'NbOfTickets' => $postData['args']['nbOfTickets'],
                'consecutiveSeatsOnly' => filter_var($postData['args']['consecutiveSeatsOnly'], FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false'
            ]
        ]);
        $vendorResponseBody = $vendorResponse->getBody()->getContents();
        if ($vendorResponse->getStatusCode() == 200) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = json_decode($vendorResponse->getBody());
        }
        else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($vendorResponseBody) ? $vendorResponseBody : json_decode($vendorResponseBody);
        }
    } catch (\GuzzleHttp\Exception\BadResponseException $exception) {
        $vendorResponseBody = $exception->getResponse()->getBody();
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = json_decode($vendorResponseBody);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});
