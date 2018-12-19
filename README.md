# Pxl Pluri Search PSE

Filter PSE by attributes combinations in the price tab on the product edit admin page.

## Installation

### Manually

* Copy the module into ```<thelia_root>/local/modules/``` directory and be sure that the name of the module is PxlPluriSearchPSE.
* Activate it in your thelia administration panel

### Composer

Add it in your main thelia composer.json file

```
composer require pixel-plurimedia/pxl-pluri-search-pse-module:~1.0
```

## Usage

You must edit the product-prices-tab.html file in the thelia-root/templates/backOffice/default/includes folder :
* Just add "product_id=$product_id template_id=$TEMPLATE" to the hook named "product.before-combinations"

## Hook

* Add template attributes selection on the product.before-combinations hook
* Add Ajax search on the product.edit-js hook

www.pixel-plurimedia.fr
