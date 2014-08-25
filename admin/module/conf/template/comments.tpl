<h2>Разрешения</h2>

<div class="form_row">
    <div class="row">
        <div class="checkbox">
            <input id="activate-comments" type="checkbox" name="comments" action="{active-comments}" />
            <label for="activate-comments">Включить комментарии на сайте.</label>
        </div>
    </div>
</div>

<div class="form_row">
    <div class="row">
        <div class="checkbox">
            <input id="comments_guest" type="checkbox" name="comments_guest" action="{comments-guest}" />
            <label for="comments_guest">Разрешить гостям оставлять комментарии.</label>
        </div>        
    </div>
</div>

<div class="form_row" style="padding-left:20px;" req="comments_guest">
    <div class="row">
        <div class="checkbox">
            <input id="guest_comments_moderation" type="checkbox" name="guest_comments_moderation" action="{CommentsGuestMod}" />
            <label for="guest_comments_moderation">Отправлять комментарии на проверку для гостей.</label>
        </div>

    </div>
</div>

<div class="form_row">
    <div class="row">
        <div class="checkbox">
            <input id="comments_moderation" type="checkbox" name="comments_moderation" action="{commentsModAll}" />
            <label for="comments_moderation">Отправлять комментарии на проверку для пользователей.</label>
        </div>
    </div>
</div>


<div class="form_row">
    <div class="row">
        <div class="checkbox">
            <input id="comments_num_rows" type="number" name="comments_num_rows" id="comments_num_rows" value="{comments_num_rows}" style="width:25px; text-align:center" /> Комментариев на странице.
        </div>    
    </div>
</div>
