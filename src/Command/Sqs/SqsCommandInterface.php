<?php

namespace MessageBus\Sqs\Command;

interface SqsCommandInterface
{
    /**
     * @return mixed
     */
    public function message();
}
