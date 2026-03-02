<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\ProductBundleWidget\Widget;

use Generated\Shared\Transfer\ProductViewTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerShop\Yves\ProductBundleWidget\ProductBundleWidgetFactory getFactory()
 */
class ProductBundleProductDetailPageItemsListWidget extends AbstractWidget
{
    /**
     * @var string
     */
    protected const PARAMETER_BUNDLE_ITEMS = 'bundleItems';

    /**
     * @var string
     */
    protected const PARAMETER_IS_VISIBLE = 'isVisible';

    public function __construct(ProductViewTransfer $productViewTransfer)
    {
        $this->addBundleItemsParameter($productViewTransfer);
        $this->addIsVisibleParameter($productViewTransfer);
    }

    public static function getName(): string
    {
        return 'ProductBundleProductDetailPageItemsListWidget';
    }

    public static function getTemplate(): string
    {
        return '@ProductBundleWidget/views/product-detail-page-items-list/product-detail-page-items-list.twig';
    }

    protected function addBundleItemsParameter(ProductViewTransfer $productViewTransfer): void
    {
        $this->addParameter(static::PARAMETER_BUNDLE_ITEMS, $productViewTransfer->getBundledProducts());
    }

    protected function addIsVisibleParameter(ProductViewTransfer $productViewTransfer): void
    {
        $this->addParameter(static::PARAMETER_IS_VISIBLE, $this->getIsVisibleParameter($productViewTransfer));
    }

    protected function getIsVisibleParameter(ProductViewTransfer $productViewTransfer): bool
    {
        return $productViewTransfer->getBundledProducts()->count() > 0;
    }
}
