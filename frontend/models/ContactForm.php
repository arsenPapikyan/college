<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $body;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email',  'body'], 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        $content ="Эл. почта:".$this->email."<br />".
            "Имя: " .'<b>'. $this->name.'</b>' . '<br>'.
            "<h3>Суть контакта</h3>".'<b>'.$this->body.'<b>';
        return Yii::$app->mailer->compose( ['text' => 'contact','html'=> 'contact'], ['content' => $content])
            ->setTo($email)
            ->setFrom($this->email)
//            ->setSubject($this->subject)
//            ->setTextBody($content)
            ->send();
    }
}
