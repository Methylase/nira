<li style="margin-left: {{ $level * 20 }}px;">
    <div class="comment-details">
        <h4 class="comment-author">{{$comment->name}}</h4>
        <span>{{date('d M. Y', strtotime($comment->created_at))}}</span>
        <p class="comment-description">
        {{$comment->content}}
        </p>
        <a id="{{$comment->id}}" class="reply">Reply</a>
    </div>
    <form action="{{ route('comments') }}" method="POST" id="reply{{$comment->id}}" class="reply-form mt-3">
        {{csrf_field()}}
        <input type="hidden" name="blog_id"  value="{{ $blog->id }}">
        <input type="hidden" name="parent_id"  value="{{ $comment->id }}">
        <input type="text" name="name" required class="form-control form-control-lg form-control-a mb-3" placeholder="Enter your name">
        <input type="text" name="email" required class="form-control form-control-lg form-control-a mb-3" placeholder="Enter your email">
        <textarea name="content" required class="form-control form-control-lg form-control-a mb-3" cols="45" rows="8" placeholder="Enter your comment..."></textarea>
        <button type="submit" class="btn btn-a mb-5">Send Reply</button>
    </form>
    @foreach ($comment->replies as $reply)
        @include('pages.estate._comment', ['comment' => $reply, 'level' => $level + 1])
    @endforeach
</li>


