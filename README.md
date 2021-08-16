# yii2-math-captcha

MathCaptchaAction for Yii Framework 2.0

![Screenshot](https://www.cyberforum.ru/blog_attachment.php?attachmentid=7084&amp;d=1629088989 "Screenshot")

## Installation
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).
Either run

```
 composer require --prefer-dist long399/yii2-math-captcha
```

or add

```json
"long399/yii2-math-captcha": "dev-main"
```

to the require section of your `composer.json` file.

## Available operations
1) Subtraction.
2) Addition.

Default, one of these operations will be used randomly.

## Usage
controller:
```php
public function actions()
{
    return [
        ...
        'captcha' => [
            'class' => \long399\captcha\MathCaptchaAction::class,
            'fixedVerifyCode' => YII_ENV_TEST ? '399' : null,
            'minLength' => 0,
            'maxLength' => 1000,
        ],
        ...
    ];
}
```

model:
```php
class MyModel extends \yii\db\ActiveRecord
{
    public $captcha;
    ...
    public function rules()
    {
        return [
            ...
            ['captcha', 'captcha', 'captchaAction' => '/site/captcha'],
            ...
        ];
    }
    ...
}
```

view:
```php
...
echo $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::class, [
    'captchaAction' => "/site/captcha",
    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
]);
...
```

If you want to use only expressions with a subtraction operation e.g., then you need to set the **operations** property accordingly in the description of the action in the controller:
```php
public function actions()
{
    return [
        ...
        'captcha' => [
            'class' => \app\components\actions\MathCaptchaAction::class,
            'fixedVerifyCode' => YII_ENV_TEST ? '399' : null,
            'minLength' => 0,
            'maxLength' => 1000,
            'operations' => ['-'],
        ],
        ...
    ];
}
```

## Author
[long399](https://github.com/ProkopenkoRoman/), e-mail: [long399@mail.ru](mailto:long399@mail.ru)
