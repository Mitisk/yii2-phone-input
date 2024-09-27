<?php

/**
 * @package   yii2-phone-input
 * @author    Mitisk
 * @version   1.0
 */

namespace Mitisk\Yii2PhoneInput;

use yii\helpers\Url;
use yii\helpers\Html;

/**
 * Class Phone
 * @package app\helper
 */
class PhoneHelper extends \yii\base\BaseObject
{
    /**
     * Convert phone number to international format
     * @param string $phoneNumber
     * @return string
     */
    public static function clear($phoneNumber = '') {
        $result = trim($phoneNumber);
        $result = preg_replace('/\D/', '', $result);
        $result = preg_replace('/^89/', '79', $result);

        $result = substr($result, 0, 14);
        if(preg_match('/^79/', $result)) {
            $result = substr($result, 0, 11);
        }

        if(preg_match('/^9\d{9}/', $result)) {
            $result = '7'.$result;
        }
        return $result;
    }

    /**
     * Convert phone number to pretty format
     * @param string $phone
     * @return string
     */
    public static function pretty($phone)
    {
        $result = trim($phone);
        $result = preg_replace('/\D/', '', $result);
        $result = preg_replace('/^89/', '79', $result);
        if(preg_match('/^9\d{9}/', $result)) {
            $result = '7'.$result;
        }
        if($result === '') {
            return $result;
        }
        return '+'.$result;
    }

}