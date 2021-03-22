<?php

class NGRestController
{

    /**
     *
     * Associative array to map actions to REST objects
     * @var array
     */
    private $actionToClass = array(
        'loadobject' => 'NGRestLoadObject',
        'loadchildobjects' => 'NGRestLoadChildObjects',
        'loadobjectchange' => 'NGRestLoadObjectChange',
        'loadobjectchanges' => 'NGRestLoadObjectChanges',
        'loadancestors' => 'NGRestLoadAncestors',
        'deleteobject' => 'NGRestDeleteObject',
        'trashobject' => 'NGRestTrashObject',
        'untrashobject' => 'NGRestUnTrashObject',
        'moveobject' => 'NGRestMoveObject',
        'queryobjects' => 'NGRestQueryObjects',
        'saveobject' => 'NGRestSaveObject',
        'saveobjectchange' => 'NGRestSaveObjectChange',
        'servertime' => 'NGRestServertime',
        'createuid' => 'NGRestCreateUID',
        'echo' => 'NGRestEcho',
        'install' => 'NGRestInstall',
        'putfile' => 'NGRestPutFile',
        'getfilestate' => 'NGRestGetFileState',
        'login' => 'NGRestLogin',
        'logout' => 'NGRestLogout',
        'loadlanguage' => 'NGRestLoadLanguage',
        'savelanguage' => 'NGRestSaveLanguage',
        'getobjectchangescount' => 'NGRestGetObjectChangesCount',
        'getlastobjectchangeuid' => 'NGRestGetLastObjectChangeUID',
        'readmeta' => 'NGRestReadMeta',
        'writemeta' => 'NGRestWriteMeta',
        'clearcache' => 'NGRestClearCache',
        'plugincallback' => 'NGRestPluginCallback',
        'countobjects' => 'NGRestCountObjects',
        'geturl' => 'NGRestGetURL',
        'shop.savecustomer' => 'NGRestShopSaveCustomer',
        'shop.loadcustomer' => 'NGRestShopLoadCustomer',
        'shop.querycustomers' => 'NGRestShopQueryCustomers',
        'shop.queryorders' => 'NGRestShopQueryOrders',
        'shop.loadorder' => 'NGRestShopLoadOrder',
        'shop.saveorder' => 'NGRestShopSaveOrder',
        'shop.deleteorder' => 'NGRestShopDeleteOrder',
        'shop.deletecustomer' => 'NGRestShopDeleteCustomer',
        'shop.createorderitem' => 'NGRestShopCreateOrderItem',
        'shop.getordercount' => 'NGRestShopGetOrderCount',
        'shop.getcustomercount' => 'NGRestShopGetCustomerCount',
        'shop.getcustomercountdeleted' => 'NGRestShopGetCustomerCountDeleted',
        'shop.getordercountdeleted' => 'NGRestShopGetOrderCountDeleted',
        'shop.getnextcustomerdeleted' => 'NGRestShopGetNextCustomerDeleted',
        'shop.getnextorderdeleted' => 'NGRestShopGetNextOrderDeleted',
        'shop.getlastchangeuidcustomer' => 'NGRestShopGetLastChangeUIDCustomer',
        'shop.getlastchangeuidorder' => 'NGRestShopGetLastChangeUIDOrder',
        'shop.getlastchangeuidcustomerdeleted' => 'NGRestShopGetLastChangeUIDCustomerDeleted',
        'shop.getlastchangeuidorderdeleted' => 'NGRestShopGetLastChangeUIDOrderDeleted',
        'shop.getstockcount' => 'NGRestShopGetStockCount',
        'shop.resendmail' => 'NGRestShopResendMail',
        'shop.sendmail' => 'NGRestShopSendMail',
        'shop.loadstock' => 'NGRestShopLoadStock',
        'shop.loadstocks' => 'NGRestShopLoadStocks',
        'shop.getlastchangeuidstock' => 'NGRestShopGetLastChangeUIDStock',
        'shop.savestock' => 'NGRestShopSaveStock',
        'shop.savestocks' => 'NGRestShopSaveStocks',
        'shop.loaddownload' => 'NGRestShopLoadDownload',
        'shop.savedownload' => 'NGRestShopSaveDownload',
        'shop.getlastchangeuiddownload' => 'NGRestShopGetLastChangeUIDDownload',
        'shop.getdownloadcount' => 'NGRestShopGetDownloadCount',
        'shop.createbill' => 'NGRestShopCreateBill',
        'shop.loadbill' => 'NGRestShopLoadBill',
        'shop.completeorder' => 'NGRestShopCompleteOrder',
        'shop.getbillcount' => 'NGRestShopGetBillCount',
        'shop.savebill' => 'NGRestShopSaveBill',
        'shop.putbillfile' => 'NGRestShopPutBillFile',
        'shop.getlastbillid' => 'NGRestShopGetLastBillId',
        'shop.loadcoupon' => 'NGRestShopLoadCoupon',
        'shop.savecoupon' => 'NGRestShopSaveCoupon',
        'shop.deletecoupon' => 'NGRestShopDeleteCoupon',
        'shop.querycoupons' => 'NGRestShopQueryCoupons',
        'shop.getcouponcount' => 'NGRestShopGetCouponCount',
        'shop.getcouponcountdeleted' => 'NGRestShopGetCouponCountDeleted',
        'shop.getnextcoupondeleted' => 'NGRestShopGetNextCouponDeleted',
        'shop.getlastchangeuidcoupon' => 'NGRestShopGetLastChangeUIDCoupon',
        'shop.getlastchangeuidcoupondeleted' => 'NGRestShopGetLastChangeUIDCouponDeleted'
    );

    /**
     *
     * Performs the rest call
     * @var NGRest
     */
    public $rest;

    /**
     *
     * Performs a rest call
     * @param string $action Action to perform
     * @param string $query Query parameters
     * @return string Query result
     */
    public function restCall($action, $query = null, $sessionUID)
    {
        set_error_handler(array($this, 'errorHandler'));

        try {
            if ($action === null) throw new NGMissingPostException();

            if (substr($action, 0, 5) === 'shop.' && !NGConfig::IsShop) throw new Exception('Missing shop components', 20010);

            if (!array_key_exists($action, $this->actionToClass)) throw new Exception("Action '$action' is not implemented.", 20000);


            $className = $this->actionToClass[$action];

            $this->rest = new $className;

            if ($this->rest->loginRequired()) {
                if (!NGSession::getInstance()->resume($sessionUID)) {
                    throw new NGNotLoggedInException();
                }
            }

            return $this->rest->restCall($query);
        } catch (NGException $ngException) {
            $restException = new NGRestException($ngException, $ngException->getHideDebugInfo(), $ngException->getAdditionalInfo());

            return $restException->restCall('');
        } catch (Exception $exception) {
            $restException = new NGRestException($exception);

            return $restException->restCall('');
        }
    }

    /**
     *
     * Error Error handler to call
     * @param int $code
     * @param string $message
     * @param string $filename
     * @param string $lineno
     * @throws ErrorException
     */
    public function errorHandler($code, $message, $filename, $lineno)
    {
        throw new ErrorException($message, $code, E_ERROR, $filename, $lineno);
    }
}
