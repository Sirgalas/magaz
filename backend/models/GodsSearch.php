<?php

namespace backend\models;

use common\models\Addlfeild;
use common\models\Category;
use common\models\Prise;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Gods;

/**
 * GodsSearch represents the model behind the search form about `common\models\Gods`.
 */
class GodsSearch extends Gods
{
    public $article;
    public $category;
    public $site;
    public $id_provider;
    public $size;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_prise', 'create_at', 'upedate_at','have'], 'integer'],
            [['title', 'discription_gods','article','category','slug_gods','site','id_provider','url','size'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if (array_key_exists('sort',$params)){
            $query = Gods::find();
        }else{
            $query = Gods::find()->orderBy(['upedate_at'=>SORT_DESC])->with('user','addfeilds','category','prise','categorys');

        }
            $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if(isset($params['GodsSearch']['article'])){
            if($params['GodsSearch']['article']!=''){
                $all_fields=Addlfeild::find()->where(['like','value', $params['GodsSearch']['article']])->all();
                foreach ($all_fields as $one_field) {
                    $id_goods[]=$one_field->id_gods;
                }
            }
        }
        if(isset($params['GodsSearch']['category'])){
            if($params['GodsSearch']['category']!='') {
                $cat = Category::findOne(['id' => $params['GodsSearch']['category']]);
                $id_goods_for_cat = array();
                foreach ($cat->gods as $goods) {
                    $id_goods_for_cat[] = $goods->id;
                }
            }
        }
        if(!empty($params['GodsSearch']['site'])){
            $prises=Prise::find()->where(['sites'=>$params['GodsSearch']['site']])->select('id')->all();
            $id_price_for_sites=array();
            foreach ($prises as $prise){
                $id_price_for_sites[]=$prise->id;
            }

        }
        if(!empty($params['GodsSearch']['size'])){
            $size=Addlfeild::find()->where(['value'=>$params['GodsSearch']['size']])->all();
            $id_goods=array();
            foreach ($size as $value) {
               $id_goods[]=$value->id_gods;
            }
        }
        if(isset($params['GodsSearch']['id_provider'])){
            if($params['GodsSearch']['id_provider']!='') {
                $id_goods_for_provider = array();
                $addFeilds = Addlfeild::find()->where(['value' => $params['GodsSearch']['id_provider']])->all();
                foreach ($addFeilds as $addFeild) {
                    $id_goods_for_provider[] = $addFeild->id_gods;
                }
            }
        }
        $this->load($params);
        if (!$this->validate()) {
            return var_dump($this->getErrors());
        }
        $query->andFilterWhere([
            'id'            => $this->id,
            'slug_gods'     => $this->slug_gods,
            'id_prise'      => $this->id_prise,
            'create_at'     => $this->create_at,
            'upedate_at'    => $this->upedate_at,
            'have'          => $this->have,
            'url'           => $this->url,

        ]);
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'discription_gods', $this->discription_gods]);

        if(isset($id_goods)) {
            $query->andFilterWhere(['in','id', $id_goods]);
        }
        if(isset($id_goods_for_cat)) {
            $query->andFilterWhere(['in','id', $id_goods_for_cat]);
        }
        if(isset($id_price_for_sites)){
            $query->andFilterWhere(['id_prise'=>$id_price_for_sites]);
        }
        if(!empty($id_goods_for_provider)){
            $query->andFilterWhere(['in','id',$id_goods_for_provider]);
        }
        return $dataProvider;
    }
}
