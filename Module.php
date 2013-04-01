<?php
namespace JerRouteLayouts;

use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;

/**
 * Module allowing route based layout configuration for ZF2
 */
class Module implements BootstrapListenerInterface
{
	/**
	 * @see BootstrapListenerInterface::onBootstrap()
	 */
    public function onBootstrap(EventInterface $e)
    {
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), 100);
    }

    /**
     * Listen to the dispatch event
     *
     * get the matched route and change the layout to the nearest parent configuration
     * @param MvcEvent $e
     */
    public function onDispatch(MvcEvent $e)
    {
        $oController = $e->getTarget();
        $sMatch = $e->getRouteMatch()->getMatchedRouteName();
        $aConfig = $e->getApplication()->getServiceManager()->get('config');
        $aMatch = array_reverse(explode('/', $sMatch));
        foreach($aMatch AS $sMatchPart)
        {
            if(isset($aConfig['route_layouts'][$sMatch]))
            {
                $oController->layout($aConfig['route_layouts'][$sMatch]);
                return;
            }
            else
            {
                $subLength = strlen($sMatchPart)+1;
                $sMatch = substr($sMatch, 0, '-' . $subLength);
            }
        }
    }
}