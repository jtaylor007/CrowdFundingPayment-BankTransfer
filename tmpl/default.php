<?php
/**
 * @package      Crowdfunding
 * @subpackage   Plugins
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * @var stdClass $item
 */

$doc->addScript('plugins/crowdfundingpayment/banktransfer/js/script.js?v='.rawurlencode($this->version));
?>
<div class="well">
    <h4>
        <img width="30" height="26" src="plugins/crowdfundingpayment/banktransfer/images/bank_icon.png" />
        <?php echo JText::_($this->textPrefix . '_TITLE'); ?>
    </h4>

<?php
// Check for valid beneficiary information. If missing information, display error message.
$beneficiaryInfo = Joomla\String\StringHelper::trim(strip_tags($this->params->get('beneficiary')));
if (!$beneficiaryInfo) {?>
<div class="alert alter-warning"><?php echo JText::_($this->textPrefix . '_ERROR_PLUGIN_NOT_CONFIGURED'); ?></div>
<?php return; } ?>
<div><?php echo nl2br($this->bankAccount); ?></div>
<?php
if ($this->params->get('display_additional_info', 1)) {
    $additionalInfo = Joomla\String\StringHelper::trim($this->params->get('additional_info'));

    if ($additionalInfo !== null and $additionalInfo !== '') {?>
    <p class="alert alert-info p-5"><span class="fa fa-info-circle"></span> <?php echo htmlspecialchars($additionalInfo, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php } else { ?>
    <p class="alert alert-info p-5"><span class="fa fa-info-circle"></span> <?php echo JText::_($this->textPrefix . '_INFO'); ?></p>
    <?php } ?>

<?php } ?>
    <div class="alert alert-info p-5 mb-10" id="js-bt-alert" style="display: none;"></div>
    <button class="btn btn-primary" id="js-register-bt" type="button" data-project-id="<?php echo $item->id; ?>" data-amount="<?php echo $item->amount; ?>">
        <?php echo JText::_($this->textPrefix . '_MAKE_BANK_TRANSFER'); ?>
    </button>
    <i class="fa fa-spinner fa-spin  fa-fw" id="js-banktransfer-ajax-loading" style="display: none;"></i>
    <span class="sr-only"><?php echo JText::_($this->textPrefix . '_LOADING'); ?></span>

    <a href="#" class="btn btn-success" id="js-continue-bt" style="display: none;" role="button">
        <span class="fa fa-chevron-right"></span>
        <?php echo JText::_($this->textPrefix . '_CONTINUE_NEXT_STEP'); ?>
    </a>
</div>