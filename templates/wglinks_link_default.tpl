<div class='wglinks-link col-xs-12 col-sm-12'>
    <{if $link.logo|default:false}>
        <div class='row'>
        <div class='col-xs-12 col-sm-6 right'>
            <a href="<{$link.url}>" title="<{$link.tooltip|default:''}>" target="_blank">
                <img src="<{$wglinks_upload_url}>/images/links/large/<{$link.logo}>" alt="<{$link.name}>" class="wglinks-img" style="height:<{$imgheight|default:200}>px">
            </a>
        </div>
        <div class='col-xs-12 col-sm-6 left'>
            <a href="<{$link.url}>" title="<{$link.tooltip|default:''}>" target="_blank"><{$link.name}></a>
        </div>
        </div>
    <{else}>
        <a href="<{$link.url}>" title="<{$link.tooltip|default:''}>" target="_blank"><{$link.name}></a>
    <{/if}>
</div>