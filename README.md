[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/LondonTheatreDirect/functions?utm_source=RapidAPIGitHub_LondonTheatreDirectFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)
# LondonTheatreDirect Package

* Domain: [London Theatre Direct](https://www.londontheatredirect.com/)
* Credentials: apiKey

## How to get credentials: 
1. Obtain apiKey from [London Theatre Direct](https://iodocs.londontheatredirect.com/apps/mykeys) 
 
 
## Custom datatypes: 
|Datatype|Description|Example
|--------|-----------|----------
|Datepicker|String which includes date and time|```2016-05-28 00:00:00```
|Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
|List|Simple array|```["123", "sample"]``` 
|Select|String with predefined values|```sample```
|Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```
 
## LondonTheatreDirect.getEvents
Returns all LIVE Events

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Your apiKey

## LondonTheatreDirect.getEventsByType
Returns all LIVE events of provided type. Use getEventTypes for details

| Field      | Type  | Description
|------------|-------|----------
| apiKey     | credentials| Your apiKey
| eventTypeId| Number| Event type identifier

## LondonTheatreDirect.getSingleEvent
Returns information about specified event

| Field  | Type  | Description
|--------|-------|----------
| apiKey | credentials| Your apiKey
| eventId| Number| Event identifier

## LondonTheatreDirect.getSingleEventPerformances
Returns all performances for a specified event

| Field  | Type  | Description
|--------|-------|----------
| apiKey | credentials| Your apiKey
| eventId| Number| Event identifier

## LondonTheatreDirect.getEventsPerformances
Returns all performances for provided events

| Field      | Type  | Description
|------------|-------|----------
| apiKey     | credentials| Your apiKey
| eventIdList| List  | Identifiers

## LondonTheatreDirect.getEventPerformancesByDate
Returns the same result as getSingleEventPerformances, but performances are filtered by a specified date range

| Field   | Type  | Description
|---------|-------|----------
| apiKey  | credentials| Your apiKey
| eventId | Number| Event identifier
| dateFrom| DatePicker| Minimal acceptable date and time of any performance’s occurrence. Example 2017-02-24
| dateTo  | DatePicker| Maximal acceptable date and time of any performance’s occurrence. Example 2017-02-28

## LondonTheatreDirect.getSingleEventTickets
Returns a specified event with all performances within specified date range that contain required amount of tickets available. In case required amount of tickets (i.e. nbOfTickets) is greater than zero, a result contains an event with performances having consecutive required amount of tickets available. In case required amount of tickets (i.e. nbOfTickets) equals to zero, a result contains an event with performances having any ticket available. Also, found tickets may not be consecutive. If no available ticket can be found at all, result object contains a null reference in property called AvailableEvent

| Field      | Type  | Description
|------------|-------|----------
| apiKey     | credentials| Your apiKey
| eventId    | Number| Event identifier
| dateFrom   | DatePicker| Minimal acceptable date and time of any performance’s occurrence. Example 2017-02-24
| dateTo     | DatePicker| Maximal acceptable date and time of any performance’s occurrence. Example 2017-02-28
| nbOfTickets| Number| Number of required tickets

## LondonTheatreDirect.getEventsTickets
Returns a set of required events. Result set has size which equals to size of a parsed eventIds parameter. If some event has no available tickets nor any performance within specified date range is found, event instance on specific index is null reference. In case required amount of tickets (i.e. nbOfTickets) is greater than zero, a result contains events with performances having consecutive required amount of tickets available. In case required amount of tickets (i.e. nbOfTickets) equals to zero, a result contains events with performances having any ticket available. Also, found tickets may not be consecutive

| Field               | Type   | Description
|---------------------|--------|----------
| apiKey              | credentials | Your apiKey
| eventIdList         | List  | List of event identifiers
| dateFrom            | DatePicker | Minimal acceptable date and time of any performance’s occurrence. Example 2017-02-24
| dateTo              | DatePicker | Maximal acceptable date and time of any performance’s occurrence. Example 2017-02-28
| nbOfTickets         | Number | Number of required tickets
| consecutiveSeatsOnly| Boolean| Flag indicating whether you are Interested only in immediately consecutive seats; parameter is ignored if nbOfTickets equals to zero

## LondonTheatreDirect.getSingleEventBookingInfo
Returns a preliminary booking information of all performances for a specified event. Requires number of tickets requested to properly return minimum and maximum ticket price

| Field               | Type   | Description
|---------------------|--------|----------
| apiKey              | credentials | Your apiKey
| eventId             | Number | Event identifier
| dateFrom            | DatePicker | Minimal acceptable date and time of any performance’s occurrence. Example 2017-02-24
| dateTo              | DatePicker | Maximal acceptable date and time of any performance’s occurrence
| nbOfTickets         | Number | Number of required tickets
| consecutiveSeatsOnly| Boolean| Flag indicating whether you are Interested only in immediately consecutive seats; parameter is ignored if nbOfTickets equals to zero

## LondonTheatreDirect.getSingleEventReviews
Returns reviews for a specified event. By default it returns 10 reviews ordered by created datetime descending

| Field       | Type  | Description
|-------------|-------|----------
| apiKey      | credentials| Your apiKey
| eventId     | Number| Event identifier
| reviewsOrder| Number| Enum ReviewsOrder (0 - DateDescending is set by default)
| nbOfReviews | Number| Count of reviews returned (10 is set by default)
| nbFrom      | Number| Count of reviews skipped (0 is set by default)

## LondonTheatreDirect.getVenues
Returns all existing venues (theatres, arenas etc.). Result set contains even venues where no event is currently played

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Your apiKey

## LondonTheatreDirect.getSingleVenue
Returns venue detail

| Field  | Type  | Description
|--------|-------|----------
| apiKey | credentials| Your apiKey
| venueId| Number| Venue identifier

## LondonTheatreDirect.getSingleVenueEvents
Returns all online events that are played in a venue having specified id

| Field  | Type  | Description
|--------|-------|----------
| apiKey | credentials| Your apiKey
| venueId| Number| Venue identifier

## LondonTheatreDirect.getSinglePerformance
Returns performance detail

| Field        | Type  | Description
|--------------|-------|----------
| apiKey       | credentials| Your apiKey
| performanceId| Number| Performance identifier

## LondonTheatreDirect.getSinglePerformanceTickets
Returns a group of tickets for a specified performance grouped by a ticket area, face and selling price. Result also respects input parameter for required amount of tickets so only areas having this amount available are returned

| Field               | Type  | Description
|---------------------|-------|----------
| apiKey              | credentials| Your apiKey
| performanceId       | Number| Performance identifier
| requiredTicketsCount| Number| Required amount of tickets to be sold

## LondonTheatreDirect.createBasket
Creates new basket. You must call this method first when you have an intention of creating a new order

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Your apiKey

## LondonTheatreDirect.addTicketsToBasket
Adds provided tickets into basket

| Field       | Type  | Description
|-------------|-------|----------
| apiKey      | credentials| Your apiKey
| basketId    | String| Unique basket identifier
| ticketIdList| List  | List of TicketIds

## LondonTheatreDirect.getSingleBasket
Returns contents of provided basket (BasketId)

| Field   | Type  | Description
|---------|-------|----------
| apiKey  | credentials| Your apiKey
| basketId| String| Unique basket identifier

## LondonTheatreDirect.submitBasket
Submits basket content

| Field                | Type   | Description
|----------------------|--------|----------
| apiKey               | credentials | Your apiKey
| basketId             | String | Unique basket identifier
| email                | String | Customer e-mail address
| name                 | String | Customer first name
| lastName             | String | Customer last name
| addressLine1         | String | Billing address line 1. Example: 132, My Street
| addressLine2         | String | Billing address line 1. Example: 1st floor
| companyName          | String | Billing company name
| city                 | String | Billing city
| country              | Number | Billing country identifier
| zip                  | String | Billing zip code
| successReturnUrl     | String | Destination URL where you get redirected after successful payment
| failureReturnUrl     | String | Destination URL where you get redirected after failure payment
| sendConfirmationEmail| Boolean| Flag indicating whether to send a confirmation e-mail to a customer
| transactionReference | String | External identification of a transaction
| paymentGateLanguage  | Number | Desired language of payment gate
| phone                | String | Contact phone number
| mobile               | String | Contact mobile phone number
| stateCode            | String | State code, applied only for United States
| deliveryType         | Number | Delivery type
| requireTicketPlan    | Boolean| Flag indicating whether a booking insurance should be also created

## LondonTheatreDirect.getSubmittedBasketSummary
Returns contents for provided BasketId only when basket was already submitted

| Field   | Type  | Description
|---------|-------|----------
| apiKey  | credentials| Your apiKey
| basketId| String| Unique basket identifier

## LondonTheatreDirect.deleteOrderFromBasket
Removes order from basket

| Field       | Type  | Description
|-------------|-------|----------
| apiKey      | credentials| Your apiKey
| basketId    | String| Unique basket identifier
| basketItemId| Number| Basket item identifier

## LondonTheatreDirect.deleteAllFromBasket
Releases all tickets from basket

| Field   | Type  | Description
|---------|-------|----------
| apiKey  | credentials| Your apiKey
| basketId| String| Unique basket identifier

## LondonTheatreDirect.checkTicketAvailability
Checks current availability of provided tickets. To get list of existing tickets, use getSingleEventTicket and getEventsTickets

| Field   | Type  | Description
|---------|-------|----------
| apiKey  | credentials| Your apiKey
| ticketId| Number| Unique ticket identifier

## LondonTheatreDirect.getTicketPlanPrice
Returns price of TicketPlan refund protection

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Your apiKey

## LondonTheatreDirect.getCountries
Returns all Countries

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Your apiKey

## LondonTheatreDirect.getUSAStates
Returns all US states

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Your apiKey

## LondonTheatreDirect.getEventTypes
Returns all Event types

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Your apiKey

## LondonTheatreDirect.getDeliveryTypes
Returns all Delivery types

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Your apiKey

## LondonTheatreDirect.getSystemHeartBeat
Returns true if the web services are available

| Field | Type  | Description
|-------|-------|----------
| apiKey| credentials| Your apiKey

