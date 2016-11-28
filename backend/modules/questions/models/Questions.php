<?php

namespace backend\modules\questions\models;

use Yii;

/**
 * This is the model class for table "questions".
 *
 * @property integer $id
 * @property string $question
 * @property string $answer
 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'answer'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Вопрос',
            'answer' => 'Ответ',
        ];
    }

    public function searchQuestions()
    {
        $word = Yii::$app->request->post("search");
        $pattern = "/($word)+/iu";

        $replacement = '<span class="highlight">' . Yii::$app->request->post("search") . '</span>';

        $data = Questions::find()
                    ->select(['question', 'answer'])
                    ->where(['like', 'answer', Yii::$app->request->post('search')])
                    ->asArray()
                    ->all();

        $result = '<h4 align="center">Результат поиска</h4>';
        $result .=  '<div class="table-responsive"><table class="tquestions table bordered">';

        foreach($data as $value)
        {
            $subject = $value["answer"];

            $result .= '<tr>
                            <td>' . $value["question"] . ': ' . preg_replace($pattern, $replacement, $subject) . '</td>
                        </tr>';
        }

        if(empty($data)) { $result .= '<p>Не найдено.</p>'; }

        $result .= '</table></div>';

        return $result;
    }
}
