<?php

$app->post('/api/LondonTheatreDirect/submitBasket', function ($request, $response) {
    /*
        English	1
German	2
Spanish	3
Italian	4
Swedish	5
French	6
Dutch	7
Norwegian	8
Danish	9*/

    /** @var \Slim\Http\Response $response */
    /** @var \Slim\Http\Request $request */
    /** @var \Models\checkRequest $checkRequest */

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'basketId', 'email', 'name', 'lastName', 'addressLine1', 'companyName', 'city', 'country', 'zip', 'successReturnUrl', 'failureReturnUrl', 'sendConfirmationEmail', 'transactionReference', 'paymentGateLanguage', ]);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $postData = $validateRes;
    }

    $url = $settings['apiUrl'] . "/Baskets/" . $postData['args']['basketId'] . "/SubmitOrder";

    $params['email'] = $postData['args']['email'];
    $params['name'] = $postData['args']['name'];
    $params['lastName'] = $postData['args']['lastName'];
    $params['addressLine1'] = $postData['args']['addressLine1'];
    $params['companyName'] = $postData['args']['companyName'];
    $params['city'] = $postData['args']['city'];
    $params['country'] = $postData['args']['country'];
    $params['zip'] = $postData['args']['zip'];
    $params['successReturnUrl'] = $postData['args']['successReturnUrl'];
    $params['failureReturnUrl'] = $postData['args']['failureReturnUrl'];
    $params['sendConfirmationEmail'] = filter_var($postData['args']['sendConfirmationEmail'], FILTER_VALIDATE_BOOLEAN);
    $params['transactionReference'] = $postData['args']['transactionReference'];
    $params['paymentGateLanguage'] = $postData['args']['paymentGateLanguage'];

   if (isset($postData['args']['addressLine2']) && strlen($postData['args']['addressLine2']) > 0) {
       $params['addressLine2'] = $postData['args']['addressLine2'];
   }
   if (isset($postData['args']['phone']) && strlen($postData['args']['phone']) > 0) {
       $params['phone'] = $postData['args']['phone'];
   }
   if (isset($postData['args']['mobile']) && strlen($postData['args']['mobile']) > 0) {
       $params['mobile'] = $postData['args']['mobile'];
   }
   if (isset($postData['args']['stateCode']) && strlen($postData['args']['stateCode']) > 0) {
       $params['stateCode'] = $postData['args']['stateCode'];
   }
   if (isset($postData['args']['deliveryType']) && strlen($postData['args']['deliveryType']) > 0) {
       $params['deliveryType'] = $postData['args']['deliveryType'];
   }
    if (isset($postData['args']['requireTicketPlan']) && strlen($postData['args']['requireTicketPlan']) > 0) {
       $params['requireTicketPlan'] = filter_var($postData['args']['requireTicketPlan'], FILTER_VALIDATE_BOOLEAN);
    }

    try {
        /** @var GuzzleHttp\Client $client */
        $client = $this->httpClient;
        $vendorResponse = $client->post($url, [
            'headers' => [
                'Api-Key' => $postData['args']['apiKey'],
                'Content-Type' => "application/json"
            ],
            'json' => $params
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
