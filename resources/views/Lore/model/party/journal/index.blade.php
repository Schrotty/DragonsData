<div class="container-data-index">
    <div class="index-title">Contents</div>
    <ul>
        @foreach($index as $entry)
            <li>
                <a href="{{ '#'.strtolower($entry->getValue('title')) }}">
                    <span class="index-number">{{ $loop->index + 1 }}</span>
                    <span>{{ $entry->getValue('title') }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>