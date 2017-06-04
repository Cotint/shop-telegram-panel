<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use Telegram\Bot\Api;
use app\models\News;
use app\models\NewsSearch;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TelegramNewsController extends Controller
{
	private $botToken = "331877590:AAHGuu5BOnZLfZP4Ci-dG4VzDeRantRMHwg";
	private $telegramApi = "https://api.telegram.org/bot";

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionSendMessage()
    {
		$rows = (new \yii\db\Query())
	    ->select(['news_id', 'news_title'])
	    ->from('news')
	    ->orderBy(['created_at' => SORT_DESC])
        ->where(['telegram_send' => false])
	    ->one();

        if ($rows == false) {
            return;
        }

        $id = $rows['news_id'];
        $news = News::findOne($id);
        $news->telegram_send = true;
        $news->save();

        $telegram = new Api($this->botToken);

        $response = $telegram->sendMessage([
            'chat_id' => '@cotinttelegram', 
            'text' => $rows['news_title']
        ]);
    }

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionSendPhoto()
    {
		$rows = (new \yii\db\Query())
	    ->select(['news_id', 'news_title', 'news_thumb', 'news_description'])
	    ->from('news')
	    ->orderBy(['created_at' => SORT_DESC])
        ->where(['telegram_send' => false])
	    ->one();

        if ($rows == false) {
            return;
        }

	    $fileName = $rows['news_thumb'];
        $newsTitle = $rows['news_title'];
        $newsDesc = $rows['news_description'];

	    $address = "http://telegram.shopket.ir/wordpress-panel-1/basic/web/news_image/original/".$fileName.".jpg";

        $id = $rows['news_id'];
        $news = News::findOne($id);
        $news->telegram_send = true;
        // $news->save();

        $newsTags = News::find()->with('tags')->where(['news_id' => $id])->one();

        $telegram = new Api($this->botToken);

        $text = $newsTitle;
        $text .= "\n";
        $text .= $newsDesc;
        $text .= "\n";

        foreach ($newsTags->tags as $key => $value) {
            $text .= '#'.$value['tag_name'].' ';
        }
    
        if ($fileName != NULL) {
            $telegram
            ->setAsyncRequest(true)
            ->sendPhoto([
                'chat_id' => '@cotinttelegram',
                'photo' => $address,
                'caption' => $text,
                ]);
        } else {
            $response = $telegram->sendMessage([
                'chat_id' => '@cotinttelegram', 
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
