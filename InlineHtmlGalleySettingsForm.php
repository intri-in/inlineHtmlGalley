<?php

/**
 * @file plugins/generic/inlineHtmlGalley/InlineHtmlGalleySettingsForm.inc.php
 * 
 * Copyright (c) University of Pittsburgh 
 * Distributed under the GNU GPL v2 or later. For full terms see the file docs/COPYING.
 * 
 * @class InlineHtmlGalleySettingsForm
 * @ingroup plugins_generic_inlineHtmlGalley
 * 
 * @brief Form to provide settings for the InlineHtmlGalley plugin
 */
namespace APP\plugins\generic\inlineHtmlGalley;

use PKP\form\Form;
use PKP\form\validation\FormValidatorPost;
use PKP\form\validation\FormValidatorCSRF;
use APP\template\TemplateManager;

class InlineHtmlGalleySettingsForm extends Form {

    /** @var $plugin InlineHtmlGalleyPlugin */
    var $plugin;

    /** @var $contextId int */
    var $contextId;

    /**
     * Constructor
     * @param $plugin InlineHtmlGalleyPlugin
     * @param $contextId int
     */
    function __construct($plugin, $contextId) {
        $this->plugin = $plugin;
        $this->contextId = $contextId;

        parent::__construct(method_exists($plugin, 'getTemplateResource') ? $plugin->getTemplateResource('settingsForm.tpl') : $plugin->getTemplatePath() . 'settingsForm.tpl');

        $this->addCheck(new FormValidatorPost($this));
        $this->addCheck(new FormValidatorCSRF($this));
    }

    /**
     * @copydoc Form::initData()
     */
    function initData() {
        $this->setData('xpath', $this->plugin->getSetting($this->contextId, 'xpath'));
    }

    /**
     * @copydoc Form::readInputData()
     */
    function readInputData() {
        $this->readUserVars(array('xpath'));
    }

    /**
     * @copydoc Form::fetch()
     */
    function fetch($request, $template = null, $display = false) {
        $templateMgr = TemplateManager::getManager($request);
        $templateMgr->assign('pluginName', $this->plugin->getName());

        return parent::fetch($request, $template, $display);
    }

    /**
     * @copydoc Form::execute()
     */
    function execute(...$functionArgs) {
        $this->plugin->updateSetting($this->contextId, 'xpath', $this->getData('xpath'));
    }
}
