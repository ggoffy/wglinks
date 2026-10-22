<ul class="nav flex-column nav-pills nav-stacked wglinks-block-ul">
    <{foreach item=link from=$block}>
        <li class="wglinks-block-li">
            <a class="wglinks-block-link" href="<{$link.href}>" title="<{$link.tooltip|default:''}>" target="<{$link.link_target|default:'_self'}>">
                <{if $link.logo|default:false}>
                    <img src="<{$wglinks_upload_url}>/images/links/thumbs/<{$link.logo}>" alt="<{$link.tooltip|default:''}>" class="wglinks-block-img" style="max-height:<{$imgheight}>">
                <{/if}>
                <{if $link.tooltip|default:''}>
                    <{$link.tooltip|default:''}>
                <{/if}>
            </a>
        </li>
    <{/foreach}>
</ul>