<?php

namespace HeimrichHannot\EnhancedAccordionsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\FrontendTemplate;
use Contao\Template;
use HeimrichHannot\EnhancedAccordionsBundle\Helper\AccordionHelper;
use HeimrichHannot\FrontendFrameworkBundle\Helper\FrontendFrameworkHelper;

class PrepareAccordionListener
{
    public function __construct(
        public AccordionHelper $accordionHelper,
        protected FrontendFrameworkHelper $frontendFrameworkHelper,
    )
    {
    }

    #[AsHook('parseTemplate')]
    public function onParseTemplate(Template $template): void
    {
        if (!str_starts_with($template->getName(), 'ce_accordion')) {
            return;
        }

        if (str_starts_with($template->getName(), 'ce_accordionSingle')) {
            $data = $this->accordionHelper->structureAccordionSingle($template->getData());
        } elseif (str_starts_with($template->getName(), 'ce_accordionStart')) {
            $data = $this->accordionHelper->structureAccordionStartStop($template->getData());
        } elseif (str_starts_with($template->getName(), 'ce_accordionStop')) {
            $data = $this->accordionHelper->structureAccordionStartStop($template->getData());
        } else {
            return;
        }

        if ($this->adjustDefaultTemplate($template)) {
            $itemClass = 'accordion_item_'.$data['accordion_parentId'].'_'.$data['id'];

            $data['class'] = trim(($data['class'] ?? '').' accordion-item');
            $data['toggler'] = trim(($data['toggler'] ?? '').' accordion-header');
            $data['accordion'] =  trim(str_replace('accordion', '', ($data['accordion'] ?? '')).' accordion-collapse collapse '.$itemClass);

            $data['headline'] = '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target=".'.$itemClass.'" aria-expanded="true" aria-controls="collapseOne">'
                .$data['headline']
                .'</button>';
        }

        $template->setData($data);
    }

    #[AsHook('parseFrontendTemplate')]
    public function onParseFrontendTemplate(string $buffer, string $templateName, FrontendTemplate $template): string
    {
        if (!str_starts_with($templateName, 'ce_accordion') || !$this->adjustDefaultTemplate($template)) {
            return $buffer;
        }

        if (true === $template->accordion_first) {
            $buffer = '<div class="accordion" id="accordion_'.$template->accordion_parentId.'">'.$buffer;
        }

        if (true === $template->accordion_last) {
            $buffer .= '</div>';
        }

        return $buffer;
    }

    protected function adjustDefaultTemplate(Template $template): bool
    {
        if (!in_array($template->getName(), ['ce_accordionStart', 'ce_accordionStop', 'ce_accordionSingle'])) {
            return false;
        }

        return 'bootstrap5' === $this->frontendFrameworkHelper->currentFramework() && $this->frontendFrameworkHelper->currentTheme()->enhAcc_adjustDefaultTemplate;
    }


}