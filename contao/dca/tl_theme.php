<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$dca = &$GLOBALS['TL_DCA']['tl_theme'];

$dca['fields']['enhAcc_adjustDefaultTemplate'] = [
    'inputType' => 'checkbox',
    'eval' => [
        'tl_class' => 'w50',
    ],
    'sql' => "char(1) NOT NULL default ''"
];