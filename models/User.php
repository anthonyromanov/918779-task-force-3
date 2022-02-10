<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $registration
 * @property string $name
 * @property string|null $birthday
 * @property string|null $avatar
 * @property string|null $phone
 * @property string $email
 * @property string|null $telegram
 * @property int|null $rating
 * @property string|null $characteristic
 * @property int $city_id
 * @property string|null $specialty
 * @property string|null $role
 * @property string|null $token
 * @property string $password
 *
 * @property City $city
 * @property Response[] $responses
 * @property Review[] $reviews
 * @property Task[] $tasks
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['registration', 'birthday'], 'safe'],
            [['name', 'email', 'city_id', 'password'], 'required'],
            [['rating', 'city_id'], 'integer'],
            [['characteristic', 'role', 'token'], 'string'],
            [['name', 'email'], 'string', 'max' => 128],
            [['avatar', 'specialty', 'password'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 11],
            [['telegram'], 'string', 'max' => 64],
            [['email'], 'unique'],
            [['phone'], 'unique'],
            [['telegram'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'registration' => 'Registration',
            'name' => 'Name',
            'birthday' => 'Birthday',
            'avatar' => 'Avatar',
            'phone' => 'Phone',
            'email' => 'Email',
            'telegram' => 'Telegram',
            'rating' => 'Rating',
            'characteristic' => 'Characteristic',
            'city_id' => 'City ID',
            'specialty' => 'Specialty',
            'role' => 'Role',
            'token' => 'Token',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Response::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['user_id' => 'id']);
    }
}
