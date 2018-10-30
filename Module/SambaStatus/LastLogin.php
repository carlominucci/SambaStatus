<?php
namespace NethServer\Module\SambaStatus;

use Nethgui\System\PlatformInterface as Validate;

class LastLogin extends \Nethgui\Controller\AbstractController
{
    private $file;

    public function initialize()
    {
        parent::initialize();
        $this->declareParameter('SystemName', $this->createValidator()->memberOf(array('0','1')));
    }
}
