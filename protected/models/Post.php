<?php

class Post extends Model
{
	/**
	 * The followings are the available columns in table 'tbl_post':
	 * @var integer $id
	 * @var string $title
	 * @var string $content
	 * @var string $tags
	 * @var integer $status
	 * @var integer $create_time
	 * @var integer $update_time
	 * @var integer $author_id
	 */
	const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_ARCHIVED=3;

	private $_oldTags;
	public $image;
   

		/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'author' => array( self::BELONGS_TO , 'User', 'author_id'),
			'comments' => array( self::HAS_MANY , 'Comment', 'post_id', 'condition'=>'comments.status='.Comment::STATUS_APPROVED, 'order'=>'comments.create_time DESC'),
			'commentCount' => array( self::STAT , 'Comment', 'post_id', 'condition'=>'status='.Comment::STATUS_APPROVED),

	);
	}

    
    public function behaviors() {
        return array(
            // attach wform behavior
            'wform' => array(
                'class' => 'ext.wform.WFormBehavior',
                // define relations which would be processed
                'relations' => array('hasOneRelation', 'belongsToRelation', 'hasManyRelation', 'manyManyRelation'),
            ),
            // or you could allow to skip some relation saving if it was submitted empty
            'wform' => array(
                'class' => 'ext.wform.WFormBehavior',
                'relations' => array(
                    'hasOneRelation' => array('required' => true), // default for HAS_ONE: false
                    'belongsToRelation' => array('required' => true), // default for BELONGS_TO: false
                    'hasManyRelation' => array('required' => false), // default for HAS_MANY: true
                    'manyManyRelation' => array('required' => false), // default for MANY_MANY: true
                ),
            ),
        );
    }
	public function findRecentPosts( $limit ){
		
		$this->beginCriteria('created DESC','status ='.Post::STATUS_PUBLISHED);
		$today = new DateTime();
			$today->modify('-1 month'); 
			$compareDate = $today->format('Y-m-d');
		$criteria->addCondition( "created >" . $compareDate );

		return Post::model()->findAll( $criteria , array( 'limit'=>10 ) );

}
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, status', 'required'),
			array('status', 'in', 'range'=>array(1,2,3)),
			array('title', 'length', 'max'=>128),
			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
			array('tags', 'normalizeTags'),
			array('title, status', 'safe', 'on'=>'search'),
		);
	}



	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'title' => 'Title',
			'content' => 'Content',
			'tags' => 'Tags',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'author_id' => 'Author',
		);
	}
	
	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl( 'post/view', 
			array(
				'id'=>$this->id,
				'title'=>$this->title,
			));
	}

	/**
	 * @return array a list of links that point to the post list filtered by every tag of this post
	 */
	public function getTagLinks()
	{
		$links = array();
		foreach ( Tag::string2array( $this->tags ) as $tag )
			$links[] = CHtml::link( CHtml::encode( $tag ), 
				array( 
					'post/index',
					'tag'=>$tag
					));
		return $links;
	}

	/**
	 * Normalizes the user-entered tags.
	 */
	public function normalizeTags( $attribute , $params )
	{
		$this->tags= Tag::array2string( array_unique( Tag::string2array( $this->tags ) ) );
	}

	/**
	 * Adds a new comment to this post.
	 * This method will set status and post_id of the comment accordingly.
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	public function addComment( $comment )
	{
		if ( Yii::app()->params['commentNeedApproval'] )
			$comment->status = Comment::STATUS_PENDING;
		else
			$comment->status = Comment::STATUS_APPROVED;
		$comment->post_id = $this->id;
		return $comment->save();
	}


	/**
	 * This is invoked when a record is populated with data from a find() call.
	 */
	protected function afterFind()
	{
		parent::afterFind();
		$this->_oldTags = $this->tags;
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if ( parent::beforeSave() )
		{
			if ( $this->isNewRecord )
			{
				$this->create_time = $this->update_time = time();
				$this->author_id = Yii::app()->user->id;
			}
			else
				$this->update_time = time();
			return true;
		}
		else
			return false;
	}

	/**
	 * This is invoked after the record is saved.
	 */
	protected function afterSave()
	{
		parent::afterSave();
		Tag::model()->updateFrequency( $this->_oldTags , $this->tags );
	}

	/**
	 * This is invoked after the record is deleted.
	 */
	protected function afterDelete()
	{
		parent::afterDelete();
		Comment::model()->deleteAll( 'post_id=' . $this->id );
		Tag::model()->updateFrequency( $this->tags , '');
	}

	/**
	 * Retrieves the list of posts based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the needed posts.
	 */
	
	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare( 'title' , $this->title , true );

		$criteria->compare( 'status' , $this->status );

		return new CActiveDataProvider( 'Post' ,
			array(
				'criteria'=>$criteria,
				'sort'=>array(
					'defaultOrder'=>'status, update_time DESC',
					),
				));
	}
}