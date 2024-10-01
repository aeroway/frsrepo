<?php

namespace backend\models;

use Yii;
use kartik\mpdf\Pdf;

/**
 * This is the model class for table "otcheterl".
 *
 * @property int $id
 * @property int|null $area_id
 * @property string|null $kuvd
 * @property string|null $application_date
 * @property string|null $kn
 * @property string|null $coordinates
 * @property string|null $address
 * @property string|null $draft_number
 * @property string|null $draft_date
 * @property string|null $outgoing_number
 * @property string|null $outgoing_date
 * @property string|null $fio_reg
 * @property string|null $email_reg
 * @property string|null $send
 *
 * @property Otcheterl $area
 * @property Otcheterl[] $otcheterls
 */
class Otcheterl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'otcheterl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['area_id', 'send'], 'integer'],
            [['kuvd', 'application_date', 'kn', 'draft_number', 'draft_date', 'fio_reg', 'coordinates', 'address', 'area_id', 'email_reg'], 'required'],
            ['email_reg', 'email'],
            [['application_date', 'draft_date', 'outgoing_date'], 'date', 'format' => 'php:Y-m-d'],
            [['kuvd'], 'string', 'max' => 60],
            [['kn', 'draft_number', 'outgoing_number', 'fio_reg', 'email_reg'], 'string', 'max' => 100],
            [['coordinates', 'address'], 'string', 'max' => 5000],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => AreaOtchet::className(), 'targetAttribute' => ['area_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area_id' => 'Тер. отдел',
            'kuvd' => '№ обращения',
            'application_date' => 'Дата обр.',
            'kn' => 'КН',
            'coordinates' => 'Координаты',
            'address' => 'Адрес',
            'draft_number' => '№ черн. в СЭД',
            'draft_date' => 'Дата черн.',
            'outgoing_number' => '№ исх.',
            'outgoing_date' => 'Дата исх.',
            'fio_reg' => 'ФИО регистратора',
            'email_reg' => 'e-mail рег.',
            'send' => 'Отпр.',
        ];
    }

    public function getPdfErl($model, $flag = 'I')
    {
        if (empty($model->id) || $model->id < 1) {
            return 0;
        }

        $content = '<table border="0"><tr><td style="text-align: center; 
            color:#4d83ba; font-family: \'Times New Roman\', Georgia, Times, serif; font-size: 10pt;">'
            . \Yii::$app->params['sendContentPdfPart1']
            . \Yii::$app->formatter->asDate($model->draft_date)
            .', '
            . $model->kuvd
            . ', в отношении объекта недвижимости с кадастровым номером: '
            . $model->kn
            . ', расположенного: '
            . $model->address
            . ', с координатами:</td></tr></table>'
			. $model->coordinates
			. '<table border="0">'            
            . str_replace("%kuvd%", $model->kuvd, \Yii::$app->params['sendContentPdfPart2'])
            . $model->fio_reg.'</td></tr></table>';

        $pdf = new Pdf(['marginTop' => 5]);
        $mpdf = $pdf->api;
        $mpdf->WriteHtml($content);
        echo $mpdf->Output(Yii::$app->params['sendMailErlPdfName'], $flag);

        return;
    }

    public function getSendStatus()
    {
        switch ($this->send) {
            case 1:
                return '<span class="glyphicon glyphicon-plus" title="Да"> </span>';
                break;
            case 0:
                return '<span class="glyphicon glyphicon-minus" title="Нет"> </span>';
                break;
            default:
                return '<span class="glyphicon glyphicon-minus" title="Нет"> </span>';
        }
    }

    public function sendMail()
    {
        $this->getPdfErl($this, 'F');
        $baseUrlFile = \Yii::$app->request->BaseUrl . Yii::$app->params['sendMailErlPdfName'];

        if (!file_exists($baseUrlFile)) {
            return false;
        }

        $send = Yii::$app->mailer->compose()
        ->setTo(Yii::$app->params['sendMailErlDaig'])
        ->setFrom($this->area->email)
        // ->setCc($this->email_reg)
        ->setSubject('Запрос o предоставлении сведений, содержащихся в правилах землепользования и застройки.')
        ->setHtmlBody(Yii::$app->params['sendMailErlDaigBody'])
        ->attach($baseUrlFile)
        ->send();

        unlink($baseUrlFile);
    }

    /**
     * Gets query for [[Area]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(AreaOtchet::className(), ['id' => 'area_id']);
    }

    /**
     * Gets query for [[Otcheterls]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOtcheterls()
    {
        return $this->hasMany(Otcheterl::class, ['area_id' => 'id']);
    }
}
