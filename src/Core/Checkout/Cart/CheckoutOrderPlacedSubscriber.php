<?php declare(strict_types=1);

namespace ShirtCharity\Choix\Core\Checkout\Cart;

use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class CheckoutOrderPlacedSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityRepositoryInterface
     */
    private $orderRepository;

    public function __construct(EntityRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CheckoutOrderPlacedEvent::class => 'onCheckoutOrderPlacedEvent',
        ];
    }

    public function onCheckoutOrderPlacedEvent(CheckoutOrderPlacedEvent $event): void
    {
        $order = $event->getOrder();
        if (!$order) {
            return;
        }

        $session = new Session();
        $dataTransferAccepted = $session->get('shirtcharity.choix.dataTransferAccepted');

        if ($dataTransferAccepted !== null) {
            $session->set('shirtcharity.choix.dataTransferAccepted', null);
            $this->orderRepository->update([[
                'id' => $order->getId(),
                'customFields' => ['data_transfer_accepted' => (bool) $dataTransferAccepted],
            ]], $event->getContext());
        }
    }
}
