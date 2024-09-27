[![Stable Version](https://poser.pugx.org/mitisk/yii2-phone-input/v/stable)](https://packagist.org/packages/mitisk/yii2-phone-input)
[![License](https://poser.pugx.org/mitisk/yii2-phone-input/license)](https://packagist.org/packages/mitisk/yii2-phone-input)
[![Total Downloads](https://poser.pugx.org/mitisk/yii2-phone-input/downloads)](https://packagist.org/packages/mitisk/yii2-phone-input)

## Установка

Запустить

```
composer require mitisk/yii2-phone-input "dev-master"
```

или добавить в `composer.json` в секцию ```require```:

```
"mitisk/yii2-phone-input": "dev-master"
```

## Использование

#### C ActiveForm
```php
// add this in your view
use Mitisk\Yii2PhoneInput\PhoneInput;

// Usage with ActiveForm
$form = \yii\widgets\ActiveForm::begin();

echo $form->field($model, 'phone')->widget(PhoneInput::class, [

]);

\yii\widgets\ActiveForm::end();
```

#### C моделью, без ActiveForm
```php
// add this in your view
use Mitisk\Yii2PhoneInput\PhoneInput;

// Usage with model and without ActiveForm 
echo PhoneInput::widget([
    'model' => $model, 
    'attribute' => 'password_1'
]);
```

#### Без модели, без ActiveForm
```php
// add this in your view
use Mitisk\Yii2PhoneInput\PhoneInput;


// Usage without a model or ActiveForm
echo PhoneInput::widget([
    'name' => 'password_2'
]);
```