<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['USER']['dce']['dceExtTablesPath'] = PATH_typo3conf . 'temp_CACHED_dce_ext_tables.php';
if (!file_exists($GLOBALS['TYPO3_CONF_VARS']['USER']['dce']['dceExtTablesPath'])) {
	/** @var $dceCache Tx_Dce_Cache */
	$dceCache = t3lib_div::makeInstance('Tx_Dce_Cache');
	$dceCache->createExtTables($GLOBALS['TYPO3_CONF_VARS']['USER']['dce']['dceExtTablesPath']);
}
require_once($GLOBALS['TYPO3_CONF_VARS']['USER']['dce']['dceExtTablesPath']);

Tx_Extbase_Utility_Extension::registerModule(
	$_EXTKEY,
	'tools',
	'dceModule',
	'',
	array(
		'DceModule' => 'index,dcePreviewReturnPage',
		'Dce' => 'renderPreview'
	),
	array(
		'access' => 'user,group',
		'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
		'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml',
	)
);

$TCA['tx_dce_domain_model_dce'] = array(
    'ctrl' => array(
        'title'    => 'LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dce',
        'label' => 'title',
        'label_userFunc' => 'tx_dce_dceFieldCustomLabel->getLabelDce',
		'adminOnly' => 1,
		'rootLevel' => 1,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'delete' => 'deleted',
		'sortby' => 'sorting',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
		'copyAfterDuplFields' => 'fields',
        'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Dce.php',
		'requestUpdate' => 'wizard_enable,template_type,preview_template_type,detailpage_template_type',
        'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/ext_icon.gif'
    ),
);

$TCA['tx_dce_domain_model_dcefield'] = array(
    'ctrl' => array(
        'title'    => 'LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dcefield',
        'label' => 'title',
		'label_userFunc' => 'tx_dce_dceFieldCustomLabel->getLabel',
		'hideTable' => 1,
		'adminOnly' => 1,
		'rootLevel' => 1,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
		'requestUpdate' => 'type',
        'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/DceField.php',
		'type' => 'type',
		'typeicon_column' => 'type',
		'typeicons' => array(
			'0' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_dce_domain_model_dcefield_element.gif',
			'1' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_dce_domain_model_dcefield_tab.gif',
			'2' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_dce_domain_model_dcefield_section.gif',
		),
    ),
);

$ttContentColumns = array(
	'tx_dce_dce' => array(
		'label' => 'LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tt_content.tx_dce_dce',
		'config' => array(
			'type' => 'select',
			'foreign_table' => 'tx_dce_domain_model_dce',
			'items' => array(
				array('', ''),
			),
			'minitems' => 0,
			'maxitems' => 1,
		),
	),
);
t3lib_div::loadTCA('tt_content');
if (version_compare(TYPO3_branch, '6.2', '<')) {
	t3lib_extMgm::addTCAcolumns('tt_content', $ttContentColumns, 1);
} else {
	t3lib_extMgm::addTCAcolumns('tt_content', $ttContentColumns);
}
