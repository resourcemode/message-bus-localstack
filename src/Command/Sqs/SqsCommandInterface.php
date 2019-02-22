<?php

namespace MessageBus\Command\Sqs;

interface SqsCommandInterface
{
    /**
     * @return mixed
     */
    public function message();
}
