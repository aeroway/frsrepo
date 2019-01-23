<?php

namespace backend\models;

use Yii;

use yii\helpers\Html;

/**
 * This is the model class for table "otchet_list".
 *
 * @property integer $id
 * @property string $name_list
 * @property string $table_list
 * @property integer $status_list
 * @property string $description_list
 */
class OtchetList extends \yii\db\ActiveRecord
{
    public $statistic_list;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otchet_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_list', 'table_list', 'description_list', 'statistic_list'], 'string'],
            [['status_list'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_list' => 'Название',
            'table_list' => 'Таблица в БД',
            'status_list' => 'Активность',
            'description_list' => 'Описание',
            'statistic_list' => 'Статистика',
        ];
    }

    public function getStatusOtchetlist($table)
    {
        //if($table == 'otchet39')
            //return Html::a('Статистика', ['otchetlist/statx', 'tblname' => $table], ['target'=>'_blank']);

        if($table == 'otchetn')
            $controller = 'otchetn';
        elseif($table == 'otchet_pay')
            $controller = 'otchet-pay';
        elseif($table == 'otchetur' || $table == 'otchet999')
            $controller = 'otchetur';
        elseif($table == 'otchetfiz')
            $controller = 'otchetfiz';
        else 
            $controller = 'otchett';


        /* Исправлен */

        $rows = (new \yii\db\Query())
            ->select('COUNT(*)')
            ->from("$table")
            ->where(['status' => 'Исправлен'])
            ->all();

        foreach($rows[0] as $otchetStatus0) {}


        /* Невозможно исправить */

        $rows = (new \yii\db\Query())
            ->select('COUNT(*)')
            ->from("$table")
            ->where(['status' => 'Невозможно исправить'])
            ->all();

        foreach($rows[0] as $otchetStatus1) {}


        /* не назначено */

        $rows = (new \yii\db\Query())
            ->select('COUNT(*)')
            ->from("$table")
            ->where(['or', 'status=null', 'status=\'не назначено\''])
            ->all();

        foreach($rows[0] as $otchetNull) {}


        /* назначено */

        $rows = (new \yii\db\Query())
            ->select('COUNT(*)')
            ->from("$table")
            ->where(['status' => 'назначено'])
            ->all();

        foreach($rows[0] as $otchetNazn) {}


        /* Повторные ошибки */

        $rows = (new \yii\db\Query())
            ->select('COUNT(*)')
            ->from("$table")
            ->where(['flag' => '1'])
            ->all();

        foreach($rows[0] as $otchetRepeat) {}


        /* В работе */

        $rows = (new \yii\db\Query())
            ->select('COUNT(*)')
            ->from("$table")
            ->where(['status' => 'В работе'])
            ->all();

        foreach($rows[0] as $otchetWork) {}


        /* Всего */

        $rows = (new \yii\db\Query())
            ->select('COUNT(*)')
            ->from("$table")
            ->all();

        foreach($rows[0] as $otchetSum) {}

        $lcl_echo;
        $lcl_echo = "<b>исправлен</b>: $otchetStatus0<br>";
        $lcl_echo .= "<b>невозможно исправить</b>: $otchetStatus1<br>";

        if($controller === 'otchet-pay')
            $cont = 'OtchetPay';
        else
            $cont = ucfirst($controller);

        if($otchetNull != 0)
        {
            $lcl_echo .= "<b><a style='color: orange' href='/backend/index.php?" . $cont . "Search[status]=не+назначено&r=$controller/index&table=$table'>не назначено</a></b>: $otchetNull<br>";
        }

        if($otchetNazn != 0)
        {
            $lcl_echo .= "<b><a style='color: green' href='/backend/index.php?" . $cont . "Search[status]=назначено&r=$controller/index&table=$table'>назначено</a></b>: $otchetNazn<br>";
        }

        if($otchetRepeat != 0)
        {
            $lcl_echo .= "<b><a style='color: red' href='/backend/index.php?" . $cont . "Search[flag]=1&r=$controller/index&table=$table'>повторные ошибки</a></b>: $otchetRepeat<br>";
        }

        if($otchetWork != 0)
        {
            $lcl_echo .= "<b><a href='?r=$controller/indexstat&table=$table'>в работе</a>:</b> $otchetWork<br>";
        }
        $lcl_echo .= "<br><p><b>Всего:</b> $otchetSum</p>";

        if($table <> 'otchet_pay' && $table <> 'otchet999')
            $lcl_echo .= Html::a('Статистика', ['otchetlist/statx', 'tblname' => $table], ['target'=>'_blank']);

        if($table == 'otchet39' || $table == 'otchet41' || $table == 'otchet42')
            $lcl_echo .= "<p>" . Html::a('Статистика за период', ['otchetlist/stat-index', 'tblname' => $table], ['target'=>'_blank']) . "</p>";

        return $lcl_echo;
    }

    public function getAltArea ($table, $area)
    {
        $localVarOut = '';

        $rowsaltarea = (new \yii\db\Query())
            ->select(["$area"])
            ->from("$table")
            ->distinct()
            ->orderBy(["$area" => SORT_ASC])
            ->all();

        for($i=0; $i < count($rowsaltarea);$i++)
        {
            $rowsaltareares = (new \yii\db\Query())
                ->select('COUNT(*)')
                ->from("$table")
                ->where(['or', ['and', 'status=null', ["$area" => $rowsaltarea[$i]["$area"]]], ['and', 'status=\'не назначено\'', ["$area" => $rowsaltarea[$i]["$area"]]]])
                ->all();
            if($rowsaltareares[0][''] > 0)
            {
                $localVarOut .= '<span class="label label-default">' . $rowsaltareares[0][''] . ' - ' . $rowsaltarea[$i]["$area"] . '</span>' . ' ';
            }
        }

        return $localVarOut;
    }

    public function getArea($table)
    {
        $area["23:01"] = "Абинск";
        $area["23:02"] = "Апшеронск";
        $area["23:03"] = "Белая глина";
        $area["23:04"] = "Брюховецкая";
        $area["23:05"] = "Выселки";
        $area["23:06"] = "Гулькевичи";
        $area["23:07"] = "Динская";
        $area["23:08"] = "Ейск";
        $area["23:09"] = "Кавказская";
        $area["23:10"] = "Калининская";
        $area["23:11"] = "Каневская";
        $area["23:12"] = "Кореновск";
        $area["23:13"] = "Красноармейская";
        $area["23:14"] = "Крыловская";
        $area["23:15"] = "Крымск";
        $area["23:16"] = "Курганинск";
        $area["23:17"] = "Кущевская";
        $area["23:18"] = "Лабинск";
        $area["23:19"] = "Ленинградская";
        $area["23:20"] = "Мостовская";
        $area["23:21"] = "Новокубанск";
        $area["23:22"] = "Новопокровская";
        $area["23:23"] = "Отрадная";
        $area["23:24"] = "Павловская";
        $area["23:25"] = "Приморско-Ахтарск";
        $area["23:26"] = "Северская";
        $area["23:27"] = "Славянск-на-Кубани";
        $area["23:28"] = "Староминская";
        $area["23:29"] = "Тбилисская";
        $area["23:30"] = "Темрюк";
        $area["23:31"] = "Тимашевск";
        $area["23:32"] = "Тихорецк - район";
        $area["23:33"] = "Туапсе";
        $area["23:34"] = "Успенская";
        $area["23:35"] = "Усть-Лабинск";
        $area["23:36"] = "Щербиновская";
        $area["23:37"] = "Анапа";
        $area["23:38"] = "Армавир";
        $area["23:39"] = "Белореченск";
        $area["23:40"] = "Геленджик";
        $area["23:41"] = "Горячий ключ";
        $area["23:42"] = "Ейск";
        $area["23:43"] = "Краснодар";
        $area["23:44"] = "Кропоткин";
        $area["23:45"] = "Крымск";
        $area["23:46"] = "Лабинск";
        $area["23:47"] = "Новороссийск";
        $area["23:48"] = "Славянск-на-Кубани";
        $area["23:49"] = "Сочи";
        $area["23:50"] = "Тихорецк - город";
        $area["23:51"] = "Туапсе";

        $localVarOut = '';

        for($i=1; $i <= count($area); $i++)
        {
            if($i < 10)    {
                $areaquery = '23:0' . "$i" . ':%';
                $areanum = '23:0' . "$i";
            } else {
                $areaquery = '23:' . "$i" . ':%';
                $areanum = '23:' . "$i";
            }

            $rowsarea = (new \yii\db\Query())
                ->select('COUNT(*)')
                ->from("$table")
                ->where(['or', ['and', 'status=null', ['like', 'kn', "$areaquery", false]], ['and', 'status=\'не назначено\'', ['like', 'kn', "$areaquery", false]]])
                ->all();

            if($rowsarea[0][''] != '0')
            {
                $localVarOut .= '<span class="label label-default">' . $rowsarea[0][''] . ' - ' . $area["$areanum"] . '</span>' . ' ';
            }
        }

        return $localVarOut;
    }

    /* ***************************** */

    public function getAltAreaa($table, $area)
    {
        $localVarOut = '';

        $rowsaltarea = (new \yii\db\Query())
            ->select(["$area"])
            ->from("$table")
            ->distinct()
            ->orderBy(["$area" => SORT_ASC])
            ->all();

        $localVarOut = '<table cellpadding="7" border="2">';
        $localVarOut .= '<head><tr><td><b>Отдел</b></td><td><b>Кол-во</b></td></tr></head>';
        $localVarOut .= '<body>';

        for($i=0; $i < count($rowsaltarea);$i++)
        {
            $rowsaltareares = (new \yii\db\Query())
                ->select('COUNT(*)')
                ->from("$table")
                //->where(['or', ['and', 'status=null', ["$area" => $rowsaltarea[$i]["$area"]]], ['and', 'status=\'не назначено\'', ["$area" => $rowsaltarea[$i]["$area"]]]])
                ->where(['and', ['and', 'status!=\'исправлен\'', ["$area" => $rowsaltarea[$i]["$area"]]], ['and', 'status!=\'невозможно исправить\'', ["$area" => $rowsaltarea[$i]["$area"]]]])
                ->all();

            $localVarOut .= '<tr>';
            $localVarOut .= '<td>' . $rowsaltarea[$i]["$area"] . '</td><td>' . $rowsaltareares[0][''] . '</td>';
            $localVarOut .= '</tr>';
        }

        $localVarOut .= '</body>';
        $localVarOut .= '</table>';

        return $localVarOut;
    }

    public function getAreaa($table)
    {
        $area["23:01"] = "Абинск";
        $area["23:02"] = "Апшеронск";
        $area["23:03"] = "Белая глина";
        $area["23:04"] = "Брюховецкая";
        $area["23:05"] = "Выселки";
        $area["23:06"] = "Гулькевичи";
        $area["23:07"] = "Динская";
        $area["23:08"] = "Ейск";
        $area["23:09"] = "Кавказская";
        $area["23:10"] = "Калининская";
        $area["23:11"] = "Каневская";
        $area["23:12"] = "Кореновск";
        $area["23:13"] = "Красноармейская";
        $area["23:14"] = "Крыловская";
        $area["23:15"] = "Крымск";
        $area["23:16"] = "Курганинск";
        $area["23:17"] = "Кущевская";
        $area["23:18"] = "Лабинск";
        $area["23:19"] = "Ленинградская";
        $area["23:20"] = "Мостовская";
        $area["23:21"] = "Новокубанск";
        $area["23:22"] = "Новопокровская";
        $area["23:23"] = "Отрадная";
        $area["23:24"] = "Павловская";
        $area["23:25"] = "Приморско-Ахтарск";
        $area["23:26"] = "Северская";
        $area["23:27"] = "Славянск-на-Кубани";
        $area["23:28"] = "Староминская";
        $area["23:29"] = "Тбилисская";
        $area["23:30"] = "Темрюк";
        $area["23:31"] = "Тимашевск";
        $area["23:32"] = "Тихорецк - район";
        $area["23:33"] = "Туапсе";
        $area["23:34"] = "Успенская";
        $area["23:35"] = "Усть-Лабинск";
        $area["23:36"] = "Щербиновская";
        $area["23:37"] = "Анапа";
        $area["23:38"] = "Армавир";
        $area["23:39"] = "Белореченск";
        $area["23:40"] = "Геленджик";
        $area["23:41"] = "Горячий ключ";
        $area["23:42"] = "Ейск";
        $area["23:43"] = "Краснодар";
        $area["23:44"] = "Кропоткин";
        $area["23:45"] = "Крымск";
        $area["23:46"] = "Лабинск";
        $area["23:47"] = "Новороссийск";
        $area["23:48"] = "Славянск-на-Кубани";
        $area["23:49"] = "Сочи";
        $area["23:50"] = "Тихорецк - город";
        $area["23:51"] = "Туапсе";

        $localVarOut = '';

        $localVarOut = '<table cellpadding="7" border="2">';
        $localVarOut .= '<head><tr><td><b>Отдел</b></td><td><b>Кол-во</b></td><td><b>Квартал</b></td></tr></head>';
        $localVarOut .= '<body>';

        for($i=1; $i <= count($area); $i++)
        {
            if($i < 10)    {
                $areaquery = '23:0' . "$i" . ':%';
                $areanum = '23:0' . "$i";
            } else {
                $areaquery = '23:' . "$i" . ':%';
                $areanum = '23:' . "$i";
            }

            $rowsarea = (new \yii\db\Query())
                ->select('COUNT(*)')
                ->from("$table")
                //->where(['or', ['and', 'status=null', ['like', 'kn', "$areaquery", false]], ['and', 'status=\'не назначено\'', ['like', 'kn', "$areaquery", false]]])
                ->where(['and', ['and', 'status!=\'исправлен\'', ['like', 'kn', "$areaquery", false]], ['and', 'status!=\'невозможно исправить\'', ['like', 'kn', "$areaquery", false]]])
                ->all();

            $localVarOut .= '<tr><td>' . $area["$areanum"] . '</td><td>' . $rowsarea[0][''] . '</td><td>' . $areanum . '</td></tr>';

        }

        $localVarOut .= '</body>';
        $localVarOut .= '</table>';

        return $localVarOut;
    }
}
