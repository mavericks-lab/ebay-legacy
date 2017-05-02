## eBay Trading API Package for Laravel 5.4

###Requirements
####Cloudinary
In order to use this package for listing products to eBay, you need to create a [cloudinary](http://cloudinary.com/) account.

### Dependencies
1. Php ^5.3.3 || ^7.0
2. guzzlehttp/guzzle ^6.2
3. cloudinary/cloudinary_php ^1.7

### Set up
1. run composer require **maverickslab/ebay-legacy**
2. run php artisan **vendor:publish**
3. edit your configuration files **"config/ebay.php"**

### Authenticating
To authorize your app to make requests to eBay on behalf of the merchant, you need to go though the authentication flow. Set up an app on the [eBay developer portal](https://go.developer.ebay.com/).
1. Set your **accepted url** to an endpoint on your app to receive the token. The default route on the package is **..yourdomain/ebay/authorized**. You can extend the **EbayController** and override the **authorized** method to handle the token response.
2. Set your **declined/rejected url** to an endpoint on your app to receive the token. The default route on the package is **..yourdomain/ebay/declined**. You can extend the **EbayController** and override the **declined** method to handle the token response.

Make a request to **...yourdomain/ebay/install** to test installation flow. 

### Making requests
In order to make requests, you have to make sure you have provided the required params in the **ebay.php** file in your **config** directory. To do this, copy and paste this in your .env file and make the necessary changes

EBAY_COMPATIBILITY_LEVEL=951
EBAY_RUNAME=XXXXXXXXX
EBAY_API_APP_NAME=XXXXXXXXX
EBAY_API_CERT_NAME=XXXXXXXXX
EBAY_API_DEV_NAME=XXXXXXXXX
EBAY_SIGN_IN_URL=https://signin.sandbox.ebay
EBAY_BASE_URL=https://api.sandbox.ebay.com/ws/api.dll
EBAY_WARNING_LEVEL=High
EBAY_ERROR_LANGUAGE=en_US
EBAY_USER_TOKEN=XXXXXXXXX

####Request methods
