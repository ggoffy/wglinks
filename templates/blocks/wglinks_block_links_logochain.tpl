<{if $block}>
    <div class="row wglinks-block-logochain center">
        <{foreach item=link from=$block}>
            <{if $link.url}><a href="<{$link.url}>" title="<{$link.tooltip}>" target="_blank"><{/if}>
                <img src="<{$wglinks_upload_url}>/images/links/thumbs/<{$link.logo}>" alt="<{$link.name}>" class="wglinks-block-img" style="height:<{$imgheight}>px">
            <{if $link.url}></a><{/if}>
        <{/foreach}>
    </div>
<{/if}>