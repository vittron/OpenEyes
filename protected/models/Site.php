<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * This is the model class for table "site".
 *
 * The followings are the available columns in table 'site':
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $postcode
 * @property string $fax
 * @property string $telephone
 * @property integer $remote_id
 *
 * The followings are the available model relations:
 * @property Institution $institution
 * @property Contact $contact
 * @property Contact $replyTo
 * @property ImportSource $import
 */
class Site extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Site the static model class
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
		return 'site';
	}

	public function behaviors()
	{
		return array(
			'ContactBehavior' => array(
				'class' => 'application.behaviors.ContactBehavior',
			),
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        return array(
            array('name, remote_id, contact_id, short_name, fax, telephone, location', 'required'),
            array('contact_id, institution_id', 'numerical', 'integerOnly'=>true),
            array('name, short_name, fax, telephone', 'length', 'max' => 255),
            array('location', 'length', 'max' => 64),
            array('institution_id, name, remote_id, short_name, fax, telephone, contact_id, replyto_contact_id,
			    source_id','safe'),
            array(
                'fax, telephone',
                'match', 'pattern' => '/^((((\(\d{3}\))|(\d{3}-))\d{3}-\d{4})|(\+?\d{2}((-| )\d{1,8}){1,5}))(( x| ext)\d{1,5}){0,1}$/',
                'message' => 'Invalid characters in Fax or Telephone. It should be similar to (xxx)xxx-xxxx, (xxx)-xxx-xxxx, (xxx)xxx-xxxx x123, +12 1234 1234',
            ),

            array('id, name', 'safe', 'on'=>'search'),
        );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			//'theatres' => array(self::HAS_MANY, 'Theatre', 'site_id'),
			//'wards' => array(self::HAS_MANY, 'Ward', 'site_id'),
			'institution' => array(self::BELONGS_TO, 'Institution', 'institution_id'),
			'contact' => array(self::BELONGS_TO, 'Contact', 'contact_id'),
			'replyTo' => array(self::BELONGS_TO, 'Contact', 'replyto_contact_id'),
			'import' => array(self::HAS_ONE, 'ImportSource', 'site_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'remote_id' => 'Code',
			'name' => 'Name',
			'institution_id' => 'Institution',
            'contact_id' => 'Contact',
            'source_id' => 'Source',
            'replyto_contact_id' => 'Reply To',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Fetch an array of site IDs and names
	 * @return array
	 */
	public function getList()
	{
		$list = Site::model()->findAll(array('order' => 'short_name'));

		$result = array();

		foreach ($list as $site) {
			$result[$site->id] = $site->short_name;
		}

		return $result;
	}

	public function getListForCurrentInstitution($field=false)
	{
		if (!$field) $field = 'short_name';

		$site = Site::model()->findByPk(Yii::app()->session['selected_site_id']);

		$criteria = new CDbCriteria;
		$criteria->compare('institution_id',$site->institution_id);
		$criteria->compare('id','<>13');
		$criteria->order = $field.' asc';

		$result = array();

		foreach (Site::model()->findAll($criteria) as $site) {
			$result[$site->id] = $site->$field;
		}

		return $result;
	}

	public function getLongListForCurrentInstitution()
	{
		$site = Site::model()->findByPk(Yii::app()->session['selected_site_id']);

		$criteria = new CDbCriteria;
		$criteria->compare('institution_id',$site->institution_id);

		$result = array();

		foreach (Site::model()->with('institution')->findAll($criteria) as $site) {
			$institution = $site->institution;

			$site_name = '';

			if ($institution->short_name && $site->name != 'Unknown') {
				$site_name = $institution->short_name.' at ';
			}
			$site_name .= $site->name;

			if ($site->location) {
				$site_name .= ', '.$site->location;
			}

			$result[$site->id] = $site_name;
		}

		return $result;
	}

	public function getDefaultSite()
	{
		$site = null;
		if (Yii::app()->params['default_site_code']) {
			$site = $this->findByAttributes(array('code' => Yii::app()->params['default_site_code']));
		}
		if (!$site) {
			$site = $this->find();
		}
		return $site;
	}

	public function getCorrespondenceName()
	{
		if ($this->institution->short_name) {
			if (!strstr($this->name,$this->institution->short_name)) {
				return $this->institution->short_name.' at '.$this->name;
			}
		}

		// this avoids duplicating lines on the addresses
		if ($this->institution->name == $this->name) {
			return $this->name;
		}
		return array($this->institution->name,$this->name);
	}

	public function getShortname()
	{
		return $this->short_name ? $this->short_name : $this->name;
	}

	public function getListForInstitution()
	{
		if (empty(Yii::app()->params['institution_code'])) {
			throw new Exception("Institution code is not set");
		}

		if (!$institution = Institution::model()->find('remote_id=?',array(Yii::app()->params['institution_code']))) {
			throw new Exception("Institution not found: ".Yii::app()->params['institution_code']);
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition('institution_id=:institution_id');
		$criteria->params[':institution_id'] = $institution->id;
		$criteria->order = 'name asc';

		return Site::model()->findAll($criteria);
	}
	
	public function getReplyToAddress($params = array())
	{
		if ($contact = $this->replyTo) {
			$params['contact'] = 'replyTo';
			return $this->getLetterAddress($params);
		}
	}
}