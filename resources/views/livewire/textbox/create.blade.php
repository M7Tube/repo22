<div>
    @if ($categoryCount != 0)
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4"><a href="{{ route('dashboard') }}"
                                    class="btn btn-outline-secondary"><i class="bi bi-skip-backward-fill"></i></a><span
                                    class="mx-5">Create Text Box</span>
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
                            <form wire:submit.prevent="create">
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
                                                                            <select wire:model="category_id"
                                                                                class="form-control">
                                                                                <option value="0" selected>Choose The
                                                                                    Category</option>
                                                                                @foreach ($categorys as $category)
                                                                                    <option
                                                                                        value="{{ $category->category_id }}">
                                                                                        {{ $category->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <span class="text-danger">
                                                                                @error('category_id')
                                                                                    {{ $message }}
                                                                                @enderror
                                                                            </span>
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
                                                                                                <b>{{ $prev['name'] }}</b>
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
                                                                                wire:model="name" autocomplete="off"
                                                                                value="{{ old('name') }}" />
                                                                            <span class="text-danger">
                                                                                @error('name')
                                                                                    {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                            <label for="inputName">Name <i
                                                                                    class="bi bi-patch-question"></i></label>
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
                                                            <div class="col-6">
                                                                <div class="form-floating mb-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" id="inputwith_visit_type" type="checkbox"
                                                                            placeholder="Mohammed S" wire:model="is_required"
                                                                            autocomplete="off" value="{{ old('is_required') }}" />
                                                                        <label for="inputdesc" class="form-check-label">Required ?</label>
                                                                    </div>
                                                                    <span class="text-danger">
                                                                        @error('is_required')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-floating mb-3">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" id="inputwith_visit_type" type="checkbox"
                                                                            placeholder="Mohammed S" wire:model="is_number"
                                                                            autocomplete="off" value="{{ old('is_number') }}" />
                                                                        <label for="inputdesc" class="form-check-label">Number Field ?</label>
                                                                    </div>
                                                                    <span class="text-danger">
                                                                        @error('is_number')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </span>
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
