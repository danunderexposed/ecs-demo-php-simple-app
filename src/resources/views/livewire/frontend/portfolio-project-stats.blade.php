<div>
    <div class="share-project action">
        <a class="first addthis_button_compact at300m" href="#" 
            addthis:url="/portfolios/{{ $project->slug ?? null }}/" 
            addthis:title="{{ $project->title }} - ArtsThread Portfolio From {{ $project->user->firstname }} {{ $project->user->surname }}" 
            addthis:url="/portfolios/{{ $project->slug ?? null }}/" 
            addthis:title="{{ $project->title }} - ArtsThread Portfolio From {{ $project->user->firstname }} {{ $project->user->surname }}" 
            data-url="/portfolios/{{ $project->slug ?? null }}/" 
            data-title="{{ $project->title }} - ArtsThread Portfolio From {{ $project->user->firstname }} {{ $project->user->surname }}" 
            title="Share {{ $project->title }} - ArtsThread Portfolio From {{ $project->user->firstname }} {{ $project->user->surname }}"><span>Share Project</span></a>
            <a title="Appreciate Project" class="appreciate main-appreciate {{ $this->isLiked($project->id) ? 'done' : ''}}" wire:click="like">{{ $this->isLiked($project->id) ? 'Appreciated!' : 'Appreciate Project' }}</a>
        <div class="clear"></div>
    </div>
    <div class="project-stats">
        <p class="views">Views&nbsp;&nbsp;<span class="bgblack projectviewcount">{{$project->views}}</span></p>
        <p class="appreciations appreciate" data-project="{{$project->id}}">Appreciations&nbsp;&nbsp;<span class="bgblack" id="projectlikecount">{{ $count }}</span></p>
        <p class="comments">Comments&nbsp;&nbsp;<span class="bgblack" id="projectcommentcount-{{$project->id}}">{{$project->comments}}</span></p>
        <div class="clear"></div>
    </div>
</div>