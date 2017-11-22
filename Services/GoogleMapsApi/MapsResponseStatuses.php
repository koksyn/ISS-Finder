<?php

namespace Services\GoogleMapsApi;

class MapsResponseStatuses
{
    const OK = 'OK';
    const ZERO_RESULTS = 'ZERO_RESULTS';
    const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    const REQUEST_DENIED = 'REQUEST_DENIED';
    const INVALID_REQUEST = 'INVALID_REQUEST';
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';
}