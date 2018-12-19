<?php
/*************************************************************************************/
/*      This file is part of the PxlPluriSearchPSE module.                           */
/*                                                                                   */
/*      Copyright (c) Pixel Plurimedia                                               */
/*      email : dev@pixel-plurimedia.fr                                              */
/*      web : https://pixel-plurimedia.fr                                            */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace PxlPluriSearchPSE\Controller;

use Thelia\Controller\Admin\ProductController;
use Thelia\Core\HttpFoundation\JsonResponse;
use Thelia\Model\AttributeCombinationQuery;
use Thelia\Model\AttributeQuery;
use Thelia\Model\AttributeAvQuery;

use PxlPluriSearchPSE\PxlPluriSearchPSE;

/**
 * Class AdminPSEController
 * @package PxlPluriSearchPSE\Controller
 * @author Thierry Caresmel <thierry@pixel-plurimedia.fr>
 */
class AdminPSEController extends ProductController
{
    public function searchPSEAction()
    {
        $tabData = $this->getRequest()->query->get('tab_data', false);
        $productId = $this->getRequest()->query->get('product_id', 0);

        $attrIds = [];
        $attrAvIds = [];
        $i=0;
        foreach($tabData as $attrId => $attrAv) {
            $attrIds[] = $attrId;
            $i++;
            foreach($attrAv as $attrAvId) {
                $attrAvIds[] = $attrAvId;
            }
        }

        $pseIds = AttributeCombinationQuery::create()
            ->useProductSaleElementsQuery()
            ->filterByProductId($productId)
            ->endUse()
            ->filterByAttributeId($attrIds)
            ->filterByAttributeAvId($attrAvIds)
            ->having('COUNT(AttributeCombination.product_sale_elements_id) >= ?', $i, \PDO::PARAM_INT)
            ->groupBy('AttributeCombination.product_sale_elements_id')
            ->select('product_sale_elements_id')
            ->find()
            ->getData()
            ;

        return new JsonResponse(['result' => $pseIds]);
    }
}
