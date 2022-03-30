<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use console\models\XmlAnalysis;

class XmlanalysisController extends Controller
{
    public function actionUpload() {
        $zip = new \ZipArchive;
        $pathDir = getcwd() . '/console/uploads/';
        $pathDirEx = getcwd() . '/console/uploads/xml/';
        $pathZip = glob($pathDir . "*.zip");
        $modelXmlAnalysis = new XmlAnalysis();

        for ($i=0; $i < count($pathZip); $i++) {
            $resZip = $zip->open($pathZip[$i]);

            if ($resZip === TRUE) {
                $zip->extractTo($pathDirEx);
                $zip->close();
                unlink($pathZip[$i]);
                $start = microtime(true);
                $modelXmlAnalysis->importXml();
                echo $time = ((microtime(true) - $start) / 60) . "\n";
            }
        }
    }
}
?>