<?php
namespace NethServer\Module;

class SambaStatus extends \Nethgui\Controller\TabsController
{
    protected function initializeAttributes(\Nethgui\Module\ModuleAttributesInterface $base)
    {
        return \Nethgui\Module\SimpleModuleAttributesProvider::extendModuleAttributes($base, 'Status');
    }

    public function initialize()
    {
        parent::initialize();
        $this->loadChildrenDirectory();
    }

}
