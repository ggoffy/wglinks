<!-- Header -->
<{include file='db:wglinks_admin_header.tpl'}>

<div class="floatleft">
    <div class="xo-buttons">
        <a class="ui-corner-all tooltip" href="link.php?op=new" title="<{$smarty.const._AM_WGLINKS_ADD_LINK}>"><i class='fa fa-plus-square wglinks-i'></i><{$smarty.const._AM_WGLINKS_ADD_LINK}></a>
        &nbsp;
        <a class="ui-corner-all tooltip" href="link.php?op=check_urls" title="<{$smarty.const._AM_WGLINKS_VALIDATE_LINK}>"><i class='fa fa-list-check wglinks-i'></i><{$smarty.const._AM_WGLINKS_VALIDATE_LINK}></a>
    </div>
</div>

<{if $links_list|default:false}>
    <table class='outer' id='sortable'>
        <thead>
            <tr class="head">
                <{if $links_count|default:0 > 1}>
                    <th class="center">&nbsp;</th>
                <{/if}>
                <{if $links_listcheck|default:false}>
                    <th class="center"><{$smarty.const._AM_WGLINKS_CHECK_RESULT}></th>
                <{/if}>
                <th class="center"><{$smarty.const._AM_WGLINKS_LINK_ID}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_LINK_NAME}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_LINK_TOOLTIP}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_LINK_DETAIL}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_LINK_URL}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_LINK_CONTACT}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_LINK_EMAIL}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_LINK_PHONE}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_LINK_ADDRESS}></th>              
                <th class="center"><{$smarty.const._AM_WGLINKS_LINK_LOGO}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_LINK_STATE}></th>
                <th class="center"><{$smarty.const._MD_WGLINKS_LINK_TYPE}></th>
                <th class="center"><{$smarty.const._MD_WGLINKS_LINK_TARGET}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_SUBMITTER}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_DATE_CREATED}></th>
                <th class="center width5"><{$smarty.const._AM_WGLINKS_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $links_count|default:0}>
            <!-- <tbody id="links-list"> -->
            <tbody>
                <{foreach item=link from=$links_list}>
                    <{if $link.new_cat|default:0 > 0}>
                        <tr class="even">
                            <td class="left" colspan="<{if $link.check_icon|default:''}>18<{else}>17<{/if}>"><{$link.catname|default:''}></td>
                        </tr>
                    <{/if}>
                    <tr class="<{cycle values="odd, even"}>"  id="lorder_<{$link.id}>">
                        <{if $links_count|default:0 > 1}>
                            <td class="center"><i class='fa fa-up-down wglinks-icon-sortable'></i></td>
                        <{/if}>
                        <{if $links_listcheck|default:false}>
                            <td class='center'>
                                <{if $link.check_icon|default:false}>
                                    <{if $link.check_icon|default:'' == 'ok'}>
                                        <i class="fa-regular fa-circle-check wglinks-i-success"></i>
                                    <{else}>
                                        <i class="fa-solid fa-triangle-exclamation wglinks-i-warning"></i>
                                    <{/if}>
                                    <{$smarty.const._AM_WGLINKS_CHECK_RESULT_STATUS}>: <{$link.check_status}><br>
                                    <{$smarty.const._AM_WGLINKS_CHECK_RESULT_TEXT}>: <{$link.check_result}><br>
                                <{/if}>
                            </td>
                        <{/if}>
                        <td class='center'><{$link.id}></td>
                        <td class=""><{$link.name|default:''}></td>
                        <td class=""><{$link.tooltip|default:''}></td>
                        <td class=""><{$link.detail_truncated|default:''}></td>
                        <td class=""><{$link.url|default:''}></td>
                        <td class=""><{$link.contact|default:''}></td>
                        <td class=""><{$link.email|default:''}></td>
                        <td class=""><{$link.phone|default:''}></td>
                        <td class=""><{$link.address|default:''}></td>
                       
                        <td class="center">
                            <{if $link.logo|default:''}>
                                <img src="<{$wglinks_upload_url}>/images/links/thumbs/<{$link.logo|default:''}>" alt="<{$link.name|default:''}>" style="height:50px" />
                            <{/if}>
                        </td>
                        <td class="center xo-buttons">
                            <{if $link.state|default:0 == 0}>
                                <a href='link.php?op=change_state&amp;link_state=1&amp;link_id=<{$link.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._MD_WGLINKS_STATE_ONLINE}>'>
                                    <i class="fa-solid fa-eye-slash"></i></a>
                            <{/if}>
                            <{if $link.state|default:0 == 1}>
                                <a href='link.php?op=change_state&amp;link_state=0&amp;link_id=<{$link.id}>&amp;start=<{$start}>&amp;limit=<{$limit}>' title='<{$smarty.const._MD_WGLINKS_STATE_OFFLINE}>'>
                                    <i class="fa-solid fa-eye"></i></a>

                            <{/if}>
                        </td>
                        <td class="center"><{$link.type_text}></td>
                        <td class="center"><{$link.target_text}></td>
                        <td class="center"><{$link.submitter}></td>
                        <td class="center"><{$link.date_created}></td>
                        <td class="center width5 xo-buttons">
                        <a href="link.php?op=edit&amp;link_id=<{$link.id}>" title="<{$smarty.const._EDIT}>"><i class='fa fa-edit'></i></a>
                        <a href="link.php?op=delete&amp;link_id=<{$link.id}>" title="<{$smarty.const._DELETE}>"><i class='fa fa-trash'></i></a>
                        </td>
                    </tr>
                <{/foreach}>
            </tbody>
        <{/if}>
    </table>
<{/if}>

<{if $form|default:false}>
    <{$form}>
<{/if}>

<{if $error|default:false}>
    <div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>

<br />
<!-- Footer -->
<{include file='db:wglinks_admin_footer.tpl'}>
