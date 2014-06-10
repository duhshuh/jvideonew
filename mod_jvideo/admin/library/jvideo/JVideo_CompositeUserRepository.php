<?php
/*
 *    @package    JVideo
 *    @subpackage Library
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

require_once(dirname(__FILE__) . '/JVideo_Exception.php');
require_once(dirname(__FILE__) . '/JVideo_IUserRepository.php');

class JVideo_CompositeUserRepository implements JVideo_IUserRepository
{
    private $repositories = array();

    public function add($repository)
    {
        $this->repositories[] = $repository;
    }

    public function insert(JVideo_User $user)
    {
        foreach ($this->repositories as $repository) {
            $repository->insert($user);
        }
    }

    public function update(JVideo_User $user)
    {
        foreach ($this->repositories as $repository) {
            $repository->update($user);
        }
    }

    public function delete(JVideo_User $user)
    {
        foreach ($this->repositories as $repository) {
            $repository->delete($user);
        }
    }

    public function getUserById($userId)
    {
        foreach ($this->repositories as $repository) {
            $user = $repository->getUserById($userId);

            if (null != $user) {
                return $user;
            }
        }
    }
}