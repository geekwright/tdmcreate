<table class='width100'>  
    <tbody class="table-list">
        <{foreach item=table from=$module.tables}>
            <{if $table.id > 0}>
                <tr id="torder_<{$table.id}>" order="<{$table.order}>" class="tdmc-tables <{cycle values='even,odd'}>">
                    <td class='cell cell-width1'>&#91;<{$table.lid}>&#93;&nbsp;<img class="move" src="<{$modPathIcon16}>/drag.png" alt="<{$table.name}>" /></td>
                    <td class='cell cell-width2'><{$table.name}></td>
                    <td class='cell cell-width3'><img src="<{xoModuleIcons32}><{$table.image}>" alt="<{$table.name}>" height="30" /></td>
                    <td class='cell cell-width4'><{$table.nbfields}></td>
                    <td class='cell cell-width5'><img id="loading_img_table_admin<{$table.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>" alt="<{$smarty.const._AM_SYSTEM_LOADING}>" /><img style="cursor:pointer;" id="img_table_admin<{$table.id}>" onclick="tdmcreate_setStatus( { op: 'display_tables', table_id: <{$table.id}>, table_admin: <{if $table.admin}>0<{else}>1<{/if}> }, 'img_table_admin<{$table.id}>', 'tables.php' )" src="<{xoModuleIcons16}><{$table.admin}>.png" alt="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" title="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" />
                    </td>
                    <td class='cell cell-width6'><img id="loading_img_table_user<{$table.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>" alt="<{$smarty.const._AM_SYSTEM_LOADING}>" /><img style="cursor:pointer;" id="img_table_user<{$table.id}>" onclick="tdmcreate_setStatus( { op: 'display_tables', table_id: <{$table.id}>, table_user: <{if $table.user}>0<{else}>1<{/if}> }, 'img_table_user<{$table.id}>', 'tables.php' )" src="<{xoModuleIcons16}><{$table.user}>.png" alt="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" title="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" />
                    </td>
                    <td class='cell cell-width7'><img id="loading_img_table_blocks<{$table.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>" alt="<{$smarty.const._AM_SYSTEM_LOADING}>" /><img style="cursor:pointer;" id="img_table_blocks<{$table.id}>" onclick="tdmcreate_setStatus( { op: 'display_tables', table_id: <{$table.id}>, table_blocks: <{if $table.blocks}>0<{else}>1<{/if}> }, 'img_table_blocks<{$table.id}>', 'tables.php' )" src="<{xoModuleIcons16}><{$table.blocks}>.png" alt="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" title="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" />
                    </td>
                    <td class='cell cell-width8'><img id="loading_img_table_submenu<{$table.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>" alt="<{$smarty.const._AM_SYSTEM_LOADING}>" /><img style="cursor:pointer;" id="img_table_submenu<{$table.id}>" onclick="tdmcreate_setStatus( { op: 'display_tables', table_id: <{$table.id}>, table_submenu: <{if $table.submenu}>0<{else}>1<{/if}> }, 'img_table_submenu<{$table.id}>', 'tables.php' )" src="<{xoModuleIcons16}><{$table.submenu}>.png" alt="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" title="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" />
                    </td>
                    <td class='cell cell-width9'><img id="loading_img_table_search<{$table.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>" alt="<{$smarty.const._AM_SYSTEM_LOADING}>" /><img style="cursor:pointer;" id="img_table_search<{$table.id}>" onclick="tdmcreate_setStatus( { op: 'display_tables', table_id: <{$table.id}>, table_search: <{if $table.search}>0<{else}>1<{/if}> }, 'img_table_search<{$table.id}>', 'tables.php' )" src="<{xoModuleIcons16}><{$table.search}>.png" alt="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" title="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" />
                    </td>
                    <td class='cell cell-width10'><img id="loading_img_table_comments<{$table.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>" alt="<{$smarty.const._AM_SYSTEM_LOADING}>" /><img style="cursor:pointer;" id="img_table_comments<{$table.id}>" onclick="tdmcreate_setStatus( { op: 'display_tables', table_id: <{$table.id}>, table_comments: <{if $table.comments}>0<{else}>1<{/if}> }, 'img_table_comments<{$table.id}>', 'tables.php' )" src="<{xoModuleIcons16}><{$table.comments}>.png" alt="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" title="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" />
                    </td>
                    <td class='cell cell-width11'><img id="loading_img_table_notifications<{$table.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>" alt="<{$smarty.const._AM_SYSTEM_LOADING}>" /><img style="cursor:pointer;" id="img_table_notifications<{$table.id}>" onclick="tdmcreate_setStatus( { op: 'display_tables', table_id: <{$table.id}>, table_notifications: <{if $table.notifications}>0<{else}>1<{/if}> }, 'img_table_notifications<{$table.id}>', 'tables.php' )" src="<{xoModuleIcons16}><{$table.notifications}>.png" alt="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" title="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" />
                    </td>
                    <td class='cell cell-width12'><img id="loading_img_table_permissions<{$table.id}>" src="<{$modPathIcon16}>/spinner.gif" style="display:none;" title="<{$smarty.const._AM_SYSTEM_LOADING}>" alt="<{$smarty.const._AM_SYSTEM_LOADING}>" /><img style="cursor:pointer;" id="img_table_permissions<{$table.id}>" onclick="tdmcreate_setStatus( { op: 'display_tables', table_id: <{$table.id}>, table_permissions: <{if $table.permissions}>0<{else}>1<{/if}> }, 'img_table_permissions<{$table.id}>', 'tables.php' )" src="<{xoModuleIcons16}><{$table.permissions}>.png" alt="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" title="<{$smarty.const._AM_TDMCREATE_CHANGE_DISPLAY}>&nbsp;<{$table.name}>" />
                    </td>
                    <td class='xo-actions cell cell-width13'>
						<a href="tables.php?op=edit&amp;table_mid=<{$table.mid}>&amp;table_id=<{$table.id}>" title="<{$smarty.const._EDIT}>">
                           <img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" />
                        </a>
                        <a href="fields.php?op=edit&amp;field_mid=<{$table.mid}>&amp;field_tid=<{$table.id}>" title="<{$smarty.const._EDIT}>">
                           <img src="<{$modPathIcon16}>/editfields.png" alt="<{$smarty.const._EDIT}>" />
                        </a>
                        <a href="tables.php?op=delete&amp;table_id=<{$table.id}>" title="<{$smarty.const._DELETE}>">
                           <img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" />
                        </a>
                    </td>
                </tr>
            <{/if}>
        <{/foreach}>
    </tbody>
</table>