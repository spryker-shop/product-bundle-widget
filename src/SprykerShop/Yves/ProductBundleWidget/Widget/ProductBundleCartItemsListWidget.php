<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\ProductBundleWidget\Widget;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerShop\Yves\ProductBundleWidget\ProductBundleWidgetFactory getFactory()
 */
class ProductBundleCartItemsListWidget extends AbstractWidget
{
    public function __construct(ItemTransfer $itemTransfer, QuoteTransfer $quoteTransfer)
    {
        $this->addParameter('bundleItems', $this->getBundleItems($itemTransfer, $quoteTransfer));
    }

    public static function getName(): string
    {
        return 'ProductBundleCartItemsListWidget';
    }

    public static function getTemplate(): string
    {
        return '@ProductBundleWidget/views/cart-bundle-items-list/cart-bundle-items-list.twig';
    }

    protected function getBundleItems(ItemTransfer $itemTransfer, QuoteTransfer $quoteTransfer): array
    {
        $groupedItems = $this->getGroupedItems($quoteTransfer);
        foreach ($groupedItems as $groupedItem) {
            if (!is_array($groupedItem)) {
                continue;
            }

            /** @var \Generated\Shared\Transfer\ItemTransfer $groupedItemTransfer */
            $groupedItemTransfer = $groupedItem['bundleProduct'];
            if ($groupedItemTransfer->getSku() === $itemTransfer->getSku()) {
                return $groupedItem['bundleItems'];
            }
        }

        return [];
    }

    protected function getGroupedItems(QuoteTransfer $quoteTransfer): array
    {
        return $this->getFactory()
            ->getProductBundleClient()
            ->getGroupedBundleItems($quoteTransfer->getItems(), $quoteTransfer->getBundleItems());
    }
}
