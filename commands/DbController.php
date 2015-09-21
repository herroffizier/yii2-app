<?php

namespace app\commands;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Console;
use app\base\ConsoleController;

/**
 * Работа с базой данных.
 */
class DbController extends ConsoleController
{
    public $mysqldumpPath = 'mysqldump';
    public $mysqlPath = 'mysql';

    public function options($actionID)
    {
        return ['mysqldumpPath', 'mysqlPath'];
    }

    protected function createDefaultsFile()
    {
        $fileName = Yii::getAlias('@app/mysql_defaults_'.md5(time()).'.cnf');

        $content = ['[client]'];
        $values = ['host' => DB_HOST, 'user' => DB_USER, 'password' => DB_PASSWORD];
        foreach ($values as $key => $value) {
            if (!$value) {
                continue;
            }
            $content[] = $key.' = '.$value;
        }
        $content = implode("\n", $content);

        if (!file_put_contents($fileName, $content)) {
            throw new InvalidConfigException('Failed to create defaults file: '.$fileName.'.');
        }

        return $fileName;
    }

    /**
     * Сохранить дамп базы в файл.
     *
     * @param string $file
     */
    public function actionDump($file = 'dump.sql')
    {
        $fileName = Yii::getAlias('@app/'.$file);

        $this->stdout("Dumping ");
        $this->stdout(DB_NAME, Console::BOLD);
        $this->stdout(" into ");
        $this->stdout($fileName, Console::BOLD);
        $this->stdout("... ");

        $defaultsFileName = $this->createDefaultsFile();

        $output = null;
        $returnVar = null;
        $cmd =
            escapeshellcmd($this->mysqldumpPath)
            .' --defaults-extra-file='.escapeshellarg($defaultsFileName)
            .' '.escapeshellarg(DB_NAME)
            .' > '.escapeshellarg($fileName)
            .' 2>&1';

        exec($cmd, $output, $returnVar);

        unlink($defaultsFileName);

        if ($returnVar) {
            throw new InvalidConfigException('DB dumping failed: '.implode("\n", $output).'.');
        } else {
            $this->stdout("done\n", Console::BOLD);
        }
    }

    /**
     * Восстановить базу из файла дампа.
     *
     * @param string $file
     */
    public function actionRestore($file = 'dump.sql')
    {
        $fileName = Yii::getAlias('@app/'.$file);

        $this->stdout("Restoring ");
        $this->stdout(DB_NAME, Console::BOLD);
        $this->stdout(" from ");
        $this->stdout($fileName, Console::BOLD);
        $this->stdout("... ");

        $defaultsFileName = $this->createDefaultsFile();

        $output = null;
        $returnVar = null;
        $cmd =
            escapeshellcmd($this->mysqlPath)
            .' --defaults-extra-file='.escapeshellarg($defaultsFileName)
            .' '.escapeshellarg(DB_NAME)
            .' < '.escapeshellarg($fileName)
            .' 2>&1';

        exec($cmd, $output, $returnVar);

        unlink($defaultsFileName);

        if ($returnVar) {
            throw new InvalidConfigException('DB restoring failed: '.implode("\n", $output).'.');
        } else {
            $this->stdout("done\n", Console::BOLD);
        }
    }
}
