@if(Session::has('success'))
    <div class="alert alert-icon-left alert-arrow-left alert-success alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Well done!</strong>
        {{Session::get('success')}}
    </div>
@endif
