<?php

namespace Dgame\Conditional\Version;

use Dgame\Conditional\Version;

/**
 * Class BooleanVersion
 * @package Dgame\Conditional\Version
 */
final class BooleanVersion extends Version
{
    /**
     * @var bool
     */
    private $isValid = false;

    /**
     * BooleanVersion constructor.
     *
     * @param bool $isValid
     */
    public function __construct(bool $isValid)
    {
        $this->isValid = $isValid;
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        return $this->isValid;
    }
}