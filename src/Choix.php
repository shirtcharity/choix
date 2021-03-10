<?php declare(strict_types=1);

namespace ShirtCharity\Choix;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepositoryInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\ContainsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\IdSearchResult;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\System\CustomField\CustomFieldTypes;

class Choix extends Plugin
{
    public function install(InstallContext $context): void
    {
        parent::install($context);
        $this->addCustomFields($context->getContext());
    }

    public function uninstall(UninstallContext $context): void
    {
        parent::uninstall($context);

        if ($context->keepUserData()) {
            return;
        }

        $this->removeCustomFields($context->getContext());
    }

    private function addCustomFields(Context $context): void
    {
        $customFieldIds = $this->getIds($this->container->get('custom_field.repository'), $context, 'data_transfer');
        if ($customFieldIds->getTotal() !== 0) {
            return;
        }

        $this->container->get('custom_field_set.repository')->create([[
            'name' => 'data_transfer',
            'config' => [
                'label' => [
                    'en-GB' => 'Data Transfer',
                    'de-DE' => 'Datenübermittlung',
                ],
            ],
            'relations' => [
                ['entityName' => 'order'],
            ],
            'customFields' => [
                [
                    'name' => 'data_transfer_accepted',
                    'type' => CustomFieldTypes::BOOL,
                    'config' => [
                        'componentName' => 'sw-checkbox-field',
                        'customFieldType' => 'checkbox',
                        'customFieldPosition' => 1,
                        'label' => [
                            'en-GB' => 'Accepted Data Transfer to Charity?',
                            'de-DE' => 'Datenübermittlung an Charity zugestimmt?',
                        ],
                    ],
                ],
            ],
        ]], $context);
    }

    private function removeCustomFields(Context $context): void
    {
        $fieldRepository = $this->container->get('custom_field.repository');
        $customFieldIds = $this->getIds($fieldRepository, $context, 'data_transfer');
        if ($customFieldIds->getTotal() === 0) {
            return;
        }

        $ids = array_map(static function ($id) {
            return ['id' => $id];
        }, $customFieldIds->getIds());
        $fieldRepository->delete($ids, $context);

        $fieldSetRepository = $this->container->get('custom_field_set.repository');
        $customFieldSetIds = $this->getIds($fieldSetRepository, $context, 'data_transfer');
        if ($customFieldSetIds->getTotal() === 0) {
            return;
        }

        $ids = array_map(static function ($id) {
            return ['id' => $id];
        }, $customFieldSetIds->getIds());
        $fieldSetRepository->delete($ids, $context);
    }

    private function getIds(EntityRepositoryInterface $repository, Context $context, string $name): IdSearchResult
    {
        $criteria = new Criteria();
        $criteria->addFilter(new ContainsFilter('name', $name));

        return $repository->searchIds($criteria, $context);
    }
}
