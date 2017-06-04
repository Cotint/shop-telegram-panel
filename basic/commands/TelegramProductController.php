<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use Telegram\Bot\Api;
use app\models\Product;
use app\models\ProductSearch;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TelegramProductController extends Controller
{
	private $botToken = "383722259:AAGCXxyl-fdUa8q6gD-J-67W64fscQ6Q8ig";
	private $telegramApi = "https://api.telegram.org/bot";

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionSendMessage()
    {
		$rows = (new \yii\db\Query())
	    ->select(['pro_ID', 'pro_Name'])
	    ->from('product')
	    ->orderBy(['created_at' => SORT_DESC])
        ->where(['telegram_send' => false])
	    ->one();

        if ($rows == false) {
            return;
        }

        $id = $rows['pro_ID'];
        $product = Product::findOne($id);
        $product->telegram_send = true;
        $product->save();

        $telegram = new Api($this->botToken);

        $response = $telegram->sendMessage([
            'chat_id' => '@cotinttelegram2', 
            'text' => $rows['pro_Name']
        ]);
    }

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionSendPhoto()
    {
		$rows = (new \yii\db\Query())
	    ->select(['pro_ID', 'pro_Name', 'pro_thumb', 'pro_Description', 'pro_FirstPrice', 'pro_LastPrice'])
	    ->from('product')
	    ->orderBy(['created_at' => SORT_DESC])
        ->where(['telegram_send' => false])
	    ->one();

        if ($rows == false) {
            return;
        }

        $id = $rows['pro_ID'];
        $product = Product::findOne($id);
        $product->telegram_send = true;
        // $product->save();

        $productTags = Product::find()->with('tags')->where(['pro_ID' => $id])->one();


	    $fileName = $rows['pro_thumb'];
        $productTitle = $rows['pro_Name'];
        $productDesc = $rows['pro_Description'];
        $productBrand = $product->proBra['bra_Name'];
        $productFirstPrice = $product['pro_FirstPrice'];
        $productLastPrice = $product['pro_LastPrice'];
        $footer = '
        •-----✵❃✵-----•
        @Farhangpazir
        ¯\_(ツ)_/¯
        ';
	    $address = "http://telegram.shopket.ir/wordpress-panel-1/basic/web/pro_image/original/".$fileName.".jpg";

        $telegram = new Api($this->botToken);

        $text = $productTitle;
        $text .= "\n";
        $text .= "برند :‌ ".$productBrand;
        $text .= "\n";
        $text .= "قیمت: ".$productFirstPrice;
        $text .= "\n";
        $text .= "قیمت با تخفیف :‌ ".$productLastPrice;
        $text .= "\n";

        foreach ($productTags->tags as $key => $value) {
            $text .= '#'.$value['tag_name'].' ';
        }

        if ($fileName != NULL) {
            $telegram
            ->setAsyncRequest(true)
            ->sendPhoto([
                'chat_id' => '@cotinttelegram2',
                'photo' => $address,
                'caption' => $text,
                ]);
        } else {
            $response = $telegram->sendMessage([
                'chat_id' => '@cotinttelegram2', 
                'text' => $text
            ]);
        }
    }

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionGetMe()
    {
        $telegram = new Api($this->botToken);

        $response = $telegram->getMe();

        $botId = $response->getId();
        $firstName = $response->getFirstName();
        $username = $response->getUsername();

        echo $botId;
        echo "\n";
        echo $firstName;
        echo "\n";
        echo $username;
        echo "\n";
    }
}
