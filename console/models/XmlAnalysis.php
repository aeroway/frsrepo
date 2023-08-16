<?php

namespace console\models;

use Yii;
// use console\models\XmlAnalysisFlats;

/**
 * This is the model class for table "xml_analysis".
 *
 * @property int $id
 * @property string $kn
 * @property string $address
 * @property string $filename
 */
class XmlAnalysis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xml_analysis';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db10');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kn', 'address', 'filename'], 'required'],
            [['kn', 'filename'], 'string', 'max' => 150],
            [['address'], 'string', 'max' => 5000],
            [['kn', 'address', 'filename'], 'unique', 'targetAttribute' => ['kn', 'filename']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kn' => 'Kn',
            'address' => 'Address',
            'filename' => 'Filename',
        ];
    }

    private function batchInsert($table, $columns, $rows) {
        if (!empty($rows)) {
            $rows = array_chunk($rows, 5);

            for ($i = 0; $i < count($rows); $i++) {
                $sql = Yii::$app->db10->queryBuilder->batchInsert($table, $columns, $rows[$i]);
                Yii::$app->db10->createCommand($sql . ' ON CONFLICT ON CONSTRAINT ' . $table . '_kn_filename_key DO NOTHING; ')->execute();
            }
        }
    }

    public function importXml()
    {
        $pathDir = getcwd() . '/console/uploads/xml/';
        $pathXml = glob($pathDir . "*.*");
        $modelXmlAnalysis = new XmlAnalysis();
        $arKnAddressFilename = [];
        $arKnBuildFlats = [];

        foreach ($pathXml as $xml) {
            echo basename($xml) . ' - ';
            $xmlfile = file_get_contents($xml);
            $xmlob = (array)simplexml_load_string($xmlfile);

            if (empty($xmlob["Object"])) {
                if (empty($xmlob["Package"])) {
                    return 'error';
                }

                $xmlob["Object"] = $xmlob["Package"];
            }

            foreach ($xmlob["Object"] as $value) {
                $number = (array)$value->Number;

                if (empty($number)) {
                    $number = (array)$value;
                }

                if (!empty($value->Flat->Address->Note)) {
                    $address = (string)$value->Flat->Address->Note;
                } elseif(!empty($value->Complex_Realty->Address->Note)) {
                    $address = $value->Complex_Realty->Address->Note;
                } elseif (!empty($number["Flat"]->Location->Note)) {
                    $address = (string)$number["Flat"]->Location->Note;
                } elseif (!empty($number["Building"]->Location->Note)) {
                    $address = (string)$number["Building"]->Location->Note;
                } elseif (!empty($number["Construction"]->Location->Note)) {
                    $address = (string)$number["Construction"]->Location->Note;
                } else {
                    $address = '';
                }

                if (!empty($number["@attributes"]["CadastralNumber"])) {
                    $kn = $number["@attributes"]["CadastralNumber"];
                } elseif (!empty($number["@attributes"]["ConditionalNumber"])) {
                    $kn = $number["@attributes"]["ConditionalNumber"];
                } elseif (!empty($number["Flat"]->Number_Register->CadastralNumber)) {
                    $kn = (string)$number["Flat"]->Number_Register->CadastralNumber;
                } elseif (!empty($number["Building"]->Number_Register->CadastralNumber)) {
                    $kn = (string)$number["Building"]->Number_Register->CadastralNumber;
                    if (!empty($number["Building"]->Flats->CadastralNumber)) {
                        foreach ($number["Building"]->Flats->CadastralNumber as $kn_flats) {
                            $arKnBuildFlats[] = [$kn_flats, $address, strtolower(basename($xml))];
                        }
                    }
                } elseif (!empty($number["Construction"]->Number_Register->CadastralNumber)) {
                    $kn = (string)$number["Construction"]->Number_Register->CadastralNumber;
                }

                if (!empty($kn)) {
                    $arKnAddressFilename[] = [$kn, $address, strtolower(basename($xml))];
                }
            }

            $modelXmlAnalysis->batchInsert('xml_analysis', ['kn', 'address', 'filename'], $arKnBuildFlats);
            $modelXmlAnalysis->batchInsert('xml_analysis', ['kn', 'address', 'filename'], $arKnAddressFilename);

            unlink($xml);
        }
    }
}
