<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gzn_object".
 *
 * @property int $id
 * @property int $gzn_type_check_id
 * @property string $authoritie_check
 * @property string $kn
 * @property int $land_num
 * @property double $land_area
 * @property string $kn_cost
 * @property string $order_check
 * @property string $act_check
 * @property string $date_enforcement
 * @property string $land_category
 * @property string $requisites_land_user
 * @property string $address_land_plot
 * @property string $type_func_use
 * @property string $description_violation
 * @property string $full_name_inspector
 * @property int $land_category_id
 * @property int $land_user_category_id
 * @property int $area_id
 * @property int $success
 * @property int $checklist
 *
 * @property GznTypeCheck $gznTypeCheck
 * @property GznLandCategory $landCategory
 * @property GznLandUserCategory $landUserCategory
 * @property AreaOtchet $areaOtchet
 * @property GznViolations[] $gznViolations
 */
class GznObject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gzn_object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gzn_type_check_id', 'authoritie_check', 'kn', 'land_num', 'land_area', 'kn_cost', 'order_check', 'act_check', 'date_enforcement', 'address_land_plot', 'type_func_use', 'description_violation', 'full_name_inspector', 'land_category_id', 'land_user_category_id'], 'required'],
            [['gzn_type_check_id', 'land_num', 'land_category_id', 'land_user_category_id', 'area_id', 'success', 'checklist'], 'integer'],
            [['authoritie_check', 'kn', 'kn_cost', 'order_check', 'act_check', 'land_category', 'requisites_land_user', 'address_land_plot', 'type_func_use', 'description_violation', 'full_name_inspector'], 'string'],
            [['land_area'], 'double'],
            [['date_enforcement'], 'safe'],
            [['gzn_type_check_id'], 'exist', 'skipOnError' => true, 'targetClass' => GznTypeCheck::className(), 'targetAttribute' => ['gzn_type_check_id' => 'id']],
            [['land_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => GznLandCategory::className(), 'targetAttribute' => ['land_category_id' => 'id']],
            [['land_user_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => GznLandUserCategory::className(), 'targetAttribute' => ['land_user_category_id' => 'id']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => AreaOtchet::className(), 'targetAttribute' => ['area_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gzn_type_check_id' => 'Тип проверки',
            'area_id' => 'Район',
            'authoritie_check' => 'Орган проводивший проверку',
            'kn' => 'Кадастровый номер',
            'land_num' => 'Количество земельных участков',
            'success' => 'Результативность',
            'checklist' => 'Проверка внесена в ЕРП',
            'land_area' => 'S всего (кв.м.)',
            'kn_cost' => 'Кадастровая стоимость (тыс. руб.)',
            'order_check' => 'На основании',
            'act_check' => 'Наименование проверяемого лица',
            'date_enforcement' => 'Акт (проверки/обследования)',
            'land_category' => 'Распоряжение',
            'requisites_land_user' => 'Реквизиты и телефон землепользователя',
            'address_land_plot' => 'Адрес земельного участка',
            'type_func_use' => 'Вид функционального использования',
            'description_violation' => '№ административного дела',
            'full_name_inspector' => 'ФИО инспектора',
            'land_category_id' => 'Категория земель',
            'land_user_category_id' => 'Категория землепользователя',
        ];
    }

    public function getIconStatus()
    {
        switch ($this->success) {
            case 1:
                return '<span class="glyphicon glyphicon-ok" title="Результативный"> </span>';
                break;
            default:
                return '<span class="glyphicon glyphicon-remove" title="Нерезультативный"> </span>';
        }
    }

    public function getIconСhecklist()
    {
        switch ($this->checklist) {
            case 1:
                return '<span class="glyphicon glyphicon-ok" title="Проверка внесена в ЕРП"> </span>';
                break;
            default:
                return '<span class="glyphicon glyphicon-remove" title="Проверка не внесена в ЕРП"> </span>';
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGznTypeCheckName()
    {
        return $this->gznTypeCheck->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreaOtchetName()
    {
        return empty($this->areaOtchet->name) ? '' : str_replace(' отдел', '', $this->areaOtchet->name);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGznTypeCheck()
    {
        return $this->hasOne(GznTypeCheck::className(), ['id' => 'gzn_type_check_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLandCategory()
    {
        return $this->hasOne(GznLandCategory::className(), ['id' => 'land_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLandUserCategory()
    {
        return $this->hasOne(GznLandUserCategory::className(), ['id' => 'land_user_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGznViolations()
    {
        return $this->hasMany(GznViolations::className(), ['gzn_obj_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreaOtchet()
    {
        return $this->hasOne(AreaOtchet::className(), ['id' => 'area_id']);
    }
}
