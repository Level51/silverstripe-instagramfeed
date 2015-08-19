<div id="instagram-feed">
    <% if $Posts %>
        <% loop $Posts %>
            <div class="instagram-post">
                <a href="$link" target="_blank"><img src="$images.standard_resolution.url"></a>
                <div class="meta">
                    <span class="likes">Likes: $likes.count | </span>
                    <span class="comments">Comments: $comments.count | </span>
                    <span class="datetime">$Top.getDate($caption.created_time, "%Y/%m/%d, %H:%M")</span>
                    <p>
                        $Top.stripCaption($caption.text)
                    </p>
                </div>
            </div>
        <% end_loop %>
    <% end_if %>
</div>
