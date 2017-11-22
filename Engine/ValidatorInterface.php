<?php

namespace Engine;

interface ValidatorInterface
{
    /**
     * @param array $data
     * @return bool
     */
    public function validate($data): bool;
}