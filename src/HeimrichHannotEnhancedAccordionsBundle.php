<?php

namespace HeimrichHannot\EnhancedAccordionsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HeimrichHannotEnhancedAccordionsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

}