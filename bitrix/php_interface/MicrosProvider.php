<?php
/**
 * Created by Micros Development.
 * User: Najmiddinov Nizamiddin
 * User: najmiddinov.nizom@gmail.com
 * Date: 12.07.2019
 * Time: 17:58
 */

class MicrosProvider extends \Bitrix\DocumentGenerator\DataProvider implements \Bitrix\DocumentGenerator\Nameable
{
    public function getFields()
    {
        return [
            'MY_FIELD' => [
                'TITLE' => 'Тест',
                'VALUE' => function()
                {
                    return 'my value';
                }
            ],
            'MY_FIELD_CUSTOM' => [
                'TITLE' => 'Тест CUSTOM',
                'VALUE' => function()
                {
                    return 'my value CUSTOM';
                }
            ],
        ];
    }

    public function isLoaded()
    {
        return true;
    }

    public static function getLangName()
    {
        return 'Мой провайдер';
    }
}