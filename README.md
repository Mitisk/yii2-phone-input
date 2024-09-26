## Установка

Запустить

```
$ composer require Mitisk/Yii2PhoneInput
```

или добавить в композер `composer.json` в секцию ```require```:

```
"Mitisk/Yii2PhoneInput": "dev-master"
```

## Использование

```php
// add this in your view
use Mitisk\Yii2PhoneInput\PhoneInput;

$form = ActiveForm::begin(['id' => 'login-form']);

echo $form->field($model, 'phone')->widget(PhoneInput::classname(), [
    'pluginOptions' => [
    ]
]);
```