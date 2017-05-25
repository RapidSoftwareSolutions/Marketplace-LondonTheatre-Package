<?php

$app->post('/api/LondonTheatreDirect/getEventsTickets', function ($request, $response) {
    /** @var \Slim\Http\Response $response */
    /** @var \Slim\Http\Request $request */
    /** @var \Models\checkRequest $checkRequest */

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'eventIdList', 'dateFrom', 'dateTo', 'nbOfTickets', 'consecutiveSeatsOnly']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $postData = $validateRes;
    }

    if (is_array($postData['args']['eventIdList'])) {
        $eventIdList = implode(',', $postData['args']['eventIdList']);
    }
    else {
        $eventIdList = $postData['args']['eventIdList'];
    }

    $url = $settings['apiUrl'] . "/Events/" . $eventIdList . '/AvailableTickets';
    $dateFrom = new DateTime($postData['args']['dateFrom']);
    $dateTo = new DateTime($postData['args']['dateTo']);

    try {
        /** @var GuzzleHttp\Client $client */
        $client = $this->httpClient;
        $vendorResponse = $client->get($url, [
            'headers' => [
                'Api-Key' => $postData['args']['apiKey'],
                'Content-Type' => "application/json"
            ],
            'query' => [
                'DateFrom' => $dateFrom->format('Y-m-d'),
                'DateTo' => $dateTo->format('Y-m-d'),
                'NbOfTickets' => $postData['args']['nbOfTickets'],
                'ConsecutiveSeatsOnly' => filter_var($postData['args']['consecutiveSeatsOnly'], FILTER_VALIDATE_BOOLEAN)
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
