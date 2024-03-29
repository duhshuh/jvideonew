<?php
/*
 *	@package	JVideo
 *	@subpackage Components
 *	@link http://jvideo.warphd.com
 *	@copyright (C) 2007 - 2010 Warp
 *	@license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 ***
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');
jvimport2('Web.AssetManager');

class JVideoViewuser extends JViewLegacy
{
	function display($tpl = null)
	{
		$mainframe = JFactory::getApplication();
		$user = JFactory::getUser();
		$params = clone($mainframe->getParams('com_jvideo'));

		$params->def( 'video_category', -1);
		$params->def( 'video_order', 'newestvideos');
		$params->def( 'video_layout', 'grid' );
		$params->def( 'video_layout_columns', 4);
		$params->def( 'show_thumbnail', 1);
		$params->def( 'show_video_description', 0);
		$params->def( 'show_video_rating', 1);
		$params->def( 'show_video_views', 1);
		$params->def( 'show_video_dateadded', 1);
		$params->def( 'show_video_duration', 1);
		$params->def( 'show_video_author', 1);
		$params->def( 'videos_per_page', 12);
		
		$this->params = $params;
		$this->logged_uid = $user->id;
		$this->items = is_array(JRequest::getVar('items')) ? JRequest::getVar('items') : array();
		$this->pagination = JRequest::getVar('pagination');
		$this->limitstart = JRequest::getVar('limitstart');
		$this->user_id = JRequest::getVar('user_id');
		$this->username = JRequest::getVar('username');
		$this->user = $user;

		$this->profile = JRequest::getVar('profile');
						
		$jvConfig = JVideo_Factory::getConfig();;
		$this->cacheThumbnails = $jvConfig->cacheThumbnails;
		$this->thumbFaderEnabled = $jvConfig->thumbFaderEnabled;

		$this->addScripts();
		$this->addStylesheets();
		
		if ($jvConfig->cacheThumbnails && $jvConfig->proxyEnabled)
		{
			$cacheProxyParams = array('host' => $jvConfig->proxyHost
				, 'port' => $jvConfig->proxyPort 
				, 'username' => $jvConfig->proxyUsername
				, 'password' => $jvConfig->proxyPassword
				, 'timeout' => $jvConfig->proxyTimeout);
			$this->cacheProxyParams = $cacheProxyParams;
		}
		else
		{
			$cacheProxyParams = null;
			$this->cacheProxyParams = $cacheProxyParams;
		}
		
		
		$breadcrumbs = $mainframe->getPathWay();
		$breadcrumbs->addItem($this->getDisplayName() . JText::_("JV_PROFILE_TITLE_SUFFIX"), JRoute::_("index.php?option=com_jvideo&view=user&user_id=".JRequest::getVar("user_id")));

		parent::display($tpl);
	}

	public function getDisplayName()
	{

		if ($this->profile->getDisplayName())
		{
			return $this->profile->getDisplayName();
		}
		
		if ($this->profile->getFullName())
		{
			return $this->profile->getFullName();
		}
		
		if ($this->profile->getUsername())
		{
			return $this->profile->getUsername();
		}

		return JText::_("JV_PROFILE_UNKNOWN_USER");
	}
		
	public function getAge()
	{
		if (is_null($this->profile) || !$this->profile->getBirthdate()) return null;

		$birthdate = date('Y-m-d', strtotime($this->profile->getBirthdate()));
		list($birthYear, $birthMonth, $birthDay) = array_map('intval', explode('-', $birthdate));
		list($currentYear, $currentMonth, $currentDay) = array_map('intval', explode('-', date('Y-m-d')));
		$age = $currentYear - $birthYear;

		if ($currentMonth < $birthMonth || ($currentMonth == $birthMonth && $currentDay < $birthDay))
		{
			$age--;
		}

		return $age; 
	}

	private function addScripts()
	{
		$config = JVideo_Factory::getConfig();

		JVideo2_AssetManager::includeJQuery();
		JVideo2_AssetManager::includeJQueryUI();
		JVideo2_AssetManager::includeSiteCoreJs();

		if ($config->thumbFaderEnabled)
			JVideo2_AssetManager::includeCrossFadeJs();
	}

	private function addStylesheets()
	{
		JVideo2_AssetManager::includeSiteCoreCss();
	}
}