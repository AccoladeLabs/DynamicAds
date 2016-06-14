<?php

class Accolade_Dynamicads_Model_Observer  {
	
	
	public function logCartAdd(Varien_Event_Observer $observer) {
 
        $event = $observer->getEvent();  
        $product = $event->getProduct();
        $categoryIds = $product->getCategoryIds();
        if (is_array($categoryIds) and count($categoryIds) >= 1) {
            $productCategory = Mage::getModel('catalog/category')->load($categoryIds[0])->getName();
        }else{
			$productCategory = '';
		};
		
        Mage::getModel('core/session')->setProductToShoppingCart(
            new Varien_Object(array(
                'id' => $product->getId(),
                'qty' => Mage::app()->getRequest()->getParam('qty', 1),
                'name' => $product->getName(),
				'sku' => $product->getSku(),
                'price' => $product->getPrice(),
                'category_name' => $productCategory,
            ))
        );
    }

}
