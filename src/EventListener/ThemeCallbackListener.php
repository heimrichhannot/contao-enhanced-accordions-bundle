<?php

namespace HeimrichHannot\EnhancedAccordionsBundle\EventListener;

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Contao\Input;

class ThemeCallbackListener
{
    #[AsCallback(table: 'tl_theme', target: 'config.onload')]
    public function onLoadCallback(DataContainer $dc = null): void
    {
        if (null === $dc || !($dc->id) || 'edit' !== Input::get('act')) {
            return;
        }

        PaletteManipulator::create()
            ->addField('enhAcc_adjustDefaultTemplate')
            ->applyToSubpalette('huh_frontendFramework_bootstrap5', 'tl_theme');
    }
}