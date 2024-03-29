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
<form action="index.php" method="post" id="adminForm" name="adminForm">
	<div class="jvideo-wrapper">

		<div class="jvideo-element-container">

			<div class="jvideo-element">
				<?php echo JText::_("JV_CATEGORY_NAME"); ?>
			</div>

			<div class="jvideo-element2">
				<input type="text" name="name" id="name" maxlength="100" value="<?php echo $this->categoryName; ?>" />
			</div>

		</div>

		<div class="jvideo-element-container">

			<div class="jvideo-element">
				<?php echo JText::_("JV_CATEGORY_PARENT") ?>
			</div>

			<div class="jvideo-element4">
				<?php echo JHTML::_('jvideo.category.dropdownlist', $this->categories, $this->categoryId); ?>
			</div>
		</div>

	</div>

	<input type="hidden" name="option" value="com_jvideo" />
	<input type="hidden" name="view" value="categories" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="strategy" value="edit" />
	<input type="hidden" name="id" value="<?php echo $this->categoryId; ?>" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
