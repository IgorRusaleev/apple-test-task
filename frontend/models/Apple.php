<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\Expression;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property int|null $colour
 * @property string $dt_add
 * @property string|null $dt_fall
 * @property int|null $status
 * @property int|null $size
 *
 * @property string $statusTitle
 */
class Apple extends ActiveRecord
{
    /**
     * константы статусов яблок
     */
    const STATUS_HANGING = 1; //статус висит на дереве
    const STATUS_FALL = 2; //статус упало - лежит на земле
    const STATUS_ROTTEN = 3; //статус сгнившего яблока

    /**
     * массив цветов яблок
     */
    private const COLOUR_LIST = [
        'зеленое',
        'желтое',
        'белое',
        'розовое',
        'красное',
        'бордовое',
        'черное',
        'коричневое',
        'малиновое',
        'золотистое',
        'серебристое',
        'безцветное',
    ];

    /**
     * карта статусов яблок
     */
    private const STATUS_MAP = [
        self::STATUS_HANGING => 'Висит',
        self::STATUS_FALL => 'Упало',
        self::STATUS_ROTTEN => 'Сгнило',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['colour'], 'string'],
            [['status', 'size'], 'integer'],
            [['dt_add', 'dt_fall'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'colour' => 'Цвет',
            'dt_add' => 'Дата создания',
            'dt_fall' => 'Дата падения',
            'status' => 'Статус',
            'size' => 'Размер',
        ];
    }

    /**
     * метод для генерации случайного колличества яблок (от 1 до 10)
     * случайного цвета (из массива цветов яблок)
     */
    public static function create(): void
    {
        $rand = rand(1, 10);
        for ($i = 1; $i <= $rand; $i++) {
            $model = new static();
            $model->colour = self::COLOUR_LIST[array_rand(self::COLOUR_LIST)];
            $model->status = Apple::STATUS_HANGING;
            $model->size = 100;

            $model->save();
        }
    }

    /**
     * метод для действия: падение яблока
     * @throws \Exception
     */
    public function fallToGround(): void
    {
        if ((int) $this->status !== self::STATUS_HANGING) {
            throw new Exception('Недопустимый статус яблока');
        }

        $this->updateAttributes([
            'status' => self::STATUS_FALL,
            'dt_fall' => new Expression('NOW()'),
        ]);
    }

    /**
     * метод для действия: съесть яблоко
     * @param int $size размер яблока
     * @throws \Exception
     */
    public function eat(int $size): void
    {
        if ((int) $this->status !== self::STATUS_FALL) {
            throw new \Exception('Недопустимый статус яблока');
        }

        if ($size < 0) {
            throw new \Exception('Недопустимый размер яблока');
        }

        $this->size -= min($size, $this->size);
        $this->save();
    }

    /**
     * @return string
     */
    public function getStatusTitle(): string
    {
        return self::STATUS_MAP[$this->status] ?? 'Неизвестный статус';
    }
}
