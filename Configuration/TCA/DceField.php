<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_dce_domain_model_dcefield'] = array(
	'ctrl' => $TCA['tx_dce_domain_model_dcefield']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden',
	),
	'types' => array(
		'0' => array('showitem' => 'type,title,variable,configuration;;;fixed-font:enable-tab,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,hidden;;1'),
		'1' => array('showitem' => 'type,title,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,hidden;;1'),
		'2' => array('showitem' => 'type,title,section_fields_tag,variable,section_fields,LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dcefield.additionalConfiguration,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,hidden;;1'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_dce_domain_model_dcefield',
				'foreign_table_where' => 'AND tx_dce_domain_model_dcefield.pid=###CURRENT_PID### AND tx_dce_domain_model_dcefield.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dcefield.type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dcefield.type.element', 0),
					array('LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dcefield.type.tab', 1),
					array('LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dcefield.type.section', 2),
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dcefield.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'variable' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dcefield.variable',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required,is_in,tx_dce_formevals_noLeadingNumber,tx_dce_formevals_lowerCamelCase',
				'is_in' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890_',
			),
		),
		'configuration' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dcefield.configuration',
			'config' => array (
				'type' => 'user',
				'size' => '30',
				'userFunc' => 'EXT:dce/Classes/UserFunction/class.tx_dce_codemirrorField.php:tx_dce_codemirrorField->getCodemirrorField',
				'parameters' => array(
					'mode' => 'xml',
					'showTemplates' => TRUE,
				)
			),
		),
		'section_fields' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dcefield.section_fields',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_dce_domain_model_dcefield',
				'MM' => 'tx_dce_dcefield_sectionfields_mm',
				'minitems' => 0,
				'maxitems' => 999,
				'appearance' => array(
					'enabledControls' => array(
						'hide' => false,
						'dragdrop' => true,
						'sort' => true,
					),
					'levelLinksPosition' => 'both',
				),
			),
		),
		'section_fields_tag' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:dce/Resources/Private/Language/locallang_db.xml:tx_dce_domain_model_dcefield.section_fields_tag',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
	),
);