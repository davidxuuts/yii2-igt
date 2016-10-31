Getui Library with Psr-4
========================
Based on Getui SDK (PHP) 4.0.1.0

Functions
---------
1. Silent transmission message to single user
2. Normal transmission message to single user
3. Normal transmission message to all users

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist davidxu/igt "*"
```

or add

```
"davidxu/igt": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by :

```php
/**
 * Send normal transmission message to all app users
 * Will play a sound and a badge (1) will display
 * 
 *   $content = [
 *       'payloadTitle' => 'transmission Title',
 *       'payloadContet' => 'transmission content here',
 *   ];
 *    $payload = Json::encode($content);
 *    $alertTitle = 'Attention Please';
 *    $alert_body = 'Alert Body Here, you have a unread message';
 * 
 * @param mixed $content
 * @param string $alertBody
 * @param string $alertTitle
 * @return mixed|null
 *
 * Sample of return result
 * {
 *    "result": "ok",
 *    "contentId": "OSA-1031_tAvRLPhf5Q9d2IAADSKOn9"
 *  }
 *
 */
public function actionSystemMsg($content, $alertBody, $alertTitle)
{
    $getui = new Getui();
    $getui->appId = '<appId>';
    $getui->appkey = '<appKey'>;
    $getui->$masterSecret = '<masterSecret'>;
    $response = $getui->pushTransmissionAlertToApp($content, $alertBody, $alertTitle);
    return $response;
}
```

Remark
------
Please refer to [Getui official documentation](http://docs.getui.com) and [Local and Remote Notification Programming Guide](https://developer.apple.com/library/content/documentation/NetworkingInternet/Conceptual/RemoteNotificationsPG/index.html#//apple_ref/doc/uid/TP40008194-CH3-SW1)

Any other question please contact me at [david.xu.uts@163.com](mailto:david.xu.uts@163.com)
