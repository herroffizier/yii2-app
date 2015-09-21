<?php

namespace app\commands;

use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Inflector;
use app\base\ConsoleController;

/**
 * Управление проектом.
 */
class ProjectController extends ConsoleController
{
    public $dryRun = true;

    protected function replaceInFile($path, array $replaces)
    {
        if (!file_exists($path)) {
            throw new InvalidParamException('File '.$path.' is missing.');
        }

        if (!is_writeable($path)) {
            throw new InvalidParamException('File '.$path.' is not writeable.');
        }

        $content = file_get_contents($path);

        foreach ($replaces as $from => $to) {
            if (strpos($content, $from) === false) {
                throw new InvalidParamException('Substring '.$from.' is not found in '.$path.'.');
            }
        }

        $content = str_replace(array_keys($replaces), array_values($replaces), $content);

        if (!$this->dryRun) {
            file_put_contents($path, $content);
        }
    }

    protected function replaceInFiles($files, $values)
    {
        foreach ($files as $path => $valueNames) {
            $path = Yii::getAlias($path);

            $replaces = [];
            foreach ($valueNames as $valueName) {
                $replaces[$valueName] = $values[$valueName];
            }

            $this->replaceInFile($path, $replaces);
        }
    }

    public function options($actionID)
    {
        return ['dryRun'];
    }

    /**
     * Инициализация проекта.
     */
    public function actionInit()
    {
        $rawProjectName = pathinfo(Yii::getAlias('@app'), PATHINFO_FILENAME);
        $rawProjectName = Inflector::camelize($rawProjectName);

        $projectId = Inflector::camel2id($rawProjectName);
        $projectId = $this->prompt("Project id", ['default' => $projectId]);

        $projectName = Inflector::titleize($projectId);
        $projectName = $this->prompt("Project name", ['default' => $projectName]);

        $vagrantIp = '192.168.33.'.rand(100, 254);
        $vagrantIp = $this->prompt('Vagrant IP', ['default' => $vagrantIp]);

        $values = [
            'PROJECT-ID' => $projectId,
            'PROJECT-NAME' => $projectName,
            'VAGRANT-IP' => $vagrantIp,
        ];

        $files = [
            '@app/build.xml' => ['PROJECT-ID'],
            '@app/Vagrantfile' => ['VAGRANT-IP', 'PROJECT-ID'],
            '@app/config/web.php' => ['PROJECT-NAME'],
            '@app/config/console.php' => ['PROJECT-NAME'],
            '@app/config/env/vagrant.php' => ['PROJECT-ID'],
        ];

        $this->replaceInFiles($files, $values);
    }
}
