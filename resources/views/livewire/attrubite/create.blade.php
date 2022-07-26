<div>
    @if ($categoryCount != 0)
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4"><a href="{{ route('dashboard') }}"
                                    class="btn btn-outline-secondary"><i class="bi bi-skip-backward-fill"></i></a><span
                                    class="mx-5">Create Question</span>
                                {{-- <a
                                    href="{{ route('template.index') }}" class="btn btn-outline-secondary"><i
                                        class="bi bi-skip-forward-fill"></i> Control Table</a></h3> --}}
                        </div>
                        <div class="card-body">
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
                            <form action="{{ route('attrubite.store') }}" enctype='multipart/form-data'
                                autocomplete="off" method="POST">
                                @csrf
                                {{--  --}}
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <div class="my-2 col-12">
                                            <div class="Scard card shadow-lg border-2 rounded-lg">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media">
                                                            <div class="media-body text-right">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-floating mb-3">
                                                                            <select name="category_id"
                                                                                class="form-control">
                                                                                <option value="0" selected>Choose The
                                                                                    Category</option>
                                                                                @foreach ($categorys as $category)
                                                                                    <option
                                                                                        value="{{ $category->category_id }}">
                                                                                        {{ $category->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <span
                                                                                class="text-danger">@error('category_id')
                                                                                    {{ $message }}
                                                                                @enderror</span>
                                                                            <label for="inputUsercategory">Choose The
                                                                                Category</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <div class="my-2 col-12">
                                            <div class="card shadow-lg border-2 rounded-lg">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            @if (isset($prevQuestions))
                                                                @forelse ($prevQuestions as $prev)
                                                                    <div class="col-12 col-md-6">
                                                                        <div class="form-floating mb-3">
                                                                            <div class="col-12">
                                                                                <div
                                                                                    class="Scard card shadow-lg border-2 rounded-lg">
                                                                                    <div class="card-content">
                                                                                        <div class="card-body">
                                                                                            <div class="col-12">
                                                                                                {{ $prev['name'] }}<span
                                                                                                    class="text-muted">({{ $prev->category->name }})</span><br />
                                                                                                @foreach ($prev->status as $statu)
                                                                                                    <button
                                                                                                        class="btn btn-{{ $statu['value'] }} mb-2"
                                                                                                        disabled>{{ $statu['key'] }}</button>
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <h4 class="text-center text-muted">Empty Questions
                                                                    </h4>
                                                                @endforelse
                                                            @else
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--  --}}
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <div class="my-2 col-12">
                                            <div class="Scard card shadow-lg border-2 rounded-lg">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="media">
                                                            <div class="media-body text-right">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-floating mb-3">
                                                                            <input class="form-control" id="inputName"
                                                                                type="text" placeholder="Mohammed S"
                                                                                name="name" autocomplete="off"
                                                                                value="{{ old('name') }}" />
                                                                            <span class="text-danger">@error('name')
                                                                                    {{ $message }}
                                                                                @enderror</span>
                                                                            <label for="inputName">Question <i
                                                                                    class="bi bi-patch-question"></i></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="media">
                                                            <div class="media-body text-right">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        Status <i class="bi bi-menu-button-fill"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">

                                                                            @for ($i = 0; $i <= 3; $i++)
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating mb-3">
                                                                                            <input
                                                                                                class="form-control"
                                                                                                id="inputName"
                                                                                                type="text"
                                                                                                placeholder="Mohammed S"
                                                                                                name="status[{{ $i }}][key]"
                                                                                                autocomplete="off"
                                                                                                value="{{ old('status[$i][key]') }}" />
                                                                                            <span
                                                                                                class="text-danger">@error('status')
                                                                                                    {{ $message }}
                                                                                                @enderror</span>
                                                                                            <label for="inputName">Name
                                                                                                <i
                                                                                                    class="bi bi-vector-pen"></i></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-floating mb-3">
                                                                                            <select
                                                                                                name="status[{{ $i }}][value]"
                                                                                                class="form-control">
                                                                                                <option value="0"
                                                                                                    selected>
                                                                                                    Choose The Status
                                                                                                    Color
                                                                                                    <i
                                                                                                        class="bi bi-palette-fill"></i>
                                                                                                </option>
                                                                                                <option value="success">
                                                                                                    Green</option>
                                                                                                <option value="danger">
                                                                                                    Red</option>
                                                                                                <option
                                                                                                    value="secondary">
                                                                                                    Gray</option>
                                                                                                <option value="warning">
                                                                                                    Yellow</option>
                                                                                            </select>
                                                                                            <span
                                                                                                class="text-danger">@error('department_id')
                                                                                                    {{ $message }}
                                                                                                @enderror</span>
                                                                                            <label
                                                                                                for="inputUserDepartment">Choose
                                                                                                The Status Color <i
                                                                                                    class="bi bi-palette-fill"></i></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr />
                                                                            @endfor
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="row mb-3">
                                    <input type="hidden" name="template_id"
                                        value="{{ request()->query('template_id') }}">
                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-outline-success">Create <i
                                                class="bi bi-file-plus"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container-fluid">
            <div class="row justify-content-center mx-2">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <h1 class="text-center text-capitalize m-5">There is no categories go create some</h1>
                        <a href="{{ route('category.create', ['template_id' => request()->query('template_id')]) }}"
                            {{-- https://erp-com.preview-domain.com/public --}} class="mx-auto btn btn-block w-25 btn-outline-success m-5">Create</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
