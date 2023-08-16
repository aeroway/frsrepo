<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "xml_analysis_fns".
 *
 * @property int $id
 * @property string $kn
 * @property string $address
 * @property string $filename
 */
class XmlAnalysisFns extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xml_analysis_fns';
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
        $modelXmlAnalysisFns = new XmlAnalysisFns();
        $arKnAddressFilename = [];
        $arKnBuildFlats = [];

        foreach ($pathXml as $xml) {
            echo basename($xml) . ' - ';
            $xmlfile = file_get_contents($xml);
            $xmlob = (array)simplexml_load_string($xmlfile, 'SimpleXMLElement', LIBXML_COMPACT | LIBXML_PARSEHUGE);

            foreach ($xmlob as $el) {
                foreach ($el as $value) {
                    $flag = false;

                    if (is_object($value)) {
                        if (!empty((string)$value->СведПомещ["АдрРФТ"])) {
                            $knB = (string)$value->СведПомещ["КадастрНомЗд"];
                            $address = $this->addressClear((string)$value->СведПомещ["АдрРФТ"]);
                            $knA = (string)$value->СведПомещ["КадастНомПом"];
                            $knL = (string)$value->СведПомещ["КадастНомЗУ"];
                        }

                        if (!empty((string)$value->СведЗдание["АдрРФТ"])) {
                            $knB = (string)$value->СведЗдание["КадастНомЗд"];
                            $address = $this->addressClear((string)$value->СведЗдание["АдрРФТ"]);
                        }

                        if (!empty((string)$value->СведЗУ["АдрРФТ"])) {
                            $knB = (string)$value->СведЗУ["КадастНомЗУ"];
                            $address = $this->addressClear((string)$value->СведЗУ["АдрРФТ"]);
                        }

                        if (!empty($knB)) {
                            $arKnAddressFilename[] = [$knB, $address, basename($xml)];
                        }

                        if (!empty($knA)) {
                            $arKnAddressFilename[] = [$knA, $address, basename($xml)];
                        }

                        if (!empty($knL)) {
                            $arKnAddressFilename[] = [$knL, $address, basename($xml)];
                        }
                    }
                }
            }

            $modelXmlAnalysisFns->batchInsert('xml_analysis_fns', ['kn', 'address', 'filename'], $arKnAddressFilename);
            unlink($xml);
        }
    }

    private function addressClear($address) {
        return trim(str_replace('                    ', '', str_replace('&#x0d;                    ', '', $address)));;
    }
}
