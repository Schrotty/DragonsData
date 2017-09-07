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

    <!--<ul>
        <li>
            <a href="#example">
                <span class="index-number">1</span>
                <span>Beginning</span>
            </a>
        </li>

        <li>
            <a href="#midway">
                <span class="index-number">2</span>
                <span>Midway</span>
            </a>
            <ul>
                <li>
                    <a href="#example">
                        <span class="index-number">2.1</span>
                        <span>Morning</span>
                        <ul>
                            <li>
                                <a href="#example">
                                    <span class="index-number">2.1.1</span>
                                    <span>Stuff</span>
                                </a>
                            </li>
                        </ul>
                    </a>
                </li>

                <li>
                    <a href="#evening">
                        <span class="index-number">2.2</span>
                        <span>Evening</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#example">
                <span class="index-number">3</span>
                <span>God damn!</span>
            </a>
        </li>
    </ul>-->
</div>