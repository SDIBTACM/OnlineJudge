<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-03-05 19:44
 */

namespace App\Units\Monolog;


class AppLogger
{
    /**
     * 自定义日志实例
     *
     * @param \Illuminate\Log\Logger $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new AppLogFormatter());
        }
    }
}