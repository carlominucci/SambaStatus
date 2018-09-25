<?php
namespace NethServer\Module\SambaStatus;

use Nethgui\System\PlatformInterface as Validate;

class Share extends \Nethgui\Controller\AbstractController
{
    private $share;

    public function initialize()
    {
        parent::initialize();
        $this->declareParameter('SystemName', $this->createValidator()->memberOf(array('0','1')));
    }
}
