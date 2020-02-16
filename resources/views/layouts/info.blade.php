<div class="row">
    <div class="col-2">
        <label for="id">ID</label>
        <input type="text" class="form-control" id="id"
               value="{{ $item->id }}" disabled>
    </div>
    <div class="col-5">
        <label for="created">Created at:</label>
        <input type="text" class="form-control" id="created"
               value="{{ $item->created_at }}" disabled>
    </div>
    <div class="col-5">
        <label for="updated">Updated at:</label>
        <input type="text" class="form-control" id="updated"
               value="{{ $item->updated_at }}" disabled>
    </div>
</div>
<hr/>
