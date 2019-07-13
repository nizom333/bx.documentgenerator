<?php
/**
 * Created by Micros Development.
 * User: Najmiddinov Nizamiddin
 * User: najmiddinov.nizom@gmail.com
 * Date: 13.07.2019
 * Time: 14:28
 */


\Bitrix\Main\EventManager::getInstance()->addEventHandler('documentgenerator', 'onGetDataProviderList', 'addDocumentProviders');

function addDocumentProviders()
{
    \Bitrix\Main\Loader::includeModule('documentgenerator');

    require_once('MicrosProvider.php');

    $result['MyProvider'] = [
        'NAME' => 'Мой провайдер',
        'CLASS' => 'MicrosProvider',
        'MODULE' => 'documentgenerator',
    ];

    return $result;
}
\Bitrix\Main\EventManager::getInstance()->addEventHandler('documentgenerator', 'onCreateDocument', function($event)
{
    $document = $event->getParameter('document');
    $fileId = $document->FILE_ID;
    $content = \Bitrix\DocumentGenerator\Model\FileTable::getContent();
    $content = $content; // some modification
    \Bitrix\DocumentGenerator\Model\FileTable::updateContent($fileId, $content);
});