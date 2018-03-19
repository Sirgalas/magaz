<?php
namespace common\models;
use pastuhov\ymlcatalog\CurrencyInterface;
use yii\db\ActiveRecord;

/**
 * @inheritdoc
 */
class Currency extends ActiveRecord implements CurrencyInterface
{
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return 'UA';
    }
    /**
     * @inheritdoc
     */
    public function getRate()
    {
        return '1';
    }
    /**
     * @inheritdoc
     */
    public function getPlus()
    {
        return false;
    }
    /**
     * @inheritdoc
     */
    public static function findYml($findParams = [])
    {
        $query = self::find();
        $query->orderBy('id');
        return $query;
    }
} ?>
