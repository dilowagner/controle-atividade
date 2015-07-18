<?php
/**
 * Class AlertMessage
 */
namespace Base\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;
use Zend\View\Helper\FlashMessenger;
use Zend\Mvc\Controller\Plugin\FlashMessenger as FlashMessage;

class AlertMessage extends AbstractHelper
{
    private $flashMessenger;

    public function __construct(FlashMessenger $flashMessenger)
    {
        $this->flashMessenger = $flashMessenger;
    }


    public function __invoke($includeCurrentMessages = true)
    {
        $messages = array(
            FlashMessage::NAMESPACE_ERROR   => array(),
            FlashMessage::NAMESPACE_SUCCESS => array(),
            FlashMessage::NAMESPACE_WARNING => array(),
            FlashMessage::NAMESPACE_INFO    => array(),
            FlashMessage::NAMESPACE_DEFAULT => array()
        );

        foreach ($messages as $ns => &$m) {
            $m = $this->flashMessenger->getMessagesFromNamespace($ns);
            if ($includeCurrentMessages) {
                $m = array_merge($m, $this->flashMessenger->getCurrentMessagesFromNamespace($ns));
                $this->flashMessenger->clearCurrentMessagesFromNamespace($ns);
            }
        }

        $html = null;
        foreach ($messages as $type => $typeMessages) {
            $type = $type == 'error' ? 'danger' : $type;
            foreach ($typeMessages as $message) {
                $html .= sprintf("<div class='col-md-12 alert alert-%s'><button type='button' class='close' data-dismiss='alert'>&times;</button> %s </div><br/>", $type, $message);
            }
        }
        return $html;
    }
}