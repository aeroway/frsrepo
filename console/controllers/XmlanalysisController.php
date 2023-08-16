<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use console\models\XmlAnalysis;
use console\models\XmlAnalysisFns;

class XmlanalysisController extends Controller
{
    public function actionUpload($fns = 0) {
        $zip = new \ZipArchive;
        $pathDir = getcwd() . '/console/uploads/';
        $pathDirEx = getcwd() . '/console/uploads/xml/';
        $pathZip = glob($pathDir . "*.zip");
        $modelXmlAnalysis = $fns ? new XmlAnalysisFns() : new XmlAnalysis();

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

    public function actionFnsCheck()
    {
        function libxml_display_errors($pathFile) {
            $errors = libxml_get_errors();
            $lines = file($pathFile);
            $errorLine = false;
            $flag = 0;
            $wStart = false;
            $wStop = false;

            for ($y=0; $y < count($errors); $y++) {
                if ($y === 1 && $errors[$y] == $errors[$y-1]) {
                    break;
                }

                $line = mb_convert_encoding($lines[$errors[$y]->line-1], "UTF-8", "Windows-1251");

                $posNumReg = false;
                $posAttribute = false;
                $posAttributeValue = false;
                $posDocInLineFirst = false;
                $posknInLineFirts = false;
                $posNameDocInLineFirst = false;
                $isCountLimitDocSearch = false;
                $posAttribute = strpos($errors[$y]->message, 'attribute');
                $posAttributeValue = strpos($errors[$y]->message, 'value');

                if ($posAttribute) {
                    $wStart = false;
                    $wStop = false;

                    if (strpos($errors[$y]->message, 'ВерсФорм') !== false) {
                        echo $errors[$y]->message;
                        die;
                    }

                    for ($w1=$errors[$y]->line; $w1 < count($lines)-1 ; $w1--) {
                        $posSvPravFirst = strpos(mb_convert_encoding($lines[$w1], "UTF-8", "Windows-1251"), 'Прав ');
                        $posDocFirst = strpos(mb_convert_encoding($lines[$w1], "UTF-8", "Windows-1251"), '<Документ ');

                        if ($posSvPravFirst !== false || $posDocFirst !== false) {
                            $wStart = $w1;
                            break;
                        }
                    }

                    for ($w2=$errors[$y]->line; $w2 < count($lines)-1 ; $w2++) {
                        $posSvPravSecond = strpos(mb_convert_encoding($lines[$w2], "UTF-8", "Windows-1251"), 'Прав>');
                        $posDocSecond = strpos(mb_convert_encoding($lines[$w2], "UTF-8", "Windows-1251"), '</Документ>');

                        if ($posSvPravSecond !== false || $posDocSecond !== false) {
                            $wStop = $w2;
                            break;
                        }
                    }
                }

                if ($y > 0 && ($errors[$y]->line - $errors[$y-1]->line) > 10) {
                    $flag = 0;
                }

                $localConcatTextNameDocsAttribute = "";
                if ($errors[$y]->line > $wStart && $errors[$y]->line <= $wStop && $flag === 0) {
                    $localConcatTextNameDocsAttribute .= "\n\r--------------\n\r";
                    $localConcatTextNameDocsAttribute .= $errors[$y]->message;
                    $localConcatTextNameDocsAttribute .= "--------------\n\r";

                    $newLine = '';
                    for ($a=$wStart; $a < $wStop; $a++) { 
                        $newLine .= mb_convert_encoding($lines[$a], "UTF-8", "Windows-1251") . "\n\r";
                    }

                    $flag = 1;

                    $posNumReg = strpos($newLine, 'НомРег');
                    if ($posNumReg !== false) {
                        $firstQuoteNumReg = strpos($newLine, '"', $posNumReg);
                        $secondQuoteNumReg = strpos($newLine, '"', $firstQuoteNumReg+1);
                        $localConcatTextNameDocsAttribute .=  'НомРег: ';
                        $localConcatTextNameDocsAttribute .= substr($newLine, $firstQuoteNumReg+1, $secondQuoteNumReg-$firstQuoteNumReg-1) . "\n\r";
                    }
                }

                $posNameDoc = strpos($line, 'НаимПравДок');
                if ($posNameDoc !== false) {
                    $firstQuoteNamePravDoc = strpos($line, '"', $posNameDoc);
                    $secondQuoteNamePravDoc = strpos($line, '"', $firstQuoteNamePravDoc+1);
                    $localConcatTextNameDocsAttribute .= "\n\r" . 'НаимПравДок: ';
                    $localConcatTextNameDocsAttribute .= substr($line, $firstQuoteNamePravDoc+1, $secondQuoteNamePravDoc-$firstQuoteNamePravDoc-1) . "\n\r";
                }

                echo $localConcatTextNameDocsAttribute;
            }

            libxml_clear_errors();
        }

        // Enable user error handling
        libxml_use_internal_errors(true);

        $pathDir = getcwd() . '/console/uploads/xml-fns/';
        $pathXml = glob($pathDir . "*.*");

        foreach ($pathXml as $xml) {
            $xmlDoc = new \DOMDocument('1.0');
            $xmlDoc->preserveWhiteSpace = false;
            $xmlDoc->formatOutput = true;
            $xmlDoc->load($xml);
            $xmlDoc->save($xml);

            $xmlDoc = new \DOMDocument();
            $xmlDoc->load($xml);

            if (!$xmlDoc->schemaValidate('console/uploads/schema_validate_223001040800.xsd')) {
                libxml_display_errors($xml);
            }
        }
    }
}
?>