<?php

namespace App\Tests\Extensions;

use BookIt\Codeception\TestRail\Extension;
use Codeception\Event\SuiteEvent;

class TestRailExtension extends Extension
{

    public function formatTime($time)
    {
        if ($time < 1.0) {
            return '1s';
        }
        return parent::formatTime($time);
    }

    public function afterSuite(SuiteEvent $event)
    {
        if (!empty($this->plan)){
            $this->writeln('Test report: ' . $this->config['url'] .'/index.php?/plans/view/' . $this->plan);
        }
        return parent::afterSuite($event);
    }
}
