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
        // Enable user error handling
        libxml_use_internal_errors(true);

        $pathDir = getcwd() . '/console/uploads/xml-fns/';
        $pathXml = glob($pathDir . "*.*");

        foreach ($pathXml as $xml) {
            $xmlDoc = new \DOMDocument('1.0');
            $xmlDoc->preserveWhiteSpace = false;
            $xmlDoc->formatOutput = true;
            $xmlDoc->load($xml, LIBXML_BIGLINES);
            $xmlDoc->save($xml);

            $xmlDoc = new \DOMDocument();
            $xmlDoc->load($xml, LIBXML_BIGLINES);

            if (!$xmlDoc->schemaValidate('console/uploads/schema_validate_223001040800.xsd')) {
                $this->libxml_display_errors($xml);
            }
        }
    }

    public function libxml_display_errors($pathFile) {
        $errors = libxml_get_errors();
        $lines = file($pathFile);
        $flag = 0;
        $posStart = false;
        // $localConcatTextNameDocsAttribute = "\n" . basename($pathFile);
        $result = [];

        for ($y=0; $y < count($errors); $y++) {
            // $localConcatTextNameDocsAttribute .= "\n" . 'Ошибка #' . $y+1 . ' из ' . count($errors) . "\n";
            // $localConcatTextNameDocsAttribute .= $errors[$y]->message;
            $result[$y]['xml'] = basename($pathFile);
            $result[$y]['error'] = $errors[$y]->message;

            if ($y === 1 && $errors[$y] == $errors[$y-1]) {
                echo 'Error 2';
                continue;
            }

            $posNumReg = false;

            if (strpos($errors[$y]->message, 'ВерсФорм') !== false) {
                echo $errors[$y]->message;
                die;
            }

            for ($i3=$errors[$y]->line; $i3 >= 0; $i3--) {
                $posStart = strpos(mb_convert_encoding($lines[$i3], "UTF-8", "Windows-1251"), '<Документ ');

                $strLine = mb_convert_encoding($lines[$i3], "UTF-8", "Windows-1251");
                $posKadastNomZU = strpos($strLine, 'КадастНомЗУ');
                if ($posKadastNomZU !== false) {
                    $firstQuoteKadastNomZU = strpos($strLine, '"', $posKadastNomZU);
                    $secondQuoteKadastNomZU = strpos($strLine, '"', $firstQuoteKadastNomZU+1);
                    $substrKadastNomZU = substr($strLine, $firstQuoteKadastNomZU+1, $secondQuoteKadastNomZU-$firstQuoteKadastNomZU-1);
                    // $localConcatTextNameDocsAttribute .= 'КадастНомЗУ: ';
                    // $localConcatTextNameDocsAttribute .= preg_replace("/[^0-9:]/", "", $substrKadastNomZU) . "\n";
                    $result[$y]['КадастНомЗУ'] = preg_replace("/[^0-9:]/", "", $substrKadastNomZU);
                    
                }

                $posKadastNomZd = strpos($strLine, 'КадастНомЗд');
                if ($posKadastNomZd !== false) {
                    $firstQuoteKadastNomZd = strpos($strLine, '"', $posKadastNomZd);
                    $secondQuoteKadastNomZd = strpos($strLine, '"', $firstQuoteKadastNomZd+1);
                    // $localConcatTextNameDocsAttribute .= 'КадастНомЗд: ';
                    // $localConcatTextNameDocsAttribute .= substr($strLine, $firstQuoteKadastNomZd+1, $secondQuoteKadastNomZd-$firstQuoteKadastNomZd-1) . "\n";
                    $result[$y]['КадастНомЗд'] = substr($strLine, $firstQuoteKadastNomZd+1, $secondQuoteKadastNomZd-$firstQuoteKadastNomZd-1);
                }

                $posKadastNomPom = strpos($strLine, 'КадастНомПом');
                if ($posKadastNomPom !== false) {
                    $firstQuoteKadastNomPom = strpos($strLine, '"', $posKadastNomPom);
                    $secondQuoteKadastNomPom = strpos($strLine, '"', $firstQuoteKadastNomPom+1);
                    // $localConcatTextNameDocsAttribute .= 'КадастНомПом: ';
                    // $localConcatTextNameDocsAttribute .= substr($strLine, $firstQuoteKadastNomPom+1, $secondQuoteKadastNomPom-$firstQuoteKadastNomPom-1) . "\n";
                    $result[$y]['КадастНомПом'] = substr($strLine, $firstQuoteKadastNomPom+1, $secondQuoteKadastNomPom-$firstQuoteKadastNomPom-1);
                }

                $posKadastNomReg = strpos($strLine, 'НомРег');
                if ($posKadastNomReg !== false && $flag == 0) {
                    $firstQuoteKadastNomReg = strpos($strLine, '"', $posKadastNomReg);
                    $secondQuoteKadastNomReg = strpos($strLine, '"', $firstQuoteKadastNomReg+1);
                    // $localConcatTextNameDocsAttribute .= 'НомРег: ';
                    // $localConcatTextNameDocsAttribute .= substr($strLine, $firstQuoteKadastNomReg+1, $secondQuoteKadastNomReg-$firstQuoteKadastNomReg-1) . "\n";
                    $flag++;
                    $result[$y]['НомРег'] = substr($strLine, $firstQuoteKadastNomReg+1, $secondQuoteKadastNomReg-$firstQuoteKadastNomReg-1);
                }

                if ($posStart) {
                    $flag = 0;
                    break;
                }
            }
        }

        // echo $localConcatTextNameDocsAttribute;


        foreach ($result as $v) {
            echo $v['xml'] . ';"';
            echo trim($v['error']) . '";';

            if (!empty($v['КадастНомПом'])) {
                echo $v['КадастНомПом'] . ";";
            } elseif (!empty($v['КадастНомЗд'])) {
                echo $v['КадастНомЗд'] . ";";
            } elseif (!empty($v['КадастНомЗУ'])) {
                echo $v['КадастНомЗУ'] . ";";
            } else {
                echo 'Нет данных' . ";";
            }

            if (!empty($v['НомРег'])) {
                echo $v['НомРег'] . "";
            }

            echo  "\n";
        }

        libxml_clear_errors();
    }
}
?>