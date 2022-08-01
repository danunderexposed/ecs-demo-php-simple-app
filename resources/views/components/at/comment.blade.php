<div class="container comments" id="comments" x-data="{active: false}">
    <h3 @click="active = !active" :class="active ? 'active' :''">Comments <span class="downarrow">></span></h3>
    <div class="comment-slider" x-show="active">
        <div class="alert-box success nosidemargin hide main"></div>
        <div class="alert-box err nosidemargin hide main"></div>
        <div class="comment-main" id="comment-form-main" data-type="project">
            <a href="./" title="ArtsThread Profile" class="imglink"><img src="" alt="ArtsThread"
                    title="ArtsThread" /></a>
            <div class="content">
                <textarea id="comment-form" placeholder="Share your thoughts"></textarea>
                <a href="#comment" id="comment-form-button" class="update-profile-button"
                    placeholder="Share your thoughts">Post</a>
            </div>
            <div class="clear"></div>
        </div>
        @php
            $comments = [];
        @endphp
        @foreach($comments as $comment)
        <div class="comment-main" id="comment-">
            <a href="#remove" title="Remove This Comment" class="comment-delete" data-id=""
                data-projectid="'.$projectid.'"></a> }
            <a href="'.$profilelink.'" title="'.$name.' ArtsThread Profile" class="imglink"><img src="'.$image.'"
                    alt="'.$name.' ArtsThread" title="'.$name.' ArtsThread" /></a>
            <div class="content noform">
                <h6><a href="'.$profilelink.'" title="'.$name.' ArtsThread Profile" class="headerlink">'.$name.'</a>
                    <span class="date">'.$commentdate.'</span></h6>
                <p>{{$comment->comment}}</p>
                <a href="#reply" class="reply" data-id=""
                    data-projectid="'.$projectid.'">Reply</a>
            </div>
            <div class="clear"></div>
            <div class="formholder"></div>
        </div>
        @endforeach
    </div>
</div>
