<div class="search-result">
    <h2><a href="{{ url($aResult['_type'] . '/' . $aResult['_source']['url']) }}">{{ $aResult['_source']['name'] }}</a>
        <small>- {{ ucfirst($aResult['_type']) }}</small>
    </h2>
    <span>{{ substr(strip_tags($aResult['_source']['description']), 0, 140) }}</span>
</div>