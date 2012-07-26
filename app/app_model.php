<?php
/* SVN FILE: $Id: app_model.php 54372 2011-05-24 08:09:19Z anandam_023ac09 $ */
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7847 $
 * @modifiedby    $LastChangedBy: renan.saddam $
 * @lastmodified  $Date: 2008-11-08 08:24:07 +0530 (Sat, 08 Nov 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppModel extends Model
{
    public $actsAs = array(
        'Containable',
    );
    function beforeSave($options = array())
    {
        $this->useDbConfig = 'master';
        return true;
    }
    function afterSave($created)
    {
        $this->useDbConfig = 'default';
        return true;
    }
    function beforeDelete($cascade = true)
    {
        $this->useDbConfig = 'master';
        return true;
    }
    function afterDelete()
    {
        $this->useDbConfig = 'default';
        return true;
    }
    function getIdHash($ids = null)
    {
        return md5($ids . Configure::read('Security.salt'));
    }
    function isValidIdHash($ids = null, $hash = null)
    {
        return (md5($ids . Configure::read('Security.salt')) == $hash);
    }
    function findOrSaveAndGetId($data)
    {
        $findExist = $this->find('first', array(
            'conditions' => array(
                'name' => $data
            ) ,
            'fields' => array(
                'id'
            ) ,
            'recursive' => -1
        ));
        if (!empty($findExist)) {
            return $findExist[$this->name]['id'];
        } else {
            $this->data[$this->name]['name'] = $data;
            $this->save($this->data[$this->name]);
            return $this->getLastInsertId();;
        }
    }
    function _isValidCaptcha()
    {
        include_once VENDORS . DS . 'securimage' . DS . 'securimage.php';
        $img = new Securimage();
        return $img->check($this->data[$this->name]['captcha']);
    }

    function changeFromEmail($from_address = null)
    {
        if (!empty($from_address)) {
            if (preg_match('|<(.*)>|', $from_address, $matches)) {
                return $matches[1];
            } else {
                return $from_address;
            }
        }
    }
    function get_languages()
    {
        App::import('Model', 'Translation');
        $this->Translation = new Translation();
        $languages = $this->Translation->find('all', array(
            'conditions' => array(
                'Language.id !=' => 0,
                'Language.iso2 != ' => ''
            ) ,
            'fields' => array(
                'DISTINCT(Translation.language_id)',
                'Language.name',
                'Language.iso2'
            ) ,
            'order' => array(
                'Language.name' => 'ASC'
            )
        ));
        $languageList = array();
        if (!empty($languages)) {
            foreach($languages as $language) {
                $languageList[$language['Language']['iso2']] = $language['Language']['name'];
            }
        }
        return $languageList;
    }
    function formatToAddress($user = null)
    {
        if (!empty($user['UserProfile']['first_name']) && !empty($user['UserProfile']['last_name'])) {
            return $user['UserProfile']['first_name'] . ' ' . $user['UserProfile']['first_name'] . ' <' . $user['User']['email'] . '>';
        } elseif (!empty($user['UserProfile']['first_name'])) {
            return $user['UserProfile']['first_name'] . ' <' . $user['User']['email'] . '>';
        } else {
            return $user['User']['email'];
        }
    }
    public function formGooglemap($companydetails = array() , $size = '320x320')
    {
        if ((!(is_array($companydetails))) || empty($companydetails)) {
            return false;
        }
        $color_array = array(
            array(
                'A',
                'green'
            ) ,
            array(
                'B',
                'orange'
            ) ,
            array(
                'C',
                'blue'
            ) ,
            array(
                'D',
                'yellow'
            )
        );
		$mapurl = 'http://maps.google.com/maps/api/staticmap?center=';
		if(env('HTTPS')){			
	        $mapurl = 'https://maps.googleapis.com/maps/api/staticmap?center=';
		}		
		if(!empty($companydetails['latitude'])){
	        $mapcenter[] = str_replace(' ', '+', $companydetails['latitude']) . ',' . $companydetails['longitude'];
	        $mapcenter[] = 'markers=color:pink|label:M|' . $companydetails['latitude'] . ',' . $companydetails['longitude'];
		}
        $mapcenter[] = 'zoom=' . (!empty($companydetails['map_zoom_level']) ? $companydetails['map_zoom_level'] : Configure::read('GoogleMap.static_map_zoom_level'));
        $mapcenter[] = 'size=' . $size;
        if (!empty($companydetails['CompanyAddress'])) {
            $count = 0;
            foreach($companydetails['CompanyAddress'] as $address) {
                if (!empty($address['latitude']) and !empty($address['longitude'])) {
                    $mapcenter[] = 'markers=color:' . $color_array[$count][1] . '|label:' . $color_array[$count][0] . '|' . $address['latitude'] . ',' . $address['longitude'];
                    $count++;
                }
            }
        }
        $mapcenter[] = 'sensor=false';
        return $mapurl . implode('&amp;', $mapcenter);
    }
	function getUserLanguageIso($user_id){
		App::import('Model', 'UserProfile');
        $this->UserProfile = new UserProfile();
		$user = $this->UserProfile->find('first', array(
			'conditions' => array(
				'UserProfile.user_id' => $user_id
			),
			'contain' => array(
				'Language'
			),
			'recursive' => 3
		));
		return !empty($user['Language']['iso2']) ? $user['Language']['iso2'] : '';
	}


	function getImageUrl($model, $attachment, $options, $path = 'absolute')
    {
        $default_options = array(
            'dimension' => 'original',
            'class' => '',
            'alt' => 'alt',
            'title' => 'title',
            'type' => 'jpg'
        );
        $options = array_merge($default_options, $options);
        $image_hash = $options['dimension'] . '/' . $model . '/' . $attachment['id'] . '.' . md5(Configure::read('Security.salt') . $model . $attachment['id'] . $options['type'] . $options['dimension'] . Configure::read('site.name')) . '.' . $options['type'];
		if($path == 'absolute')
	        return Cache::read('site_url_for_shell', 'long') . 'img/' . $image_hash;
		else
	        return 'img/' . $image_hash;
    }


}
?>