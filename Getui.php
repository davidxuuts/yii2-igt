<?php
/**
 * Created by PhpStorm.
 * User: davidxu
 * Date: 30/10/2016
 * Time: 4:45 PM
 */

namespace davidxu\igt;
use davidxu\igt\core\DictionaryAlertMsg;
use davidxu\igt\core\IGtAPNPayload;
use davidxu\igt\core\IGtAppMessage;
use davidxu\igt\core\IGtSingleMessage;
use davidxu\igt\core\IGtTarget;
use davidxu\igt\template\IGtNotificationTemplate;
use davidxu\igt\template\IGtTransmissionTemplate;

/**
 * Getui Push Messages
 *
 * There are 4 message templates supplied by getui.com,
 * 1.TransmissionTemplate: All messages will transfer to App internal
 * 2.LinkTemplate: Messages will show on top of mobile, for access to a LINK URL
 * 3.NotificationTemplate：Notification Template
 * 4.NotyPopLoadTemplate：Popup Notification Template for downloading
 *
 */
class Getui
{
    const PUSH_TEMPLATE_TRANSMISSION_SILENT  = 10;
    const PUSH_TEMPLATE_TRANSMISSION_ALERT   = 20;
    const PUSH_TEMPLATE_NOTIFICATION         = 30;
//    const PUSH_TEMPLATE_LINK                 = 40;
//    const PUSH_TEMPLATE_NOTY_POP_LOAD        = 50;

    /**
     * @var string $appKey The app key from Getui provider
     */
    public $appkey = 'J3hKrIpDP06CuVGYpvxkl8';

    /**
     * @var string $appId The app ID from Getui provider
     */
    public $appId = 'BpGI5WHqdZ97mciaFihJx6';

    /**
     * @var string $masterSecret The master secret from Getui provider
     */
    public $masterSecret = '1OtRbNaIsbA6HA2rB8YTJ7';

    /**
     * @var string $host The host need to access
     */
    public $host = 'http://sdk.open.api.igexin.com/apiex.htm';

    public $logo = null;

    /**
     * Push silence transmission message to single user
     *
     * @param string $clientId __用户的个推Client ID__
     * @param mixed $msgContent
     * @return mixed
     */
    public function pushTransmissionSilenceToSingle($clientId, $msgContent)
    {
        $template = $this->templateTransmissionSilence($msgContent);
        $response = $this->handleTransmissionSingleTemplate($clientId, $template);
        return $response;
    }

    /**
     * Push alert transmission message to single user
     *
     * @param string $clientId __用户的个推Client ID__
     * @param mixed $msgContent
     * @param string $alertTitle
     * @param string $alertBody
     * @param integer $badge
     * @param boolean $isRing
     * @param integer $transmissionType
     * @return mixed
     */
    public function pushTransmissionAlertToSingle($clientId, $msgContent, $alertBody, $alertTitle, $badge = 1, $isRing = true, $transmissionType = 1)
    {
        $template = $this->templateTransmissionAlert($msgContent, $alertBody, $alertTitle, $badge, $isRing, $transmissionType);
        $response = $this->handleTransmissionSingleTemplate($clientId, $template);
        return $response;
    }

    /**
     * @param mixed $msgContent
     * @param mixed $alertBody
     * @param string $alertTitle
     * @param integer $badge
     * @param boolean $isRing
     * @param integer $transmissionType
     * @return mixed|null
     */
    public function pushTransmissionAlertToApp($msgContent, $alertBody, $alertTitle, $badge = 1, $isRing = true, $transmissionType = 1)
    {
        $template = $this->templateTransmissionAlert($msgContent, $alertBody, $alertTitle, $badge, $isRing, $transmissionType);

        $message = new IGtAppMessage();
        $message->set_isOffline(true);
        $message->set_offlineExpireTime(3600 * 72 * 1000);
        $message->set_data($template);
//        $message->set_speed(100);
        $message->set_appIdList([$this->appId]);

        $igt = new IGeTui('', $this->appkey, $this->masterSecret);
        return $response = $igt->pushMessageToApp($message);
    }

    /**
     * @param mixed $content
     * @param integer $transmissionType 1: Start Immediately; 2. Broadcast and waiting for manual starting
     * @return string
     */
    protected function templateTransmissionSilence($content, $transmissionType = 2)
    {
        $apnPayload = new IGtAPNPayload();
        $apnPayload->sound = "com.gexin.ios.silence";
        $apnPayload->badge = 0;
        $apnPayload->contentAvailable = 1;
//        $apnPayload->add_customMsg("payload","阿波罗度上市");

        $template = new IGtTransmissionTemplate();
        $template->set_appId($this->appId);
        $template->set_appkey($this->appkey);
        $template->set_transmissionType($transmissionType);
        $template->set_transmissionContent($content);

        $template->set_apnInfo($apnPayload);
        return $template;
    }

    /**
     * @param string $alertTitle
     * @param string $alertBody
     * @param integer $badge
     * @param boolean $isRing
     * @param mixed $msgContent
     * @param integer $transmissionType 1: Start Immediately; 2. Broadcast and waiting for manual starting
     * @return string
     */
    protected function templateTransmissionAlert($msgContent, $alertBody, $alertTitle, $badge, $isRing, $transmissionType)
    {
        $alertMsg = new DictionaryAlertMsg();
        $alertMsg->body = $alertBody;
        //for iOS 8.2 or above
        $alertMsg->title = $alertTitle;

        $apnPayload = new IGtAPNPayload();
        $apnPayload->alertMsg = $alertMsg;
        $apnPayload->sound = $isRing ? "default" : "com.gexin.ios.silence";
        $apnPayload->badge = $badge;
        $apnPayload->contentAvailable = 1;

        $template = new IGtTransmissionTemplate();
        $template->set_appId($this->appId);
        $template->set_appkey($this->appkey);
        $template->set_transmissionType($transmissionType);
        $template->set_transmissionContent($msgContent);
        $template->set_apnInfo($apnPayload);
        return $template;
    }

    /**
     * @param $content
     * @param $notificationTitle
     * @param $notificationText
     * @param bool $isRing
     * @param bool $isVibrate
     * @param bool $isClearable
     * @param int $transmissionType
     * @return IGtNotificationTemplate
     */
    protected function templateNotification($content, $notificationTitle, $notificationText, $transmissionType = 1, $isRing = true, $isVibrate = true, $isClearable = true)
    {
        $template = new IGtNotificationTemplate();
        $template->set_appId($this->appId);
        $template->set_appkey($this->appkey);
        $template->set_transmissionType($transmissionType);
        $template->set_transmissionContent($content);
        $template->set_title($notificationTitle);
        $template->set_text($notificationText);
        $template->set_logo("");
        $template->set_logoURL("");
        $template->set_isRing($isRing);
        $template->set_isVibrate($isVibrate);
        $template->set_isClearable($isClearable);
        return $template;
    }

    /**
     * @param $clientId
     * @param $template
     * @return array
     */
    private function handleTransmissionSingleTemplate($clientId, $template)
    {
        // Create Message
        $message = new IGtSingleMessage();
        $message->set_isOffline(true);
        $message->set_offlineExpireTime(3600 * 72 * 1000);
        $message->set_data($template);
        $message->set_pushNetWorkType(0);

        // Message Receiver
        $target = new IGtTarget();
        $target->set_appId($this->appId);
        $target->set_clientId($clientId);

        $igt = new IGetui($this->host, $this->appkey, $this->masterSecret);
        try {
            $response = $igt->pushMessageToSingle($message, $target);
            return $response;
        } catch (RequestException $e) {
            $requestId = $e->getRequestId();
            $response = $igt->pushMessageToSingle($message, $target, $requestId);
            return $response;
        }
    }

}
