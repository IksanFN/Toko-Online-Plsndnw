<div class="row">
    <div class="col-md-6">
        <div class="text-secondary">
            Showing <strong class="text-body">{{ $items->firstItem() }}</strong> to <strong
                class="text-body">{{ $items->lastItem() }}</strong> of <strong
                class="text-body">{{ $items->total() }}</strong> items
        </div>
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        {{ $items->links() }}
    </div>
</div>
