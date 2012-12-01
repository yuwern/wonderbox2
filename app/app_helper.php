<?php
/* SVN FILE: $Id: app_helper.php 60091 2011-07-12 13:34:02Z mohanraj_109at09 $ */
/**
 * Short description for file.
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @subpackage    cake.cake
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision: 7904 $
 * @modifiedby    $LastChangedBy: mark_story $
 * @lastmodified  $Date: 2008-12-05 22:19:43 +0530 (Fri, 05 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
App::import('Core', 'Helper');
/**
 * This is a placeholder class.
 * Create the same file in app/app_helper.php
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake
 */
class AppHelper extends Helper
{
    function getUserAvatar($user_id)
    {
        App::import('Model', 'User');
        $this->User = new User();
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
            ) ,
            'fields' => array(
                'UserAvatar.id',
                'UserAvatar.dir',
                'UserAvatar.filename'
            ) ,
            'recursive' => 0
        ));
        return $user['UserAvatar'];
    }
	function getMonthLists()
    {
       return  array(
				1=>__l('January'),
				2 =>__l('February'),
				3 =>__l('March'),
				4 =>__l('April'),
				5=>__l('May'),
				6 =>__l('June'),
				7=>__l('July'),
				8=>__l('August'),
				9 =>__l('September'),
				10 =>__l('October'),
				11 =>__l('November'),
				12 =>__l('December')
			);
    }
	function getYearLists(){
               $array = range(2012, 2025) ;
			   $years = array();
			   foreach($array as $val){
				$years[$val] = $val;
			   }
			 return $years;
	}
	function getWonderPointAvialable($user_id)
    {
        App::import('Model', 'User');
        $this->User = new User();
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
            ) ,
            'fields' => array(
                'User.id',
                'User.available_wonder_points',
            ) ,
            'recursive' => 0
        ));
		return number_format($user['User']['available_wonder_points'],0);
    }
	function checkPackageAvialable(){
		App::import('Model', 'PackageUser');
		date_default_timezone_set('UTC');
        $this->PackageUser = new PackageUser();
		$start_date = date('Y-'.Configure::read('header.month').'-15');
		$dateMonthAdded = strtotime(date("Y-m-d", strtotime($start_date)) . "+1 month");
		$end_date= date('Y-m-d', $dateMonthAdded);
		$package_available = $this->PackageUser->find('count',array('conditions'=>array('PackageUser.start_date >= '=>$start_date,
				'PackageUser.end_date <= '=>$end_date)));
		if((Configure::read('header.number_of_paid_subscriber') - $package_available)>= 1)
		return (Configure::read('header.number_of_paid_subscriber') - $package_available);
		else 
		return 0;
	}
	function checkProductSurveyStatus($product_id, $user_id){
		App::import('Model', 'ProductSurvey');
        $this->ProductSurvey = new ProductSurvey();
		$productsurveyCount = $this->ProductSurvey->find('count',array('conditions'=>array('ProductSurvey.product_id'=>$product_id,
				'ProductSurvey.user_id'=>$user_id)));
		if(!empty($productsurveyCount))
			return 'Completed';
		else
		  return 'StartSurvey';	
	}
	function checkUserActive($user_id){
		App::import('Model', 'PackageUser');
		date_default_timezone_set('UTC');
		$end_date = date('Y-m-d');
        $this->PackageUser = new PackageUser();
		$packageuserCount = $this->PackageUser->find('count',array(
				'conditions'=>array(
					'PackageUser.user_id' => $user_id,
					'PackageUser.end_date >=' => $end_date,
				),
				'order'=> array(
					'PackageUser.id'=>'desc'
				),
				'recursive'=> -1
			));
		return $packageuserCount;
	}

	function beautyProfileDetails($question_id,$participantUserIds = array()){
		App::import('Model', 'BeautyProfile');
		$this->BeautyProfile = new BeautyProfile();
		$conditions = array();
		if(!empty($question_id))
			$conditions['BeautyProfile.beauty_question_id'] =  $question_id;
		if(!empty($participantUserIds))
			$conditions['BeautyProfile.user_id'] =  $participantUserIds;

		$beautyprofies = $this->BeautyProfile->find('all',array(
			'conditions'=> $conditions,
			'fields'=> array(
				'SUM(BeautyProfile.answer1) as Answer1',
				'SUM(BeautyProfile.answer2) as Answer2',
				'SUM(BeautyProfile.answer3) as Answer3',
				'SUM(BeautyProfile.answer4) as Answer4',
				'SUM(BeautyProfile.answer5) as Answer5',
				'SUM(BeautyProfile.answer6) as Answer6',
				'SUM(BeautyProfile.answer7) as Answer7',
				'SUM(BeautyProfile.answer8) as Answer8',
				'SUM(BeautyProfile.answer9) as Answer9',
				'SUM(BeautyProfile.answer10) as Answer10',
				'SUM(BeautyProfile.answer11) as Answer11',
				'SUM(BeautyProfile.answer12) as Answer12',
				'BeautyProfile.beauty_question_id',
				'BeautyQuestion.name',
				'BeautyQuestion.beauty_answer_count',
				

			),
		));
		return $beautyprofies[0];
	}
	function beautyProfileDetailsResult($question_id,$participantUserIds = array(),$totalparticipants){
		App::import('Model', 'BeautyProfile');
		$this->BeautyProfile = new BeautyProfile();
		$conditions = array();
		if(!empty($question_id))
			$conditions['BeautyProfile.beauty_question_id'] =  $question_id;
		if(!empty($participantUserIds))
			$conditions['BeautyProfile.user_id'] =  $participantUserIds;

		$beautyprofies = $this->BeautyProfile->find('all',array(
			'conditions'=> $conditions,
			'fields'=> array(
			    "(SUM(BeautyProfile.answer1)/$totalparticipants)*100 as Answer1",
				"(SUM(BeautyProfile.answer2)/$totalparticipants)*100 as Answer2",
				"(SUM(BeautyProfile.answer3)/$totalparticipants)*100 as Answer3",
				"(SUM(BeautyProfile.answer4)/$totalparticipants)*100 as Answer4",
				"(SUM(BeautyProfile.answer5)/$totalparticipants)*100 as Answer5",
				"(SUM(BeautyProfile.answer6)/$totalparticipants)*100 as Answer6",
				"(SUM(BeautyProfile.answer7)/$totalparticipants)*100 as Answer7",
				"(SUM(BeautyProfile.answer8)/$totalparticipants)*100 as Answer8",
				"(SUM(BeautyProfile.answer9)/$totalparticipants)*100 as Answer9",
				"(SUM(BeautyProfile.answer10)/$totalparticipants)*100 as Answer10",
				"(SUM(BeautyProfile.answer11)/$totalparticipants)*100 as Answer11",
				"(SUM(BeautyProfile.answer12)/$totalparticipants)*100 as Answer12",
				'BeautyProfile.beauty_question_id',
				'BeautyQuestion.name',
				'BeautyQuestion.beauty_answer_count',
				

			),
		));
		return $beautyprofies[0];
	}
	function beautyProfileDetailsNew($question_id,$participantUserIds = array(),$totalparticipants){
		App::import('Model', 'BeautyProfile');
		$this->BeautyProfile = new BeautyProfile();
		$conditions = array();
		if(!empty($question_id))
			$conditions['BeautyProfile.beauty_question_id'] =  $question_id;
		if(!empty($participantUserIds))
			$conditions['BeautyProfile.user_id'] =  $participantUserIds;
			$beautyprofies = $this->BeautyProfile->find('all',array(
			'conditions'=> $conditions,
			'fields'=> array(
				"(SUM(BeautyProfile.answer1)/$totalparticipants) as Answer1",
				"(SUM(BeautyProfile.answer2)/$totalparticipants) as Answer2",
				"(SUM(BeautyProfile.answer3)/$totalparticipants) as Answer3",
				"(SUM(BeautyProfile.answer4)/$totalparticipants) as Answer4",
				"(SUM(BeautyProfile.answer5)/$totalparticipants) as Answer5",
				"(SUM(BeautyProfile.answer6)/$totalparticipants) as Answer6",
				"(SUM(BeautyProfile.answer7)/$totalparticipants) as Answer7",
				"(SUM(BeautyProfile.answer8)/$totalparticipants) as Answer8",
				"(SUM(BeautyProfile.answer9)/$totalparticipants) as Answer9",
				"(SUM(BeautyProfile.answer10)/$totalparticipants) as Answer10",
				"(SUM(BeautyProfile.answer11)/$totalparticipants) as Answer11",
				"(SUM(BeautyProfile.answer12)/$totalparticipants) as Answer12",
				'BeautyProfile.beauty_question_id',
				'BeautyQuestion.name',
				'BeautyQuestion.beauty_answer_count',
			),
		));
		return $beautyprofies[0];
	}
		
	function beautyProfileDetailsNew1($question_id,$participantUserIds = array(),$totalparticipants,$userFields){
		App::import('Model', 'BeautyProfile');
		$this->BeautyProfile = new BeautyProfile();
		$conditions = array();
		if(!empty($question_id))
			$conditions['BeautyProfile.beauty_question_id'] =  $question_id;
		if(!empty($participantUserIds))
			$conditions['BeautyProfile.user_id'] =  $participantUserIds;
		if(!empty($userFields)){
			$fields = array();
			//print_r($userFields);	
			foreach($userFields as $userField){
			 $userField1 = ucfirst($userField); 
			 $fields[]= "(SUM(BeautyProfile.$userField)/$totalparticipants)*100 as $userField1";
			}
		}
		$fields  =  implode(',',$fields);
		$beautyprofies = $this->BeautyProfile->find('all',array(
			'conditions'=> $conditions,
			'fields'=> array(
				$fields,
				'BeautyProfile.beauty_question_id',
				'BeautyQuestion.name',
				'BeautyQuestion.beauty_answer_count',
				

			),
		));
		return $beautyprofies[0];
	}
	function beautyProfileBarChart($question_id,$fields = array()){
		App::import('Model', 'BeautyProfile');
		$field_conditions  = array(
				'BeautyProfile.beauty_question_id',
				'BeautyQuestion.name',
				'BeautyQuestion.beauty_answer_count',
		);
		$fields = array_merge($fields,$field_conditions);
		if(!empty($fields)){
			$fields = implode(',',$fields);
		}
		$this->BeautyProfile = new BeautyProfile();
		$beautyprofiles = $this->BeautyProfile->find('all',array(
			'conditions'=> array(
				'BeautyProfile.beauty_question_id'=> $question_id
			),
			'fields'=> array(
					$fields
		 	),
		));
		return $beautyprofiles[0];
	}
	function beautyQuestionListing($beauty_category_id){
		App::import('Model', 'BeautyQuestion');
		$this->BeautyQuestion = new BeautyQuestion();
		$beautyQuestions = $this->BeautyQuestion->find('all',array(
			'conditions'=> array(
				'BeautyQuestion.beauty_category_id'=> $beauty_category_id
			),
			'recursive'=> -1
		));


		return $beautyQuestions;
	}
	function productSuveryDetails($question_id,$product_id = null,$subquestion = null ){
		$conditions = array();
		$conditions['ProductSurvey.beauty_question_id'] = $question_id;
		if(!empty($product_id))
		$conditions['ProductSurvey.product_id'] = $product_id;
		if(!empty($subquestion))
		$conditions['ProductSurvey.question_no'] = $subquestion;
		App::import('Model', 'ProductSurvey');
		$this->ProductSurvey = new ProductSurvey();
		$productSurveys = $this->ProductSurvey->find('all',array(
			'conditions'=> $conditions,
			'fields'=> array(
				'SUM(ProductSurvey.answer1) as Answer1',
				'SUM(ProductSurvey.answer2) as Answer2',
				'SUM(ProductSurvey.answer3) as Answer3',
				'SUM(ProductSurvey.answer4) as Answer4',
				'SUM(ProductSurvey.answer5) as Answer5',
				'SUM(ProductSurvey.answer6) as Answer6',
				'SUM(ProductSurvey.answer7) as Answer7',
				'SUM(ProductSurvey.answer8) as Answer8',
				'SUM(ProductSurvey.answer9) as Answer9',
				'SUM(ProductSurvey.answer10) as Answer10',
				'SUM(ProductSurvey.answer11) as Answer11',
				'SUM(ProductSurvey.answer12) as Answer12',
				'ProductSurvey.beauty_question_id',
				'BeautyQuestion.name',
				'BeautyQuestion.beauty_answer_count',

			),
		));
		return $productSurveys[0];
	}
	function productSuveryUserLists($question_id,$product_id = null,$field = null ,$subquestion = null){
		$conditions = array();
		$conditions['ProductSurvey.beauty_question_id'] = $question_id;
		if(!empty($product_id))
		$conditions['ProductSurvey.product_id'] = $product_id;
		if(!empty($field))
		$conditions["ProductSurvey.$field"] = 1;
		if(!empty($subquestion))
		$conditions['ProductSurvey.question_no'] = $subquestion;
		App::import('Model', 'ProductSurvey');
		$this->ProductSurvey = new ProductSurvey();
		$productSurveys = $this->ProductSurvey->find('all',array(
			'conditions'=> $conditions,
			'fields'=> array(
				'Distinct(ProductSurvey.user_id)'

			),
		));
		$participantUserIds = Set::extract('/ProductSurvey/user_id', $productSurveys);
		return $participantUserIds;
	}
	function productSuvery23Questions($question_id,$product_id = null ){
		$conditions = array();
		$conditions['ProductSurvey.beauty_question_id'] = $question_id;
		if(!empty($product_id))
		$conditions['ProductSurvey.product_id'] = $product_id;
		$conditions['ProductSurvey.answer1'] = 1;
		$conditions['ProductSurvey.other_answer !='] = '';
		App::import('Model', 'ProductSurvey');
		$this->ProductSurvey = new ProductSurvey();
		$productSurveysAnswer['Answer1'] = $this->ProductSurvey->find('all',array(
			'conditions'=> $conditions,
			'fields'=> array(
					'ProductSurvey.other_answer'	
			),
		));
		unset($conditions['ProductSurvey.answer1']);
		$conditions['ProductSurvey.answer2'] = 1;
		$productSurveysAnswer['Answer2'] = $this->ProductSurvey->find('all',array(
			'conditions'=> $conditions,
			'fields'=> array(
					'ProductSurvey.other_answer'	
			),
		));	
		return $productSurveysAnswer;
	}
	function productQuestionChoices($question_id ){
		App::import('Model', 'BeautyQuestion');
		$this->BeautyQuestion = new BeautyQuestion();
		$productQuestion = $this->BeautyQuestion->find('first',array(
						'conditions' => array(
							'BeautyQuestion.id'=> $question_id
						),
						'contain'=> array(
							'BeautyAnswer'=> array(
								'fields'=> array(
									'BeautyAnswer.answer',
								)
							)
						),
						'fields'=> array(
							'BeautyQuestion.id',
							'BeautyQuestion.beauty_category_id',
							'BeautyQuestion.name',
						)
		));
		return $productQuestion;
	}
	function getBrandLogo($brand_id){
		App::import('Model', 'Brand');
		$this->Brand = new Brand();
		$brand  = $this->Brand->find('first',array(
				'contain'=> array(
					'Attachment',
				),
				'conditions'=> array(
					'Brand.id'=> $brand_id
				),
		));
		return $brand;
	}
	function dateDiff($start , $end ) {
		$start_ts = strtotime($start);
		$end_ts = strtotime($end);
		$diff = $end_ts - $start_ts;
		return round($diff / 86400);
	}
	function getLanguage()
    {
        $languages = Cache::read('site_languages');
        if(empty($languages)) {
            App::import('Model', 'Translation');
            $this->Translation = new Translation();
            $languages = $this->Translation->find('all', array(
                'conditions' => array(
                    'Language.id !=' => 0,
                    'Language.is_active' => 1
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
            // we delete cache file in translation and language model in afterSave and afterDelete
            // we delete in languages/admin_update also.
            Cache::write('site_languages', $languages);
        }
        $languageList = array();
        if (!empty($languages)) {
            foreach($languages as $language) {
                $languageList[$language['Language']['iso2']] = $language['Language']['name'];
            }
        }
        return $languageList;
    }
    function getCityTwitterFacebookURL($slug = null)
    {
        App::import('Model', 'City');
        $this->City = new City();
        $city = $this->City->find('first', array(
            'conditions' => array(
                'City.slug' => $slug
            ) ,
            'fields' => array(
                'City.twitter_url',
                'City.facebook_url'
            ) ,
            'recursive' => -1
        ));
		if(empty($city['City']['facebook_url'])){
			$city['City']['facebook_url'] = (env('HTTPS')) ? str_replace("http://", "https://", Configure::read('facebook.site_facebook_url')): Configure::read('facebook.site_facebook_url');
		}
		else{
			$city['City']['facebook_url'] = (env('HTTPS')) ? str_replace("http://", "https://", $city['City']['facebook_url']): $city['City']['facebook_url'];
		}
		if(empty($city['City']['twitter_url'])){
			$city['City']['twitter_url'] = (env('HTTPS')) ? str_replace("http://", "https://", Configure::read('twitter.site_twitter_url')): Configure::read('twitter.site_twitter_url');
		}
		else{
			$city['City']['twitter_url'] = (env('HTTPS')) ? str_replace("http://", "https://", $city['City']['twitter_url']): $city['City']['twitter_url'];
		}
        return $city;
    }
    public function url($url = null, $full = false)
    {
        if (Cache::read('site.city_url', 'long') == 'prefix') {
            return parent::url(router_url_city($url, $this->params['named']) , $full);
        }
        return parent::url($url, $full);
    }
   
    function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = false)
    {
        return $this->Text->truncate($this->cText($text, false) , $length, $ending, $exact, $considerHtml);
    }
    
	function cInt($str, $wrap = 'span', $title = false)
    {
        $_currencies = Cache::read('site_currencies');
		$changed = (($r = intval($str)) != $str);
        if ($wrap) {
            if (!$title) {
                $title = $this->_num2words($r, 'en_US');
            }
            $r = '<' . $wrap . ' class="c' . $changed . '" title="' . $title . '">' . number_format($r, 0, '', $_currencies[Cache::read('site.currency_id')]['Currency']['thousands_sep']) . '</' . $wrap . '>';
        }
        return $r;
    }
    function cFloat($str, $wrap = 'span', $title = false)
    {
        $_precision = 2;
		$_currencies = Cache::read('site_currencies');
        $changed = (($r = floatval($str)) != $str);
        $rounded = (($rt = round($r, $_precision)) != $r);
        $r = $rt;
        if ($wrap) {
            if (!$title) {
                $title = $this->_num2words($r, 'en_US', $_precision);
            }
            $r = '<' . $wrap . ' class="c' . $changed . ' cr' . $rounded . '" title="' . $title . '">' . number_format($r, $_precision, $_currencies[Cache::read('site.currency_id')]['Currency']['dec_point'], $_currencies[Cache::read('site.currency_id')]['Currency']['thousands_sep']) . '</' . $wrap . '>';
        }
        return $r;
    }
    function getUserLink($user_details)
    {
        if ($user_details['user_type_id'] == ConstUserTypes::Admin || $user_details['user_type_id'] == ConstUserTypes::User) {
			App::import('Model', 'UserProfile');
	        $this->UserProfile = new UserProfile();
			$user_profile = $this->UserProfile->find('first', array(
				'conditions' => array(
					'UserProfile.user_id' => $user_details['id']
				) ,
				'fields' => array(
					'UserProfile.id',
					'UserProfile.first_name',
				) ,

				'recursive' => -1
			));
			$username = !empty($user_profile['UserProfile']['first_name'])?$user_profile['UserProfile']['first_name']:$user_details['username'];
            return $this->link($this->cText($username) , array(
                'controller' => 'users',
                'action' => 'view',
                $user_details['username'],
                'admin' => false
            ) , array(
                'title' => $this->cText($user_details['username'], false) ,
                'escape' => false
            ));
        }
        //for company
        if ($user_details['user_type_id'] == ConstUserTypes::Company) {
            $companyDetails = $this->getCompany($user_details['id']);
            if (!$companyDetails['Company']['is_company_profile_enabled'] || !$companyDetails['Company']['is_online_account']) {
                return $this->cText($companyDetails['Company']['name']);
            }
            return $this->link($this->cText($companyDetails['Company']['name'], false) , array(
                'controller' => 'companies',
                'action' => 'view',
                $companyDetails['Company']['slug'],
                'admin' => false
            ) , array(
                'title' => $this->cText($companyDetails['Company']['name'], false) ,
                'escape' => false
            ));
        }
    }
    function getUserAvatarLink($user_details, $dimension = 'medium_thumb', $is_link = true)
    {
		App::import('Model', 'Setting');
        $this->Setting = new Setting();
		App::import('Model', 'User');
        $modelObj = new User();
        $user = $modelObj->find('first', array(
            'conditions' => array(
                'User.id' => $user_details['id'],
            ) ,
            'fields' => array(
                'UserAvatar.id',
                'UserAvatar.dir',
                'UserAvatar.filename',
                'UserAvatar.height',
                'UserAvatar.width',
                'User.profile_image_id',
               'User.fb_user_id',
                'User.username',
                'User.id',
            ) ,
            'recursive' => 0
        ));
        if ($user_details['user_type_id'] == ConstUserTypes::Admin || $user_details['user_type_id'] == ConstUserTypes::User ) {
			$user_image = '';
			// Setting Default Profile Image //
			$width = $this->Setting->find('first', array('conditions' => array('Setting.name' => 'thumb_size.'.$dimension.'.width'), 'recursive' => -1));
			$height = $this->Setting->find('first', array('conditions' => array('Setting.name' => 'thumb_size.'.$dimension.'.height'), 'recursive' => -1));
			if(!empty($user['User']['fb_user_id'])){
				$user_image = $this->getFacebookAvatar($user['User']['fb_user_id'], $height['Setting']['value'],$width['Setting']['value']);						
			}
			// Setting Profile Image based on settings choosed by user //
			if($user['User']['profile_image_id'] == ConstProfileImage::Facebook){
				$width = $this->Setting->find('first', array('conditions' => array('Setting.name' => 'thumb_size.'.$dimension.'.width'), 'recursive' => -1));
				$height = $this->Setting->find('first', array('conditions' => array('Setting.name' => 'thumb_size.'.$dimension.'.height'), 'recursive' => -1));
				$user_image = $this->getFacebookAvatar($user['User']['fb_user_id'], $height['Setting']['value'],$width['Setting']['value']);			
			}elseif($user['User']['profile_image_id'] == ConstProfileImage::Upload || empty($user_image)){
				//get user image
				$user_image = $this->showImage('UserAvatar', (!empty($user_details['UserAvatar'])) ? $user_details['UserAvatar'] : '', array(
					'dimension' => $dimension,
					'alt' => sprintf('[Image: %s]', $user_details['username']) ,
					'title' => $user_details['username']
				));
			}
		    //return image to user
            return (!$is_link) ? $user_image : $this->link($user_image, array(
                'controller' => 'users',
                'action' => 'view',
                $user_details['username'],
                'admin' => false
            ) , array(
                'title' => $this->cText($user_details['username'], false) ,
                'escape' => false
            ));
        }
        
    }
	function getFacebookAvatar($fbuser_id,$height=35,$width=35)
	{
		return $this->image("http://graph.facebook.com/{$fbuser_id}/picture",array('height'=>$height, 'width'=> $width));
	}
    function cDate($str, $wrap = 'span', $title = false)
    {
        $changed = (($r = $this->htmlPurifier->purify(strftime(Configure::read('site.date.format') , strtotime($str . ' GMT')))) != strftime(Configure::read('site.date.format') , strtotime($str . ' GMT')));
        if ($wrap) {
            if (!$title) {
                $title = ' title="' . strftime(Configure::read('site.datetime.tooltip') , strtotime($str . ' GMT')) . ' ' . Configure::read('site.timezone_offset') . '"';
            }
            $r = '<' . $wrap . ' class="c' . $changed . '"' . $title . '>' . $r . '</' . $wrap . '>';
        }
        return $r;
    }
    function cDateTime($str, $wrap = 'span', $title = false)
    {
        $changed = (($r = $this->htmlPurifier->purify(strftime(Configure::read('site.datetime.format') , strtotime($str . ' GMT')))) != strftime(Configure::read('site.datetime.format') , strtotime($str . ' GMT')));
        if ($wrap) {
            if (!$title) {
                $title = ' title="' . strftime(Configure::read('site.datetime.tooltip') , strtotime($str . ' GMT')) . ' ' . Configure::read('site.timezone_offset') . '"';
            }
            $r = '<' . $wrap . ' class="c' . $changed . '"' . $title . '>' . $r . '</' . $wrap . '>';
        }
        return $r;
    }
    function cTime($str, $wrap = 'span', $title = false)
    {
        $changed = (($r = $this->htmlPurifier->purify(strftime(Configure::read('site.time.format') , strtotime($str . ' GMT')))) != strftime(Configure::read('site.time.format') , strtotime($str . ' GMT')));
        if ($wrap) {
            if (!$title) {
                $title = ' title="' . strftime(Configure::read('site.datetime.tooltip') , strtotime($str . ' GMT')) . ' ' . Configure::read('site.timezone_offset') . '"';
            }
            $r = '<' . $wrap . ' class="c' . $changed . '"' . $title . '>' . $r . '</' . $wrap . '>';
        }
        return $r;
    }
    function cBool($str, $wrap = 'span', $title = false)
    {
        $_options = array(
            0 => __l('No') ,
            1 => __l('Yes')
        );
        if (isset($_options[$str])) {
            $str = $_options[$str];
        }
        return $this->cText($str, $wrap, $title);
    }
    function cDateTimeHighlight($str, $wrap = 'span', $title = false)
    {
        if (strtotime(_formatDate('Y-m-d', strtotime($str))) == strtotime(date('Y-m-d'))) {
            $str = strftime('%I:%M %p', strtotime($str . ' GMT'));
        } else if (strtotime(date('Y-m-d', strtotime(_formatDate('Y-m-d', strtotime($str))))) > strtotime(date('Y-m-d')) || mktime(0, 0, 0, 0, 0, date('Y', strtotime(_formatDate('Y-m-d', strtotime($str))))) < mktime(0, 0, 0, 0, 0, date('Y'))) {
            $str = strftime('%b %d, %Y', strtotime($str . ' GMT'));
        } else {
            $str = strftime('%b %d', strtotime($str . ' GMT'));
        }
        $changed = (($r = $this->htmlPurifier->purify($str)) != $str);
        if ($wrap) {
            if (!$title) {
                $title = ' title="' . strftime(Configure::read('site.datetime.tooltip') , strtotime($str . ' GMT')) . ' ' . Configure::read('site.timezone_offset') . '"';
            }
            $r = '<' . $wrap . ' class="c' . $changed . '"' . $title . '>' . $r . '</' . $wrap . '>';
        }
        return $r;
    }
    function time_left($integer)
	{
		$seconds = $integer;
		if ($seconds/60 >= 1) {
			$minutes = floor($seconds/60);
			if ($minutes/60 >= 1) { // Hours
				$hours = floor($minutes/60);
				if ($hours/24 >= 1) { //days
					$days = floor($hours/24);
					$return = '';
					if ($days >= 2) $return = "$return $days days";
					if ($days == 1) $return = "$return $days day";
				} //end of days
				$hours = $hours-(floor($hours/24)) *24;
				if ($days >= 1 && $hours >= 1) $return = "$return ";
				if ($hours >= 2) $return = "$return $hours hours";
				if ($hours == 1) $return = "$return $hours hour";
			} //end of Hours
			$minutes = $minutes-(floor($minutes/60)) *60;
			if ($hours >= 1 && $minutes >= 1) $return = "$return ";
			if ($minutes >= 2) $return = "$return $minutes minutes";
			if ($minutes == 1) $return = "$return $minutes minute";
		} //end of minutes
		$seconds = $integer-(floor($integer/60)) *60;
		if ($minutes >= 1 && $seconds >= 1) $return = "$return ";
		if ($seconds >= 2) $return = "$return $seconds seconds";
		if ($seconds == 1) $return = "$return $seconds second";
		$return = "$return";
		return $return;
	}
}
?>
