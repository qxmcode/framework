<?php

declare(strict_types=1);
/**
 * copyright: Copyright (c) 2022 深圳市有传科技有限公司
 * author: 企晓萌
 * Date Time: 2022/04/11
 */
namespace Qxmcode\Framework\Command;

use Swoole\Process;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @\Hyperf\Command\Annotation\Command()
 */
class StopServer extends Command
{
    public function __construct()
    {
        parent::__construct('server:stop');
    }

    protected function configure()
    {
        $this->setDescription('Stop Qxmcode servers.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $pidFile = BASE_PATH . '/runtime/hyperf.pid';
        $pid = file_exists($pidFile) ? intval(file_get_contents($pidFile)) : false;
        if (!$pid) {
            $io->note('Qxmcode server pid is invalid.');
            return -1;
        }

        if (!Process::kill($pid, SIG_DFL)) {
            $io->note('Qxmcode server process does not exist.');
            return -1;
        }

        if (!Process::kill($pid, SIGTERM)) {
            $io->error('Qxmcode server stop error.');
            return -1;
        }

        $io->success('Qxmcode server stop success.');
        return 0;
    }

}