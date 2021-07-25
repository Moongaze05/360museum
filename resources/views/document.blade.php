<div class="media-info" id="{{ $document->getKey() }}" style="display: none;">
    <button onclick="cross({{ $document->getKey() }})" class='media-button-cross'>
        <svg height="15px" viewBox="0 0 365.696 365.696" width="15px" xmlns="http://www.w3.org/2000/svg" ><path d="m243.1875 182.859375 113.132812-113.132813c12.5-12.5 12.5-32.765624 0-45.246093l-15.082031-15.082031c-12.503906-12.503907-32.769531-12.503907-45.25 0l-113.128906 113.128906-113.132813-113.152344c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503907-12.5 32.769531 0 45.25l113.152344 113.152344-113.128906 113.128906c-12.503907 12.503907-12.503907 32.769531 0 45.25l15.082031 15.082031c12.5 12.5 32.765625 12.5 45.246093 0l113.132813-113.132812 113.128906 113.132812c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082031c12.5-12.503906 12.5-32.769531 0-45.25zm0 0" /></svg>
    </button>
    @if($document->description !== null)
    <div class="media-description-text-left" id="toggle-text-{{ $document->getKey() }}">
        <div class="media-description-text-left-wrapper">
            <div class="media-description-text-left-header">
                <h3>"{{ $document->title }}"</h3>
                <h4>{{ $document->author }}</h4>
            </div>
            <div class="media-description-text-left-p">
                <p>{{ $document->description }}</p>
            </div>
        </div>
        <div class="media-description-text-toggler" id="toggler-text" onclick="toggleText('toggle-text-{{ $document->getKey() }}')">&#9650;</div>
    </div>
    @endif
    <div class="media-description-wrapper">
        <div class="media-description-text">
            <h3>"{{ $document->title }}"</h3>
            <h4>{{ $document->author }}</h4>
        </div>
        <div class="media-picture">
            @foreach($document->additional as $additional)
            <button class="media-info-additional" style="
                       top: {{ $additional->parent_y }}%;
                       left: {{ $additional->parent_x }}%;"
                    onclick="showMoreInfo({{ $additional->getKey() }})">a</button>
            @endforeach
            <img src="{{ $document->image }}" alt="{{ $document->title }} {{ $document->author }}" class='media-img'>
        </div>
    </div>
    @if($document->audio !== null)
        <div class="media-description-audio">
            <div class="media-description-custom-audio">
                <audio crossorigin>
                    <source src="{{ $document->audio }}" type="audio/mpeg">
                </audio>
            </div>
        </div>
    @endif
</div>
