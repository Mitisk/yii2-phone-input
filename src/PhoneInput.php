<?php

/**
 * @package   yii2-phone-input
 * @author    Mitisk
 * @version   1.0
 */

namespace Mitisk\Yii2PhoneInput;

use Yii;
use yii\web\View;
use yii\widgets\InputWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class PhoneInput extends InputWidget
{
    /**
     * @var string Path to intl-tel-input utils.js
     */
    public $utilsScriptPath = 'https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/utils.min.js';

    /**
     * @var string Path to intlTelInput.js
     */
    public $scriptPath = 'https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/js/intlTelInput.min.js';

    /**
     * @var string Path to intlTelInput.css
     */
    public $cssPath = 'https://cdn.jsdelivr.net/npm/intl-tel-input@24.5.0/build/css/intlTelInput.min.css';

    /**
     * @var boolean Whether input is to be disabled
     */
    public $disabled = false;

    /**
     * @var boolean Whether input is to be readonly
     */
    public $readonly = false;

    /**
     * @var string Country code
     */
    public $country = 'ru';

    /**
     * @var array Options for intlTelInput
     */
    public $inputOptions = [];


    public function run()
    {
        if($this->disabled) {
            $this->options['disabled'] = true;
        }

        if($this->readonly) {
            $this->options['readonly'] = true;
        }

        if($this->inputOptions && is_array($this->inputOptions)) {
            $this->options = ArrayHelper::merge($this->options, $this->inputOptions);
        }

        if ($this->hasModel()) {

            $this->name = ArrayHelper::remove(
                $this->options,
                'name',
                Html::getInputName($this->model, $this->attribute)
            );

            $this->value = Html::getAttributeValue($this->model, $this->attribute);
        }

        echo $this->getInput('input');

        $this->getJs();

        parent::run();
    }

    /**
     * Generates an input.
     *
     * @return string the rendered input markup
     */
    protected function getInput($type)
    {
        if ($this->hasModel()) {
            return Html::activeTextInput($this->model, $this->attribute, $this->options);
        }

        return Html::textInput($this->name, $this->value, $this->options);
    }

    protected function getJs()
    {
        $script = <<< JS
        
        const {$this->getConstId()} = document.querySelector("#{$this->getInputId()}");

        window.intlTelInput({$this->getConstId()}, {
            i18n: "{$this->country}",
            initialCountry: "{$this->country}",
            onlyCountries: ["{$this->country}"],
            separateDialCode: true,
            strictMode: true,
            allowDropdown: false,
            nationalMode: true,
            hiddenInput: () => ({phone: "{$this->getInputName()}"}),
            utilsScript: "{$this->utilsScriptPath}"
        });
        
        JS;


        $this->view->registerJsFile($this->scriptPath, ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::class]]);
        $this->view->registerCssFile($this->cssPath);

        $this->view->registerJs($script, View::POS_LOAD);
    }

    /**
     * @return string The input id
     */
    protected function getInputId()
    {
        if ($this->hasModel()) {
            return Html::getInputId($this->model, $this->attribute);
        }

        return $this->id;
    }

    /**
     * @return string The input name
     */
    protected function getInputName()
    {
        if ($this->hasModel()) {
            return Html::getInputName($this->model, $this->attribute);
        }

        return $this->name;
    }

    /**
     * @return string The const id for the js
     */
    protected function getConstId()
    {
        return 'phoneInput' . str_replace(' ', '', ucwords(str_replace(['-', '_',], ' ', $this->getInputId())));
    }
}