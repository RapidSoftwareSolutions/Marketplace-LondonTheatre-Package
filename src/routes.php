<?php
$routes = [
    'getEvents',
    'getEventsByType',
    'getSingleEvent',
    'getSingleEventPerformances',
    'getEventsPerformances',
    'getEventPerformancesByDate',
    'getSingleEventTickets',
    'getEventsTickets',
    'getSingleEventBookingInfo',
    'getSingleEventReviews',
    'getVenues',
    'getSingleVenue',
    'getSingleVenueEvents',
    'getSinglePerformance',
    'getSinglePerformanceTickets',
    'createBasket',
    'addTicketsToBasket',
    'getSingleBasket',
    'submitBasket',
    'getSubmittedBasketSummary',
    'deleteOrderFromBasket',
    'deleteAllFromBasket',
    'checkTicketAvailability',
    'getTicketPlanPrice',
    'getCountries',
    'getUSAStates',
    'getEventTypes',
    'getDeliveryTypes',
    'getSystemHeartBeat',
    'metadata'
];
foreach ($routes as $file) {
    require __DIR__ . '/../src/routes/' . $file . '.php';
}