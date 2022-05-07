<div>
    {{-- <a class="btn btn-primary mx-5 mt-2" href='{{ url()->previous() }}'>
                    <- back
                </a> --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4"><a href="/public/admin"
                                class="btn btn-outline-secondary"><i class="bi bi-skip-backward-fill"></i></a><span
                                class="mx-5">Create Template</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('template.store') }}" enctype='multipart/form-data' autocomplete="off"
                            method="POST">
                            @csrf
                            <div class="results">
                                @if (Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                    </div>
                                @endif
                            </div>
                            <div class="results">
                                @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputName" type="text"
                                            placeholder="Mohammed S" name="name" autocomplete="off"
                                            value="{{ old('name') }}" />
                                        <span class="text-danger">@error('name')
                                                {{ $message }}
                                            @enderror</span>
                                        <label for="inputName">Template Name</label>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="file" id="inputTemplatePicture" autocomplete="off" name="pic"
                                            class="form-control" placeholder="Template Picture"
                                            value="{{ old('pic') }}">
                                        <span class="text-danger">@error('pic')
                                                {{ $message }}
                                            @enderror</span>
                                        <label for="inputTemplatePicture">Template Icon</label>
                                    </div>
                                </div> --}}
                                <input type="hidden" name="user_id"
                                    value="{{ Session()->get('LoggedAccount')['user_id'] }}">
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
