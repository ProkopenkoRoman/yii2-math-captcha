# yii2-math-captcha

[![Total Downloads](http://poser.pugx.org/long399/yii2-math-captcha/downloads)](https://packagist.org/packages/long399/yii2-math-captcha)
[![License](http://poser.pugx.org/long399/yii2-math-captcha/license)](https://packagist.org/packages/long399/yii2-math-captcha)

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
"long399/yii2-math-captcha": "~0.1"
```

to the require section of your `composer.json` file.

## Available operations
1) Addition.
2) Subtraction.
3) Multiplication.

Default addition or subtraction operation will be used randomly.

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

## Expressions with multiplication
If you want to use also expressions with a multiplication operation, then you need to set the **operations** property accordingly in the description of the action in the controller:
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
            'operations' => ['+', '-', '*'],
        ],
        ...
    ];
}
```

Three kinds of expressions can be generated:
1) Expression with multiplication.  
![Screenshot](https://www.cyberforum.ru/blog_attachment.php?attachmentid=7085&amp;d=1629172431 "Expression with multiplication")
2) Expression with multiplication and addition.  
![Screenshot](https://www.cyberforum.ru/blog_attachment.php?attachmentid=7086&amp;d=1629172431 "Expression with multiplication and addition")
3) Expression with multiplication and subtraction.  
![Screenshot](https://www.cyberforum.ru/blog_attachment.php?attachmentid=7087&amp;d=1629172431 "Expression with multiplication and subtraction")

## Author
[long399](https://github.com/ProkopenkoRoman/), e-mail: [long399@mail.ru](mailto:long399@mail.ru)
