<div>
    @if ($message = Session::get('success'))
        <div class="col-lg-12">
            <div class="alert alert-success  alert-dismissible alert-outline fade show" role="alert">
                <strong> Success ! </strong> - {!! $message !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if ($message = Session::get('delete'))
        <div class="col-lg-12">
            <div class="alert alert-danger  alert-dismissible alert-outline fade show" role="alert">
                <strong> Delete ! </strong> - {!! $message !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif


    @if ($errors->any())
        <div class="col-lg-12">
            <div class="alert alert-danger  alert-dismissible alert-outline fade show" role="alert">
                <strong> Error ! </strong> - {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
</div>
