<?php

namespace XoopsModules\Tdmcreate\Files\Templates\Blocks;

use XoopsModules\Tdmcreate;
use XoopsModules\Tdmcreate\Files;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * tdmcreate module.
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 *
 * @since           2.5.0
 *
 * @author          Txmod Xoops http://www.txmodxoops.org
 *
 */

/**
 * Class TemplatesBlocks.
 */
class TemplatesBlocks extends Files\CreateFile
{
    /**
     * @public function constructor
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @static function getInstance
     * @param null
     * @return TemplatesBlocks
     */
    public static function getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * @public function write
     * @param string $module
     * @param string $table
     * @param string $filename
     */
    public function write($module, $table, $filename)
    {
        $this->setModule($module);
        $this->setTable($table);
        $this->setFileName($filename);
    }

    /**
     * @private  function getTemplatesBlocksTableThead
     * @param        $tableId
     * @param        $tableMid
     * @param string $language
     * @return string
     */
    private function getTemplatesBlocksTableThead($tableId, $tableMid, $language)
    {
        $hc     = Tdmcreate\Files\CreateHtmlSmartyCodes::getInstance();
        $th     = '';
        $fields = $this->getTableFields($tableMid, $tableId);
        foreach (array_keys($fields) as $f) {
            $fieldName    = $fields[$f]->getVar('field_name');
            $stuFieldName = mb_strtoupper($fieldName);
            $lang         = $hc->getSmartyConst($language, $stuFieldName);
            $th           .= $hc->getHtmlTableHead($lang, 'center', '', "\t\t\t");
        }
        $tr = $hc->getHtmlTableRow($th, 'head', "\t\t");

        return $hc->getHtmlTableThead($tr, '', "\t");
    }

    /**
     * @private  function getTemplatesBlocksTableTbody
     * @param string $moduleDirname
     * @param        $tableId
     * @param        $tableMid
     * @param        $tableName
     * @param        $tableSoleName
     * @param        $tableAutoincrement
     * @param string $language
     * @return string
     */
    private function getTemplatesBlocksTableTbody($moduleDirname, $tableId, $tableMid, $tableName, $tableSoleName, $tableAutoincrement, $language)
    {
        $hc = Tdmcreate\Files\CreateHtmlSmartyCodes::getInstance();
        $td = '';
        if (1 == $tableAutoincrement) {
            $double = $hc->getSmartyDoubleVar($tableSoleName, 'id');
            $td     .= $hc->getHtmlTag('td', ['class' => 'center'], $double);
        }
        $fields = $this->getTableFields($tableMid, $tableId);
        foreach (array_keys($fields) as $f) {
            $fieldName    = $fields[$f]->getVar('field_name');
            $fieldElement = $fields[$f]->getVar('field_element');
            $rpFieldName  = $this->getRightString($fieldName);
            if (0 == $f) {
                $fieldId = $fieldName;
            }
            if (1 == $fields[$f]->getVar('field_inlist')) {
                switch ($fieldElement) {
                    case 9:
                        // This is to be reviewed, as it was initially to style = "backgroung-color: #"
                        // Now with HTML5 is not supported inline style in the parameters of the HTML tag
                        // Old code was <span style="background-color: #<{\$list.{$rpFieldName}}>;">...
                        $double = $hc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                        $span   = $hc->getHtmlTag('span', [], $double);
                        $td     .= $hc->getHtmlTag('td', ['class' => 'center'], $span, false, "\t\t\t");
                        /*$ret .= <<<EOT
                    <td class="center"><span style="background-color: #<{\$list.{$rpFieldName}}>;">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>\n
EOT;*/
                        break;
                    case 10:
                        $src = $hc->getSmartyNoSimbol('xoModuleIcons32');
                        $src .= $hc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                        $img = $hc->getHtmlTag('img', ['src' => $src, 'alt' => $tableName], '', true,'','');
                        $td  .= $hc->getHtmlTag('td', ['class' => 'center'], $img, false, "\t\t\t");
                        break;
                    case 13:
                        $single = $hc->getSmartySingleVar($moduleDirname . '_upload_url');
                        $double = $hc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                        $img    = $hc->getHtmlTag('img', ['src' => $single . "/images/{$tableName}/" . $double, 'alt' => $tableName], '', true, '', '');
                        $td     .= $hc->getHtmlTag('td', ['class' => 'center'], $img, false, "\t\t\t");
                        break;
                    default:
                        if (0 != $f) {
                            $double = $hc->getSmartyDoubleVar($tableSoleName, $rpFieldName);
                            $td     .= $hc->getHtmlTag('td', ['class' => 'center'], $double, false, "\t\t\t");
                        }
                        break;
                }
            }
        }
        $lang    = $hc->getSmartyConst('', '_EDIT');
        $double  = $hc->getSmartyDoubleVar($tableSoleName, 'id');
        $src     = $hc->getSmartyNoSimbol('xoModuleIcons32 edit.png');
        $img     = $hc->getHtmlTag('img', ['src' => $src, 'alt' => $tableName], '', true, '', '');
        $anchor  = $hc->getHtmlTag('a', ['href' => $tableName . ".php?op=edit&amp;{$fieldId}=" . $double, 'title' => $lang], $img, false, "\t\t\t\t");
        $lang    = $hc->getSmartyConst('', '_DELETE');
        $double  = $hc->getSmartyDoubleVar($tableSoleName, 'id');
        $src     = $hc->getSmartyNoSimbol('xoModuleIcons32 delete.png');
        $img     = $hc->getHtmlTag('img', ['src' => $src . $double, 'alt' => $tableName], '', true, '', '');
        $anchor  .= $hc->getHtmlTag('a', ['href' => $tableName . ".php?op=delete&amp;{$fieldId}=" . $double, 'title' => $lang], $img, false, "\t\t\t\t");
        $td      .= $hc->getHtmlTag('td', ['class' => 'center'], "\n" . $anchor . "\t\t\t", false, "\t\t\t");
        $cycle   = $hc->getSmartyNoSimbol('cycle values="odd, even"');
        $tr      = $hc->getHtmlTag('tr', ['class' => $cycle], $td. "\t\t", false, "\t\t");
        //$foreach = $hc->getSmartyForeach($tableSoleName, $tableName . '_list', $tr) . PHP_EOL;
        $foreach = $hc->getSmartyForeach($tableSoleName, 'block', $tr, '','', "\t\t");
        $tbody   = $hc->getHtmlTableTbody($foreach,'' , "\t");

        //return $hc->getSmartyConditions($tableName . '_count', '', '', $tbody) . PHP_EOL;
        return $hc->getSmartyConditions("block", '', '', $tbody, false, true, true, "\t");
    }

    /**
     * @private  function getTemplatesBlocksTfoot
     * @return string
     */
    private function getTemplatesBlocksTableTfoot()
    {
        $hc = Tdmcreate\Files\CreateHtmlSmartyCodes::getInstance();
        $td = $hc->getHtmlTag('td', [], "&nbsp;", false, '', '');
        $tr = $hc->getHtmlTag('tr', [], $td, false, '', '');

        return $hc->getHtmlTag('tfoot', [], $tr, false, "\t");
    }

    /**
     * @private  function getTemplatesBlocksTable
     * @param string $moduleDirname
     * @param        $tableId
     * @param        $tableMid
     * @param string $tableName
     * @param        $tableSoleName
     * @param        $tableAutoincrement
     * @param string $language
     * @return string
     */
    private function getTemplatesBlocksTable($moduleDirname, $tableId, $tableMid, $tableName, $tableSoleName, $tableAutoincrement, $language)
    {
        $hc     = Tdmcreate\Files\CreateHtmlSmartyCodes::getInstance();
        $tbody  = $this->getTemplatesBlocksTableThead($tableId, $tableMid, $language);
        $tbody  .= $this->getTemplatesBlocksTableTbody($moduleDirname, $tableId, $tableMid, $tableName, $tableSoleName, $tableAutoincrement, $language);
        $tbody  .= $this->getTemplatesBlocksTableTfoot();
        $single = $hc->getSmartySingleVar('table_type');

        return $hc->getHtmlTable($tbody, 'table table-' . $single);
    }

    /**
     * @public function render
     * @param null
     *
     * @return bool|string
     */
    public function render()
    {
        $module             = $this->getModule();
        $table              = $this->getTable();
        $filename           = $this->getFileName();
        $moduleDirname      = $module->getVar('mod_dirname');
        $tableId            = $table->getVar('table_id');
        $tableMid           = $table->getVar('table_mid');
        $tableName          = $table->getVar('table_name');
        $tableSoleName      = $table->getVar('table_solename');
        $tableAutoincrement = $table->getVar('table_autoincrement');
        $language           = $this->getLanguage($moduleDirname, 'MB');
        $content            = $this->getTemplatesBlocksTable($moduleDirname, $tableId, $tableMid, $tableName, $tableSoleName, $tableAutoincrement, $language);

        $this->create($moduleDirname, 'templates/blocks', $filename, $content, _AM_TDMCREATE_FILE_CREATED, _AM_TDMCREATE_FILE_NOTCREATED);

        return $this->renderFile();
    }
}
