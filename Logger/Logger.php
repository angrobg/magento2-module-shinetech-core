<?php

namespace ST\Core\Logger;

class Logger extends \Monolog\Logger
{
    /**
     * Adds a log record.
     *
     * @param integer $level The logging level
     * @param string $message The log message
     * @param array $context The log context
     *
     * @return bool Whether the record has been processed
     */
    public function addRecord($level, $message, array $context = []): bool
    {
        if (is_array($message)) {
            $message = var_export($message, true);
        }

        return parent::addRecord($level, $message, $context);
    }
}
