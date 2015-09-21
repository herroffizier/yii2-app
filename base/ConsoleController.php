<?php

namespace app\base;

use ConsoleKit\Console as CKConsole;
use ConsoleKit\Widgets\ProgressBar;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class ConsoleController extends Controller
{
    protected $console = null;

    protected function getConsole()
    {
        if ($this->console === null) {
            $this->console = new CKConsole;
        }

        return $this->console;
    }

    /**
     * Cоздать прогрессбар.
     *
     * @param  integer     $size
     * @return ProgressBar
     */
    public function createProgress($size)
    {
        return new ProgressBar($this->getConsole(), $size, 40, false);
    }
}
