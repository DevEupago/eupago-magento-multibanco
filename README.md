euPago Multibanco payment gateway extension for Magento 2


Install using File Upload:


1) At Magento 2 root folder go to the **app/code/** folder and create the structure **Eupago/Multibanco**

2) Put the content of the ZIP file inside the folder **Multibanco** created at step 2.

3) Execute comands above:

		3.1) bin/magento module:enable --clear-static-content Eupago_Multibanco

		3.2) bin/magento setup:upgrade

		3.3) bin/magento setup:di:compile

		3.4) bin/magento setup:static-content:deploy -f
  

4) Enable and configure Eupago Multibanco in your Backoffice Magento 2 under "Stores/Configuration/Payment Methods/Eupago Multibanco".

5) url callback shoul be: http://your-store.com/Eupago/callback/multibanco 