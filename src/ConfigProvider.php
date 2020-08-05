<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Reasno\HyperfMysqlPartition;

use Hyperf\Database\Connectors\ConnectionFactory;
use Reasno\HyperfMysqlPartition\Console\PartitionsCommand;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                ConnectionFactory::class => \Reasno\HyperfMysqlPartition\Connector\ConnectionFactory::class,
            ],
            'commands' => [
                PartitionsCommand::class,
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
        ];
    }
}
