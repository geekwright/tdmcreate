<?php

namespace XoopsModules\Tdmcreate\Files\Templates\User;

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
 * class Index.
 */
class Index extends Files\CreateFile
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
     * @return Index
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
     * @param $module
     * @param $table
     * @param $tables
     * @param $filename
     */
    public function write($module, $table, $tables, $filename)
    {
        $this->setModule($module);
        $this->setTable($table);
        $this->setTables($tables);
        $this->setFileName($filename);
    }

    /**
     * @public function getTemplateUserIndexHeader
     * @param $moduleDirname
     * @return bool|string
     */
    public function getTemplateUserIndexHeader($moduleDirname)
    {
        $hc = Tdmcreate\Files\CreateHtmlSmartyCodes::getInstance();

        return $hc->getSmartyIncludeFile($moduleDirname, 'header') . PHP_EOL;
    }

    /**
     * @private function getTemplatesUserIndexTable
     * @param $moduleDirname
     * @param $tableName
     * @param $tableSoleName
     * @param $language
     * @return string
     */
    private function getTemplatesUserIndexTable($moduleDirname, $tableName, $tableSoleName, $language)
    {
        $hc     = Tdmcreate\Files\CreateHtmlSmartyCodes::getInstance();
        $single = $hc->getSmartySingleVar('table_type');
        $table  = $this->getTemplatesUserIndexTableThead($tableName, $language);
        $table  .= $this->getTemplatesUserIndexTableTBody($moduleDirname, $tableName, $tableSoleName, $language);

        return $hc->getHtmlTable($table, 'table table-' . $single) . PHP_EOL;
    }

    /**
     * @private function getTemplatesUserIndexThead
     * @param string $language
     * @param        $tableName
     * @return string
     */
    private function getTemplatesUserIndexTableThead($tableName, $language)
    {
        $hc           = Tdmcreate\Files\CreateHtmlSmartyCodes::getInstance();
        $stuTableName = mb_strtoupper($tableName);
        $lang         = $hc->getSmartyConst($language, $stuTableName);
        $col          = $hc->getSmartySingleVar('numb_col');
        $th           = $hc->getHtmlTableHead($lang, '', $col) . PHP_EOL;
        $tr           = $hc->getHtmlTableRow($th, 'head') . PHP_EOL;

        return $hc->getHtmlTableThead($tr) . PHP_EOL;
    }

    /**
     * @private function getTemplatesUserIndexTbody
     * @param $moduleDirname
     * @param $tableName
     * @param $tableSoleName
     * @param $language
     * @return string
     */
    private function getTemplatesUserIndexTableTBody($moduleDirname, $tableName, $tableSoleName, $language)
    {
        $hc      = Tdmcreate\Files\CreateHtmlSmartyCodes::getInstance();
        $type    = $hc->getSmartySingleVar('panel_type');
        $include = $hc->getSmartyIncludeFileListForeach($moduleDirname, $tableName, $tableSoleName);
        $div     = $hc->getHtmlDiv($include, 'panel panel-' . $type);
        $cont    = $hc->getHtmlTableData($div) . PHP_EOL;
        $html    = $hc->getHtmlEmpty('</tr><tr>') . PHP_EOL;
        $cont    .= $hc->getSmartyConditions($tableSoleName . '.count', ' is div by ', '$divideby', $html) . PHP_EOL;
        $foreach = $hc->getSmartyForeach($tableSoleName, $tableName, $cont) . PHP_EOL;
        $tr      = $hc->getHtmlTableRow($foreach) . PHP_EOL;

        return $hc->getHtmlTableTbody($tr) . PHP_EOL;
    }

    /**
     * @private function getTemplatesUserIndexTfoot
     * @return string
     */
    private function getTemplatesUserIndexTableTfoot()
    {
        $hc = Tdmcreate\Files\CreateHtmlSmartyCodes::getInstance();
        $td = $hc->getHtmlTableData('&nbsp;') . PHP_EOL;
        $tr = $hc->getHtmlTableRow($td) . PHP_EOL;

        return $hc->getHtmlTableTfoot($tr) . PHP_EOL;
    }

    /**
     * @public function getTemplatesUserIndexBodyDefault
     * @param $module
     * @param $table
     * @param $language
     * @return bool|string
     */
    public function getTemplatesUserIndexBodyDefault($module, $table, $language)
    {
        $moduleDirname = $module->getVar('mod_dirname');
        $tableName     = $table->getVar('table_name');
        $ret           = <<<EOT
<{if \${$tableName}Count == 0}>
<table class="table table-<{\$table_type}>">
    <thead>
        <tr class="center">
            <th><{\$smarty.const.{$language}TITLE}>  -  <{\$smarty.const.{$language}DESC}></th>
        </tr>
    </thead>
    <tbody>
        <tr class="center">
            <td class="bold pad5">
                <ul class="menu text-center">
                    <li><a href="<{\${$moduleDirname}_url}>"><{\$smarty.const.{$language}INDEX}></a></li>\n
EOT;
        $tables        = $this->getTableTables($module->getVar('mod_id'), 'table_order');
        foreach (array_keys($tables) as $i) {
            $tableName    = $tables[$i]->getVar('table_name');
            $stuTableName = mb_strtoupper($tableName);
            $ret          .= <<<EOT
                    <li><a href="<{\${$moduleDirname}_url}>/{$tableName}.php"><{\$smarty.const.{$language}{$stuTableName}}></a></li>\n
EOT;
        }
        $ret .= <<<EOT
                </ul>
				<div class="justify pad5"><{\$smarty.const.{$language}INDEX_DESC}></div>
            </td>
        </tr>
    </tbody>
    <tfoot>
    <{if \$adv != ''}>
        <tr class="center"><td class="center bold pad5"><{\$adv}></td></tr>
    <{else}>
        <tr class="center"><td class="center bold pad5">&nbsp;</td></tr>
    <{/if}>
    </tfoot>
</table>
<{/if}>\n
EOT;

        return $ret;
    }

    /**
     * @public function getTemplateUserIndexCategories
     * @param $moduleDirname
     * @param $tableName
     * @param $tableSoleName
     * @param $language
     * @return bool|string
     */
    public function getTemplateUserIndexCategories($moduleDirname, $tableName, $tableSoleName, $language)
    {
        $stuTableName = mb_strtoupper($tableName);
        $ret          = <<<EOT
<{if \${$tableName}Count > 0}>
<div class="table-responsive">
    <table class="table table-<{\$table_type}>">
		<thead>
			<tr>
				<th colspan="<{\$numb_col}>"><{\$smarty.const.{$language}{$stuTableName}}></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<{foreach item={$tableSoleName} from=\${$tableName}}>
				<td>
					<{include file="db:{$moduleDirname}_{$tableName}_list.tpl" {$tableSoleName}=\${$tableSoleName}}>
				</td>
			<{if \${$tableSoleName}.count is div by \$numb_col}>
			</tr><tr>
			<{/if}>
				<{/foreach}>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="<{\$numb_col}>" class="{$tableSoleName}-thereare"><{\$lang_thereare}></td>
			</tr>
		</tfoot>
	</table>
</div>
<{/if}>\n
EOT;
        $hc           = Tdmcreate\Files\CreateHtmlSmartyCodes::getInstance();
        $single       = $hc->getSmartySingleVar('table_type');
        $table        = $this->getTemplatesUserIndexTableThead($tableName, $language);
        $table        .= $this->getTemplatesUserIndexTableTBody($moduleDirname, $tableName, $tableSoleName, $language);
        $table        .= $hc->getHtmlTable($table, 'table table-' . $single) . PHP_EOL;
        $div          = $hc->getHtmlDiv($table, 'table-responsive') . PHP_EOL;

        return $ret/*$hc->getSmartyConditions($tableName, ' > ', '0', $div, false, true)*/ . PHP_EOL;
    }

    /**
     * @public function getTemplateUserIndexTable
     * @param $moduleDirname
     * @param $tableName
     * @param $tableSoleName
     * @param $language
     * @return bool|string
     */
    public function getTemplateUserIndexTable($moduleDirname, $tableName, $tableSoleName, $language)
    {
        $ret = <<<EOT
<{if \${$tableName}Count > 0}>
	<!-- Start Show new {$tableName} in index -->
	<div class="{$moduleDirname}-linetitle"><{\$smarty.const.{$language}INDEX_LATEST_LIST}></div>
	<table class="table table-<{\$table_type}>">
		<tr>
			<!-- Start new link loop -->
			<{section name=i loop=\${$tableName}}>
				<td class="col_width<{\$numb_col}> top center">
					<{include file="db:{$moduleDirname}_{$tableName}_list.tpl" {$tableSoleName}=\${$tableName}[i]}>
				</td>
	<{if \${$tableName}[i].count is div by \$divideby}>
		</tr><tr>
	<{/if}>
			<{/section}>
	<!-- End new link loop -->
		</tr>
	</table>
<!-- End Show new files in index -->
<{/if}>\n
EOT;

        return $ret;
    }

    /**
     * @public function getTemplateUserIndexFooter
     * @param $moduleDirname
     * @return bool|string
     */
    public function getTemplateUserIndexFooter($moduleDirname)
    {
        $hc = Tdmcreate\Files\CreateHtmlSmartyCodes::getInstance();

        return $hc->getSmartyIncludeFile($moduleDirname, 'footer');
    }

    /**
     * @public function render
     * @param null
     * @return bool|string
     */
    public function render()
    {
        $module        = $this->getModule();
        $table         = $this->getTable();
        $tables        = $this->getTableTables($module->getVar('mod_id'), 'table_order');
        $filename      = $this->getFileName();
        $moduleDirname = $module->getVar('mod_dirname');
        $language      = $this->getLanguage($moduleDirname, 'MA');
        $content       = $this->getTemplateUserIndexHeader($moduleDirname);
        $content       .= $this->getTemplatesUserIndexBodyDefault($module, $table, $language);
        foreach (array_keys($tables) as $t) {
            $tableName       = $tables[$t]->getVar('table_name');
            $tableSoleName   = $tables[$t]->getVar('table_solename');
            $tableCategory[] = $tables[$t]->getVar('table_category');
            $tableFieldname  = $tables[$t]->getVar('table_fieldname');
            $tableIndex[]    = $tables[$t]->getVar('table_index');
            if (in_array(1, $tableCategory, true) && in_array(1, $tableIndex)) {
                $content .= $this->getTemplateUserIndexCategories($moduleDirname, $tableName, $tableSoleName, $language);
            }
            if (in_array(0, $tableCategory, true) && in_array(1, $tableIndex)) {
                $content .= $this->getTemplateUserIndexTable($moduleDirname, $tableName, $tableSoleName, $language);
            }
        }
        $content  .= $this->getTemplateUserIndexFooter($moduleDirname);
        $tdmcfile = Tdmcreate\Files\CreateFile::getInstance();
        $tdmcfile->create($moduleDirname, 'templates', $filename, $content, _AM_TDMCREATE_FILE_CREATED, _AM_TDMCREATE_FILE_NOTCREATED);

        return $tdmcfile->renderFile();
    }
}
