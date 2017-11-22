<?php

namespace Services\IssApi;

use Engine\Configuration\Config;
use Services\AbstractApiAdapter;

class IssApiAdapter extends AbstractApiAdapter
{
    /**
     * @param string $endpoint
     * @return string
     */
    protected function generateUrl(string $endpoint): string
    {
        return sprintf('%s/%s/', Config::get('issApiUrl'), $endpoint);
    }
}