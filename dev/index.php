<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Новый раздел");

\Bitrix\Main\Loader::includeModule('documentgenerator');


echo '<pre>';

// проверим, что наш провайдер появился в списке
print_r(\Bitrix\DocumentGenerator\DataProviderManager::getList(['filter' => ['MODULE' => 'documentgenerator']]));

//die;

// сохраним файл шаблона
$fileResult = \Bitrix\DocumentGenerator\Model\FileTable::saveFile(\CFile::MakeFileArray('/dev/stepForm.docx'));

if($fileResult->isSuccess())
{
    $fileId = $fileResult->getId();
}
else
{
    print_r($fileResult->getErrorMessages());
    die;
}

//$pathF = CFile::GetPath($fileId);

//echo "<pre>"; print_r($pathF); echo "</pre>";

// сохраним шаблон
$data = [
    'NAME' => 'Резиденет',
    'ACTIVE' => 'Y',
    'CODE' => 'stepForm',
    'REGION' => 'ru',
    'MODULE_ID' => 'documentgenerator',
    'FILE_ID' => $fileId,
    'BODY_TYPE' => \Bitrix\DocumentGenerator\Body\Docx::class,
    'NUMERATOR_ID' => 1,
];

$templateResult = \Bitrix\DocumentGenerator\Model\TemplateTable::add($data);
if($templateResult->isSuccess())
{
    $templateId = $templateResult->getId();
    echo "<pre style='color:red;'>"; print_r($templateId); echo "</pre>";
}
else
{
    print_r($templateResult->getErrorMessages());
    die;
}

$template = \Bitrix\DocumentGenerator\Template::loadById($templateId);
$template->setSourceType(MyProvider::class);

$document = \Bitrix\DocumentGenerator\Document::createByTemplate($template, '1');

// проверим, что в значение поля подставилось значение из провайдера
print_r($document->getFields());

echo "<hr>";

// получим файл документа
print_r($document->getFile());

echo '</pre>';



 require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>