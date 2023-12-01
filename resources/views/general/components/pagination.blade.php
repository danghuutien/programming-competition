@if ($paginator->lastPage() > 1)
<nav>
	<div class="pagination__numbers pagination">
	    @if($paginator->currentPage() > 3)
	        <p class="paginate_item" data-href="{{ $paginator->url(1) }}">1</p>
	    @endif

	    @if($paginator->currentPage() > 4)
	        <p>...</p>
	    @endif

	    @foreach(range(1, $paginator->lastPage()) as $i)
	        @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
	            @if ($i == $paginator->currentPage())
	                <p class="paginate_item active" data-href="{{ $paginator->url($i) }}">{{ $i }}</p>
	            @else
	                <p class="paginate_item" data-href="{{ $paginator->url($i) }}">{{ $i }}</p>
	            @endif
	        @endif
	    @endforeach

	    @if($paginator->currentPage() < $paginator->lastPage() - 3)
	        <p>...</p>
	    @endif

	    @if($paginator->currentPage() < $paginator->lastPage() - 2)
	        <p class="paginate_item" data-href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</p>
	    @endif

	    @if ($paginator->hasMorePages())
	        <p class="paginate_item" data-href="{{ $paginator->url($paginator->currentPage()+1) }}" class="next">
				<svg xmlns="http://www.w3.org/2000/svg" width="6" height="9" viewBox="0 0 6 9" fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M0 0V9L6 4.5L0 0Z" fill="#727272"/>
				</svg>	
	        </p>
	    @else
	        <p class="paginate_item" data-href="">
				<svg xmlns="http://www.w3.org/2000/svg" width="6" height="9" viewBox="0 0 6 9" fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M0 0V9L6 4.5L0 0Z" fill="#727272"/>
				</svg>	
	        </p>
	    @endif
	</div>
</nav>
@endif