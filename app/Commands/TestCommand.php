<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Commands;

use App\Models\Logic\UserLogic;
use App\Services\PhoneCodeService;
use Swoft\App;
use Swoft\Bean\Annotation\Inject;
use Swoft\Console\Bean\Annotation\Command;
use Swoft\Console\Bean\Annotation\Mapping;
use Swoft\Console\Input\Input;
use Swoft\Console\Output\Output;
use Swoft\Core\Coroutine;
use Swoft\Log\Log;
use Swoft\Task\Task;

/**
 * Test command
 *
 * @Command(coroutine=false)
 */
class TestCommand
{

    /**
     * @Inject()
     * @var PhoneCodeService 短信发送Service
     */
    private $phoneCodeService;

    /**
     * 测试
     * @Mapping()
     * @param Input $input
     * @param Output $output
     */
    public function task(Input $input, Output $output)
    {
        $phone = $input->get('phone');
        $result = $this->phoneCodeService->sendCode(0, $phone);
        print_r($result);
    }
}
