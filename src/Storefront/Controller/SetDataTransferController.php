<?php declare(strict_types=1);

namespace ShirtCharity\Choix\Storefront\Controller;

use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes={"storefront"})
 */
class SetDataTransferController extends StorefrontController
{
    /**
     * @Route("shirtcharity/checkout/data-transfer", name="shirtcharity.checkout.dataTransfer", methods={"POST"}, options={"seo"="false"}, defaults={"XmlHttpRequest"=true})
     */
    public function setDataTransfer(RequestDataBag $requestDataBag, SalesChannelContext $salesChannelContext): Response
    {
        $session = new Session();
        $session->set('shirtcharity.choix.dataTransferAccepted', (bool) $requestDataBag->get('dataTransferAccepted'));

        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);

        return $response;
    }
}
