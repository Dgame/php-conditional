<?php

namespace Dgame\Conditional\Exception;

final class UnknownOSException extends \Exception
{
    public function __construct(string $os, int $bit)
    {
        $msg = sprintf('OS %s(%d) is not supported', $os, $bit);
        
        parent::__construct($msg);
    }
}