<nav class="nav justify-content-center" aria-label="Page navigation example">
    @if ($posts->lastPage() > 1)
        <ul class="pagination">
            <li class="page-item {{ ($posts->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $posts->url(1) }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $posts->lastPage(); $i++)
                <li class="page-item {{ ($posts->currentPage() == $i) ? ' active' : '' }}">
                    <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ ($posts->currentPage() == $posts->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $posts->url($posts->currentPage()+1) }}" >Next</a>
            </li>
        </ul>
    @endif
</nav>
