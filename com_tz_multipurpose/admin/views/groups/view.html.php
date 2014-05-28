<?php
/**
 * Created by PhpStorm.
 * User: Thuong
 * Date: 4/28/14
 * Time: 10:00 AM
 */

defined('_JEXEC') or die();
jimport('joomla.application.component.view');
JHtml::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_tz_multipurpose/helpers');

class TZ_MultipurposeViewGroups extends JViewLegacy {
    protected $item     = null;
    protected $state    = null;

    public function display($tpl = null) {
        $this -> item   = $this -> get('Items');

        $this -> state  = $this -> get('State');

        $this -> Toolbar();

        TZ_Multipurpose::addSubmenu('groups');
        $this->sidebar = JHtmlSidebar::render();

        parent::display($tpl);
    }

    protected function Toolbar() {
        JToolBarHelper::title(JText::_('COM_TZ_MULTIPURPOSE_GROUPS_MANAGER'));

        JToolBarHelper::addNew('group.add');

        JToolBarHelper::editList('group.edit');

        JToolBarHelper::deleteList(JText::_('COM_TZ_MULTIPURPOSE_QUESTION_DELETE'),'groups.delete');
    }
}