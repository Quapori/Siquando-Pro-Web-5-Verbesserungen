<?php

class NGPluginParagraphForm extends NGPluginParagraph
{
    const ObjectTypePluginParagraphForm = 'NGPluginParagraphForm';
    const Product = 'SIQUANDO Pro 5';
    const StoreFolder = 'ngpluginparagraphform';
    const StoreFilename = 'store.csv';
    const DomainParagraphForm = "paragraphform";

    public $recaptchapublic = '';

    public $recaptchaprivate = '';

    public $store = false;

    public $send = false;

    public $sendto = '';

    public $from = '';

    public $fromName = '';

    public $subject = '';

    public $sendcopy = false;

    public $copyfrom = '';

    public $copyfromName = '';

    public $copysubject = '';

    public $columns = 1;

    public $itemsleft = Array();

    public $itemsright = Array();

    public $feedback = '';

    public $instanceuid = '00000000000000000000000000000000';

    public $pictureWidth;

    /**
     *
     * Columns of form
     *
     * @var Array
     */
    private $formColumns = Array();

    /**
     *
     * Template to use
     *
     * @var NGTemplate
     */
    private $template;

    /**
     *
     * Rich text parser
     *
     * @var NGRichText
     */
    private $richText;

    /**
     * @var NGDBAdapterObject
     */
    private $adapter;

    /**
     *
     * Form has error
     *
     * @var bool
     */
    private $formError;

    /**
     *
     * The form cotains files
     *
     * @var string
     */
    private $formHasFileItems = false;

    /**
     *
     * The form has been sent containing files
     *
     * @var unknown_type
     */
    private $formFilesUploaded = false;

    /**
     *
     * The current message ID
     *
     * @var string
     */
    private $messageId = '';

    /**
     *
     * Language resources
     *
     * @var NGLanguageAdapter
     */
    private $lang;

    /**
     *
     * Store path for this paragraph
     *
     * @var string
     */
    private $storePath = '';

    /**
     *
     * Store path for this message
     *
     * @var string
     */
    private $messageStorePath = '';

    /**
     *
     * Error of captcha
     *
     * @var bool
     */
    private $captchaError = false;

    /**
     *
     * Settings of typography
     *
     * @var NGPluginTypographySettings
     */
    private $settingsTypography;

    /*
     * (non-PHPdoc)
     * @see NGObjectMapped::getPropertiesMapped()
     */
    protected function getPropertiesMapped()
    {
        parent::getPropertiesMapped();

        $this->propertiesMapped [] = new NGPropertyMapped ('recaptchapublic', NGProperty::TypeString, self::DomainParagraphForm, 'recaptchapublic', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('recaptchaprivate', NGProperty::TypeString, self::DomainParagraphForm, 'recaptchaprivate', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('store', NGProperty::TypeBool, self::DomainParagraphForm, 'store', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('send', NGProperty::TypeBool, self::DomainParagraphForm, 'send', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('sendto', NGProperty::TypeString, self::DomainParagraphForm, 'sendto', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('from', NGProperty::TypeString, self::DomainParagraphForm, 'from', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('fromname', NGProperty::TypeString, self::DomainParagraphForm, 'fromName', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('subject', NGProperty::TypeString, self::DomainParagraphForm, 'subject', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('columns', NGProperty::TypeInt, self::DomainParagraphForm, 'columns', NGPropertyMapped::MultiplicityScalar, false, 1);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemsleft', NGProperty::TypeFulltext, self::DomainParagraphForm, 'itemsleft', NGPropertyMapped::MultiplicityList, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('itemsright', NGProperty::TypeFulltext, self::DomainParagraphForm, 'itemsright', NGPropertyMapped::MultiplicityList, true);
        $this->propertiesMapped [] = new NGPropertyMapped ('feedback', NGProperty::TypeFulltext, self::DomainParagraphForm, 'feedback', NGPropertyMapped::MultiplicityScalar, true, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('instanceuid', NGProperty::TypeFulltext, self::DomainParagraphForm, 'instanceuid', NGPropertyMapped::MultiplicityScalar, true, '');

        $this->propertiesMapped [] = new NGPropertyMapped ('sendcopy', NGProperty::TypeBool, self::DomainParagraphForm, 'sendcopy', NGPropertyMapped::MultiplicityScalar, false, false);
        $this->propertiesMapped [] = new NGPropertyMapped ('copyfrom', NGProperty::TypeString, self::DomainParagraphForm, 'copyfrom', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('copyfromname', NGProperty::TypeString, self::DomainParagraphForm, 'copyfromName', NGPropertyMapped::MultiplicityScalar, false, '');
        $this->propertiesMapped [] = new NGPropertyMapped ('copysubject', NGProperty::TypeString, self::DomainParagraphForm, 'copysubject', NGPropertyMapped::MultiplicityScalar, false, '');
    }

    public function render()
    {
        $this->pictureWidth = floor($this->renderWidth * 0.65 / $this->columns);
        if ($this->pictureWidth < 768) $this->pictureWidth = 768;

        $this->richText = new NGRichText ();
        $this->richText->previewMode = $this->previewMode;

        $this->adapter = new NGDBAdapterObject();

        ksort($this->itemsleft, SORT_NUMERIC);
        ksort($this->itemsright, SORT_NUMERIC);

        $this->formColumns [] = $this->parseItems($this->itemsleft);
        if ($this->columns == 2)
            $this->formColumns [] = $this->parseItems($this->itemsright);

        $this->lang = new NGLanguageAdapter ();
        $this->lang->langURL = 'classes/plugins/ngpluginparagraph/ngpluginparagraphform/language/langform.xml';
        $this->lang->load();

        $adapterTypography = new NGDBAdapterObject ();
        $this->settingsTypography = $adapterTypography->loadSetting(NGPluginTypographySettings::IdTypography, NGPluginTypographySettings::ObjectTypeNGPluginTypographySettings);

        if ($this->getPostData()) {
            $this->renderForm();
        } else {
            $this->renderResult();
        }

        $this->dontCache = true;
    }

    /**
     * Renders the result
     */
    private function renderResult()
    {
        $div = new NGRenderTag ('div');
        $div->id = $this->resultAnchor();
        $div->content = $this->richText->parse($this->feedback);

        $this->output = $div->render();

        if ($this->send || $this->store)
            $this->processMessage();
    }

    private function resultAnchor()
    {
        return 'ngformresult' . $this->objectUID;
    }

    /**
     * Renders of re-renders the form
     */
    private function renderForm()
    {
        if (NGUtil::isMobile()) {
            $totalWidth = $this->renderWidth;
        } else {
            $totalWidth = floor($this->renderWidth / $this->columns);
            if ($this->columns == 2)
                $totalWidth -= 12;
        }

        $labelWidth = floor($totalWidth / 3);
        $inputWidth = $totalWidth - $labelWidth;

        $this->template = new NGTemplate ();
        $this->template->assign('formcolumns', $this->formColumns);
        $this->template->assign('uid', $this->objectUID);
        $this->template->assign('columnwidth', $totalWidth);
        $this->template->assign('columns', $this->columns);
        $this->template->assign('labelwidth', $labelWidth);
        $this->template->assign('inputwidth', $inputWidth);
        $this->template->assign('formerror', $this->formError);
        $this->template->assign('captchaerror', $this->captchaError);
        $this->template->assign('lang', $this->lang->languageResources);
        $this->template->assign('extrawidth', $this->settingsTypography->fieldExtraWidth());
        $this->template->assign('responsive', $this->responsive);

        $link = new NGLink ();
        $link->previewMode = $this->previewMode;
        $link->uid = $this->currentPage->objectUID;
        $link->linkType = NGLink::LinkPage;

        $this->template->assign('action', $link->getURL() . '#' . $this->resultAnchor());
        $this->template->assign('mobile', NGUtil::isMobile());

        if ($this->recaptchapublic !== '') {
            $this->template->assign('recaptchapublic', $this->recaptchapublic);
        }

        $this->output = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphform/tpl/template.tpl');

        $this->styleSheets = Array(
            'NGPluginParagraphForm' => $this->prependPluginsPath('ngpluginparagraphform/css/')
        );

        if ($this->recaptchapublic !== '') {
            $this->javaScripts = Array(
                'recaptcha' => 'https://www.google.com/recaptcha/api.js'
            );
        }
    }

    /**
     * Send the mail
     */
    private function processMessage()
    {
        $this->template = new NGTemplate ();

        if ($this->columns > 1) {
            $result = array_merge($this->formColumns [0], $this->formColumns [1]);
        } else {
            $result = $this->formColumns [0];
        }

        $date = date(NGConfig::DateTimeFormatLocal);

        $sendMail = new NGMail ();

        $filesToDelete = array();

        if ($this->formFilesUploaded) {
            foreach ($result as $item) {
                /* @var $item NGFormItem */
                if ($item->type === 'File') {
                    if (isset ($item->fileData)) {
                        $source = $item->fileData ['tmp_name'];
                        $name = $item->fileData ['name'];
                        $destination = NGUtil::joinPaths($this->getMessageStorePath(), NGUtil::extraSafeFilename($name));
                        $type = $item->fileData ['type'];
                        move_uploaded_file($source, $destination);
                        if ($this->send)
                            $sendMail->addAttachment($destination, $name, $type);
                        if (!$this->store)
                            $filesToDelete[] = $destination;
                    }
                }
            }

        }

        if ($this->store) {

            $exits = is_file($this->getStoreFile());

            $fp = @fopen($this->getStoreFile(), 'a');

            if (!$exits) {
                @fwrite($fp, $this->lang->languageResources ['date']->value);
                foreach ($result as $item) {
                    if ($item->view()) {
                        @fwrite($fp, ';');
                        @fwrite($fp, $item->caption);
                    }
                }
            }

            @fwrite($fp, "\r\n");
            @fwrite($fp, $date);

            foreach ($result as $item) {
                if ($item->view()) {
                    @fwrite($fp, ';');

                    if ($item->type === 'File') {
                        if ($item->result() !== '')
                            @fwrite($fp, NGUtil::joinPaths($this->getAbsoluteMessageStorePath(), NGUtil::extraSafeFilename($item->result())));
                    } else {
                        @fwrite($fp, $item->result());
                    }
                }
            }

            @fclose($fp);
        }

        if ($this->send) {
            $this->template->assign('items', $result);
            $this->template->assign('lang', $this->lang->languageResources);
            $this->template->assign('preamble', str_ireplace('[d]', $date, $this->lang->languageResources ['preamble']->value));
            $mail = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphform/tpl/mail.tpl');

            $sendMail->sendTo = $this->sendto;
            $sendMail->fromMail = $this->from;
            $sendMail->fromName = $this->fromName;

            foreach ($result as $item) {
                /* @var $item NGFormItem */
                if ($item->type === 'Email' && $item->replyto && $item->result() !== '') {
                    $sendMail->replyTo = $item->result();
                    break;
                }
            }

            $sendMail->subject = $this->subject;
            $sendMail->html = $mail;
            $sendMail->send();
        }

        if ($this->sendcopy) {
            $this->template->assign('items', $result);
            $this->template->assign('lang', $this->lang->languageResources);
            $this->template->assign('preamble', str_ireplace('[d]', $date, $this->lang->languageResources ['preamblecopy']->value));
            $mail = $this->template->fetchPluginTemplate('ngpluginparagraph/ngpluginparagraphform/tpl/mail.tpl');

            $sendMail->sendTo = '';
            $sendMail->fromMail = $this->copyfrom;
            $sendMail->replyTo = $this->copyfrom;
            $sendMail->fromName = $this->copyfromName;

            foreach ($result as $item) {
                /* @var $item NGFormItem */
                if ($item->type === 'Email' && $item->replyto && $item->result() !== '') {
                    $sendMail->sendTo = $item->result();
                    break;
                }
            }

            $sendMail->subject = $this->copysubject;
            $sendMail->html = $mail;

            if ($sendMail->sendTo !== '') {
                $sendMail->send();
            }
        }

        if (!$this->store) {
            foreach ($filesToDelete as $fileToDelete) {
                @unlink($fileToDelete);
            }
            @rmdir($this->getMessageStorePath());
        }

    }

    /**
     *
     * Validates the form
     *
     * @return true if form has to be displayed
     */
    private function getPostData()
    {
        $this->formError = false;

        $formId = 'ngform-' . $this->objectUID;

        if (array_key_exists($formId, $_POST)) {
            $columnIndex = 0;
            foreach ($this->formColumns as $formColumn) {
                $columnId = $formId . '-' . $columnIndex;
                $fieldIndex = 0;
                foreach ($formColumn as $formField) {
                    /* @var $formField NGFormItem */
                    $fieldId = $columnId . '-' . $fieldIndex;

                    switch ($formField->type) {
                        case 'File' :
                            if (array_key_exists($fieldId, $_FILES)) {
                                if ($_FILES [$fieldId] ['error'] === 0) {
                                    $formField->fileData = $_FILES [$fieldId];
                                    $this->formFilesUploaded = true;
                                }
                            }
                        case 'Text' :
                        case 'Date' :
                        case 'Time' :
                        case 'TextArea' :
                            if (array_key_exists($fieldId, $_POST)) {
                                $formField->default = $_POST [$fieldId];
                            }
                            if ($formField->mandatory && $formField->default === '') {
                                $formField->error = true;
                                $this->formError = true;
                            }
                            break;
                        case 'Radio' :
                        case 'Select' :
                            if ($formField->mandatory) {
                                $defaultValue = $formField->getSelectedOption();
                            }
                            if (array_key_exists($fieldId, $_POST)) {
                                $formField->setSelectedOption($_POST [$fieldId]);
                            }
                            if ($formField->mandatory) {
                                if ($defaultValue === $formField->getSelectedOption()) {
                                    $formField->error = true;
                                    $this->formError = true;
                                }
                            }
                            break;
                        case 'CheckBox' :
                        case 'Consent' :
                            $formField->default = NGUtil::boolToStringXML(array_key_exists($fieldId, $_POST));
                            if ($formField->mandatory) {
                                if (!NGUtil::StringXMLToBool($formField->default)) {
                                    $formField->error = true;
                                    $this->formError = true;
                                }
                            }
                            break;
                        case 'Password' :
                            $fieldIdRepeat = $fieldId . '-repeat';

                            if (array_key_exists($fieldId, $_POST) && array_key_exists($fieldIdRepeat, $_POST)) {

                                $formField->default = $_POST [$fieldId];
                                if ($formField->default !== $_POST [$fieldIdRepeat]) {
                                    $formField->error = true;
                                    $this->formError = true;
                                }
                            }
                            if ($formField->mandatory && $formField->default === '') {
                                $formField->error = true;
                                $this->formError = true;
                            }
                            break;
                        case 'Number' :
                            if (array_key_exists($fieldId, $_POST)) {
                                $formField->default = $_POST [$fieldId];
                            }
                            if ($formField->default === '') {
                                if ($formField->mandatory) {
                                    $formField->error = true;
                                    $this->formError = true;
                                }
                            } else {
                                if (!is_numeric($formField->default)) {
                                    $formField->error = true;
                                    $this->formError = true;
                                } else {
                                    if (($formField->min !== '')) {
                                        if (intval($formField->default) < intval($formField->min)) {
                                            $formField->error = true;
                                            $this->formError = true;
                                        }
                                    }
                                    if (($formField->max !== '')) {
                                        if (intval($formField->default) > intval($formField->max)) {
                                            $formField->error = true;
                                            $this->formError = true;
                                        }
                                    }
                                }
                            }
                            break;
                        case 'Email' :
                            if (array_key_exists($fieldId, $_POST)) {
                                $formField->default = $_POST [$fieldId];
                            }
                            if ($formField->default === '') {
                                if ($formField->mandatory) {
                                    $formField->error = true;
                                    $this->formError = true;
                                }
                            } else {
                                if (!NGUtil::checkEmail($formField->default)) {
                                    $formField->error = true;
                                    $this->formError = true;
                                }
                            }
                    }

                    $fieldIndex++;
                }
                $columnIndex++;
            }

            if ($this->recaptchapublic !== '') {
                $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $this->recaptchaprivate . '&response=' . $_POST ['g-recaptcha-response']);
                $responseData = json_decode($verifyResponse);

                if (!$responseData->success === true) {
                    $this->formError = true;
                    $this->captchaError = true;
                }
            }

            return $this->formError;
        } else {
            return true;
        }
    }

    /**
     * Get message id
     */
    private function getMessageId()
    {
        if ($this->messageId === '')
            $this->messageId = str_replace('.', '', uniqid('w', true));
        return $this->messageId;
    }

    /**
     * Get Path, where all messages will be stored
     */
    private function getStorePath()
    {
        if ($this->storePath === '')
            $this->storePath = NGUtil::createPath(NGConfig::storePath(), NGUtil::joinPaths(self::StoreFolder, $this->instanceuid));

        return $this->storePath;
    }

    /**
     * Get the store file
     */
    private function getStoreFile()
    {
        return NGUtil::joinPaths($this->getStorePath(), self::StoreFilename);
    }

    /**
     * Get Path, where message will be stored
     */
    private function getMessageStorePath()
    {
        if ($this->messageStorePath === '')
            $this->messageStorePath = NGUtil::createPath($this->getStorePath(), $this->getMessageId());

        return $this->messageStorePath;
    }

    /**
     * Get the absolute store path
     */
    private function getAbsoluteMessageStorePath()
    {
        $path = NGUtil::joinPaths(NGConfig::RootURL, NGConfig::FolderStore);
        $path = NGUtil::joinPaths($path, self::StoreFolder);
        $path = NGUtil::joinPaths($path, $this->instanceuid);
        $path = NGUtil::joinPaths($path, $this->getMessageId());

        return $path;
    }

    /**
     *
     * Parse items XML
     *
     * @param unknown_type $items
     */
    private function parseItems($items)
    {
        $form = Array();

        foreach ($items as $item) {

            $xml = new DOMDocument ('1.0', 'UTF-8');
            $xml->loadXML($item);

            $formItem = new NGFormItem ();
            $formItem->type = $xml->documentElement->nodeName;

            if ($formItem->type === 'File')
                $this->formHasFileItems = true;

            foreach ($xml->documentElement->childNodes as $node) {
                /* @var $node DOMNode */
                if ($node->nodeType === XML_ELEMENT_NODE) {
                    switch ($node->nodeName) {
                        case 'caption' :
                            if ($formItem->type === 'Info') {
                                $formItem->caption = $this->richText->parse($node->nodeValue);
                            } else {
                                $formItem->caption = $node->nodeValue;
                            }
                            break;
                        case 'mandatory' :
                            $formItem->mandatory = $node->nodeValue;
                            break;
                        case 'replyto' :
                            $formItem->replyto = $node->nodeValue;
                            break;
                        case 'autocomplete' :
                            $formItem->autocomplete = $node->nodeValue;
                            break;
                        case 'min' :
                            $formItem->min = $node->nodeValue;
                            break;
                        case 'max' :
                            $formItem->max = $node->nodeValue;
                            break;
                        case 'placeholder' :
                            $formItem->placeholder = $node->nodeValue;
                            break;
                        case 'accept' :
                            $formItem->accept = $node->nodeValue;
                            break;
                        case 'pictureuid' :
                            /* @var $picture NGPicture */
                            $picture = $this->adapter->loadObject($node->nodeValue, NGPicture::ObjectTypePicture, NGPicture::ObjectTypePicture);

                            if ($picture !== null) {
                                $formItem->picturesize = $picture->getResizedSize($this->pictureWidth, floor($this->pictureWidth / 4 * 3));
                                $formItem->picturesource = NGLink::getPictureURL($node->nodeValue, $this->pictureWidth, floor($this->pictureWidth / 4 * 3));
                            }
                            break;
                        case 'valuecaption' :
                            if ($formItem->type === 'Consent') {
                                $formItem->valuecaption = $this->richText->parse($node->nodeValue);
                            } else {
                                $formItem->valuecaption = $node->nodeValue;
                            }
                            break;
                        case 'default' :
                            $formItem->default = $node->nodeValue;
                            break;
                        case 'options' :
                            $formItem->options = $this->getOptions($node);
                            break;
                    }
                }
            }

            $form [] = $formItem;
        }

        return $form;
    }

    /**
     *
     * Get options from Node for select and radio
     *
     * @param DOMNode $node
     */
    private function getOptions(DOMNode $node)
    {
        $options = Array();

        foreach ($node->childNodes as $node) {
            /* @var $node DOMElement */
            if ($node->nodeType === XML_ELEMENT_NODE) {
                if ($node->nodeName == 'option') {
                    $option = new NGFormOption ();
                    $option->caption = $node->nodeValue;

                    if ($node->getAttribute('default') === 'true')
                        $option->default = true;

                    $options [] = $option;
                }
            }
        }

        return $options;
    }

    /**
     *
     * Purge data in path
     *
     * @param id $id
     * @throws NGException
     */
    private function purgeData($id)
    {
        $id = NGUtil::safeFilename($id);

        if ($id == '')
            throw new NGException ('param not set');

        $path = NGUtil::joinPaths(NGConfig::storePath(), NGUtil::joinPaths(self::StoreFolder, $id));

        if (is_dir($path)) {
            NGUtil::emptyFolder($path);
            return NGUtil::boolToStringXML(true);
        } else {
            return NGUtil::boolToStringXML(false);
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see NGPluginParagraph::callback()
     */
    public function callback($method, $param)
    {
        switch ($method) {
            case 'purge' :
                return $this->purgeData($param);
            default :
                throw new NGException (sprintf('Method "%s" is not implemented', $method));
        }
    }
}

/**
 * A form item
 */
class NGFormItem
{

    public $caption;

    public $type;

    public $default;

    public $valuecaption;

    public $mandatory = false;

    public $replyto = false;

    public $autocomplete;

    public $placeholder;

    public $min;

    public $max;

    public $options = Array();

    public $error = false;

    public $fileData;

    public $picturesource;

    public $picturesize;

    public $accept;

    /**
     * Get the selected option
     */
    public function getSelectedOption()
    {
        foreach ($this->options as $option) {
            if ($option->default)
                return $option->caption;
        }
        return '';
    }

    /**
     *
     * Set the selected option
     *
     * @param string $value
     */
    public function setSelectedOption($value)
    {
        foreach ($this->options as $option) {
            $option->default = $option->caption === $value;
        }
    }

    /**
     * Get the result
     */
    public function result()
    {
        switch ($this->type) {
            case 'Select' :
            case 'Radio' :
                return $this->getSelectedOption();
            case 'File' :
                if (isset ($this->fileData)) {
                    return $this->fileData ['name'];
                } else {
                    return '';
                }
            case 'CheckBox' :
                if (NGUtil::StringXMLToBool($this->default)) {
                    return $this->valuecaption;
                } else {
                    return '';
                }
            case 'Consent' :
                if (NGUtil::StringXMLToBool($this->default)) {
                    return strip_tags($this->valuecaption);
                } else {
                    return '';
                }
            default :
                return $this->default;
        }
    }

    /**
     * Should the item be displayed
     */
    public function view()
    {
        switch ($this->type) {
            case 'Headline' :
            case 'Info' :
            case 'Spacer' :
            case 'Line' :
            case 'Picture' :
                return false;
            default :
                return true;
        }
    }
}

/**
 * A option for select and radio
 */
class NGFormOption
{

    public $caption;

    public $default = false;
}