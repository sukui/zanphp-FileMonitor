<?php
/**
 * 代码来自workerman文件监控重启代码
 * 建议只允许开发环境使用
 * workerman(http://www.workerman.net)
 * @author walkor<walkor@workerman.net>
 * @link https://github.com/walkor/workerman-filemonitor
 */

namespace Com\Youzan\ZanHttpDemo\Init\WorkerStart;

use Zan\Framework\Foundation\Core\RunMode;
use Zan\Framework\Network\Server\Timer\Timer;

class FileMonitor
{
    public $monitor_dir;
    public $last_mtime;
    public $server;
    public function bootstrap($server,$workerId)
    {
        if(RunMode::isOnline()){
            return false;
        }
        if($workerId == 0){
            $this->server = $server;
            $this->monitor_dir = realpath(__DIR__.'/../../');
            $this->last_mtime = time();
            Timer::tick(1000,[$this,'check_files_change']);
        }
    }

    public function check_files_change(){
        $dir_iterator = new \RecursiveDirectoryIterator($this->monitor_dir);
        $iterator = new \RecursiveIteratorIterator($dir_iterator);
        foreach ($iterator as $file)
        {
            if(pathinfo($file, PATHINFO_EXTENSION) != 'php')
            {
                continue;
            }
            if($this->last_mtime < $file->getMTime())
            {
                $this->last_mtime = $file->getMTime();
                echo $file." update and reload\n";
                $this->server->swooleServer->reload();
                break;
            }
        }
    }
}