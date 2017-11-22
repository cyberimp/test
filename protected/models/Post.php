<?php


///Модель статьи
class Post extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tbl_post';
    }

    public function rules()
  	{
  		// NOTE: you should only define rules for those attributes that
  		// will receive user inputs.
  		return array(
  			array('title, content', 'required'),
  			array('title', 'length', 'max'=>128),
  			// The following rule is used by search().
  			// @todo Please remove those attributes that should not be searched.
  			array('title, content', 'safe', 'on'=>'search'),
  		);
    }

    protected function beforeSave()
    {
      if($this->isNewRecord){
        $this->create_time=new CDbExpression('NOW()');
      }
      return parent::beforeSave();
    }


    //здесь будем искать оценки
    public function relations()
  	{
  		// NOTE: you may need to adjust the relation name and the related
  		// class name for the relations automatically generated below.
  		return array(
  		);
  	}

  	/**
  	 * @return array customized attribute labels (name=>label)
  	 */
  	public function attributeLabels()
  	{
  		return array(
  			'id' => 'ID',
  			'title' => 'Название',
  			'content' => 'Содержание',
  			'create_time' => 'Время создания',
  		);
  	}

  	/**
  	 * Retrieves a list of models based on the current search/filter conditions.
  	 *
  	 * Typical usecase:
  	 * - Initialize the model fields with values from filter form.
  	 * - Execute this method to get CActiveDataProvider instance which will filter
  	 * models according to data in model fields.
  	 * - Pass data provider to CGridView, CListView or any similar widget.
  	 *
  	 * @return CActiveDataProvider the data provider that can return the models
  	 * based on the search/filter conditions.
  	 */
  	public function search()
  	{
  		// @todo Please modify the following code to remove attributes that should not be searched.

  		$criteria=new CDbCriteria;

  		$criteria->compare('id',$this->id);
  		$criteria->compare('title',$this->title,true);

  		return new CActiveDataProvider($this, array(
  			'criteria'=>$criteria,
  		));
  	}


  }

?>
