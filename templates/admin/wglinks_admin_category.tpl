<!-- Header -->
<{include file='db:wglinks_admin_header.tpl'}>

<{if $categories_list|default:false}>
    <table class='outer' id='<{if $categories_count|default:0 > 1}>sortable<{/if}>'>
        <thead>
            <tr class="head">
                <{if $categories_count|default:0 > 1}>
                    <th class="center">&nbsp;</th>
                <{/if}>
                <th class="center"><{$smarty.const._AM_WGLINKS_CAT_ID}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_CAT_NAME}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_CAT_DESC}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_SUBMITTER}></th>
                <th class="center"><{$smarty.const._AM_WGLINKS_DATE_CREATED}></th>
                <th class="center width5"><{$smarty.const._AM_WGLINKS_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $categories_count|default:0}>
            <tbody><{foreach item=category from=$categories_list}>
                <tr class="<{cycle values="odd, even"}>" id="corder_<{$category.id}>">
                    <{if $categories_count|default:0 > 1}>
                        <td class="center"><i class='fa fa-up-down wglinks-icon-sortable'></i></td>
                    <{/if}>
                    <td class='center'><{$category.id}></td>
                    <td class=""><{$category.name}></td>
                    <td class=""><{$category.desc|default:''}></td>
                    <td class="center"><{$category.submitter}></td>
                    <td class="center"><{$category.date_created}></td>
                    <td class="center width5 xo-buttons">
                        <a href="category.php?op=edit&amp;cat_id=<{$category.id}>" title="<{$smarty.const._EDIT}>"><i class='fa fa-edit'></i></a>
                        <a href="category.php?op=delete&amp;cat_id=<{$category.id}>" title="<{$smarty.const._DELETE}>"><i class='fa fa-trash'></i></a>
                    </td>
                </tr>
            <{/foreach}></tbody>
        <{/if}>
    </table>
<{/if}>

<{if $form|default:false}>
    <{$form}>
<{/if}>

<{if $error|default:false}>
    <div class="errorMsg"><strong><{$error}></strong>
</div>

<{/if}>

<br />
<!-- Footer -->
<{include file='db:wglinks_admin_footer.tpl'}>
