<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\FileHelper;

/**
 * Управление картой классов.
 */
class ClassmapController extends Controller
{
    protected function generateMapFile($mapFile, $map)
    {
        ksort($map);

        $content = "<?php\n\nreturn ".var_export($map, true).";\n";

        if (is_file($mapFile) && file_get_contents($mapFile) === $content) {
            echo "Nothing changed.\n";
        } else {
            file_put_contents($mapFile, $content);
            echo "Class map saved in $mapFile\n";
        }
    }

    /**
     * Сгенерировать карту классов для автоподгрузки.
     */
    public function actionGenerate()
    {
        $root = '@app';
        $root = Yii::getAlias($root);
        $root = FileHelper::normalizePath($root);

        $mapFile = '@app/config/classes.php';
        $mapFile = Yii::getAlias($mapFile);

        $options = [
            'filter' => function ($path) {
                if (is_file($path)) {
                    $file = basename($path);
                    if ($file[0] < 'A' || $file[0] > 'Z') {
                        return false;
                    }
                }

                return;
            },
            'only' => ['*.php'],
            'except' => [
                '/views/',
                '/vendor/',
                '/config/',
                '/tests/',
            ],
        ];
        $files = FileHelper::findFiles($root, $options);
        $map = [];
        foreach ($files as $file) {
            if (strpos($file, $root) !== 0) {
                throw new \Exception("Something wrong: $file\n");
            }

            $path = str_replace('\\', '/', substr($file, strlen($root)));
            $map['app'.substr(str_replace('/', '\\', $path), 0, -4)] = $file;
        }

        $this->generateMapFile($mapFile, $map);
    }
}
