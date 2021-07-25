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
            <button class="media-info-additional-button" style="
                       top: {{ $additional->parent_y }}%;
                       left: {{ $additional->parent_x }}%;"
                    onclick="showMoreInfo({{ $additional->getKey() }})">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 45.999 45.999" xml:space="preserve">
                <path d="M39.264,6.736c-8.982-8.981-23.545-8.982-32.528,0c-8.982,8.982-8.981,23.545,0,32.528c8.982,8.98,23.545,8.981,32.528,0
                C48.245,30.281,48.244,15.719,39.264,6.736z M25.999,33c0,1.657-1.343,3-3,3s-3-1.343-3-3V21c0-1.657,1.343-3,3-3s3,1.343,3,3V33z
                M22.946,15.872c-1.728,0-2.88-1.224-2.844-2.735c-0.036-1.584,1.116-2.771,2.879-2.771c1.764,0,2.88,1.188,2.917,2.771
                C25.897,14.648,24.746,15.872,22.946,15.872z"/>
            </svg>
            </button>
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
