<?php
/*
 *    @package    JVideo
 *    @subpackage Components
 *    @link http://jvideo.warphd.com
 *    @copyright (C) 2007 - 2010 Warp
 *    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 ***
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die('Restricted access');
?>
<div class="jvideo-wrapper<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<h1><?php echo $this->resultHeader; ?></h1>
	<br />
	<p><?php echo $this->resultMessage; ?></p>
	<br />
	<p><?php echo JText::_("JV_EDIT_RETURN_TO") ?> <a href="<?php echo $this->resultReturn; ?>"><?php echo JText::_("JV_EDIT_YOUR_VIDEO"); ?></a></p>
</div>